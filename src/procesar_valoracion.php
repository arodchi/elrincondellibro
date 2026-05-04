<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$libro_id = isset($_POST['libro_id']) ? (int)$_POST['libro_id'] : 0;
$puntuacion = isset($_POST['puntuacion']) ? (int)$_POST['puntuacion'] : 0;

if ($libro_id <= 0 || $puntuacion < 1 || $puntuacion > 5) {
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    exit;
}

$sql = "INSERT INTO valoraciones (usuario_id, libro_id, puntuacion) VALUES (?, ?, ?) ";
$sql .= "ON DUPLICATE KEY UPDATE puntuacion = VALUES(puntuacion), fecha_creacion = CURRENT_TIMESTAMP";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('iii', $usuario_id, $libro_id, $puntuacion);
$stmt->execute();

$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
?>