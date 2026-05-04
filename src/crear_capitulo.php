<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

function resizeImage($filePath, $maxWidth = 800, $maxHeight = 600) {
    $imageInfo = getimagesize($filePath);
    if (!$imageInfo) return false;
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $mime = $imageInfo['mime'];

    if ($width <= $maxWidth && $height <= $maxHeight) return true;

    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = round($width * $ratio);
    $newHeight = round($height * $ratio);

    $srcImage = null;
    switch ($mime) {
        case 'image/jpeg': $srcImage = imagecreatefromjpeg($filePath); break;
        case 'image/png': $srcImage = imagecreatefrompng($filePath); break;
        case 'image/gif': $srcImage = imagecreatefromgif($filePath); break;
        default: return false;
    }

    $dstImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    switch ($mime) {
        case 'image/jpeg': imagejpeg($dstImage, $filePath, 85); break;
        case 'image/png': imagepng($dstImage, $filePath); break;
        case 'image/gif': imagegif($dstImage, $filePath); break;
    }

    imagedestroy($srcImage);
    imagedestroy($dstImage);
    return true;
}

$usuario_id = $_SESSION['usuario_id'];

if (!isset($_POST['libro_id']) || !isset($_POST['titulo_capitulo'])) {
    header("Location: escribir.php");
    exit;
}

$libro_id = (int)$_POST['libro_id'];
$titulo_capitulo = trim($_POST['titulo_capitulo'] ?? '');
$contenido_capitulo = trim($_POST['contenido_capitulo'] ?? '');
$posicion_imagen = trim($_POST['posicion_imagen'] ?? 'medio');
$imagen_capitulo = null;

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'img/uploads/capitulos/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('chapter_', true) . '.' . strtolower($extension);
    $targetPath = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
        resizeImage($targetPath); // Agregar resize
        $imagen_capitulo = $targetPath;
    }
}

$sql_check = "SELECT titulo, usuario_id FROM libros WHERE id_libros = $libro_id AND usuario_id = $usuario_id";
$result_check = $conexion->query($sql_check);

if ($result_check->num_rows === 0) {
    die("No tienes permisos para añadir capítulos a este libro o el libro no existe.");
}

if (empty($titulo_capitulo) || empty($contenido_capitulo)) {
    die("El título y el contenido del capítulo son obligatorios.");
}

$titulo_capitulo_safe = $conexion->real_escape_string($titulo_capitulo);
$contenido_capitulo_safe = $conexion->real_escape_string($contenido_capitulo);

$sql = "INSERT INTO capitulos (libro_id, titulo, contenido) VALUES ('$libro_id', '$titulo_capitulo_safe', '$contenido_capitulo_safe')";

if ($conexion->query($sql)) {
    $capitulo_id = $conexion->insert_id;
    if ($imagen_capitulo) {
        $imagen_path = $conexion->real_escape_string($imagen_capitulo);
        $posicion_safe = $conexion->real_escape_string($posicion_imagen);
        $conexion->query("INSERT INTO archivos (capitulo_id, ruta, tipo, descripcion) VALUES ($capitulo_id, '$imagen_path', 'capitulo_imagen', '$posicion_safe')");
    }

    $libro_data = $result_check->fetch_assoc();
    $titulo_libro = $conexion->real_escape_string($libro_data['titulo']);
    $url_capitulo = $conexion->real_escape_string("leer.php?id=$capitulo_id");

    $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url)
                      SELECT DISTINCT f.usuario_id, CONCAT('Se ha publicado un nuevo capítulo en ', '$titulo_libro', '.'), '$url_capitulo'
                      FROM favoritos f
                      WHERE f.libro_id = $libro_id
                        AND f.usuario_id != $usuario_id");

    $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url)
                      SELECT DISTINCT s.seguidor_id, CONCAT('Tu autor seguido ha publicado un nuevo capítulo en ', '$titulo_libro', '.'), '$url_capitulo'
                      FROM seguidores s
                      JOIN libros l ON l.usuario_id = s.seguido_id
                      WHERE l.id_libros = $libro_id
                        AND s.seguidor_id != $usuario_id");

    header("Location: escribir.php");
    exit;
} else {
    echo "Error al añadir capítulo: " . $conexion->error;
}
?>