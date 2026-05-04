CREATE DATABASE IF NOT EXISTS elrincondellibro;
USE elrincondellibro;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    bio TEXT,
    activo TINYINT(1) DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de categorías
CREATE TABLE IF NOT EXISTS categorias (
    id_categorias INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla de libros
CREATE TABLE IF NOT EXISTS libros (
    id_libros INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    categoria_id INT,
    titulo VARCHAR(255) NOT NULL,
    portada VARCHAR(255),
    precio DECIMAL(8,2) DEFAULT 0,
    edad_recomendada INT DEFAULT 0,
    estado VARCHAR(20) DEFAULT 'en_proceso',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id_categorias) ON DELETE SET NULL
);

-- Tabla de capítulos
CREATE TABLE IF NOT EXISTS capitulos (
    id_capitulos INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (libro_id) REFERENCES libros(id_libros) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS capitulo_imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capitulo_id INT NOT NULL,
    ruta VARCHAR(255) NOT NULL,
    orden INT DEFAULT 0,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (capitulo_id) REFERENCES capitulos(id_capitulos) ON DELETE CASCADE
);

-- Tabla de archivos (para subir PDFs, imágenes u otros recursos)
CREATE TABLE IF NOT EXISTS archivos (
    id_archivos INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT,
    capitulo_id INT,
    ruta VARCHAR(255) NOT NULL,
    tipo VARCHAR(50),
    descripcion VARCHAR(255),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (libro_id) REFERENCES libros(id_libros) ON DELETE CASCADE,
    FOREIGN KEY (capitulo_id) REFERENCES capitulos(id_capitulos) ON DELETE CASCADE
);

-- Tabla de comentarios
CREATE TABLE IF NOT EXISTS comentarios (
    id_comentarios INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    capitulo_id INT NOT NULL,
    parent_id INT DEFAULT NULL,
    contenido TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (capitulo_id) REFERENCES capitulos(id_capitulos) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES comentarios(id_comentarios) ON DELETE CASCADE
);

-- Tabla de favoritos
CREATE TABLE IF NOT EXISTS favoritos (
    id_favoritos INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    libro_id INT,
    capitulo_id INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unico_favorito (usuario_id, libro_id, capitulo_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (libro_id) REFERENCES libros(id_libros) ON DELETE CASCADE,
    FOREIGN KEY (capitulo_id) REFERENCES capitulos(id_capitulos) ON DELETE CASCADE
);

-- Tabla de valoraciones
CREATE TABLE IF NOT EXISTS valoraciones (
    id_valoracion INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    libro_id INT NOT NULL,
    puntuacion TINYINT NOT NULL CHECK (puntuacion BETWEEN 1 AND 5),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unico_valoracion (usuario_id, libro_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (libro_id) REFERENCES libros(id_libros) ON DELETE CASCADE
);

-- Tabla de notificaciones
CREATE TABLE IF NOT EXISTS notificaciones (
    id_notificaciones INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    mensaje TEXT NOT NULL,
    url VARCHAR(255),
    leida TINYINT(1) DEFAULT 0,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

-- Tabla de seguidores
CREATE TABLE IF NOT EXISTS seguidores (
    id_seguidores INT AUTO_INCREMENT PRIMARY KEY,
    seguidor_id INT NOT NULL,
    seguido_id INT NOT NULL,
    fecha_seguimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unico_seguimiento (seguidor_id, seguido_id),
    FOREIGN KEY (seguidor_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (seguido_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

-- Tabla de actividad (para log de acciones del usuario)
CREATE TABLE IF NOT EXISTS actividad (
    id_actividad INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    referencia_id INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

-- Tabla de chats directos entre usuarios
CREATE TABLE IF NOT EXISTS chats (
    id_chat INT AUTO_INCREMENT PRIMARY KEY,
    usuario_a INT NOT NULL,
    usuario_b INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CHECK (usuario_a <> usuario_b),
    UNIQUE KEY unica_conversacion (usuario_a, usuario_b),
    FOREIGN KEY (usuario_a) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (usuario_b) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS mensajes (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    chat_id INT NOT NULL,
    remitente_id INT NOT NULL,
    contenido TEXT,
    archivo VARCHAR(255),
    tipo VARCHAR(50) DEFAULT 'texto',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES chats(id_chat) ON DELETE CASCADE,
    FOREIGN KEY (remitente_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comunidad_mensajes (
    id_comunidad INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    contenido TEXT,
    archivo VARCHAR(255),
    tipo VARCHAR(50) DEFAULT 'texto',
    parent_id INT DEFAULT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES comunidad_mensajes(id_comunidad) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comentario_likes (
    id_like INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    comentario_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unico_like (usuario_id, comentario_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (comentario_id) REFERENCES comentarios(id_comentarios) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS bloqueos (
    id_bloqueo INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    bloqueado_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unico_bloqueo (usuario_id, bloqueado_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (bloqueado_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS soporte (
    id_soporte INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    email VARCHAR(100),
    asunto VARCHAR(255),
    descripcion TEXT,
    estado VARCHAR(20) DEFAULT 'abierto',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS transacciones (
    id_transaccion INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    referencia_id INT,
    monto DECIMAL(8,2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE
);

-- Datos iniciales para que el catálogo no esté vacío
INSERT INTO categorias (nombre) VALUES ('Ficción'), ('Romance'), ('Misterio'), ('Aventura'), ('Fantasía');