<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: catalogo.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$libro_id = isset($_POST['libro_id']) ? (int)$_POST['libro_id'] : 0;

if ($libro_id <= 0) {
    header('Location: catalogo.php');
    exit;
}

$libro_res = $conexion->query("SELECT id_libros, titulo, usuario_id, precio FROM libros WHERE id_libros = $libro_id LIMIT 1");
if (!$libro_res || $libro_res->num_rows === 0) {
    header('Location: catalogo.php');
    exit;
}

$libro = $libro_res->fetch_assoc();
$precio = (float)$libro['precio'];
if ($libro['usuario_id'] == $usuario_id) {
    header('Location: catalogo.php');
    exit;
}

$check = $conexion->query("SELECT id_transaccion FROM transacciones WHERE usuario_id = $usuario_id AND tipo = 'libro' AND referencia_id = $libro_id LIMIT 1");
if ($check && $check->num_rows > 0) {
    header('Location: catalogo.php');
    exit;
}

$saldo_res = $conexion->query("SELECT monedas FROM usuarios WHERE id_usuarios = $usuario_id LIMIT 1");
$saldo = $saldo_res && $saldo_res->num_rows > 0 ? (float)$saldo_res->fetch_assoc()['monedas'] : 0.00;

if ($precio > 0 && $saldo < $precio) {
    header('Location: pago_libro.php?libro_id=' . $libro_id . '&error=saldo');
    exit;
}

if ($precio > 0) {
    $stmt_balance = $conexion->prepare("UPDATE usuarios SET monedas = monedas - ? WHERE id_usuarios = ?");
    $stmt_balance->bind_param('di', $precio, $usuario_id);
    $stmt_balance->execute();
}

$stmt = $conexion->prepare("INSERT INTO transacciones (usuario_id, tipo, referencia_id, monto) VALUES (?, 'libro', ?, ?)");
$stmt->bind_param('iid', $usuario_id, $libro_id, $precio);
$stmt->execute();

$mensaje = $conexion->real_escape_string("Tu libro '" . $libro['titulo'] . "' ha sido comprado.");
$conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ({$libro['usuario_id']}, '$mensaje', 'perfil.php?user_id={$libro['usuario_id']}')");

$first_chapter = $conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $libro_id ORDER BY id_capitulos ASC LIMIT 1");
$redirect = 'catalogo.php';
if ($first_chapter && $first_chapter->num_rows > 0) {
    $redirect = 'leer.php?id=' . $first_chapter->fetch_assoc()['id_capitulos'];
}

header('Location: ' . $redirect);
exit;
?>