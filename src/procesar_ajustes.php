<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$action = $_POST['action'] ?? '';

if ($action === 'update_profile') {
    $bio = $conexion->real_escape_string(trim($_POST['bio'] ?? ''));
    $avatar_path = null;

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/uploads/avatars/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('avatar_', true) . '.' . strtolower($extension);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
            $avatar_path = $targetPath;
        }
    }

    $sql = "UPDATE usuarios SET bio = '$bio'";
    if ($avatar_path) {
        $avatar_safe = $conexion->real_escape_string($avatar_path);
        $sql .= ", avatar = '$avatar_safe'";
        $_SESSION['usuario_avatar'] = $avatar_path;
    }
    $sql .= " WHERE id_usuarios = $usuario_id";
    $conexion->query($sql);
    header('Location: ajustes.php#cuenta');
    exit;
}

if ($action === 'change_password') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        header('Location: ajustes.php#cuenta');
        exit;
    }

    if ($new_password !== $confirm_password) {
        header('Location: ajustes.php#cuenta');
        exit;
    }

    $res = $conexion->query("SELECT password FROM usuarios WHERE id_usuarios = $usuario_id LIMIT 1");
    if (!$res || $res->num_rows === 0) {
        header('Location: ajustes.php#cuenta');
        exit;
    }

    $user = $res->fetch_assoc();
    if (!password_verify($current_password, $user['password'])) {
        header('Location: ajustes.php#cuenta');
        exit;
    }

    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE id_usuarios = ?");
    $stmt->bind_param('si', $new_password_hash, $usuario_id);
    $stmt->execute();

    header('Location: ajustes.php#cuenta');
    exit;
}

if ($action === 'deactivate_account') {
    $conexion->query("UPDATE usuarios SET activo = 0 WHERE id_usuarios = $usuario_id");
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

header('Location: ajustes.php');
exit;
?>