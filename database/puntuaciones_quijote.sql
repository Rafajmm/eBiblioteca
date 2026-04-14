USE eBiblioteca;

-- ============================================
-- INSERTAR PUNTUACIONES PARA DON QUIJOTE DE LA MANCHA (ID = 1)
-- ============================================

INSERT INTO puntuaciones (id_usuario, id_obra, valor) VALUES
((SELECT id FROM usuarios WHERE nombre_usuario = 'ana_lector'), 1, 5),
((SELECT id FROM usuarios WHERE nombre_usuario = 'carlos_bookworm'), 1, 5),
((SELECT id FROM usuarios WHERE nombre_usuario = 'maria_elena_reads'), 1, 4);

-- ============================================
-- VERIFICACIÓN
-- ============================================

SELECT 
    u.nombre_usuario,
    p.valor,
    p.fecha_puntuacion
FROM puntuaciones p
JOIN usuarios u ON p.id_usuario = u.id
WHERE p.id_obra = 1
ORDER BY p.fecha_puntuacion DESC;

-- Puntuación media actualizada
SELECT 
    ROUND(AVG(valor), 1) AS puntuacion_media,
    COUNT(*) AS total_puntuaciones
FROM puntuaciones 
WHERE id_obra = 1;
