<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: notificaciones.php');
    exit;
}

$sql = "SELECT url FROM notificaciones WHERE id_notificaciones = $id AND usuario_id = $usuario_id LIMIT 1";
$res = $conexion->query($sql);
if (!$res || $res->num_rows === 0) {
    header('Location: notificaciones.php');
    exit;
}

$notificacion = $res->fetch_assoc();
$conexion->query("UPDATE notificaciones SET leida = 1 WHERE id_notificaciones = $id AND usuario_id = $usuario_id");

$url = $notificacion['url'] ?: 'notificaciones.php';
header('Location: ' . $url);
exit;
?>