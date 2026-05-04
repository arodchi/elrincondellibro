<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $capitulo_id = isset($_POST['capitulo_id']) ? (int)$_POST['capitulo_id'] : 0;
    $contenido = trim($_POST['contenido'] ?? '');

    if ($capitulo_id > 0 && !empty($contenido)) {
        $parent_id = isset($_POST['parent_id']) && is_numeric($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
        if ($parent_id > 0) {
            $sql = "INSERT INTO comentarios (usuario_id, capitulo_id, parent_id, contenido) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iiis", $usuario_id, $capitulo_id, $parent_id, $contenido);
        } else {
            $sql = "INSERT INTO comentarios (usuario_id, capitulo_id, contenido) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iis", $usuario_id, $capitulo_id, $contenido);
        }
        $stmt->execute();

        $libro_id_res = $conexion->query("SELECT libro_id FROM capitulos WHERE id_capitulos = $capitulo_id LIMIT 1");
        if ($libro_id_res && $libro_id_res->num_rows > 0) {
            $libro_id = $libro_id_res->fetch_assoc()['libro_id'];
            $autor_res = $conexion->query("SELECT usuario_id, titulo FROM libros WHERE id_libros = $libro_id LIMIT 1");
            if ($autor_res && $autor_res->num_rows > 0) {
                $libro = $autor_res->fetch_assoc();
                if ($libro['usuario_id'] != $usuario_id) {
                    $mensaje = $conexion->real_escape_string("Tu libro '" . $libro['titulo'] . "' ha recibido un nuevo comentario.");
                    $url = $conexion->real_escape_string('leer.php?id=' . $capitulo_id);
                    $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ({$libro['usuario_id']}, '$mensaje', '$url')");
                }
            }
        }

        if ($parent_id) {
            $reply_owner_res = $conexion->query("SELECT u.id_usuarios FROM comentarios com JOIN usuarios u ON com.usuario_id = u.id_usuarios WHERE com.id_comentarios = $parent_id LIMIT 1");
            if ($reply_owner_res && $reply_owner_res->num_rows > 0) {
                $reply_owner = $reply_owner_res->fetch_assoc();
                if ($reply_owner['id_usuarios'] != $usuario_id) {
                    $mensaje = $conexion->real_escape_string("Tu comentario ha recibido una respuesta.");
                    $url = $conexion->real_escape_string('leer.php?id=' . $capitulo_id);
                    $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ({$reply_owner['id_usuarios']}, '$mensaje', '$url')");
                }
            }
        }
    }
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit();
?>