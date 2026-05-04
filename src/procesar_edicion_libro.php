<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
    if (!isset($_POST['id_libros']) || !isset($_POST['nuevo_titulo'])) {
        die("Error: Faltan datos para editar el libro.");
    }

    $id_libro = (int)$_POST['id_libros'];
    $nuevo_titulo = $conexion->real_escape_string(trim($_POST['nuevo_titulo']));
    $categoria_id = isset($_POST['categoria_id']) && $_POST['categoria_id'] !== '' ? (int)$_POST['categoria_id'] : 'NULL';
    $edad_recomendada = (int)$_POST['edad_recomendada'];
    $estado = $conexion->real_escape_string($_POST['estado']);
    $precio = isset($_POST['es_pago']) && isset($_POST['precio']) ? (float)$_POST['precio'] : 0.00;
    $usuario_id = $_SESSION['usuario_id'];

    // Manejar nueva portada
    $portada_path = null;
    if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/uploads/portadas/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $extension = pathinfo($_FILES['portada']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('portada_', true) . '.' . strtolower($extension);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['portada']['tmp_name'], $targetPath)) {
            $portada_path = $targetPath;
        }
    }

    $sql = "UPDATE libros SET titulo = '$nuevo_titulo', categoria_id = $categoria_id, edad_recomendada = $edad_recomendada, estado = '$estado', precio = $precio";
    if ($portada_path) {
        $portada_safe = $conexion->real_escape_string($portada_path);
        $sql .= ", portada = '$portada_safe'";
    }
    $sql .= " WHERE id_libros = $id_libro AND usuario_id = $usuario_id";

    if ($conexion->query($sql)) {
        // Notificar seguidores de cambios
        $seguidores_res = $conexion->query("SELECT seguidor_id FROM seguidores WHERE seguido_id = $usuario_id");
        if ($seguidores_res) {
            while ($seg = $seguidores_res->fetch_assoc()) {
                $mensaje = $conexion->real_escape_string("El libro '$nuevo_titulo' ha sido actualizado.");
                $url = $conexion->real_escape_string('leer.php?id=' . ($conexion->query("SELECT id_capitulos FROM capitulos WHERE libro_id = $id_libro ORDER BY id_capitulos ASC LIMIT 1")->fetch_assoc()['id_capitulos'] ?? ''));
                $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ({$seg['seguidor_id']}, '$mensaje', '$url')");
            }
        }
        header("Location: escribir.php?mensaje=Libro actualizado");
        exit;
    } else {
        echo "Error: " . $conexion->error;
    }
} else {
    header("Location: escribir.php");
}
?>