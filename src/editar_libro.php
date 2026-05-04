<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$id_libro = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM libros WHERE id_libros = $id_libro AND usuario_id = $usuario_id";
$res = $conexion->query($sql);
$libro = $res->fetch_assoc();

if (!$libro) {
    die("Error: El libro no existe o no tienes permiso para editarlo.");
}

$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <div class="container">
        <div class="card-form" style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #ddd; border-radius: 12px; background: #fff;">
            <h2 style="color: var(--rosa-800); margin-bottom: 20px;">
                <i class="fa-solid fa-book"></i> Editar Libro
            </h2>

            <form action="procesar_edicion_libro.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_libros" value="<?php echo $libro['id_libros']; ?>">

                <div style="margin-bottom: 20px;">
                    <label for="nuevo_titulo" style="display: block; margin-bottom: 8px; font-weight: bold;">Nombre del libro:</label>
                    <input type="text" id="nuevo_titulo" name="nuevo_titulo" 
                           value="<?php echo htmlspecialchars($libro['titulo']); ?>" 
                           class="input-field" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="categoria_id" style="display: block; margin-bottom: 8px; font-weight: bold;">Categoría:</label>
                    <select id="categoria_id" name="categoria_id" class="input-field" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                        <option value="">Sin categoría</option>
                        <?php while ($cat = $categorias->fetch_assoc()): ?>
                            <option value="<?php echo $cat['id_categorias']; ?>" <?php echo $libro['categoria_id'] == $cat['id_categorias'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['nombre']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="edad_recomendada" style="display: block; margin-bottom: 8px; font-weight: bold;">Edad recomendada:</label>
                    <select id="edad_recomendada" name="edad_recomendada" class="input-field" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                        <option value="0" <?php echo $libro['edad_recomendada'] == 0 ? 'selected' : ''; ?>>Todas las edades</option>
                        <option value="7" <?php echo $libro['edad_recomendada'] == 7 ? 'selected' : ''; ?>>7+</option>
                        <option value="10" <?php echo $libro['edad_recomendada'] == 10 ? 'selected' : ''; ?>>10+</option>
                        <option value="13" <?php echo $libro['edad_recomendada'] == 13 ? 'selected' : ''; ?>>13+</option>
                        <option value="16" <?php echo $libro['edad_recomendada'] == 16 ? 'selected' : ''; ?>>16+</option>
                        <option value="18" <?php echo $libro['edad_recomendada'] == 18 ? 'selected' : ''; ?>>18+</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="estado" style="display: block; margin-bottom: 8px; font-weight: bold;">Estado:</label>
                    <select id="estado" name="estado" class="input-field" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                        <option value="en_proceso" <?php echo $libro['estado'] == 'en_proceso' ? 'selected' : ''; ?>>En proceso</option>
                        <option value="completado" <?php echo $libro['estado'] == 'completado' ? 'selected' : ''; ?>>Completado</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="portada" style="display: block; margin-bottom: 8px; font-weight: bold;">Nueva portada (opcional):</label>
                    <input type="file" id="portada" name="portada" accept="image/*" class="input-field" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: bold;">¿Poner el libro de pago?</label>
                    <input type="checkbox" id="es_pago" name="es_pago" <?php echo $libro['precio'] > 0 ? 'checked' : ''; ?> onchange="togglePrecio()">
                </div>

                <div id="precio-container" style="margin-bottom: 20px; <?php echo $libro['precio'] > 0 ? '' : 'display: none;'; ?>">
                    <label for="precio" style="display: block; margin-bottom: 8px; font-weight: bold;">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?php echo htmlspecialchars($libro['precio']); ?>" class="input-field" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn-primary" style="flex: 1;">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                    </button>
                    <a href="escribir.php" class="btn-secondary" style="flex: 1; text-align: center; text-decoration: none; line-height: 2.5; background: #6c757d; color: white; border-radius: 6px;">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>
    <script>
        function togglePrecio() {
            const checkbox = document.getElementById('es_pago');
            const container = document.getElementById('precio-container');
            container.style.display = checkbox.checked ? 'block' : 'none';
        }
    </script>
</body>
</html>
