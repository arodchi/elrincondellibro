<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) { header("Location: login.php"); exit; }
include 'conexion.php';

$u_id = $_SESSION['usuario_id'];
$mis_libros = $conexion->query("SELECT l.*, c.nombre AS categoria, COALESCE(AVG(v.puntuacion),0) AS promedio FROM libros l LEFT JOIN categorias c ON l.categoria_id = c.id_categorias LEFT JOIN valoraciones v ON v.libro_id = l.id_libros WHERE l.usuario_id = $u_id GROUP BY l.id_libros, c.nombre ORDER BY l.fecha_creacion DESC");
$libros_favoritos = $conexion->query("SELECT l.id_libros, l.titulo, l.portada FROM favoritos f JOIN libros l ON f.libro_id = l.id_libros WHERE f.usuario_id = $u_id ORDER BY f.id_favoritos DESC LIMIT 8");
$autores_seguidos = $conexion->query("SELECT u.id_usuarios, u.nombre FROM seguidores s JOIN usuarios u ON s.seguido_id = u.id_usuarios WHERE s.seguidor_id = $u_id ORDER BY s.id_seguidores DESC");
$lecturas = $conexion->query("SELECT l.id_libros, l.titulo AS libro, l.portada, c.id_capitulos, c.titulo AS capitulo, a.fecha FROM actividad a JOIN capitulos c ON c.id_capitulos = a.referencia_id JOIN libros l ON c.libro_id = l.id_libros WHERE a.usuario_id = $u_id AND a.tipo = 'lectura_capitulo' AND (l.id_libros, a.fecha) IN (SELECT l2.id_libros, MAX(a2.fecha) FROM actividad a2 JOIN capitulos c2 ON c2.id_capitulos = a2.referencia_id JOIN libros l2 ON c2.libro_id = l2.id_libros WHERE a2.usuario_id = $u_id AND a2.tipo = 'lectura_capitulo' GROUP BY l2.id_libros) ORDER BY a.fecha DESC LIMIT 8");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Biblioteca - ElRincónDelLibro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<section class="section">
    <div class="container">
        <h2 class="section-title">Mis Obras Creadas</h2>
        <div class="row-cards">
            <?php if ($mis_libros && $mis_libros->num_rows > 0): ?>
                <?php while($libro = $mis_libros->fetch_assoc()): 
                    $l_id = $libro['id_libros'];
                    $cap_res = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $l_id ORDER BY id_capitulos ASC LIMIT 1");
                    $cap = $cap_res ? $cap_res->fetch_assoc() : null;
                    $link = $cap ? "leer.php?id=" . $cap['id_capitulos'] : "escribir.php";
                    $portada = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png';
                ?>
                    <div class="small-card">
                        <a href="<?php echo $link; ?>" style="text-decoration: none; color: inherit;">
                            <img src="<?php echo htmlspecialchars($portada); ?>" alt="Portada">
                            <p><strong><?php echo htmlspecialchars($libro['titulo']); ?></strong></p>
                            <p style="font-size: 0.8rem; color: var(--rosa-600);"><?php echo ($libro['precio'] > 0 ? 'Premium $' . number_format($libro['precio'], 2) : 'Gratis'); ?></p>
                            <p style="font-size: 0.75rem; color: #555;"><?php echo htmlspecialchars($libro['categoria']); ?> • <?php echo number_format($libro['promedio'],1); ?>★</p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="text-align: center; width: 100%;">
                    <p>Aún no has creado ningún libro.</p>
                    <a href="escribir.php" class="btn-primary" style="display:inline-block; margin-top:10px; text-decoration:none;">Escribir mi primer libro</a>
                </div>
            <?php endif; ?>
        </div>

        <h2 class="section-title" style="margin-top: 40px;">Libros Favoritos</h2>
        <div class="row-cards">
            <?php if ($libros_favoritos && $libros_favoritos->num_rows > 0): ?>
                <?php while($libro = $libros_favoritos->fetch_assoc()): 
                    $portada = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png';
                    $cap_res = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = " . $libro['id_libros'] . " ORDER BY id_capitulos ASC LIMIT 1");
                    $cap = $cap_res ? $cap_res->fetch_assoc() : null;
                ?>
                    <div class="small-card">
                        <a href="<?php echo $cap ? 'leer.php?id=' . $cap['id_capitulos'] : 'catalogo.php'; ?>" style="text-decoration: none; color: inherit;">
                            <img src="<?php echo htmlspecialchars($portada); ?>" alt="Portada">
                            <p><strong><?php echo htmlspecialchars($libro['titulo']); ?></strong></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No has marcado libros como favoritos.</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title" style="margin-top: 40px;">Autores Seguidos</h2>
        <div style="display: grid; gap: 12px;">
            <?php if ($autores_seguidos && $autores_seguidos->num_rows > 0): ?>
                <?php while($autor = $autores_seguidos->fetch_assoc()): ?>
                    <a href="perfil.php?user_id=<?php echo $autor['id_usuarios']; ?>" style="text-decoration: none; color: inherit;">
                        <div style="border: 1px solid #ddd; border-radius: 10px; padding: 14px; display:flex; justify-content:space-between; align-items:center;">
                            <span><?php echo htmlspecialchars($autor['nombre']); ?></span>
                            <i class="fa-solid fa-chevron-right" style="color:#999;"></i>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Aún no sigues a ningún autor.</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title" style="margin-top: 40px;">Historial de Lectura</h2>
        <div class="row-cards">
            <?php if ($lecturas && $lecturas->num_rows > 0): ?>
                <?php while($entrada = $lecturas->fetch_assoc()): 
                    $portada = !empty($entrada['portada']) ? (strpos($entrada['portada'], 'img/') === 0 ? $entrada['portada'] : 'img/' . $entrada['portada']) : 'img/Imagen_de_ejemplo.png'; ?>
                    <div class="small-card">
                        <a href="leer.php?id=<?php echo $entrada['id_capitulos']; ?>" style="text-decoration: none; color: inherit;">
                            <img src="<?php echo htmlspecialchars($portada); ?>" alt="Portada">
                            <p><strong><?php echo htmlspecialchars($entrada['capitulo']); ?></strong></p>
                            <p style="font-size: 0.8rem; color: var(--rosa-600);"><?php echo htmlspecialchars($entrada['libro']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay lecturas recientes.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'partials/footer.php'; ?>
</body>
</html>