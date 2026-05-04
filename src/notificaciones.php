<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];

$notificaciones = [];
$res = $conexion->query("SELECT id_notificaciones, mensaje, url, leida, fecha FROM notificaciones WHERE usuario_id = $usuario_id ORDER BY fecha DESC");
if ($res) {
    while ($fila = $res->fetch_assoc()) {
        $notificaciones[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificaciones - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <div class="card-form">
        <h2 class="section-title">Notificaciones</h2>
        <?php if (count($notificaciones) > 0): ?>
            <div style="display: grid; gap: 12px;">
                <?php foreach ($notificaciones as $notif): ?>
                    <div style="border: 1px solid #ddd; border-radius: 10px; padding: 14px; background: <?php echo $notif['leida'] ? '#f8f9fa' : '#fff6f6'; ?>;">
                        <div style="display: flex; justify-content: space-between; gap: 10px; align-items: center;">
                            <div>
                                <a href="notificacion.php?id=<?php echo $notif['id_notificaciones']; ?>" style="color: inherit; text-decoration: none;">
                                    <p style="margin: 0 0 8px; font-weight: bold; color: #333;"><?php echo htmlspecialchars($notif['mensaje']); ?></p>
                                </a>
                                <p style="margin: 0; font-size: 0.85rem; color: #666;"><?php echo htmlspecialchars($notif['fecha']); ?></p>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <?php if ($notif['url']): ?>
                                    <a href="notificacion.php?id=<?php echo $notif['id_notificaciones']; ?>" class="btn-secondary" style="padding: 8px 12px;">Ir</a>
                                <?php endif; ?>
                                <a href="borrar_notificacion.php?id=<?php echo $notif['id_notificaciones']; ?>" class="btn-secondary" style="background: #e74c3c; color: white; padding: 8px 12px;">Eliminar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No tienes notificaciones nuevas.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>