<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $conexion->query("DELETE FROM notificaciones WHERE id_notificaciones = $id AND usuario_id = $usuario_id");
}

header('Location: notificaciones.php');
exit;
?>