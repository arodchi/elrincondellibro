<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$usuario_res = $conexion->query("SELECT monedas FROM usuarios WHERE id_usuarios = $usuario_id LIMIT 1");
$usuario = $usuario_res->fetch_assoc();
$monedas_actuales = $usuario['monedas'] ?? 0;

$mensaje = '';
if (isset($_GET['success'])) {
    $mensaje = '<p style="color: green;">Recarga exitosa. Tus monedas han sido actualizadas.</p>';
} elseif (isset($_GET['error'])) {
    $mensaje = '<p style="color: red;">Error en la recarga. Inténtalo de nuevo.</p>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recargar monedas - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
    <div class="card-form" style="max-width: 600px; margin: 40px auto;">
        <h2 class="section-title">Recargar monedas</h2>
        <?php echo $mensaje; ?>
        <p>Monedas actuales: <strong><?php echo number_format($monedas_actuales, 2); ?> 💰</strong></p>
        <form action="procesar_recarga.php" method="POST" style="margin-top: 20px;">
            <label for="monto">Seleccionar monto:</label>
            <select name="monto" id="monto" required style="width:100%; padding:10px; margin:10px 0;">
                <option value="1.00">1.00 $</option>
                <option value="5.00">5.00 $</option>
                <option value="10.00">10.00 $</option>
                <option value="20.00">20.00 $</option>
            </select>
            <button type="submit" class="btn-primary" style="width:100%; padding: 14px;">Recargar ahora</button>
        </form>
        <a href="perfil.php" class="btn-secondary" style="display:inline-block; margin-top: 12px; width:100%; text-align:center; text-decoration:none;">Volver al perfil</a>
    </div>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>