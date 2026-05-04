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

$usuario_id = isset($_SESSION['usuario_id']) ? (int)$_SESSION['usuario_id'] : 0;
$other_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
if ($other_id <= 0 || $other_id === $usuario_id) {
    header('Location: mensajes.php');
    exit;
}

$ordenA = min($usuario_id, $other_id);
$ordenB = max($usuario_id, $other_id);
$chat_res = $conexion->query("SELECT id_chat FROM chats WHERE usuario_a = $ordenA AND usuario_b = $ordenB LIMIT 1");
if ($chat_res->num_rows === 0) {
    $conexion->query("INSERT INTO chats (usuario_a, usuario_b) VALUES ($ordenA, $ordenB)");
    $chat_id = $conexion->insert_id;
} else {
    $chat_id = $chat_res->fetch_assoc()['id_chat'];
}

$mensaje_bloqueado = false;
$bloqueo_res = $conexion->query("SELECT 1 FROM bloqueos WHERE (usuario_id = $usuario_id AND bloqueado_id = $other_id) OR (usuario_id = $other_id AND bloqueado_id = $usuario_id) LIMIT 1");
if ($bloqueo_res && $bloqueo_res->num_rows > 0) {
    $mensaje_bloqueado = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$mensaje_bloqueado) {
    $contenido = trim($_POST['mensaje'] ?? '');
    $archivo = null;
    $tipo = 'texto';

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/uploads/chat/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('chat_', true) . '.' . strtolower($extension);
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
        $sql_insert = "INSERT INTO mensajes (chat_id, remitente_id, contenido, archivo, tipo) VALUES ($chat_id, $usuario_id, '" . $contenido_safe . "', " . ($archivo ? "'" . $archivo_safe . "'" : 'NULL') . ", '$tipo_safe')";
        $conexion->query($sql_insert);

        $nombre_remitente = $conexion->real_escape_string($_SESSION['usuario_nombre']);
        $mensaje_not = $conexion->real_escape_string("Nuevo mensaje de $nombre_remitente.");
        $conexion->query("INSERT INTO notificaciones (usuario_id, mensaje, url) VALUES ($other_id, '$mensaje_not', 'chat.php?user_id=$usuario_id')");
    }

    header('Location: chat.php?user_id=' . $other_id);
    exit;
}

$partner_res = $conexion->query("SELECT nombre FROM usuarios WHERE id_usuarios = $other_id LIMIT 1");
if (!$partner_res || $partner_res->num_rows === 0) {
    header('Location: mensajes.php');
    exit;
}
$partner = $partner_res->fetch_assoc();
$mensajes_res = $conexion->query("SELECT m.contenido, m.fecha, m.archivo, m.tipo, u.nombre, u.id_usuarios FROM mensajes m JOIN usuarios u ON m.remitente_id = u.id_usuarios WHERE m.chat_id = $chat_id ORDER BY m.fecha ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat con <?php echo htmlspecialchars($partner['nombre']); ?> - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <div class="card-form">
        <h2 class="section-title">Chat con <?php echo htmlspecialchars($partner['nombre']); ?></h2>
        <div style="display: grid; gap: 12px; margin-bottom: 20px;">
            <?php if ($mensajes_res && $mensajes_res->num_rows > 0): ?>
                <?php while ($msg = $mensajes_res->fetch_assoc()): ?>
                    <div style="background: <?php echo $msg['id_usuarios'] === $usuario_id ? '#e3f2fd' : '#fafafa'; ?>; padding: 12px 14px; border-radius: 12px; border: 1px solid #ddd; max-width: 90%; <?php echo $msg['id_usuarios'] === $usuario_id ? 'margin-left:auto;' : ''; ?>">
                        <p style="margin: 0 0 6px; font-weight: 600; color: #333;"><?php echo htmlspecialchars($msg['nombre']); ?></p>
                        <?php if (!empty($msg['contenido'])): ?>
                            <p style="margin: 0; color: #444; line-height: 1.5;"><?php echo nl2br(htmlspecialchars($msg['contenido'])); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($msg['archivo'])): ?>
                            <div style="margin-top: 10px;">
                                <?php if ($msg['tipo'] === 'imagen'): ?>
                                    <img src="<?php echo htmlspecialchars($msg['archivo']); ?>" alt="Adjunto" style="max-width: 200px; border-radius: 10px; border: 1px solid #ddd;">
                                <?php else: ?>
                                    <a href="<?php echo htmlspecialchars($msg['archivo']); ?>" target="_blank" style="color: #1e90ff;">Ver archivo adjunto</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <p style="margin: 8px 0 0; font-size: 0.8rem; color: #777; text-align: right;"><?php echo date('d/m/Y H:i', strtotime($msg['fecha'])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay mensajes aún. Envía el primero para comenzar la conversación.</p>
            <?php endif; ?>
        </div>

        <?php if ($mensaje_bloqueado): ?>
            <div style="background: #fff0f0; color: #a33; padding: 15px; border-radius: 10px; border: 1px solid #f5c2c7;">
                La conversación está bloqueada entre los usuarios. No puedes enviar ni recibir mensajes en este chat.
            </div>
        <?php else: ?>
            <form action="chat.php?user_id=<?php echo $other_id; ?>" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <textarea name="mensaje" placeholder="Escribe tu mensaje..." class="input-field" rows="4" style="flex:1; min-width: 220px;"></textarea>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <input type="file" name="archivo" accept="image/*,application/pdf,.txt" class="input-field" style="padding: 8px; border-radius: 8px; border: 1px solid #ccc;">
                    <button type="submit" class="btn-primary" style="height: 56px;">Enviar</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
<script>
    window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    };
</script>
</body>
</html>
