<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$libro_id = isset($_GET['libro_id']) ? (int)$_GET['libro_id'] : 0;
if ($libro_id <= 0) {
    header('Location: catalogo.php');
    exit;
}

$libro_res = $conexion->query("SELECT l.id_libros, l.titulo, l.precio, l.edad_recomendada, l.estado, u.nombre AS autor FROM libros l JOIN usuarios u ON l.usuario_id = u.id_usuarios WHERE l.id_libros = $libro_id LIMIT 1");
if (!$libro_res || $libro_res->num_rows === 0) {
    header('Location: catalogo.php');
    exit;
}

$libro = $libro_res->fetch_assoc();
$saldo_res = $conexion->query("SELECT monedas FROM usuarios WHERE id_usuarios = " . (int)$_SESSION['usuario_id'] . " LIMIT 1");
$saldo = $saldo_res && $saldo_res->num_rows > 0 ? (float)$saldo_res->fetch_assoc()['monedas'] : 0.00;
$error = isset($_GET['error']) && $_GET['error'] === 'saldo';
$primer_cap = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $libro_id ORDER BY id_capitulos ASC LIMIT 1");
$capitulo_id = $primer_cap && $primer_cap->num_rows > 0 ? $primer_cap->fetch_assoc()['id_capitulos'] : 0;
$cancel_link = $capitulo_id ? "leer.php?id=$capitulo_id" : 'catalogo.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagar libro - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
    <div class="card-form" style="max-width: 600px; margin: 40px auto;">
        <h2 class="section-title">Confirmar compra</h2>
        <p>Vas a comprar el libro <strong><?php echo htmlspecialchars($libro['titulo']); ?></strong> de <strong><?php echo htmlspecialchars($libro['autor']); ?></strong>.</p>
        <p>Precio: <strong>$<?php echo number_format($libro['precio'], 2); ?></strong></p>
        <p>Saldo disponible: <strong><?php echo number_format($saldo, 2); ?> monedas</strong></p>
        <?php if ($error): ?>
            <div style="background: #ffe6e6; color: #a33; padding: 12px; border-radius: 10px; margin-bottom: 16px; border: 1px solid #f5c2c7;">
                No tienes suficientes monedas. Recarga monedas o elige otro libro.
            </div>
        <?php endif; ?>
        <p>Edad recomendada: <?php echo $libro['edad_recomendada'] > 0 ? $libro['edad_recomendada'] . '+' : 'Todas las edades'; ?></p>
        <p>Estado: <?php echo $libro['estado'] === 'completado' ? 'Completado' : 'En proceso'; ?></p>
        <form action="comprar_libro.php" method="POST" style="margin-top: 20px;">
            <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">
            <button type="submit" class="btn-primary" style="width:100%; padding: 14px;">Pagar ahora</button>
        </form>
        <a href="<?php echo htmlspecialchars($cancel_link); ?>" class="btn-secondary" style="display:inline-block; margin-top: 12px; width:100%; text-align:center; text-decoration:none;">Cancelar</a>
    </div>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>
