<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = isset($_SESSION['usuario_id']) ? (int)$_SESSION['usuario_id'] : 0;
$accion = $_POST['accion'] ?? '';

if ($accion === 'favorito') {
    $libro_id = isset($_POST['libro_id']) ? (int)$_POST['libro_id'] : 0;
    if ($libro_id > 0) {
        $exists_res = $conexion->query("SELECT id_favoritos FROM favoritos WHERE usuario_id = $usuario_id AND libro_id = $libro_id LIMIT 1");
        if ($exists_res && $exists_res->num_rows > 0) {
            $conexion->query("DELETE FROM favoritos WHERE usuario_id = $usuario_id AND libro_id = $libro_id");
        } else {
            $sql = "INSERT IGNORE INTO favoritos (usuario_id, libro_id) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $libro_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $sql_autor = "SELECT usuario_id, titulo FROM libros WHERE id_libros = ?";
                $stmt2 = $conexion->prepare($sql_autor);
                $stmt2->bind_param("i", $libro_id);
                $stmt2->execute();
                $res_autor = $stmt2->get_result();
                if ($res_autor && $res_autor->num_rows === 1) {
                    $libro = $res_autor->fetch_assoc();
                    if ($libro['usuario_id'] != $usuario_id) {
                        $mensaje = $conexion->real_escape_string("Tu libro '" . $libro['titulo'] . "' ha recibido un nuevo favorito.");
                        $url = $conexion->real_escape_string('leer.php?id=' . ($conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $libro_id ORDER BY id_capitulos ASC LIMIT 1")->fetch_assoc()['id_capitulos'] ?? ''));
                        $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ({$libro['usuario_id']}, '$mensaje', '$url')");
                    }
                }
            }
        }
    }
}

if ($accion === 'seguir') {
    $seguido_id = isset($_POST['seguido_id']) ? (int)$_POST['seguido_id'] : 0;
    if ($seguido_id > 0 && $usuario_id !== $seguido_id) {
        $check_res = $conexion->query("SELECT id_seguidores FROM seguidores WHERE seguidor_id = $usuario_id AND seguido_id = $seguido_id LIMIT 1");
        if ($check_res && $check_res->num_rows > 0) {
            $conexion->query("DELETE FROM seguidores WHERE seguidor_id = $usuario_id AND seguido_id = $seguido_id");
        } else {
            $sql = "INSERT IGNORE INTO seguidores (seguidor_id, seguido_id) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $seguido_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $nombre_seguidor = $conexion->real_escape_string($_SESSION['usuario_nombre']);
                $mensaje = $conexion->real_escape_string("El usuario $nombre_seguidor ya te sigue.");
                $url = $conexion->real_escape_string('perfil.php?user_id=' . $usuario_id);
                $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ($seguido_id, '$mensaje', '$url')");
            }
        }
    }
}

if ($accion === 'bloquear') {
    $bloqueado_id = isset($_POST['bloqueado_id']) ? (int)$_POST['bloqueado_id'] : 0;
    if ($bloqueado_id > 0 && $usuario_id !== $bloqueado_id) {
        $check_res = $conexion->query("SELECT id_bloqueo FROM bloqueos WHERE usuario_id = $usuario_id AND bloqueado_id = $bloqueado_id LIMIT 1");
        if ($check_res && $check_res->num_rows > 0) {
            $conexion->query("DELETE FROM bloqueos WHERE usuario_id = $usuario_id AND bloqueado_id = $bloqueado_id");
        } else {
            $sql = "INSERT IGNORE INTO bloqueos (usuario_id, bloqueado_id) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $bloqueado_id);
            $stmt->execute();
        }
    }
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit();
?>