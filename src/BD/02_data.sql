SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE transacciones;
TRUNCATE TABLE mensajes;
TRUNCATE TABLE chats;
TRUNCATE TABLE actividad;
TRUNCATE TABLE notificaciones;
TRUNCATE TABLE archivos;
TRUNCATE TABLE favoritos;
TRUNCATE TABLE seguidores;
TRUNCATE TABLE comentarios;
TRUNCATE TABLE valoraciones;
TRUNCATE TABLE capitulos;
TRUNCATE TABLE libros;
TRUNCATE TABLE categorias;
TRUNCATE TABLE usuarios;

INSERT INTO usuarios (nombre, email, password, avatar, bio) VALUES
('María Lectora', 'maria@ejemplo.com', '$2y$10$D2tN3k7qEuw1z0mi.elX.ODvRHIhPXkeCpT3ERss4wazOP5htqO7a', 'img/user-default.png', 'Exploradora de historias fantásticas y amante de los clásicos.');

INSERT INTO categorias (nombre) VALUES
('Ficcion'),
('Romance'),
('Misterio'),
('Aventura'),
('Fantasia');

INSERT INTO libros (usuario_id, categoria_id, titulo, portada, precio) VALUES
(1, 1, 'El Bosque Místico', 'Imagen_de_ejemplo.png', 0.00),
(1, 5, 'Regalo de Ceniza', 'Imagen_de_ejemplo.png', 4.99);

INSERT INTO capitulos (libro_id, titulo, contenido) VALUES
(1, 'Capítulo 1 - El primer susurro', 'El bosque se despertó con un murmullo de hojas. Cada tronco parecía guardar un secreto.'),
(2, 'Capítulo 1 - La carta olvidada', 'El sobre amarillo apareció sobre la mesa. Nadie esperaba que dentro hubiera algo más que palabras.');

INSERT INTO comentarios (usuario_id, capitulo_id, contenido) VALUES
(1, 1, 'Un inicio muy prometedor. ¡No puedo esperar a leer el siguiente capítulo!');

INSERT INTO valoraciones (usuario_id, libro_id, puntuacion) VALUES
(1, 1, 5);

SET FOREIGN_KEY_CHECKS = 1;
USE elrincondellibro;

-- 1. LIMPIEZA TOTAL (Para poder ejecutar el script varias veces sin errores)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE actividad; TRUNCATE TABLE notificaciones; TRUNCATE TABLE seguidores;
TRUNCATE TABLE favoritos; TRUNCATE TABLE comentarios;
TRUNCATE TABLE archivos; TRUNCATE TABLE capitulos; TRUNCATE TABLE libros;
TRUNCATE TABLE categorias; TRUNCATE TABLE usuarios;
SET FOREIGN_KEY_CHECKS = 1;

-- 2. USUARIOS (Contraseña para todos: 1234)
-- El Usuario 1 es 'Alba Autora', el Usuario 2 es 'Lector' y el Usuario 3 es 'Gorka'
-- Generado con password_hash('1234', PASSWORD_BCRYPT)
/*INSERT INTO usuarios (id_usuarios, nombre, email, password) VALUES 
(1, 'Alba Autora', 'alba@demo.com', '1234'),
(2, 'Lector', 'lector@demo.com', '1234'),
(3, 'Escritor', 'escritor@demo.com', '1234');*/

-- 3. CATEGORIAS
INSERT INTO categorias (id_categorias, nombre) VALUES 
(1, 'Ficcion'), (2, 'Romance'), (3, 'Misterio'), (4, 'Aventura'), (5, 'Fantasia');

-- 4. LIBROS (Varios libros por usuario)
INSERT INTO libros (id_libros, usuario_id, categoria_id, titulo, portada) VALUES 
(1, 1, 1, 'El Misterio del Dragon Rosado', 'portada1.png'),
(2, 1, 5, 'Las Cronicas de PHP', 'portada2.png'),
(3, 3, 3, 'Sombras en el Servidor', 'portada3.png'), -- Libro del Usuario 3
(4, 3, 4, 'Aventura en Docker', 'portada4.png');    -- Otro libro del Usuario 3

-- 5. CAPITULOS (Varios capítulos por libro)
INSERT INTO capitulos (id_capitulos, libro_id, titulo, contenido) VALUES 
(1, 1, 'El Despertar', 'Contenido del capitulo 1...'),
(2, 1, 'La Cueva', 'Contenido del capitulo 2...'),
(3, 3, 'El Error 404', 'Contenido del capitulo de misterio...');

-- 6. FAVORITOS (Relación solicitada: Usuario 1 tiene como fav el libro del Usuario 3)
INSERT INTO favoritos (usuario_id, libro_id) VALUES 
(1, 3), -- Alba (ID 1) tiene en favoritos 'Sombras en el Servidor' (ID 3, de Gorka)
(2, 1), -- Juan tiene en favoritos el libro de Alba
(1, 4); -- Alba también tiene otro libro de Gorka en favoritos

-- 7. SEGUIDORES
INSERT INTO seguidores (seguidor_id, seguido_id) VALUES 
(1, 3), -- Alba sigue a Gorka
(2, 1); -- Juan sigue a Alba

-- 8. COMENTARIOS
INSERT INTO comentarios (usuario_id, capitulo_id, contenido) VALUES 
(2, 1, '¡Me encanta este libro, Alba!'),
(1, 3, 'Gorka, este capitulo de misterio es increible.');

-- 9. NOTIFICACIONES
INSERT INTO notificaciones (usuario_id, mensaje) VALUES 
(1, 'A Juan Lector le ha gustado tu libro.'),
(3, 'Alba Autora ha añadido tu libro a favoritos.'),
(1, 'Gorka Escritor ha publicado un nuevo capitulo.');

-- 10. ACTIVIDAD (Log de acciones)
INSERT INTO actividad (usuario_id, tipo, referencia_id) VALUES 
(1, 'registro', 1),
(3, 'publicacion_libro', 3),
(1, 'favorito', 3);

-- 11. ARCHIVOS
INSERT INTO archivos (libro_id, ruta) VALUES 
(1, 'uploads/dragon.pdf'),
(3, 'uploads/misterio.epub');
INSERT INTO archivos (libro_id, ruta) VALUES 
(1, 'uploads/dragon.pdf'),
(3, 'uploads/misterio.epub');