<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
include 'conexion.php';
$alert = isset($_GET['status']) ? $_GET['status'] : '';
$email_usuario = '';
$user_res = $conexion->query("SELECT email FROM usuarios WHERE id_usuarios = " . (int)$_SESSION['usuario_id'] . " LIMIT 1");
if ($user_res && $user_res->num_rows > 0) {
    $email_usuario = $user_res->fetch_assoc()['email'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Soporte - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
    <div class="card-form" style="max-width: 700px; margin: 40px auto;">
        <h2 class="section-title">Centro de soporte</h2>
        <?php if ($alert === 'ok'): ?>
            <div style="background: #e6ffed; color: #1f7a3f; border: 1px solid #b7eb8f; border-radius: 10px; padding: 12px; margin-bottom: 20px;">
                Gracias por enviar tu consulta. Nuestro equipo de soporte te responderá pronto.
            </div>
        <?php endif; ?>
        <p>Si tienes un problema, comentario o sugerencia, envíanos una solicitud y te responderemos lo antes posible.</p>
        <form action="enviar_soporte.php" method="POST" style="display: grid; gap: 14px;">
            <label>
                <span>Tu correo</span>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email_usuario); ?>" required class="input-field">
            </label>
            <label>
                <span>Asunto</span>
                <input type="text" name="asunto" required class="input-field" placeholder="Breve descripción del problema">
            </label>
            <label>
                <span>Descripción</span>
                <textarea name="descripcion" rows="6" required class="input-field" placeholder="Explícanos qué ocurre..."></textarea>
            </label>
            <button type="submit" class="btn-primary">Enviar solicitud</button>
        </form>
    </div>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>
