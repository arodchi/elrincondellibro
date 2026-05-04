<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: soporte.php');
    exit;
}
include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$email = trim($_POST['email'] ?? '');
$asunto = trim($_POST['asunto'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if (empty($email) || empty($asunto) || empty($descripcion)) {
    header('Location: soporte.php');
    exit;
}

$email_safe = $conexion->real_escape_string($email);
$asunto_safe = $conexion->real_escape_string($asunto);
$descripcion_safe = $conexion->real_escape_string($descripcion);

$sql = "INSERT INTO soporte (usuario_id, email, asunto, descripcion) VALUES ($usuario_id, '$email_safe', '$asunto_safe', '$descripcion_safe')";
$conexion->query($sql);

header('Location: soporte.php?status=ok');
exit;
?>
