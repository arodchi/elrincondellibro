<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$comentario_id = isset($_POST['comentario_id']) ? (int)$_POST['comentario_id'] : 0;
$tipo = $_POST['tipo'] ?? '';

if ($comentario_id > 0) {
    if ($tipo === 'capitulo') {
        $check = $conexion->query("SELECT usuario_id FROM comentarios WHERE id_comentarios = $comentario_id LIMIT 1");
        if ($check && $check->num_rows > 0 && $check->fetch_assoc()['usuario_id'] == $usuario_id) {
            $conexion->query("DELETE FROM comentario_likes WHERE comentario_id = $comentario_id");
            $conexion->query("DELETE FROM comentarios WHERE id_comentarios = $comentario_id");
        }
    } elseif ($tipo === 'comunidad') {
        $check = $conexion->query("SELECT usuario_id FROM comunidad_mensajes WHERE id_comunidad = $comentario_id LIMIT 1");
        if ($check && $check->num_rows > 0 && $check->fetch_assoc()['usuario_id'] == $usuario_id) {
            $conexion->query("DELETE FROM comunidad_mensajes WHERE id_comunidad = $comentario_id OR parent_id = $comentario_id");
        }
    }
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
?>