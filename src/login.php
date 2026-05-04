<?php
session_start();
include 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conexion->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND activo = 1";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        // Verificar contraseña
        if (password_verify($password, $usuario['password'])) {
            // GUARDAMOS EN LA SESIÓN (Usando el nombre correcto: $usuario)
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_id']     = $usuario['id_usuarios'];
            $_SESSION['usuario_email']  = $usuario['email'];
            
            header('Location: index.php');
            exit;
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - ElRincónDelLibro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container" style="max-width:400px; margin-top:100px;">
        <div class="card-form" style="text-align: center;">
            <img src="img/dragon1.png" style="width: 80px; margin: 0 auto 20px;">
            <h2 class="section-title">Iniciar sesión</h2>
            
            <?php if($mensaje): ?>
                <p style="color:#C5446C; background: #FCE8ED; padding: 10px; border-radius: 8px;"><?= $mensaje ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="email" name="email" placeholder="Correo electrónico" class="input-field" required>
                <input type="password" name="password" placeholder="Contraseña" class="input-field" required>
                <button class="btn-primary" type="submit" style="width: 100%; font-size: 16px;">Entrar</button>
            </form>
            
            <p style="margin-top: 20px; font-size: 14px;">
                ¿No tienes cuenta? <a href="registro.php" style="color: var(--rosa-600); font-weight: bold;">Regístrate aquí</a>
            </p>
        </div>
    </div>

    <script>
        // Aplicar modo noche si está guardado en el navegador
        if (localStorage.getItem("dark-mode") === "true") {
            document.body.classList.add("dark-mode");
        }
    </script>
</body>
</html>