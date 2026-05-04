<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';

$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
$notificaciones = [];
$notif_count = 0;

if ($usuario_id) {
    $res_not = $conexion->query("SELECT id_notificaciones, mensaje, url, leida, fecha FROM notificaciones WHERE usuario_id = $usuario_id ORDER BY fecha DESC LIMIT 8");
    if ($res_not) {
        while ($fila = $res_not->fetch_assoc()) {
            $notificaciones[] = $fila;
        }
    }
    $res_count = $conexion->query("SELECT COUNT(*) AS total FROM notificaciones WHERE usuario_id = $usuario_id AND leida = 0");
    if ($res_count) {
        $row_count = $res_count->fetch_assoc();
        $notif_count = $row_count['total'] ?? 0;
    }

    $avatar_url = 'img/user-default.png';
    $res_avatar = $conexion->query("SELECT avatar FROM usuarios WHERE id_usuarios = $usuario_id LIMIT 1");
    if ($res_avatar && $res_avatar->num_rows === 1) {
        $row = $res_avatar->fetch_assoc();
        if (!empty($row['avatar'])) {
            $avatar_url = $row['avatar'];
        }
    }
}
?>
<header class="header">
    <div class="container header-inner">
        
        <div class="header-left">
            <img src="img/dragon1.png" class="logo-dragon" alt="logo">
            <h1 class="logo-text">ElRincónDelLibro</h1>
        </div>

        <nav class="nav-menu">
            <a href="index.php">Inicio</a>
            <a href="catalogo.php">Catálogo</a>
            <a href="biblioteca.php">Biblioteca</a>
            <a href="escribir.php">Escribir</a>
        </nav>

        <div class="header-right">
            <form action="catalogo.php" method="GET" class="search-box">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" name="search" placeholder="Buscar historias o autores..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            </form>

            <div class="dark-mode-switch" onclick="toggleDarkMode()" title="Cambiar modo">
                <i id="dark-icon" class="fa-solid fa-moon"></i>
            </div>

            <div class="notification-dropdown">
                <div class="notification-trigger" id="notifTrigger">
                    <i class="fa-solid fa-bell"></i>
                    <?php if ($nombre_usuario && $notif_count > 0): ?>
                        <span class="notif-count" style="position: absolute; top: -6px; right: -6px; background: #ff4757; color: white; border-radius: 50%; width: 18px; height: 18px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;"><?php echo $notif_count; ?></span>
                    <?php endif; ?>
                </div>
                <div class="notification-menu" id="notifMenu">
                    <?php if (count($notificaciones) > 0): ?>
                        <?php foreach ($notificaciones as $notif): ?>
                            <a href="notificacion.php?id=<?php echo $notif['id_notificaciones']; ?>" class="notif-item" style="display: block; padding: 10px; border-bottom: 1px solid #eee; font-size: 0.9rem; text-decoration: none; color: inherit;">
                                <p style="margin: 0 0 6px; color: #333;"><?php echo htmlspecialchars($notif['mensaje']); ?></p>
                                <span style="font-size: 0.75rem; color: #777;"><?php echo htmlspecialchars($notif['fecha']); ?></span>
                            </a>
                        <?php endforeach; ?>
                        <a href="notificaciones.php" style="display: block; text-align: center; padding: 10px 0; color: var(--rosa-700); font-weight: bold; text-decoration: none;">Ver todas</a>
                    <?php else: ?>
                        <p class="notif-empty">No tienes notificaciones</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($nombre_usuario): ?>
                <div class="user-menu">
                    <div class="user-trigger">
                        <div class="avatar-container">
                            <img src="<?php echo htmlspecialchars($avatar_url); ?>" alt="Usuario" class="img-login-header">
                        </div>
                        <span class="user-name-text"><?= htmlspecialchars($nombre_usuario) ?></span>
                        <i class="fa-solid fa-chevron-down icon-arrow"></i>
                    </div>
                    <div class="user-dropdown">
                        <a href="perfil.php">👤 Mi perfil</a>
                        <a href="mensajes.php">💬 Mensajes</a>
                        <a href="comunidad.php">👥 Comunidad</a>
                        <a href="soporte.php">🆘 Soporte</a>
                        <a href="recargar_monedas.php">💰 Recargar monedas</a>
                        <a href="ajustes.php">⚙️ Ajustes</a>
                        <hr>
                        <a href="logout.php">🚪 Cerrar sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="login-link"><i class="fa-solid fa-user"></i></a>
            <?php endif; ?>
        </div>
    </div>
</header>