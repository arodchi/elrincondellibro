<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) { header("Location: login.php"); exit; }
include 'conexion.php';

$viewer_id = isset($_SESSION['usuario_id']) ? (int)$_SESSION['usuario_id'] : 0;
$perfil_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : $viewer_id;
$es_mi_perfil = $perfil_id === $viewer_id;

$perfil_res = $conexion->query("SELECT id_usuarios, nombre, email, avatar, bio FROM usuarios WHERE id_usuarios = $perfil_id LIMIT 1");
if (!$perfil_res || $perfil_res->num_rows === 0) {
    die('Usuario no encontrado.');
}
$perfil = $perfil_res->fetch_assoc();

$avatar_path = !empty($perfil['avatar']) ? $perfil['avatar'] : 'img/user-default.png';
$avatar_path = strpos($avatar_path, 'img/') === 0 ? $avatar_path : 'img/' . $avatar_path;

$obra_count = $conexion->query("SELECT COUNT(*) AS total FROM libros WHERE usuario_id = $perfil_id")->fetch_assoc()['total'];
$seguidores_count = $conexion->query("SELECT COUNT(*) AS total FROM seguidores WHERE seguido_id = $perfil_id")->fetch_assoc()['total'];
$seguidos_count = $conexion->query("SELECT COUNT(*) AS total FROM seguidores WHERE seguidor_id = $perfil_id")->fetch_assoc()['total'];
$leidos_count = $conexion->query("SELECT COUNT(DISTINCT referencia_id) AS total FROM actividad WHERE usuario_id = $perfil_id AND tipo = 'lectura_capitulo'")->fetch_assoc()['total'];

$es_seguido = false;
$esta_bloqueado = false;
if (!$es_mi_perfil) {
    $check_seg = $conexion->query("SELECT id_seguidores FROM seguidores WHERE seguidor_id = $viewer_id AND seguido_id = $perfil_id LIMIT 1");
    $es_seguido = $check_seg && $check_seg->num_rows > 0;
    $check_bloqueo = $conexion->query("SELECT id_bloqueo FROM bloqueos WHERE usuario_id = $viewer_id AND bloqueado_id = $perfil_id LIMIT 1");
    $esta_bloqueado = $check_bloqueo && $check_bloqueo->num_rows > 0;
}

$mis_libros = $conexion->query("SELECT l.id_libros, l.titulo, l.portada, l.precio, c.nombre AS categoria, COALESCE(AVG(v.puntuacion),0) AS promedio
    FROM libros l
    LEFT JOIN categorias c ON l.categoria_id = c.id_categorias
    LEFT JOIN valoraciones v ON v.libro_id = l.id_libros
    WHERE l.usuario_id = $perfil_id
    GROUP BY l.id_libros, l.titulo, l.portada, l.precio, c.nombre
    ORDER BY l.fecha_creacion DESC");

$libros_seguidos = [];
$ultimos_leidos = [];
if ($es_mi_perfil) {
    $fav_res = $conexion->query("SELECT l.id_libros, l.titulo, l.portada FROM favoritos f JOIN libros l ON f.libro_id = l.id_libros WHERE f.usuario_id = $viewer_id ORDER BY f.id_favoritos DESC LIMIT 6");
    if ($fav_res) {
        while ($row = $fav_res->fetch_assoc()) { $libros_seguidos[] = $row; }
    }
    $read_res = $conexion->query("SELECT DISTINCT c.id_capitulos, c.titulo AS capitulo, l.titulo AS libro, l.portada, a.fecha
        FROM actividad a
        JOIN capitulos c ON c.id_capitulos = a.referencia_id
        JOIN libros l ON c.libro_id = l.id_libros
        WHERE a.usuario_id = $viewer_id AND a.tipo = 'lectura_capitulo'
        ORDER BY a.fecha DESC LIMIT 6");
    if ($read_res) {
        while ($row = $read_res->fetch_assoc()) { $ultimos_leidos[] = $row; }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($perfil['nombre']); ?> - Perfil</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <div class="profile-layout">
        <aside class="profile-sidebar">
            <div class="profile-card">
                <div class="profile-avatar-big">
                    <img src="<?php echo htmlspecialchars($avatar_path); ?>" alt="Avatar">
                </div>
                <h2><?php echo htmlspecialchars($perfil['nombre']); ?></h2>
                <p class="user-role"><?php echo $es_mi_perfil ? 'Tu perfil personal' : 'Perfil del autor'; ?></p>
                <?php if (!$es_mi_perfil): ?>
                    <form action="procesar_interaccion.php" method="POST" style="margin-top: 12px; display:inline-block; width:100%;">
                        <input type="hidden" name="seguido_id" value="<?php echo $perfil_id; ?>">
                        <button type="submit" name="accion" value="seguir" class="btn-primary" style="width:100%;">
                            <?php echo $es_seguido ? 'Dejar de seguir' : 'Seguir autor'; ?>
                        </button>
                    </form>
                    <a href="chat.php?user_id=<?php echo $perfil_id; ?>" class="btn-secondary" style="display:block; margin-top:10px; text-align:center;">Enviar mensaje</a>
                    <form action="procesar_interaccion.php" method="POST" style="margin-top: 10px; display:inline-block; width:100%;">
                        <input type="hidden" name="bloqueado_id" value="<?php echo $perfil_id; ?>">
                        <button type="submit" name="accion" value="bloquear" class="btn-secondary" style="width:100%; background: <?php echo $esta_bloqueado ? '#6c757d' : '#ff4757'; ?>; color: white; border-color: transparent;">
                            <?php echo $esta_bloqueado ? 'Desbloquear usuario' : 'Bloquear usuario'; ?>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </aside>

        <main class="profile-main">
            <div class="card-form">
                <h3 class="section-title">Sobre <?php echo htmlspecialchars($perfil['nombre']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($perfil['bio'] ?? 'No hay descripción disponible.')); ?></p>
                <?php if ($es_mi_perfil): ?>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($perfil['email']); ?></p>
                <?php endif; ?>
            </div>

            <div class="card-form" style="margin-top: 20px;">
                <h3 class="section-title">Estadísticas</h3>
                <div class="activity-stats">
                    <div class="stat-box">
                        <i class="fa-solid fa-book-open"></i>
                        <span><?php echo intval($leidos_count); ?></span>
                        <label>Libros leídos</label>
                    </div>
                    <div class="stat-box">
                        <i class="fa-solid fa-pen-nib"></i>
                        <span><?php echo intval($obra_count); ?></span>
                        <label>Obras publicadas</label>
                    </div>
                    <div class="stat-box">
                        <i class="fa-solid fa-heart"></i>
                        <span><?php echo intval($seguidores_count); ?></span>
                        <label>Seguidores</label>
                    </div>
                    <div class="stat-box">
                        <i class="fa-solid fa-user-check"></i>
                        <span><?php echo intval($seguidos_count); ?></span>
                        <label>Seguidos</label>
                    </div>
                </div>
            </div>

            <div class="card-form" style="margin-top: 20px;">
                <h3 class="section-title"><?php echo $es_mi_perfil ? 'Tus libros' : 'Obras del autor'; ?></h3>
                <div class="row-cards">
                    <?php if ($mis_libros && $mis_libros->num_rows > 0): ?>
                        <?php while($libro = $mis_libros->fetch_assoc()): 
                            $portada_path = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png';
                            $primer_cap = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = " . $libro['id_libros'] . " ORDER BY id_capitulos ASC LIMIT 1");
                            $cap_id = $primer_cap && $primer_cap->num_rows > 0 ? $primer_cap->fetch_assoc()['id_capitulos'] : null; ?>
                            <div class="small-card">
                                <a href="<?php echo $cap_id ? 'leer.php?id=' . $cap_id : 'escribir.php'; ?>" style="text-decoration: none; color: inherit;">
                                    <img src="<?php echo htmlspecialchars($portada_path); ?>" alt="Portada">
                                    <p><strong><?php echo htmlspecialchars($libro['titulo']); ?></strong></p>
                                    <p style="font-size: 0.8rem; color: var(--rosa-600);"><?php echo ($libro['precio'] > 0 ? 'Premium $' . number_format($libro['precio'], 2) : 'Gratis'); ?></p>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No hay libros publicados aún.</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($es_mi_perfil): ?>
                <div class="card-form" style="margin-top: 20px;">
                    <h3 class="section-title">Libros que sigues</h3>
                    <div class="row-cards">
                        <?php if (count($libros_seguidos) > 0): ?>
                            <?php foreach ($libros_seguidos as $libro): 
                                $portada_path = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png';
                                $primer_cap = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = " . $libro['id_libros'] . " ORDER BY id_capitulos ASC LIMIT 1");
                                $cap_id = $primer_cap && $primer_cap->num_rows > 0 ? $primer_cap->fetch_assoc()['id_capitulos'] : null; ?>
                                <div class="small-card">
                                    <a href="<?php echo $cap_id ? 'leer.php?id=' . $cap_id : 'catalogo.php'; ?>" style="text-decoration: none; color: inherit;">
                                        <img src="<?php echo htmlspecialchars($portada_path); ?>" alt="Portada">
                                        <p><strong><?php echo htmlspecialchars($libro['titulo']); ?></strong></p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aún no sigues libros.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-form" style="margin-top: 20px;">
                    <h3 class="section-title">Lecturas recientes</h3>
                    <div class="row-cards">
                        <?php if (count($ultimos_leidos) > 0): ?>
                            <?php foreach ($ultimos_leidos as $entrada): 
                                $portada_path = !empty($entrada['portada']) ? (strpos($entrada['portada'], 'img/') === 0 ? $entrada['portada'] : 'img/' . $entrada['portada']) : 'img/Imagen_de_ejemplo.png'; ?>
                                <div class="small-card">
                                    <a href="leer.php?id=<?php echo $entrada['id_capitulos']; ?>" style="text-decoration: none; color: inherit;">
                                        <img src="<?php echo htmlspecialchars($portada_path); ?>" alt="Portada">
                                        <p><strong><?php echo htmlspecialchars($entrada['capitulo']); ?></strong></p>
                                        <p style="font-size: 0.8rem; color: var(--rosa-600);"><?php echo htmlspecialchars($entrada['libro']); ?></p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No has registrado lecturas recientes.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>