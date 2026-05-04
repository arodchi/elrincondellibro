<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';

$id_capitulo = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_capitulo <= 0) {
    header("Location: catalogo.php");
    exit;
}

$sql = "SELECT c.titulo AS titulo_capitulo, c.contenido, c.libro_id, l.titulo AS titulo_libro, l.usuario_id AS autor_id, l.precio 
        FROM capitulos c 
        JOIN libros l ON c.libro_id = l.id_libros 
        WHERE c.id_capitulos = $id_capitulo";
$resultado = $conexion->query($sql);

if ($resultado->num_rows === 0) {
    die("Capítulo no encontrado.");
}

$datos = $resultado->fetch_assoc();
$libro_id = $datos['libro_id'];
$autor_id = $datos['autor_id'];
$precio_libro = (float)$datos['precio'];
$comprado = false;
$es_autor = false;
$es_seguido = false;
$es_favorito = false;
$reply_to = isset($_GET['reply_to']) ? (int)$_GET['reply_to'] : null;
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0;

if ($usuario_id) {
    $es_autor = $usuario_id === $autor_id;
    if ($precio_libro > 0 && !$es_autor) {
        $check_compra = $conexion->query("SELECT id_transaccion FROM transacciones WHERE usuario_id = $usuario_id AND tipo = 'libro' AND referencia_id = $libro_id LIMIT 1");
        $comprado = $check_compra && $check_compra->num_rows > 0;
    } else {
        $comprado = true;
    }

    $check_follow = $conexion->query("SELECT id_seguidores FROM seguidores WHERE seguidor_id = $usuario_id AND seguido_id = $autor_id LIMIT 1");
    $es_seguido = $check_follow && $check_follow->num_rows > 0;

    $check_fav = $conexion->query("SELECT id_favoritos FROM favoritos WHERE usuario_id = $usuario_id AND libro_id = $libro_id LIMIT 1");
    $es_favorito = $check_fav && $check_fav->num_rows > 0;

    $actividad_sql = "INSERT INTO actividad (usuario_id, tipo, referencia_id) VALUES ($usuario_id, 'lectura_capitulo', $id_capitulo)";
    $conexion->query($actividad_sql);
}

$sql_prev = "SELECT id_capitulos FROM capitulos WHERE libro_id = $libro_id AND id_capitulos < $id_capitulo ORDER BY id_capitulos DESC LIMIT 1";
$sql_next = "SELECT id_capitulos FROM capitulos WHERE libro_id = $libro_id AND id_capitulos > $id_capitulo ORDER BY id_capitulos ASC LIMIT 1";
$prev_res = $conexion->query($sql_prev)->fetch_assoc();
$next_res = $conexion->query($sql_next)->fetch_assoc();

$capitulo_imagenes = [];
$imagenes_res = $conexion->query("SELECT ruta FROM archivos WHERE capitulo_id = $id_capitulo AND tipo = 'capitulo_imagen'");
if ($imagenes_res) {
    while ($img = $imagenes_res->fetch_assoc()) {
        $capitulo_imagenes[] = $img['ruta'];
    }
}

$sql_comentarios = "SELECT com.id_comentarios, com.parent_id, com.contenido, com.fecha_creacion AS fecha, u.nombre, u.id_usuarios, 
                         COALESCE(SUM(cl.usuario_id = $usuario_id), 0) AS liked_by_user, 
                         COUNT(cl.id_like) AS likes 
                  FROM comentarios com 
                  JOIN usuarios u ON com.usuario_id = u.id_usuarios 
                  LEFT JOIN comentario_likes cl ON cl.comentario_id = com.id_comentarios 
                  WHERE com.capitulo_id = $id_capitulo 
                  GROUP BY com.id_comentarios, com.parent_id, com.contenido, com.fecha_creacion, u.nombre, u.id_usuarios 
                  ORDER BY com.fecha_creacion DESC";
$res_comentarios = $conexion->query($sql_comentarios);

$comentarios_por_parent = [];
if ($res_comentarios) {
    while ($com = $res_comentarios->fetch_assoc()) {
        $parent_key = $com['parent_id'] !== null ? $com['parent_id'] : 'root';
        $comentarios_por_parent[$parent_key][] = $com;
    }
}
$comentarios = $comentarios_por_parent['root'] ?? [];
$reply_to = isset($_GET['reply_to']) ? (int)$_GET['reply_to'] : 0;

$rating_data = ['promedio' => 0, 'total' => 0];
$rating_res = $conexion->query("SELECT AVG(puntuacion) AS promedio, COUNT(*) AS total FROM valoraciones WHERE libro_id = $libro_id");
if ($rating_res) {
    $rating_data = $rating_res->fetch_assoc();
}
$user_rating = 0;
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $user_rating_res = $conexion->query("SELECT puntuacion FROM valoraciones WHERE libro_id = $libro_id AND usuario_id = $usuario_id LIMIT 1");
    if ($user_rating_res && $user_rating_res->num_rows > 0) {
        $user_rating = (int)$user_rating_res->fetch_assoc()['puntuacion'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($datos['titulo_capitulo']); ?> - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .lectura-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: var(--color-blanco-elementos);
            border-radius: 12px;
            box-shadow: 0 4px 15px var(--sombra);
        }
        .texto-capitulo {
            font-size: 1.2rem;
            line-height: 1.8;
            white-space: normal;
            margin-top: 30px;
            color: var(--color-texto);
        }
        .info-libro-cabecera {
            text-align: center;
            border-bottom: 2px solid var(--rosa-200);
            padding-bottom: 10px;
        }
        .interacciones {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .btn-interact {
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-fav { background: #ff4757; color: white; }
        .btn-follow { background: #1e90ff; color: white; }
        .btn-interact:hover { opacity: 0.8; transform: scale(1.05); }
        .rating-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin: 25px 0;
        }
        .rating-form select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .seccion-comentarios {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid var(--rosa-100);
        }
        .comentario-form textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            resize: none;
        }
        .lista-comentarios { margin-top: 30px; }
        .comentario-item {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid var(--rosa-500);
        }
        .comentario-meta { font-size: 0.85rem; color: #666; margin-bottom: 5px; }
    </style>
</head>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <article class="lectura-container">
        <header class="info-libro-cabecera">
            <p><a href="perfil.php?user_id=<?php echo $autor_id; ?>" style="color: inherit; text-decoration: none; font-weight: 600;">Autor: <?php echo htmlspecialchars($conexion->query("SELECT nombre FROM usuarios WHERE id_usuarios = $autor_id LIMIT 1")->fetch_assoc()['nombre'] ?? 'Autor'); ?></a></p>
            <p><?php echo htmlspecialchars($datos['titulo_libro']); ?></p>
            <h1><?php echo htmlspecialchars($datos['titulo_capitulo']); ?></h1>
        </header>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <?php if ($precio_libro > 0): ?>
                <div style="background: #fff4e6; border: 1px solid #ffd8a8; padding: 15px; border-radius: 12px; text-align: center; margin-bottom: 20px;">
                    <strong>Contenido Premium</strong> • Precio: $<?php echo number_format($precio_libro, 2); ?>
                    <?php if (!$comprado): ?>
                        <form action="pago_libro.php" method="GET" style="display:inline-block; margin-left: 15px;">
                            <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">
                            <button type="submit" class="btn-primary" style="padding: 10px 18px;">Comprar libro</button>
                        </form>
                    <?php else: ?>
                        <span style="margin-left: 15px; color: #2f8f3f;">Acceso activo</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="interacciones">
                <form action="procesar_interaccion.php" method="POST">
                    <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">
                    <button type="submit" name="accion" value="favorito" class="btn-interact btn-fav">
                        <i class="fa-solid fa-heart"></i> <?php echo $es_favorito ? 'Quitar favorito' : 'Seguir Libro'; ?>
                    </button>
                </form>

                <?php if ($_SESSION['usuario_id'] != $autor_id): ?>
                    <form action="procesar_interaccion.php" method="POST">
                        <input type="hidden" name="seguido_id" value="<?php echo $autor_id; ?>">
                        <button type="submit" name="accion" value="seguir" class="btn-interact btn-follow">
                            <i class="fa-solid fa-user-plus"></i> <?php echo $es_seguido ? 'Dejar de seguir' : 'Seguir Autor'; ?>
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="rating-summary">
                <p><strong>Valoración media:</strong> <?php echo number_format($rating_data['promedio'] ?? 0, 1); ?> ★</p>
                <p><?php echo intval($rating_data['total']); ?> voto<?php echo intval($rating_data['total']) === 1 ? '' : 's'; ?></p>
            </div>

            <form action="procesar_valoracion.php" method="POST" class="rating-form">
                <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">
                <label for="puntuacion">Valora este libro:</label>
                <select name="puntuacion" id="puntuacion">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo $user_rating === $i ? 'selected' : ''; ?>><?php echo $i; ?> estrella<?php echo $i === 1 ? '' : 's'; ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn-secondary">Guardar</button>
            </form>
        <?php endif; ?>

        <div class="texto-capitulo">
            <?php if ($precio_libro > 0 && !$comprado && !$es_autor): ?>
                <?php echo nl2br(htmlspecialchars(substr($datos['contenido'], 0, 400))); ?>
                <div class="premium-notice">
                    <p>Este contenido es premium. Compra el libro para continuar leyendo el capítulo completo.</p>
                </div>
            <?php else: ?>
                <?php if (!empty($capitulo_imagenes)): ?>
                    <div class="imagen-capitulo">
                        <?php foreach ($capitulo_imagenes as $img_path): ?>
                            <img src="<?php echo htmlspecialchars($img_path); ?>" alt="Imagen del capítulo">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php echo nl2br(htmlspecialchars($datos['contenido'])); ?>
            <?php endif; ?>
        </div>
        </br>

        <nav class="navegacion-lectura">
            <?php if ($prev_res): ?>
                <a href="leer.php?id=<?php echo $prev_res['id_capitulos']; ?>" class="btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Anterior
                </a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            <a href="catalogo.php" class="btn-primary">Volver al Índice</a>

            <?php if ($next_res): ?>
                <a href="leer.php?id=<?php echo $next_res['id_capitulos']; ?>" class="btn-secondary">
                    Siguiente <i class="fa-solid fa-arrow-right"></i>
                </a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>
        </nav>

        <section class="seccion-comentarios">
            <h3><i class="fa-solid fa-comments"></i> Comentarios</h3>

            <div class="comentario-filtros" style="margin-bottom: 20px;">
                <label for="orden-comentarios">Ordenar por:</label>
                <select id="orden-comentarios" onchange="ordenarComentarios(this.value)">
                    <option value="fecha_desc">Más recientes</option>
                    <option value="fecha_asc">Más antiguos</option>
                    <option value="likes_desc">Más likes</option>
                </select>
            </div>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <form id="comentario-form" action="procesar_comentario.php" method="POST" class="comentario-form">
                    <input type="hidden" name="capitulo_id" value="<?php echo $id_capitulo; ?>">
                    <?php if ($reply_to): ?>
                        <input type="hidden" name="parent_id" value="<?php echo $reply_to; ?>">
                        <p style="font-size: 0.9rem; color: #555;">Respondiendo a un comentario...</p>
                    <?php endif; ?>
                    <textarea name="contenido" placeholder="Escribe tu comentario aquí..." required></textarea>
                    <button type="submit" class="btn-primary">Publicar comentario</button>
                </form>
            <?php else: ?>
                <p><a href="login.php">Inicia sesión</a> para dejar un comentario.</p>
            <?php endif; ?>

            <div class="lista-comentarios">
                <?php
                function mostrarComentarios($comentarios, $id_capitulo, $parent_id = 'root', $nivel = 0) {
                    if (!isset($comentarios[$parent_id])) return;
                    foreach ($comentarios[$parent_id] as $com) {
                        $indent = $nivel * 20;
                        echo '<div class="comentario-item" style="margin-left: ' . $indent . 'px; border-left: ' . ($nivel > 0 ? '2px solid #ddd' : 'none') . ';">';
                        echo '<div class="comentario-meta">';
                        echo '<span class="comentario-nombre">' . htmlspecialchars($com['nombre']) . '</span>';
                        echo ' • ' . htmlspecialchars($com['fecha']);
                        echo '</div>';
                        echo '<div class="comentario-texto">';
                        echo nl2br(htmlspecialchars($com['contenido']));
                        echo '</div>';
                        echo '<div class="comentario-actions" style="margin-top: 8px; font-size: 0.8rem;">';
                        if (isset($_SESSION['usuario_id'])) {
                            echo '<a href="?id=' . $id_capitulo . '&reply_to=' . $com['id_comentarios'] . '#comentario-form" style="color: #1e90ff; margin-right: 10px;">Responder</a>';
                            echo '<form action="procesar_like_comentario.php" method="POST" style="display:inline; margin-right: 10px;">';
                            echo '<input type="hidden" name="comentario_id" value="' . $com['id_comentarios'] . '">';
                            echo '<button type="submit" class="btn-interact" style="padding: 2px 6px; font-size: 0.7rem; background: ' . ($com['liked_by_user'] ? '#ff4757' : '#ddd') . '; color: ' . ($com['liked_by_user'] ? 'white' : 'black') . '; border: none; border-radius: 4px;">';
                            echo '<i class="fa-solid fa-heart"></i> ' . $com['likes'];
                            echo '</button>';
                            echo '</form>';
                            if (isset($_SESSION['usuario_id']) && $com['id_usuarios'] == $_SESSION['usuario_id']) {
                                echo '<form action="procesar_delete_comentario.php" method="POST" style="display:inline;">';
                                echo '<input type="hidden" name="comentario_id" value="' . $com['id_comentarios'] . '">';
                                echo '<input type="hidden" name="tipo" value="capitulo">';
                                echo '<button type="submit" class="btn-secondary" style="padding: 2px 6px; font-size: 0.7rem;">Eliminar</button>';
                                echo '</form>';
                            }
                        }
                        echo '</div>';
                        echo '</div>';
                        mostrarComentarios($comentarios, $id_capitulo, $com['id_comentarios'], $nivel + 1);
                    }
                }
                mostrarComentarios($comentarios_por_parent, $id_capitulo, 'root', 0);
                ?>
            </div>
        </section>

    </article>
</div>

<?php include 'partials/footer.php'; ?>

    <script>
        function ordenarComentarios(orden) {
            const lista = document.querySelector('.lista-comentarios');
            const comentarios = Array.from(document.querySelectorAll('.comentario-item'));

            comentarios.sort((a, b) => {
                if (orden === 'fecha_desc') {
                    return new Date(b.querySelector('.comentario-meta').textContent.split(' • ')[1]) - new Date(a.querySelector('.comentario-meta').textContent.split(' • ')[1]);
                } else if (orden === 'fecha_asc') {
                    return new Date(a.querySelector('.comentario-meta').textContent.split(' • ')[1]) - new Date(b.querySelector('.comentario-meta').textContent.split(' • ')[1]);
                } else if (orden === 'likes_desc') {
                    return parseInt(b.querySelector('.fa-heart').nextSibling.textContent.trim()) - parseInt(a.querySelector('.fa-heart').nextSibling.textContent.trim());
                }
            });

            comentarios.forEach(com => lista.appendChild(com));
        }
    </script>
</body>
</html>
