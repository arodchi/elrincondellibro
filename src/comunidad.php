<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
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
$parent_id = null;
if (isset($_POST['parent_id'])) {
    $parent_id = (int)$_POST['parent_id'];
} elseif (isset($_GET['reply_to'])) {
    $parent_id = (int)$_GET['reply_to'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenido = trim($_POST['contenido'] ?? '');
    $archivo = null;
    $tipo = 'texto';

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/uploads/comunidad/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('comunidad_', true) . '.' . strtolower($extension);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $targetPath)) {
            if (strpos($_FILES['archivo']['type'], 'image/') === 0) {
                resizeImage($targetPath);
            }
            $archivo = $targetPath;
            $tipo = strpos($_FILES['archivo']['type'], 'image/') === 0 ? 'imagen' : 'archivo';
        }
    }

    if ($contenido !== '' || $archivo !== null) {
        $contenido_safe = $conexion->real_escape_string($contenido);
        $archivo_safe = $archivo ? $conexion->real_escape_string($archivo) : 'NULL';
        $tipo_safe = $conexion->real_escape_string($tipo);
        $parent_safe = $parent_id ? $parent_id : 'NULL';
        $sql = "INSERT INTO comunidad_mensajes (usuario_id, contenido, archivo, tipo, parent_id) VALUES ($usuario_id, '$contenido_safe', " . ($archivo ? "'" . $archivo_safe . "'" : 'NULL') . ", '$tipo_safe', $parent_safe)";
        $conexion->query($sql);
    }
    header('Location: comunidad.php');
    exit;
}

$mensajes = $conexion->query("SELECT cm.*, u.nombre FROM comunidad_mensajes cm JOIN usuarios u ON cm.usuario_id = u.id_usuarios ORDER BY cm.fecha DESC");

$mensajes_por_parent = [];
if ($mensajes) {
    while ($msg = $mensajes->fetch_assoc()) {
        $mensajes_por_parent[$msg['parent_id']][] = $msg;
    }
}

function mostrarMensajes($mensajes, $parent_id = null, $nivel = 0) {
    if (!isset($mensajes[$parent_id])) return;
    foreach ($mensajes[$parent_id] as $msg) {
        $indent = $nivel * 20;
        echo '<div style="border: 1px solid var(--color-borde); border-radius: 10px; padding: 15px; background: var(--color-blanco-elementos); color: var(--color-texto); margin-left: ' . $indent . 'px; border-left: ' . ($nivel > 0 ? '2px solid var(--color-borde)' : 'none') . ';">';
        echo '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">';
        echo '<strong>' . htmlspecialchars($msg['nombre']) . '</strong>';
        echo '<span style="font-size:0.8rem; color: var(--rosa-400);">' . date('d/m/Y H:i', strtotime($msg['fecha'])) . '</span>';
        echo '</div>';
        if (!empty($msg['contenido'])) {
            echo '<p style="margin:0 0 10px; color: var(--color-texto); line-height:1.6;">' . nl2br(htmlspecialchars($msg['contenido'])) . '</p>';
        }
        if (!empty($msg['archivo'])) {
            echo '<div style="margin-top:8px;">';
            if ($msg['tipo'] === 'imagen') {
                echo '<img src="' . htmlspecialchars($msg['archivo']) . '" alt="Adjunto" style="max-width: 100%; border-radius: 10px;">';
            } else {
                echo '<a href="' . htmlspecialchars($msg['archivo']) . '" target="_blank" style="color: var(--rosa-600);">Ver archivo adjunto</a>';
            }
            echo '</div>';
        }
        echo '<div style="margin-top: 8px; font-size: 0.8rem;">';
        if (isset($_SESSION['usuario_id'])) {
            echo '<a href="?reply_to=' . $msg['id_comunidad'] . '#form" style="color: var(--rosa-600); margin-right: 10px; text-decoration: none;">Responder</a>';
            if ((int)$msg['usuario_id'] === (int)$_SESSION['usuario_id']) {
                echo '<form action="procesar_delete_comentario.php" method="POST" style="display:inline; margin-left: 10px;">';
                echo '<input type="hidden" name="comentario_id" value="' . $msg['id_comunidad'] . '">';
                echo '<input type="hidden" name="tipo" value="comunidad">';
                echo '<button type="submit" class="btn-secondary" style="padding: 5px 12px; font-size: 0.75rem;">Eliminar</button>';
                echo '</form>';
            }
        }
        echo '</div>';
        echo '</div>';
        mostrarMensajes($mensajes, $msg['id_comunidad'], $nivel + 1);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comunidad - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
    <div class="card-form" style="max-width: 800px; margin: 40px auto;">
        <h2 class="section-title">Chat abierto de comunidad</h2>
        <p>Comparte ideas, preguntas o tus avances con otros lectores y autores.</p>
        <form id="form" action="comunidad.php" method="POST" enctype="multipart/form-data" style="display: grid; gap: 12px; margin-bottom: 24px;">
            <?php if ($parent_id): ?>
                <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>">
                <p style="font-size: 0.9rem; color: #555;">Respondiendo a un mensaje...</p>
            <?php endif; ?>
            <textarea name="contenido" rows="4" class="input-field" placeholder="Escribe un mensaje para la comunidad..."></textarea>
            <input type="file" name="archivo" accept="image/*,application/pdf,.txt" class="input-field">
            <button type="submit" class="btn-primary">Enviar mensaje</button>
        </form>
        <div style="display: grid; gap: 14px;">
            <?php mostrarMensajes($mensajes_por_parent); ?>
        </div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>
