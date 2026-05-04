<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
    
    // Verificamos que lleguen los datos del capítulo
    if (!isset($_POST['id_capitulos']) || !isset($_POST['titulo']) || !isset($_POST['contenido'])) {
        die("Error: Faltan datos en el formulario del capítulo.");
    }

    $id = (int)$_POST['id_capitulos'];
    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $contenido = $conexion->real_escape_string($_POST['contenido']);
    $usuario_id = $_SESSION['usuario_id'];

    // Manejar eliminación de imágenes
    if (isset($_POST['eliminar_imagen'])) {
        $img_id = (int)$_POST['eliminar_imagen'];
        $conexion->query("DELETE FROM capitulo_imagenes WHERE id = $img_id AND capitulo_id = $id");
        header("Location: editar_capitulo.php?id=" . $id);
        exit;
    }

    // Manejar nuevas imágenes para existentes
    foreach ($_FILES as $key => $file) {
        if (strpos($key, 'nueva_imagen_') === 0 && $file['error'] === UPLOAD_ERR_OK) {
            $img_id = (int)str_replace('nueva_imagen_', '', $key);
            $uploadDir = 'img/uploads/capitulos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid('cap_', true) . '.' . strtolower($extension);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $conexion->query("UPDATE capitulo_imagenes SET ruta = '$targetPath' WHERE id = $img_id AND capitulo_id = $id");
            }
        }
    }

    // Seguridad: Verificar que el capítulo pertenece a un libro del usuario
    $sql = "UPDATE capitulos c 
            JOIN libros l ON c.libro_id = l.id_libros 
            SET c.titulo = '$titulo', c.contenido = '$contenido' 
            WHERE c.id_capitulos = $id AND l.usuario_id = $usuario_id";

    if ($conexion->query($sql)) {
        header("Location: leer.php?id=" . $id);
        exit;
    } else {
        echo "Error al actualizar el capítulo: " . $conexion->error;
    }
} else {
    header("Location: escribir.php");
}
?>