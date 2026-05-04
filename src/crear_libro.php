<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$titulo_libro = trim($_POST['titulo_libro'] ?? '');
$categoria_id = isset($_POST['categoria_id']) && $_POST['categoria_id'] !== '' ? (int)$_POST['categoria_id'] : 'NULL';
$precio = isset($_POST['precio']) ? number_format((float)$_POST['precio'], 2, '.', '') : '0.00';
$edad_recomendada = isset($_POST['edad_recomendada']) ? (int)$_POST['edad_recomendada'] : 0;
$estado = isset($_POST['estado']) && in_array($_POST['estado'], ['en_proceso', 'completado']) ? $_POST['estado'] : 'en_proceso';
$portada = null;

if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'img/uploads/covers/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $extension = pathinfo($_FILES['portada']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('cover_', true) . '.' . strtolower($extension);
    $targetPath = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['portada']['tmp_name'], $targetPath)) {
        $portada = $targetPath;
    }
}

if (empty($titulo_libro)) {
    die('Debes indicar un título para el libro.');
}

$titulo_libro_safe = $conexion->real_escape_string($titulo_libro);
$portada_sql = $portada ? "'" . $conexion->real_escape_string($portada) . "'" : 'NULL';
$estado_sql = $conexion->real_escape_string($estado);
$sql = "INSERT INTO libros (usuario_id, titulo, categoria_id, portada, precio, edad_recomendada, estado) VALUES ('$usuario_id', '$titulo_libro_safe', $categoria_id, $portada_sql, $precio, $edad_recomendada, '$estado_sql')";

if ($conexion->query($sql)) {
    $safe_url = $conexion->real_escape_string('catalogo.php?search=' . urlencode($titulo_libro));
    $mensaje = $conexion->real_escape_string("El autor " . $_SESSION['usuario_nombre'] . " ha publicado un nuevo libro: $titulo_libro_safe.");
    $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url)
                      SELECT seguidor_id, '$mensaje', '$safe_url'
                      FROM seguidores
                      WHERE seguido_id = $usuario_id");

    header("Location: escribir.php");
    exit;
} else {
    echo "Error al crear libro: " . $conexion->error;
}
?>
