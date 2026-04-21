USE eBiblioteca;

-- ============================================
-- CREAR COLECCIONES PARA EL USUARIO ADMIN (ID=10)
-- Nombres en estilo sentence case (no Title Case)
-- ============================================

-- 1. El siglo de oro español
INSERT INTO listas (nombre, descripcion, id_usuario) VALUES 
('El siglo de oro español', 'Obras representativas del teatro y narrativa del Siglo de Oro español (siglos XVI-XVII). Incluye la primera novela moderna, el precursor del teatro clásico y las grandes obras filosóficas del barroco.', 10);
SET @lista1 = LAST_INSERT_ID();

INSERT INTO lista_obras (id_lista, id_obra) VALUES
(@lista1, 1),   -- Don Quijote de la Mancha (Cervantes, 1605)
(@lista1, 9),   -- La Celestina (Fernando de Rojas, 1499)
(@lista1, 10),  -- Fuenteovejuna (Lope de Vega, 1619)
(@lista1, 11),  -- La vida es sueño (Calderón de la Barca, 1635)
(@lista1, 12);  -- El burlador de Sevilla (Tirso de Molina, 1630)

-- 2. Romanticismo hispánico
INSERT INTO listas (nombre, descripcion, id_usuario) VALUES 
('Romanticismo hispánico', 'Movimiento romántico en España e Hispanoamérica (1800-1880). Poesía lírica, teatro romántico, novela sentimental y el costumbrismo crítico que marca la transición del Neoclasicismo al Romanticismo.', 10);
SET @lista2 = LAST_INSERT_ID();

INSERT INTO lista_obras (id_lista, id_obra) VALUES
(@lista2, 6),   -- Rimas (Bécquer, 1871)
(@lista2, 7),   -- Cantares gallegos (Rosalía de Castro, 1863)
(@lista2, 8),   -- Don Juan Tenorio (Zorrilla, 1844)
(@lista2, 13),  -- Vuelva usted mañana (Larra, 1834)
(@lista2, 15),  -- María (Jorge Isaacs, 1867)
(@lista2, 3);   -- El sí de las niñas (Moratín, 1806)

-- 3. Narrativa del realismo y naturalismo
INSERT INTO listas (nombre, descripcion, id_usuario) VALUES 
('Narrativa del realismo y naturalismo', 'Obras del Realismo español (1870-1900) y su extensión americana. Las tres grandes novelas realistas españolas, el poema gauchesco argentino y el cuento modernista como transición.', 10);
SET @lista3 = LAST_INSERT_ID();

INSERT INTO lista_obras (id_lista, id_obra) VALUES
(@lista3, 2),   -- Fortunata y Jacinta (Galdós, 1887)
(@lista3, 4),   -- Los pazos de Ulloa (Pardo Bazán, 1886)
(@lista3, 5),   -- La Regenta (Clarín, 1884-1885)
(@lista3, 14),  -- Martín Fierro (José Hernández, 1872)
(@lista3, 16);  -- Cuentos de amor de locura y de muerte (Quiroga, 1917)

-- 4. Modernismo y vanguardismo hispanoamericano
INSERT INTO listas (nombre, descripcion, id_usuario) VALUES 
('Modernismo y vanguardismo hispanoamericano', 'El Modernismo (1880-1920) y su evolución hacia la vanguardia. Incluye al príncipe de las letras castellanas, el poeta que revolucionó la métrica, y el poema hermético barroco que anticipa el simbolismo.', 10);
SET @lista4 = LAST_INSERT_ID();

INSERT INTO lista_obras (id_lista, id_obra) VALUES
(@lista4, 18),  -- Azul (Rubén Darío, 1888)
(@lista4, 28),  -- Prosas profanas (Rubén Darío, 1896)
(@lista4, 24),  -- Los heraldos negros (César Vallejo, 1919)
(@lista4, 23),  -- Nocturno (José Asunción Silva, 1894)
(@lista4, 26);  -- Primero sueño (Sor Juana Inés de la Cruz, 1692)

-- 5. Ensayos y pensamiento latinoamericano
INSERT INTO listas (nombre, descripcion, id_usuario) VALUES 
('Ensayos y pensamiento latinoamericano', 'Pensamiento crítico, ensayo político y literatura de difusión cultural. Desde el análisis sociológico de Sarmiento hasta el idealismo de Rodó, el americanismo de Martí y la literatura popular.', 10);
SET @lista5 = LAST_INSERT_ID();

INSERT INTO lista_obras (id_lista, id_obra) VALUES
(@lista5, 21),  -- Facundo (Sarmiento, 1845)
(@lista5, 22),  -- Ariel (Rodó, 1900)
(@lista5, 27),  -- Nuestra América (Martí, 1891)
(@lista5, 25),  -- Viaje maravilloso del señor Nic-Nac (Holmberg, 1875)
(@lista5, 30),  -- Tradiciones peruanas (Ricardo Palma, 1872)
(@lista5, 17);  -- Cuentos de la selva (Quiroga, 1918)

-- 6. Mujeres escritoras en la literatura hispánica
INSERT INTO listas (nombre, descripcion, id_usuario) VALUES 
('Mujeres escritoras en la literatura hispánica', 'Recuperación de voces femeninas y obras con fuerte componente femenino. Tres autoras fundamentales y obras donde el protagonismo femenino es central.', 10);
SET @lista6 = LAST_INSERT_ID();

INSERT INTO lista_obras (id_lista, id_obra) VALUES
(@lista6, 4),   -- Los pazos de Ulloa (Emilia Pardo Bazán, 1886)
(@lista6, 7),   -- Cantares gallegos (Rosalía de Castro, 1863)
(@lista6, 26),  -- Primero sueño (Sor Juana Inés de la Cruz, 1692)
(@lista6, 15),  -- María (Jorge Isaacs, 1867)
(@lista6, 29); -- La vorágine (José Eustasio Rivera, 1924)

-- Verificación
SELECT 'COLECCIONES CREADAS EXITOSAMENTE' AS resultado;
SELECT 
    l.id,
    l.nombre,
    l.descripcion,
    COUNT(lo.id_obra) as total_obras
FROM listas l
LEFT JOIN lista_obras lo ON l.id = lo.id_lista
WHERE l.id_usuario = 10 AND l.id > 13
GROUP BY l.id, l.nombre, l.descripcion
ORDER BY l.id;
