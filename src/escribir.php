<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
include 'conexion.php';
$usuario_id = $_SESSION['usuario_id'];

$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre");
$libros = $conexion->query("SELECT l.*, c.nombre AS categoria FROM libros l LEFT JOIN categorias c ON l.categoria_id = c.id_categorias WHERE usuario_id = $usuario_id ORDER BY l.fecha_creacion DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escribir - ElRincónDelLibro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include 'partials/header.php'; ?>

<div class="container">
    <h2 class="section-title">Panel de Escritura</h2>

    <div class="card-form">
        <h3><i class="fa-solid fa-book"></i> Crear nuevo libro</h3>
        <form action="crear_libro.php" method="POST" enctype="multipart/form-data" class="flex-form" style="gap: 10px; align-items: center; flex-wrap: wrap;">
            <input type="text" name="titulo_libro" placeholder="Título de tu nueva obra..." class="input-field" required style="flex: 1; min-width: 220px;">
            <select name="categoria_id" class="input-field" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 180px;">
                <option value="">Categoría (opcional)</option>
                <?php while ($cat = $categorias->fetch_assoc()): ?>
                    <option value="<?php echo $cat['id_categorias']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
                <?php endwhile; ?>
            </select>
            <input type="number" name="precio" min="0" step="0.01" placeholder="Precio (0 para gratis)" class="input-field" style="width: 160px;" value="0.00">
            <select name="edad_recomendada" class="input-field" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 170px;">
                <option value="0">Edad recomendada</option>
                <option value="7">7+</option>
                <option value="10">10+</option>
                <option value="13">13+</option>
                <option value="16">16+</option>
                <option value="18">18+</option>
            </select>
            <select name="estado" class="input-field" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; min-width: 170px;">
                <option value="en_proceso">En proceso</option>
                <option value="completado">Completado</option>
            </select>
            <input type="file" name="portada" accept="image/*" class="input-field" style="flex: 1 1 100%; max-width: 320px;">
            <button type="submit" class="btn-primary">Publicar Libro</button>
        </form>
    </div>

    <hr>

    <h3 class="section-title">Mis Libros y Capítulos</h3>
    <div class="libros-lista">
        <?php if ($libros->num_rows > 0): ?>
            <?php while($libro = $libros->fetch_assoc()): 
                    $cover_path = !empty($libro['portada']) ? (strpos($libro['portada'], 'img/') === 0 ? $libro['portada'] : 'img/' . $libro['portada']) : 'img/Imagen_de_ejemplo.png'; ?>
                <div class="libro-item card" style="margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                    <div style="display: flex; gap: 20px; align-items: flex-start; margin-bottom: 15px;">
                        <img src="<?php echo htmlspecialchars($cover_path); ?>" alt="Portada" style="width: 100px; height: 140px; object-fit: cover; border-radius: 8px;">
                        <div style="flex: 1;">
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--rosa-200); padding-bottom: 10px; margin-bottom: 15px;">
                        <div>
                            <h4 style="color: var(--rosa-800); font-size: 1.5rem; margin: 0;">
                                <?php echo htmlspecialchars($libro['titulo']); ?>
                            </h4>
                            <?php if (!empty($libro['categoria'])): ?>
                                <p style="font-size: 0.9rem; color: #666; margin: 6px 0 0;">Categoría: <?php echo htmlspecialchars($libro['categoria']); ?></p>
                            <?php endif; ?>
                        </div>
                        <a href="editar_libro.php?id=<?php echo $libro['id_libros']; ?>" class="btn-secondary" style="background: #6c757d; color: white; padding: 5px 12px; font-size: 0.85rem; text-decoration: none; border-radius: 4px; display: flex; align-items: center; gap: 5px;">
                            <i class="fa-solid fa-pen-to-square"></i> Editar Libro
                        </a>
                    </div>
                    <p style="font-size:0.95rem; color:#444; margin: 0 0 8px;">
                        <?php echo ($libro['precio'] > 0 ? 'Precio: $' . number_format($libro['precio'],2) : 'Gratis'); ?> • Edad: <?php echo $libro['edad_recomendada'] > 0 ? $libro['edad_recomendada'] . '+' : 'Todas'; ?> • Estado: <?php echo $libro['estado'] === 'completado' ? 'Completado' : 'En proceso'; ?>
                    </p>
                    </div>
                </div>

                    <div class="capitulos-gestion" style="margin: 15px 0;">
                        <h5 style="margin-bottom: 10px;"><i class="fa-solid fa-list-ul"></i> Capítulos publicados:</h5>
                        <?php 
                        $id_l = $libro['id_libros'];
                        $capitulos = $conexion->query("SELECT id_capitulos, titulo FROM capitulos WHERE libro_id = $id_l");
                        if ($capitulos->num_rows > 0): ?>
                            <ul style="list-style: none; padding-left: 0;">
                                <?php while($cap = $capitulos->fetch_assoc()): ?>
                                    <li style="display: flex; justify-content: space-between; align-items: center; background: #f9f9f9; padding: 8px 12px; margin-bottom: 8px; border-radius: 6px; border: 1px solid #eee;">
                                        <span style="font-weight: 500;"><?php echo htmlspecialchars($cap['titulo']); ?></span>
                                        <a href="editar_capitulo.php?id=<?php echo $cap['id_capitulos']; ?>" class="btn-primary" style="padding: 4px 10px; font-size: 0.8rem; text-decoration: none;">
                                            <i class="fa-solid fa-edit"></i> Editar
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p style="font-size: 0.9rem; color: #666; font-style: italic;">Aún no hay capítulos en este libro.</p>
                        <?php endif; ?>
                    </div>

                    <div style="background: #fff0f5; padding: 15px; border-radius: 8px; margin-top: 20px;">
                        <h5 style="margin-bottom: 10px; color: var(--rosa-700);"><i class="fa-solid fa-plus"></i> Añadir nuevo capítulo:</h5>
                        <form action="crear_capitulo.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="libro_id" value="<?php echo $libro['id_libros']; ?>">
                            <input type="text" name="titulo_capitulo" placeholder="Título del capítulo" class="input-field" required style="width: 100%; margin-bottom: 10px; border: 1px solid #ccc;">
                            <textarea name="contenido_capitulo" placeholder="Escribe aquí el contenido..." class="input-field" rows="4" required style="width: 100%; margin-bottom: 10px; border: 1px solid #ccc;"></textarea>
                            <select name="posicion_imagen" class="input-field" style="width: 100%; margin-bottom: 10px; border: 1px solid #ccc;">
                                <option value="medio">Imagen en medio del capítulo</option>
                                <option value="arriba">Imagen arriba del contenido</option>
                                <option value="abajo">Imagen abajo del contenido</option>
                                <option value="portada">Usar como portada del capítulo</option>
                            </select>
                            <input type="file" name="imagen" accept="image/*" class="input-field" style="width: 100%; margin-bottom: 10px; border: 1px solid #ccc;">
                            <button type="submit" class="btn-secondary" style="width: 100%;">Publicar Capítulo</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 40px; color: #666;">
                <p>Aún no tienes libros. ¡Utiliza el formulario de arriba para crear tu primera obra!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>