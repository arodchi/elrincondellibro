<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ajustes y Ayuda - El Rincón del Libro</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <div class="profile-layout">
        
        <aside class="profile-sidebar">
            <div class="profile-card">
                <h3 class="section-title" style="font-size: 20px;">Configuración</h3>
                <nav class="settings-nav">
                    <a href="#cuenta" class="active"><i class="fa-solid fa-user-gear"></i> Cuenta</a>
                    <a href="#manual-lector"><i class="fa-solid fa-book-reader"></i> Guía del Lector</a>
                    <a href="#manual-autor"><i class="fa-solid fa-pen-nib"></i> Guía del Autor</a>
                    <a href="#soporte"><i class="fa-solid fa-headset"></i> Soporte Técnico</a>
                </nav>
            </div>
        </aside>

        <main class="profile-main">
            
            <section id="cuenta" class="card-form settings-section">
                <h3 class="section-title">Gestión de la Cuenta</h3>
                <p>Aquí puedes actualizar tu avatar, tu biografía y tu contraseña.</p>

                <form action="procesar_ajustes.php" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                    <input type="hidden" name="action" value="update_profile">
                    <label style="display:block; margin-bottom: 10px; font-weight:600;">Avatar</label>
                    <input type="file" name="avatar" accept="image/*" class="input-field" style="margin-bottom: 15px;">
                    <label style="display:block; margin-bottom: 10px; font-weight:600;">Biografía</label>
                    <textarea name="bio" class="input-field" rows="4" placeholder="Una breve descripción sobre ti..." style="width:100%; margin-bottom: 15px; border:1px solid #ccc;"></textarea>
                    <button type="submit" class="btn-primary">Guardar perfil</button>
                </form>

                <form action="procesar_ajustes.php" method="POST" style="margin-bottom: 30px;">
                    <input type="hidden" name="action" value="change_password">
                    <label style="display:block; margin-bottom: 10px; font-weight:600;">Contraseña actual</label>
                    <input type="password" name="current_password" placeholder="Contraseña actual" class="input-field" style="margin-bottom: 10px;">
                    <label style="display:block; margin-bottom: 10px; font-weight:600;">Nueva contraseña</label>
                    <input type="password" name="new_password" placeholder="Nueva contraseña" class="input-field" style="margin-bottom: 10px;">
                    <label style="display:block; margin-bottom: 10px; font-weight:600;">Confirmar contraseña</label>
                    <input type="password" name="confirm_password" placeholder="Confirmar nueva contraseña" class="input-field" style="margin-bottom: 15px;">
                    <button type="submit" class="btn-primary">Actualizar contraseña</button>
                </form>

                <form action="procesar_ajustes.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas desactivar tu cuenta? Esta acción cerrará tu sesión.');">
                    <input type="hidden" name="action" value="deactivate_account">
                    <button type="submit" class="btn-secondary" style="background: #e74c3c; color: white;">Desactivar cuenta</button>
                </form>
            </section>

            <section id="manual-lector" class="card-form settings-section">
                <h3 class="section-title">Manual: Guía para el Lector</h3>
                <div class="manual-content">
                    <h4>Navegación por el Catálogo</h4>
                    <p>Puedes encontrar todas las obras organizadas de manera visual mediante tarjetas de libros y filtrado por categorías como Ficción o Romance.</p>
                    
                    <h4>Mi Biblioteca Personal</h4>
                    <p>Al marcar un libro como "Favorito", se guardará un acceso directo en tu panel de "Biblioteca" y recibirás alertas cuando haya actualizaciones.</p>
                </div>
            </section>

            <section id="manual-autor" class="card-form settings-section">
                <h3 class="section-title">Manual: Guía para el Autor</h3>
                <div class="manual-content">
                    <h4>Creación de una Nueva Obra</h4>
                    <p>Accede a la sección "Escribir", pulsa en "+ Crear nuevo libro" y asigna un título y categoría.</p>
                    
                    <h4>Publicación de Capítulos </h4>
                    <p>Puedes añadir contenido de forma progresiva. Al pulsar "Publicar", el capítulo estará disponible inmediatamente para toda la plataforma.</p>
                </div>
            </section>

            <section id="soporte" class="card-form settings-section">
                <h3 class="section-title">Resolución de Problemas </h3>
                <p>Si experimentas dificultades técnicas, comprueba tus credenciales o el estado de tus pagos en el monedero virtual.</p>
                <p>Para incidencias mayores, usa nuestro formulario de contacto.</p>
            </section>

        </main>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<script>
    document.querySelectorAll('.settings-nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.settings-nav a').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            const target = this.getAttribute('href').substring(1);
            document.querySelectorAll('.settings-section').forEach(sec => {
                sec.style.display = (sec.id === target) ? 'block' : 'none';
            });
        });
    });
</script>

</body>
</html>