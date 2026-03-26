USE eBiblioteca;

-- ============================================
-- LIMPIEZA OPCIONAL
-- ============================================
DELETE FROM obra_etiquetas;
DELETE FROM obra_autores;
DELETE FROM obras;
DELETE FROM autores;
DELETE FROM etiquetas;

ALTER TABLE etiquetas AUTO_INCREMENT = 1;
ALTER TABLE autores AUTO_INCREMENT = 1;
ALTER TABLE obras AUTO_INCREMENT = 1;

-- ============================================
-- ETIQUETAS
-- ============================================
INSERT INTO etiquetas (id, nombre) VALUES
(1, 'Clásico'),
(2, 'Realismo'),
(3, 'Naturalismo'),
(4, 'Romanticismo'),
(5, 'Costumbrismo'),
(6, 'Aventuras'),
(7, 'Sátira'),
(8, 'Drama'),
(9, 'Comedia'),
(10, 'Cuento'),
(11, 'Modernismo'),
(12, 'Simbolismo'),
(13, 'Ciencia ficción'),
(14, 'Criollismo'),
(15, 'Feminismo'),
(16, 'Rural'),
(17, 'Filosófico'),
(18, 'Identidad'),
(19, 'Social'),
(20, 'Infantil'),
(21, 'Fantástico'),
(22, 'Amor'),
(23, 'Caballerías'),
(24, 'Picaresca'),
(25, 'Político'),
(26, 'Lírico'),
(27, 'Tragedia'),
(28, 'Psicológico');

-- ============================================
-- AUTORES
-- ============================================
INSERT INTO autores (id, nombre, pais, fecha_nacimiento, biografia) VALUES
(1, 'Miguel de Cervantes', 'España', '1547-09-29', 'Novelista, poeta y dramaturgo español, figura central de la literatura en lengua española.'),
(2, 'Benito Pérez Galdós', 'España', '1843-05-10', 'Novelista y dramaturgo español, uno de los principales representantes del realismo.'),
(3, 'Emilia Pardo Bazán', 'España', '1851-09-16', 'Narradora, ensayista y crítica literaria española vinculada al naturalismo.'),
(4, 'Leopoldo Alas Clarín', 'España', '1852-04-25', 'Escritor y crítico español, autor de una de las novelas más importantes del siglo XIX.'),
(5, 'Gustavo Adolfo Bécquer', 'España', '1836-02-17', 'Poeta y narrador español, referente del posromanticismo.'),
(6, 'Rosalía de Castro', 'España', '1837-02-23', 'Poeta y novelista gallega, figura clave de la literatura española del siglo XIX.'),
(7, 'José Zorrilla', 'España', '1817-02-21', 'Poeta y dramaturgo español, célebre por su teatro romántico.'),
(8, 'Fernando de Rojas', 'España', '1470-01-01', 'Autor de La Celestina, obra fundamental de la literatura hispánica.'),
(9, 'Lope de Vega', 'España', '1562-11-25', 'Dramaturgo y poeta del Siglo de Oro español.'),
(10, 'Pedro Calderón de la Barca', 'España', '1600-01-17', 'Dramaturgo barroco español y figura esencial del teatro universal.'),
(11, 'Tirso de Molina', 'España', '1579-03-24', 'Dramaturgo y poeta del Siglo de Oro español.'),
(12, 'Mariano José de Larra', 'España', '1809-03-24', 'Escritor y periodista español del romanticismo.'),
(13, 'José Hernández', 'Argentina', '1834-11-10', 'Poeta argentino, autor del gran poema nacional gauchesco.'),
(14, 'Jorge Isaacs', 'Colombia', '1837-04-01', 'Novelista y poeta colombiano, autor de una de las novelas románticas más conocidas de América Latina.'),
(15, 'Horacio Quiroga', 'Uruguay', '1878-12-31', 'Narrador uruguayo, maestro del cuento hispanoamericano.'),
(16, 'Rubén Darío', 'Nicaragua', '1867-01-18', 'Poeta nicaragüense, máximo exponente del modernismo.'),
(17, 'José Martí', 'Cuba', '1853-01-28', 'Escritor, poeta y ensayista cubano, figura clave del pensamiento hispanoamericano.'),
(18, 'Clorinda Matto de Turner', 'Perú', '1852-11-11', 'Escritora peruana destacada por su narrativa de denuncia social.'),
(19, 'Domingo Faustino Sarmiento', 'Argentina', '1811-02-15', 'Ensayista, político y educador argentino.'),
(20, 'José Enrique Rodó', 'Uruguay', '1871-07-15', 'Ensayista uruguayo, figura importante del pensamiento hispanoamericano.'),
(21, 'José Asunción Silva', 'Colombia', '1865-11-27', 'Poeta colombiano vinculado al modernismo.'),
(22, 'César Vallejo', 'Perú', '1892-03-16', 'Poeta y escritor peruano, una de las grandes voces de la poesía en español.'),
(23, 'Eduardo Ladislao Holmberg', 'Argentina', '1852-06-27', 'Escritor argentino pionero de la ciencia ficción en español.'),
(24, 'Sor Juana Inés de la Cruz', 'México', '1648-11-12', 'Poeta y dramaturga novohispana, figura esencial del barroco hispánico.'),
(25, 'José Eustasio Rivera', 'Colombia', '1888-02-19', 'Escritor colombiano, autor de una novela clave sobre la selva americana.'),
(26, 'Ricardo Palma', 'Perú', '1833-02-07', 'Escritor peruano célebre por sus relatos históricos y costumbristas.');

-- ============================================
-- OBRAS
-- genero: Narrativa | Ensayo | Poesía | Teatro | Infantil
-- ============================================
INSERT INTO obras (
    id, titulo, sinopsis, paginas, fecha_publicacion, ruta_pdf, ruta_html, genero
) VALUES
(1, 'Don Quijote de la Mancha', 'Novela sobre un hidalgo que enloquece leyendo libros de caballerías y decide convertirse en caballero andante.', 863, '1605-01-16', NULL, NULL, 'Narrativa'),
(2, 'Fortunata y Jacinta', 'Novela realista sobre clases sociales, matrimonio, deseo y vida urbana en el Madrid del siglo XIX.', 1050, '1887-01-01', NULL, NULL, 'Narrativa'),
(3, 'Marianela', 'Novela breve sobre amor, pobreza y apariencia en un entorno minero.', 240, '1878-01-01', NULL, NULL, 'Narrativa'),
(4, 'Los pazos de Ulloa', 'Novela naturalista ambientada en la Galicia rural, centrada en decadencia, poder y violencia.', 340, '1886-01-01', NULL, NULL, 'Narrativa'),
(5, 'La Regenta', 'Novela de análisis psicológico y crítica social ambientada en una ciudad de provincias.', 700, '1884-01-01', NULL, NULL, 'Narrativa'),
(6, 'Rimas', 'Colección de poemas breves de tono íntimo, amoroso y reflexivo.', 120, '1871-01-01', NULL, NULL, 'Poesía'),
(7, 'Cantares gallegos', 'Libro poético fundamental del renacimiento literario gallego.', 180, '1863-01-01', NULL, NULL, 'Poesía'),
(8, 'Don Juan Tenorio', 'Drama romántico sobre el mito del seductor y la redención.', 200, '1844-01-01', NULL, NULL, 'Teatro'),
(9, 'La Celestina', 'Tragicomedia sobre pasión, codicia y manipulación.', 220, '1499-01-01', NULL, NULL, 'Teatro'),
(10, 'Fuenteovejuna', 'Drama teatral basado en un levantamiento colectivo contra el abuso de poder.', 180, '1619-01-01', NULL, NULL, 'Teatro'),
(11, 'La vida es sueño', 'Drama filosófico sobre libertad, destino, poder y apariencia.', 170, '1635-01-01', NULL, NULL, 'Teatro'),
(12, 'El burlador de Sevilla', 'Obra teatral asociada al mito de Don Juan.', 160, '1630-01-01', NULL, NULL, 'Teatro'),
(13, 'Vuelva usted mañana', 'Artículo satírico sobre la burocracia y las costumbres sociales.', 35, '1833-01-01', NULL, NULL, 'Ensayo'),
(14, 'Martín Fierro', 'Poema narrativo gauchesco sobre injusticia, marginalidad y vida en la frontera.', 350, '1872-01-01', NULL, NULL, 'Poesía'),
(15, 'María', 'Novela romántica sobre amor idealizado, naturaleza y tragedia.', 260, '1867-01-01', NULL, NULL, 'Narrativa'),
(16, 'Cuentos de amor de locura y de muerte', 'Colección de relatos sobre obsesión, violencia, enfermedad y destino.', 220, '1917-01-01', NULL, NULL, 'Narrativa'),
(17, 'Cuentos de la selva', 'Relatos para público joven ambientados en la selva con animales y aventura.', 160, '1918-01-01', NULL, NULL, 'Infantil'),
(18, 'Azul...', 'Libro clave del modernismo hispánico, mezcla de poesía y prosa poética.', 180, '1888-01-01', NULL, NULL, 'Poesía'),
(19, 'Versos sencillos', 'Poemario de expresión clara, emocional y meditativa.', 130, '1891-01-01', NULL, NULL, 'Poesía'),
(20, 'Aves sin nido', 'Novela de denuncia social sobre opresión e injusticia en los Andes.', 240, '1889-01-01', NULL, NULL, 'Narrativa'),
(21, 'Facundo', 'Ensayo sobre civilización, barbarie y construcción nacional en Argentina.', 300, '1845-01-01', NULL, NULL, 'Ensayo'),
(22, 'Ariel', 'Ensayo sobre cultura, juventud y valores espirituales en Hispanoamérica.', 150, '1900-01-01', NULL, NULL, 'Ensayo'),
(23, 'Nocturno', 'Poema emblemático de tono melancólico y musicalidad modernista.', 20, '1894-01-01', NULL, NULL, 'Poesía'),
(24, 'Los heraldos negros', 'Libro poético marcado por el dolor, la existencia y la experiencia humana.', 140, '1919-01-01', NULL, NULL, 'Poesía'),
(25, 'Viaje maravilloso del señor Nic-Nac al planeta Marte', 'Relato pionero de ciencia ficción en español con viaje interplanetario y tono satírico.', 90, '1875-01-01', NULL, NULL, 'Narrativa'),
(26, 'Primero sueño', 'Poema filosófico y barroco sobre el conocimiento y los límites humanos.', 60, '1692-01-01', NULL, NULL, 'Poesía'),
(27, 'Nuestra América', 'Ensayo sobre identidad, emancipación intelectual y realidad latinoamericana.', 40, '1891-01-01', NULL, NULL, 'Ensayo'),
(28, 'Prosas profanas', 'Poemario modernista de gran musicalidad e imaginería.', 170, '1896-01-01', NULL, NULL, 'Poesía'),
(29, 'La vorágine', 'Novela sobre la violencia, la explotación y la selva como fuerza destructora.', 300, '1924-01-01', NULL, NULL, 'Narrativa'),
(30, 'Tradiciones peruanas', 'Conjunto de relatos breves de tono histórico, anecdótico y costumbrista.', 400, '1872-01-01', NULL, NULL, 'Narrativa');

-- ============================================
-- RELACIÓN OBRA - AUTOR
-- ============================================
INSERT INTO obra_autores (id_autor, id_obra) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11),
(11, 12),
(12, 13),
(13, 14),
(14, 15),
(15, 16),
(15, 17),
(16, 18),
(17, 19),
(18, 20),
(19, 21),
(20, 22),
(21, 23),
(22, 24),
(23, 25),
(24, 26),
(17, 27),
(16, 28),
(25, 29),
(26, 30);

-- ============================================
-- RELACIÓN OBRA - ETIQUETA
-- ============================================
INSERT INTO obra_etiquetas (id_obra, id_etiqueta) VALUES
(1, 1), (1, 6), (1, 7), (1, 23),
(2, 1), (2, 2), (2, 19), (2, 28),
(3, 1), (3, 2), (3, 22), (3, 19),
(4, 1), (4, 3), (4, 16), (4, 19),
(5, 1), (5, 2), (5, 28), (5, 19),
(6, 1), (6, 4), (6, 22), (6, 26),
(7, 1), (7, 26), (7, 18), (7, 16),
(8, 1), (8, 4), (8, 8), (8, 27),
(9, 1), (9, 8), (9, 22), (9, 24),
(10, 1), (10, 8), (10, 19), (10, 25),
(11, 1), (11, 17), (11, 27), (11, 8),
(12, 1), (12, 8), (12, 9), (12, 27),
(13, 1), (13, 5), (13, 7), (13, 25),
(14, 1), (14, 14), (14, 16), (14, 18),
(15, 1), (15, 4), (15, 22), (15, 8),
(16, 1), (16, 10), (16, 21), (16, 8),
(17, 6), (17, 10), (17, 20), (17, 21),
(18, 1), (18, 11), (18, 12), (18, 26),
(19, 1), (19, 26), (19, 18), (19, 22),
(20, 1), (20, 19), (20, 15), (20, 16),
(21, 1), (21, 25), (21, 18), (21, 17),
(22, 1), (22, 17), (22, 18), (22, 25),
(23, 1), (23, 11), (23, 12), (23, 26),
(24, 1), (24, 26), (24, 17), (24, 8),
(25, 1), (25, 13), (25, 6), (25, 7),
(26, 1), (26, 17), (26, 26), (26, 12),
(27, 1), (27, 18), (27, 25), (27, 19),
(28, 1), (28, 11), (28, 12), (28, 26),
(29, 1), (29, 16), (29, 19), (29, 8),
(30, 1), (30, 5), (30, 10), (30, 18);