<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';

$search = trim($_GET['search'] ?? '');
$buscar_tipo = isset($_GET['buscar_tipo']) ? $_GET['buscar_tipo'] : 'libros'; // 'libros' o 'usuarios'
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$edad = isset($_GET['edad']) ? (int)$_GET['edad'] : 0;
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';

$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre");

if ($buscar_tipo === 'usuarios') {
    $sql = "SELECT u.id_usuarios, u.nombre, u.avatar, u.bio, COUNT(l.id_libros) AS libros_publicados, COUNT(s.seguidor_id) AS seguidores
            FROM usuarios u
            LEFT JOIN libros l ON l.usuario_id = u.id_usuarios
            LEFT JOIN seguidores s ON s.seguido_id = u.id_usuarios
            WHERE 1=1";
    if ($search !== '') {
        $safe_search = $conexion->real_escape_string($search);
        $sql .= " AND u.nombre LIKE '%$safe_search%'";
    }
    $sql .= " GROUP BY u.id_usuarios, u.nombre, u.avatar, u.bio ORDER BY u.nombre ASC";
} else {
    $sql = "SELECT l.id_libros, l.titulo, u.nombre AS autor, l.portada, l.precio, l.edad_recomendada, l.estado, c.nombre AS categoria, 
                   COALESCE(AVG(v.puntuacion), 0) AS promedio, COUNT(v.id_valoracion) AS votos 
            FROM libros l 
            JOIN usuarios u ON l.usuario_id = u.id_usuarios 
            LEFT JOIN categorias c ON l.categoria_id = c.id_categorias 
            LEFT JOIN valoraciones v ON v.libro_id = l.id_libros 
            WHERE 1=1";

    if ($search !== '') {
        $safe_search = $conexion->real_escape_string($search);
        $sql .= " AND (l.titulo LIKE '%$safe_search%' OR u.nombre LIKE '%$safe_search%')";
    }

    if ($categoria_id > 0) {
        $sql .= " AND l.categoria_id = $categoria_id";
    }

    if ($tipo === 'gratis') {
        $sql .= " AND l.precio = 0";
    } elseif ($tipo === 'premium') {
        $sql .= " AND l.precio > 0";
    }

    if ($edad > 0) {
        $sql .= " AND l.edad_recomendada <= $edad";
    }

    if (in_array($estado, ['en_proceso', 'completado'])) {
        $sql .= " AND l.estado = '$estado'";
    }

    $sql .= " GROUP BY l.id_libros, l.titulo, u.nombre, l.portada, l.precio, l.edad_recomendada, l.estado, c.nombre 
              ORDER BY l.fecha_creacion DESC";
}

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<section class="section">
    <div class="container">
        <h2 class="section-title">Catálogo de Libros</h2>

        <form action="catalogo.php" method="GET" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 25px;">
            <div>
                <label style="margin-right: 10px;"><input type="radio" name="buscar_tipo" value="libros" <?php echo $buscar_tipo === 'libros' ? 'checked' : ''; ?>> Libros</label>
                <label><input type="radio" name="buscar_tipo" value="usuarios" <?php echo $buscar_tipo === 'usuarios' ? 'checked' : ''; ?>> Usuarios</label>
            </div>
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="search" placeholder="Buscar por <?php echo $buscar_tipo === 'usuarios' ? 'usuario' : 'libro o autor'; ?>" value="<?php echo htmlspecialchars($search); ?>" style="width:100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc;">
            </div>
            <?php if ($buscar_tipo === 'libros'): ?>
                <div>
                    <select name="categoria" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 180px;">
                        <option value="">Todas las categorías</option>
                        <?php while ($cat = $categorias->fetch_assoc()): ?>
                            <option value="<?php echo $cat['id_categorias']; ?>" <?php echo $categoria_id === (int)$cat['id_categorias'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['nombre']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <select name="tipo" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 160px;">
                        <option value="">Todos los libros</option>
                        <option value="gratis" <?php echo $tipo === 'gratis' ? 'selected' : ''; ?>>Gratis</option>
                        <option value="premium" <?php echo $tipo === 'premium' ? 'selected' : ''; ?>>De pago</option>
                    </select>
                </div>
                <div>
                    <select name="edad" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 150px;">
                        <option value="0">Edad recomendada</option>
                        <option value="7" <?php echo $edad === 7 ? 'selected' : ''; ?>>7+</option>
                        <option value="10" <?php echo $edad === 10 ? 'selected' : ''; ?>>10+</option>
                        <option value="13" <?php echo $edad === 13 ? 'selected' : ''; ?>>13+</option>
                        <option value="16" <?php echo $edad === 16 ? 'selected' : ''; ?>>16+</option>
                        <option value="18" <?php echo $edad === 18 ? 'selected' : ''; ?>>18+</option>
                    </select>
                </div>
                <div>
                    <select name="estado" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 180px;">
                        <option value="">Cualquier estado</option>
                        <option value="en_proceso" <?php echo $estado === 'en_proceso' ? 'selected' : ''; ?>>En proceso</option>
                        <option value="completado" <?php echo $estado === 'completado' ? 'selected' : ''; ?>>Completado</option>
                    </select>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn-secondary" style="padding: 11px 20px;">Buscar</button>
        </form>

        <div class="row-cards">
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php if ($buscar_tipo === 'usuarios'): ?>
                    <?php while($usuario = $resultado->fetch_assoc()): ?>
                        <div class="small-card">
                            <a href="perfil.php?user_id=<?php echo $usuario['id_usuarios']; ?>" style="text-decoration: none; color: inherit;">
                                <?php $avatar_path = !empty($usuario['avatar']) ? (strpos($usuario['avatar'], 'img/') === 0 ? $usuario['avatar'] : 'img/' . $usuario['avatar']) : 'img/user-default.png'; ?>
                                <img src="<?php echo htmlspecialchars($avatar_path); ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                <p><strong><?php echo htmlspecialchars($usuario['nombre']); ?></strong></p>
                                <p style="font-size: 0.8rem; color: #666;"><?php echo htmlspecialchars(substr($usuario['bio'] ?? 'Sin descripción', 0, 100)); ?>...</p>
                                <p style="font-size: 0.75rem; color: #555;">Libros publicados: <?php echo $usuario['libros_publicados']; ?> • Seguidores: <?php echo $usuario['seguidores']; ?></p>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <?php while($libro = $resultado->fetch_assoc()): 
                        $l_id = $libro['id_libros'];
                        $cap_res = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $l_id ORDER BY id_capitulos ASC LIMIT 1");
                        $cap_data = $cap_res ? $cap_res->fetch_assoc() : null;
                        $link = $cap_data ? "leer.php?id=" . $cap_data['id_capitulos'] : "#";
                    ?>
                        <div class="small-card">
                            <a href="<?php echo $link; ?>" style="text-decoration: none; color: inherit;">
                                <?php $portada_path = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png'; ?>
                                <img src="<?php echo htmlspecialchars($portada_path); ?>" alt="Portada">
                                <p><strong><?php echo htmlspecialchars($libro['titulo']); ?></strong></p>
                                <p style="font-size: 0.8rem; color: var(--rosa-600);">Por: <?php echo htmlspecialchars($libro['autor']); ?></p>
                                <?php if (!empty($libro['categoria'])): ?>
                                    <p style="font-size: 0.75rem; color: #666; margin: 4px 0 0;">Categoría: <?php echo htmlspecialchars($libro['categoria']); ?></p>
                                <?php endif; ?>
                                <p style="font-size: 0.85rem; color: #222; margin: 4px 0 0; font-weight: bold;">
                                    <?php echo ($libro['precio'] > 0 ? 'Premium $' . number_format($libro['precio'], 2) : 'Gratis'); ?>
                                </p>
                                <p style="font-size: 0.75rem; color: #555; margin: 4px 0 0;">Edad recomendada: <?php echo $libro['edad_recomendada'] > 0 ? $libro['edad_recomendada'] . '+' : 'Todas'; ?> • <?php echo $libro['estado'] === 'completado' ? 'Completado' : 'En proceso'; ?></p>
                                <p style="font-size: 0.75rem; color: #555; margin: 4px 0 0;">Valoración: <?php echo number_format($libro['promedio'], 1); ?> ★ (<?php echo $libro['votos']; ?>)</p>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php else: ?>
                <p>No hay <?php echo $buscar_tipo === 'usuarios' ? 'usuarios' : 'libros'; ?> disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'partials/footer.php'; ?>
</body>
</html>