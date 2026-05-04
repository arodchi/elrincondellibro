<?php
session_start();
include 'conexion.php';

$id_capitulo = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 1. Verificar que el capítulo existe y que el usuario es el dueño
$sql = "SELECT c.*, l.usuario_id FROM capitulos c 
        JOIN libros l ON c.libro_id = l.id_libros 
        WHERE c.id_capitulos = $id_capitulo";
$res = $conexion->query($sql);
$cap = $res ? $res->fetch_assoc() : null;

if (!$cap || $cap['usuario_id'] != $_SESSION['usuario_id']) {
    die("No tienes permiso para editar este capítulo.");
}

$capitulo_imagenes = false;
$check_table = $conexion->query("SHOW TABLES LIKE 'capitulo_imagenes'");
if ($check_table && $check_table->num_rows > 0) {
    $capitulo_imagenes = $conexion->query("SELECT * FROM capitulo_imagenes WHERE capitulo_id = $id_capitulo ORDER BY orden");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Capítulo</title>
    <link rel="stylesheet" href="CSS/style1.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <div class="container">
        <form action="procesar_edicion.php" method="POST" enctype="multipart/form-data" class="lectura-container">
            <input type="hidden" name="id_capitulos" value="<?php echo $cap['id_capitulos']; ?>">
            <h2>Editar: <?php echo htmlspecialchars($cap['titulo']); ?></h2>
            
            <label>Título del capítulo:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($cap['titulo']); ?>" required style="width: 100%; margin-bottom: 20px;">
            
            <label>Contenido:</label>
            <textarea name="contenido" style="width: 100%; height: 400px;" required><?php echo htmlspecialchars($cap['contenido']); ?></textarea>
            
            <h3>Imágenes del capítulo</h3>
            <?php if ($capitulo_imagenes && $capitulo_imagenes->num_rows > 0): ?>
                <div style="display: grid; gap: 10px; margin-bottom: 20px;">
                    <?php while ($img = $capitulo_imagenes->fetch_assoc()): ?>
                        <div style="border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                            <img src="<?php echo htmlspecialchars($img['ruta']); ?>" alt="Imagen" style="max-width: 200px; border-radius: 4px;">
                            <div style="margin-top: 10px;">
                                <button type="button" onclick="eliminarImagen(<?php echo $img['id']; ?>)" class="btn-secondary" style="margin-right: 10px;">Eliminar</button>
                                <input type="file" name="nueva_imagen_<?php echo $img['id']; ?>" accept="image/*">
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No hay imágenes en este capítulo.</p>
            <?php endif; ?>
            
            <button type="submit" class="btn-primary">Guardar Cambios</button>
            <a href="leer.php?id=<?php echo $id_capitulo; ?>">Cancelar</a>
        </form>
        
        <script>
            function eliminarImagen(id) {
                if (confirm('¿Estás seguro de que quieres eliminar esta imagen?')) {
                    // Enviar POST para eliminar
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'procesar_edicion.php';
                    form.style.display = 'none';
                    
                    const inputId = document.createElement('input');
                    inputId.name = 'eliminar_imagen';
                    inputId.value = id;
                    
                    const inputCap = document.createElement('input');
                    inputCap.name = 'id_capitulos';
                    inputCap.value = '<?php echo $cap['id_capitulos']; ?>';
                    
                    form.appendChild(inputId);
                    form.appendChild(inputCap);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
    </div>
</body>
</html>
