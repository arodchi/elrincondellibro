<footer class="footer">
    <div class="container footer-inner">
        <p>&copy; 2025 ElRincónDelLibro. Proyecto realizado por Alba Rodríguez Chito</p>
    </div>
</footer>

<script>
    /* ==========================
   DROPDOWN USUARIO (CLIC)
========================== */
const userTrigger = document.querySelector(".user-trigger");
const userMenu = document.querySelector(".user-dropdown");

if (userTrigger && userMenu) {
    userTrigger.addEventListener("click", (e) => {
        e.stopPropagation(); // Evita que el clic se propague al documento
        userMenu.classList.toggle("active");
        
        // Opcional: Cerrar el menú de notificaciones si está abierto
        const notifMenu = document.getElementById("notifMenu");
        if(notifMenu) notifMenu.classList.remove("active");
    });

    // Cerrar al hacer clic en cualquier otro lugar de la página
    document.addEventListener("click", () => {
        userMenu.classList.remove("active");
    });
}
document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       NOTIFICACIONES
    ========================== */
    const notifTrigger = document.getElementById("notifTrigger");
    const notifMenu = document.getElementById("notifMenu");

    if (notifTrigger && notifMenu) {
        notifTrigger.addEventListener("click", (e) => {
            e.stopPropagation();
            notifMenu.classList.toggle("active");
        });

        document.addEventListener("click", () => {
            notifMenu.classList.remove("active");
        });
    }

    /* ==========================
       MODO OSCURO
    ========================== */
    if (localStorage.getItem("dark-mode") === "true") {
        document.body.classList.add("dark-mode");
    }

    updateDarkIcon();
});

function updateDarkIcon() {
    const icon = document.getElementById("dark-icon");
    if (!icon) return;

    if (document.body.classList.contains("dark-mode")) {
        icon.classList.remove("fa-moon");
        icon.classList.add("fa-sun");
    } else {
        icon.classList.remove("fa-sun");
        icon.classList.add("fa-moon");
    }
}

function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
    // Guardamos el estado
    const isDark = document.body.classList.contains("dark-mode");
    localStorage.setItem("dark-mode", isDark);
    updateDarkIcon();
}

// Al cargar la página, aplicamos si ya estaba activado
document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("dark-mode") === "true") {
        document.body.classList.add("dark-mode");
    }
    updateDarkIcon();
});
</script>

