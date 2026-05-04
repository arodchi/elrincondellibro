<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$comentario_id = isset($_POST['comentario_id']) ? (int)$_POST['comentario_id'] : 0;

if ($comentario_id > 0) {
    $check = $conexion->query("SELECT id_like FROM comentario_likes WHERE comentario_id = $comentario_id AND usuario_id = $usuario_id LIMIT 1");
    if ($check && $check->num_rows > 0) {
        $conexion->query("DELETE FROM comentario_likes WHERE comentario_id = $comentario_id AND usuario_id = $usuario_id");
    } else {
        $conexion->query("INSERT INTO comentario_likes (comentario_id, usuario_id) VALUES ($comentario_id, $usuario_id)");
    }
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
?>