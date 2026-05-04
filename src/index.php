<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';

$search = trim($_GET['search'] ?? '');
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre");

$sql_cap = "SELECT c.id_capitulos, c.titulo AS cap_titulo, l.titulo AS libro_titulo, l.portada, l.precio 
            FROM capitulos c 
            JOIN libros l ON c.libro_id = l.id_libros 
            JOIN usuarios u ON l.usuario_id = u.id_usuarios 
            WHERE 1=1";

if ($search !== '') {
    $safe_search = $conexion->real_escape_string($search);
    $sql_cap .= " AND (c.titulo LIKE '%$safe_search%' OR l.titulo LIKE '%$safe_search%' OR u.nombre LIKE '%$safe_search%')";
}

if ($categoria_id > 0) {
    $sql_cap .= " AND l.categoria_id = $categoria_id";
}

$sql_cap .= " ORDER BY c.fecha_creacion DESC LIMIT 4";
$res_cap = $conexion->query($sql_cap);

$hero_query = "SELECT l.id_libros, l.titulo, l.portada, l.precio, u.nombre AS autor, c.nombre AS categoria, COALESCE(AVG(v.puntuacion),0) AS promedio, COUNT(v.id_valoracion) AS votos
               FROM libros l
               JOIN usuarios u ON l.usuario_id = u.id_usuarios
               LEFT JOIN categorias c ON l.categoria_id = c.id_categorias
               LEFT JOIN valoraciones v ON v.libro_id = l.id_libros
               GROUP BY l.id_libros, l.titulo, l.portada, l.precio, u.nombre, c.nombre
               ORDER BY promedio DESC, votos DESC, l.fecha_creacion DESC
               LIMIT 1";
$hero_book = $conexion->query($hero_query);
$hero_book = $hero_book && $hero_book->num_rows > 0 ? $hero_book->fetch_assoc() : null;

$recomendados = $conexion->query("SELECT l.id_libros, l.titulo, l.portada, l.precio FROM libros l ORDER BY RAND() LIMIT 6");

$ultima_lectura = [];
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $lecturas_res = $conexion->query("SELECT DISTINCT c.id_capitulos, c.titulo AS capitulo, l.titulo AS libro, l.portada, a.fecha
        FROM actividad a
        JOIN capitulos c ON c.id_capitulos = a.referencia_id
        JOIN libros l ON c.libro_id = l.id_libros
        WHERE a.usuario_id = $usuario_id AND a.tipo = 'lectura_capitulo'
        ORDER BY a.fecha DESC LIMIT 4");
    if ($lecturas_res) {
        while ($row = $lecturas_res->fetch_assoc()) {
            $ultima_lectura[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ElRincónDelLibro - Inicio</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<section class="hero">
    <div class="container hero-inner">
        <?php if ($hero_book): 
            $hero_cover = !empty($hero_book['portada']) ? (strpos($hero_book['portada'], 'img/') === 0 ? $hero_book['portada'] : 'img/' . $hero_book['portada']) : 'img/Imagen_de_ejemplo.png';
            $first_chapter_res = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = " . $hero_book['id_libros'] . " ORDER BY id_capitulos ASC LIMIT 1");
            $first_chapter = ($first_chapter_res && $first_chapter_res->num_rows > 0) ? $first_chapter_res->fetch_assoc()['id_capitulos'] : null;
            $hero_link = $first_chapter ? 'leer.php?id=' . $first_chapter : 'catalogo.php';
        ?>
            <div class="hero-text">
                <h2>Top valorado: <?php echo htmlspecialchars($hero_book['titulo']); ?></h2>
                <p><?php echo htmlspecialchars($hero_book['autor']); ?> • <?php echo htmlspecialchars($hero_book['categoria']); ?> • <?php echo number_format($hero_book['promedio'], 1); ?>★</p>
                <p><?php echo $hero_book['precio'] > 0 ? 'Contenido premium por $' . number_format($hero_book['precio'], 2) : 'Acceso gratuito para todos los lectores'; ?></p>
                </br>
                <a href="<?php echo htmlspecialchars($hero_link); ?>" class="btn-primary" style="text-decoration:none;">Seguir leyendo</a>
            </div>
            <div class="hero-image">
                <img src="<?php echo htmlspecialchars($hero_cover); ?>" alt="Top valorado">
            </div>
        <?php else: ?>
            <div class="hero-text">
                <h2>Tu lugar para leer y escribir historias</h2>
                <p>Explora miles de historias, crea tus propias obras y descubre nuevos mundos.</p>
                <a href="catalogo.php" class="btn-primary" style="text-decoration:none;">Comenzar</a>
            </div>
            <div class="hero-image">
                <img src="img/Imagen_de_ejemplo.png" alt="Banner">
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Libros recomendados</h2>
        <div class="row-cards">
            <?php if ($recomendados && $recomendados->num_rows > 0): ?>
                <?php while($libro = $recomendados->fetch_assoc()): 
                    $l_id = $libro['id_libros'];
                    $cap_res = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $l_id ORDER BY id_capitulos ASC LIMIT 1");
                    $cap_data = $cap_res ? $cap_res->fetch_assoc() : null;
                    $link = $cap_data ? "leer.php?id=" . $cap_data['id_capitulos'] : "#";
                    $portada_path = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png';
                ?>
                    <div class="small-card">
                        <a href="<?php echo $link; ?>" style="text-decoration: none; color: inherit;">
                            <img src="<?php echo htmlspecialchars($portada_path); ?>" alt="Portada">
                            <p><strong><?php echo htmlspecialchars($libro['titulo']); ?></strong></p>
                            <p style="font-size: 0.8rem; color: var(--rosa-600);"><?php echo ($libro['precio'] > 0 ? 'Premium $' . number_format($libro['precio'], 2) : 'Gratis'); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay libros disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Explora por categoría</h2>
        <form action="index.php" method="GET" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 25px;">
            <select name="categoria" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 200px;">
                <option value="">Todas las categorías</option>
                <?php while ($cat = $categorias->fetch_assoc()): ?>
                    <option value="<?php echo $cat['id_categorias']; ?>" <?php echo $categoria_id === (int)$cat['id_categorias'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['nombre']); ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="search" placeholder="Buscar libro, capítulo o autor" value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; min-width: 220px; padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc;">
            <button type="submit" class="btn-secondary" style="padding: 11px 20px;">Filtrar</button>
        </form>

        <?php if (!empty($ultima_lectura)): ?>
            <h2 class="section-title">Últimas lecturas</h2>
            <div class="row-cards">
                <?php foreach ($ultima_lectura as $lectura): 
                    $portada_path = !empty($lectura['portada']) ? (strpos($lectura['portada'], 'img/') === 0 ? $lectura['portada'] : 'img/' . $lectura['portada']) : 'img/Imagen_de_ejemplo.png'; ?>
                    <div class="small-card">
                        <a href="leer.php?id=<?php echo $lectura['id_capitulos']; ?>" style="text-decoration: none; color: inherit;">
                            <img src="<?php echo htmlspecialchars($portada_path); ?>" alt="Portada">
                            <p><strong><?php echo htmlspecialchars($lectura['capitulo']); ?></strong></p>
                            <p style="font-size: 0.8rem; color: var(--rosa-600);"><?php echo htmlspecialchars($lectura['libro']); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h2 class="section-title">Últimos Capítulos Publicados</h2>
        <div class="row-cards">
            <?php if ($res_cap && $res_cap->num_rows > 0): ?>
                <?php while($cap = $res_cap->fetch_assoc()): ?>
                    <div class="small-card">
                        <a href="leer.php?id=<?php echo $cap['id_capitulos']; ?>" style="text-decoration: none; color: inherit;">
                            <div style="background: var(--rosa-50); padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 10px;">
                                <i class="fa-solid fa-book-open" style="font-size: 2rem; color: var(--rosa-600);"></i>
                            </div>
                            <p><strong><?php echo htmlspecialchars($cap['cap_titulo']); ?></strong></p>
                            <p style="font-size: 0.8rem; color: var(--rosa-400);"><?php echo htmlspecialchars($cap['libro_titulo']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay capítulos recientes.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'partials/footer.php'; ?>
</body>
</html>