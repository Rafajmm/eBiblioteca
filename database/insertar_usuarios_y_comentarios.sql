USE eBiblioteca;

-- ============================================
-- INSERTAR 3 USUARIOS DE PRUEBA
-- Contraseñas hasheadas con password_hash('password123', PASSWORD_DEFAULT)
-- La contraseña plain text es: password123
-- La contraseña del administrador y otros usuarios creados desde la app es: passPrueba1!
-- ============================================

INSERT INTO usuarios (nombre, nombre_usuario, correo, pass, bio, es_admin, activo) VALUES
('Ana García López', 'ana_lectora', 'ana.garcia@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Amante de la literatura clásica y el café. Leo todos los días antes de dormir.', 0, 1),

('Carlos Martínez Ruiz', 'carlos_bookworm', 'carlos.mtz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Profesor de literatura y escritor aficionado. Especialista en Siglo de Oro.', 0, 1),

('María Elena Sousa', 'maria_elena_reads', 'maria.sousa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bloguera literaria. Comparto reseñas y recomendaciones semanales.', 0, 1);

-- Obtener los IDs de los usuarios recién creados
-- (asumiendo que los IDs son consecutivos después de los existentes)
-- Si ya hay usuarios, ajustar los IDs según corresponda

-- ============================================
-- INSERTAR COMENTARIOS EN "DON QUIJOTE DE LA MANCHA" (ID = 1)
-- ============================================

-- Comentarios de Ana García (usuario recién creado)
INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'Acabo de terminar de leer el Quijote por primera vez y estoy maravillada. La prosa de Cervantes es tan viva que parece que los personajes van a salir del libro. El contraste entre la idealismo de Don Quijote y el pragmatismo de Sancho es simplemente genial.',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'ana_lectora';

INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'El capítulo de los molinos de viento es mi favorito. Me reí tanto con la escena de los "gigantes". Cervantes era un maestro del humor y la ironía.',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'ana_lectora';

-- Comentarios de Carlos Martínez (usuario recién creado)
INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'Como docente, recomiendo esta edición a mis alumnos. La estructura de la novela -con sus historias intercaladas- es un prodigio de construcción narrativa. Cervantes inventó la novela moderna y esto es evidencia palpable.',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'carlos_bookworm';

INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'El personaje de Dulcinea del Toboso es fascinante desde el punto de vista literario. Es un amor idealizado, una quimera que impulsa toda la trama. El capítulo de la cueva de Montesinos es pura genialidad metaficcional.',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'carlos_bookworm';

INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'La segunda parte del Quijote es aún mejor que la primera, algo poco común en las novelas de la época. Cervantes respondió a la continuación apócrifa de Avellaneda con una obra maestra de auto-consciencia literaria.',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'carlos_bookworm';

-- Comentarios de María Elena (usuario recién creado)
INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'Reseña completa en mi blog: este libro merece cada página de sus 800+ hojas. La relación entre amo y escudero evoluciona de manera tan natural que te hace reflexionar sobre la amistad verdadera. ⭐⭐⭐⭐⭐',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'maria_elena_reads';

INSERT INTO comentarios (contenido, id_usuario, id_obra, revisado) 
SELECT 
    'Lo que más me impresiona es cómo Cervantes trata temas tan actuales hace más de 400 años: la locura y la cordura, la realidad vs la ficción, el envejecimiento... Una obra atemporal.',
    id,
    1,
    1
FROM usuarios WHERE nombre_usuario = 'maria_elena_reads';

-- ============================================
-- VERIFICACIÓN: MOSTRAR LOS DATOS INSERTADOS
-- ============================================

SELECT 'USUARIOS CREADOS' AS resultado;
SELECT id, nombre, nombre_usuario, correo, es_admin, activo, fecha_registro 
FROM usuarios 
WHERE nombre_usuario IN ('ana_lectora', 'carlos_bookworm', 'maria_elena_reads');

SELECT 'COMENTARIOS EN DON QUIJOTE' AS resultado;
SELECT 
    c.id,
    u.nombre_usuario,
    LEFT(c.contenido, 50) AS contenido_preview,
    c.fecha_comentario
FROM comentarios c
JOIN usuarios u ON c.id_usuario = u.id
WHERE c.id_obra = 1
ORDER BY c.fecha_comentario DESC;
