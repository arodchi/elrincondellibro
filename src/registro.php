<?php
session_start();
include 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $email = $conexion->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // encriptar contraseña

    // Verificar si el email ya existe
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $mensaje = "Este correo ya está registrado.";
    } else {
        // Insertar usuario usando columna 'password'
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
        if ($conexion->query($sql)) {
            $_SESSION['usuario_nombre'] = $nombre;
            header('Location: index.php'); // Redirigir al inicio
            exit;
        } else {
            $mensaje = "Error al registrar usuario: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - ElRincónDelLibro</title>
    <link rel="stylesheet" href="CSS/style1.css">
</head>
<body>
    <div class="container" style="max-width:400px; margin-top:50px;">
        <h2>Registro</h2>
        <?php if($mensaje): ?>
            <p style="color:red;"><?= $mensaje ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre" class="input-field" required>
            <input type="email" name="email" placeholder="Correo" class="input-field" required>
            <input type="password" name="password" placeholder="Contraseña" class="input-field" required>
            <button class="btn-primary" type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
    <script>
    // Aplicar modo noche si está guardado en el navegador
    if (localStorage.getItem("dark-mode") === "true") {
        document.body.classList.add("dark-mode");
    }
</script>
</body>
</html>
