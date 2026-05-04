<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT c.id_chat, 
               IF(c.usuario_a = $usuario_id, c.usuario_b, c.usuario_a) AS partner_id,
               u.nombre AS partner_nombre,
               (SELECT contenido FROM mensajes WHERE chat_id = c.id_chat ORDER BY fecha DESC LIMIT 1) AS ultimo_mensaje,
               (SELECT fecha FROM mensajes WHERE chat_id = c.id_chat ORDER BY fecha DESC LIMIT 1) AS fecha_ultimo
        FROM chats c
        JOIN usuarios u ON u.id_usuarios = IF(c.usuario_a = $usuario_id, c.usuario_b, c.usuario_a)
        WHERE c.usuario_a = $usuario_id OR c.usuario_b = $usuario_id
        ORDER BY fecha_ultimo DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensajes - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
    <div class="card-form">
        <h2 class="section-title">Chats</h2>
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div style="display: grid; gap: 12px;">
                <?php while ($chat = $resultado->fetch_assoc()): ?>
                    <a href="chat.php?user_id=<?php echo $chat['partner_id']; ?>" style="text-decoration: none; color: inherit;">
                        <div style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                            <div>
                                <h4 style="margin: 0; color: #333;"><?php echo htmlspecialchars($chat['partner_nombre']); ?></h4>
                                <p style="margin: 5px 0 0; color: #666; font-size: 0.95rem;">
                                    <?php echo htmlspecialchars(substr($chat['ultimo_mensaje'] ?? 'Inicia una conversación', 0, 60)); ?>
                                </p>
                            </div>
                            <span style="font-size: 0.8rem; color: #999; white-space: nowrap;">
                                <?php echo $chat['fecha_ultimo'] ? date('d/m/Y H:i', strtotime($chat['fecha_ultimo'])) : ''; ?>
                            </span>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No tienes conversaciones aún. Visita el perfil de un autor para enviar el primer mensaje.</p>
        <?php endif; ?>
    </div>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>