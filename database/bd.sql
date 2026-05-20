-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: eBiblioteca
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autores`
--
USE a10;

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `biografia` text,
  `ruta_foto` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,'Miguel de Cervantes','España','1547-09-29','2026-03-23 08:08:59',NULL,'Novelista, poeta y dramaturgo español, figura central de la literatura en lengua española.','https://covers.openlibrary.org/a/olid/OL66452A-M.jpg'),(2,'Benito Pérez Galdós','España','1843-05-10','2026-03-23 08:08:59',NULL,'Novelista y dramaturgo español, uno de los principales representantes del realismo.','https://ia800505.us.archive.org/view_archive.php?archive=/5/items/m_covers_0012/m_covers_0012_75.zip&file=0012756415-M.jpg'),(3,'Emilia Pardo Bazán','España','1851-09-16','2026-03-23 08:08:59',NULL,'Narradora, ensayista y crítica literaria española vinculada al naturalismo.','https://covers.openlibrary.org/a/olid/OL49026A-M.jpg'),(4,'Leopoldo Alas Clarín','España','1852-04-25','2026-03-23 08:08:59',NULL,'Escritor y crítico español, autor de una de las novelas más importantes del siglo XIX.','https://covers.openlibrary.org/a/olid/OL28169A-M.jpg'),(5,'Gustavo Adolfo Bécquer','España','1836-02-17','2026-03-23 08:08:59',NULL,'Poeta y narrador español, referente del posromanticismo.','https://covers.openlibrary.org/a/olid/OL3792450A-M.jpg'),(6,'Rosalía de Castro','España','1837-02-23','2026-03-23 08:08:59',NULL,'Poeta y novelista gallega, figura clave de la literatura española del siglo XIX.','https://covers.openlibrary.org/a/olid/OL123396A-M.jpg'),(7,'José Zorrilla','España','1817-02-21','2026-03-23 08:08:59',NULL,'Poeta y dramaturgo español, célebre por su teatro romántico.','https://covers.openlibrary.org/a/olid/OL70943A-M.jpg'),(8,'Fernando de Rojas','España','1470-01-01','2026-03-23 08:08:59',NULL,'Autor de La Celestina, obra fundamental de la literatura hispánica.',NULL),(9,'Lope de Vega','España','1562-11-25','2026-03-23 08:08:59',NULL,'Dramaturgo y poeta del Siglo de Oro español.','https://covers.openlibrary.org/a/olid/OL80534A-M.jpg'),(10,'Pedro Calderón de la Barca','España','1600-01-17','2026-03-23 08:08:59',NULL,'Dramaturgo barroco español y figura esencial del teatro universal.','https://covers.openlibrary.org/a/olid/OL4280652A-M.jpg'),(11,'Tirso de Molina','España','1579-03-24','2026-03-23 08:08:59',NULL,'Dramaturgo y poeta del Siglo de Oro español.','https://covers.openlibrary.org/a/olid/OL49131A-M.jpg'),(12,'Mariano José de Larra','España','1809-03-24','2026-03-23 08:08:59',NULL,'Escritor y periodista español del romanticismo.',NULL),(13,'José Hernández','Argentina','1834-11-10','2026-03-23 08:08:59',NULL,'Poeta argentino, autor del gran poema nacional gauchesco.','https://covers.openlibrary.org/a/olid/OL4280830A-M.jpg'),(14,'Jorge Isaacs','Colombia','1837-04-01','2026-03-23 08:08:59',NULL,'Novelista y poeta colombiano, autor de una de las novelas románticas más conocidas de América Latina.','https://covers.openlibrary.org/a/olid/OL429462A-M.jpg'),(15,'Horacio Quiroga','Uruguay','1878-12-31','2026-03-23 08:08:59',NULL,'Narrador uruguayo, maestro del cuento hispanoamericano.','https://covers.openlibrary.org/a/olid/OL70874A-M.jpg'),(16,'Rubén Darío','Nicaragua','1867-01-18','2026-03-23 08:08:59',NULL,'Poeta nicaragüense, máximo exponente del modernismo.','https://covers.openlibrary.org/a/olid/OL76614A-M.jpg'),(17,'José Martí','Cuba','1853-01-28','2026-03-23 08:08:59',NULL,'Escritor, poeta y ensayista cubano, figura clave del pensamiento hispanoamericano.','https://covers.openlibrary.org/a/olid/OL54909A-M.jpg'),(18,'Clorinda Matto de Turner','Perú','1852-11-11','2026-03-23 08:08:59',NULL,'Escritora peruana destacada por su narrativa de denuncia social.',NULL),(19,'Domingo Faustino Sarmiento','Argentina','1811-02-15','2026-03-23 08:08:59',NULL,'Ensayista, político y educador argentino.','https://covers.openlibrary.org/a/olid/OL117634A-M.jpg'),(20,'José Enrique Rodó','Uruguay','1871-07-15','2026-03-23 08:08:59',NULL,'Ensayista uruguayo, figura importante del pensamiento hispanoamericano.',NULL),(21,'José Asunción Silva','Colombia','1865-11-27','2026-03-23 08:08:59',NULL,'Poeta colombiano vinculado al modernismo.',NULL),(22,'César Vallejo','Perú','1892-03-16','2026-03-23 08:08:59',NULL,'Poeta y escritor peruano, una de las grandes voces de la poesía en español.','https://covers.openlibrary.org/a/olid/OL91716A-M.jpg'),(23,'Eduardo Ladislao Holmberg','Argentina','1852-06-27','2026-03-23 08:08:59',NULL,'Escritor argentino pionero de la ciencia ficción en español.',NULL),(24,'Sor Juana Inés de la Cruz','México','1648-11-12','2026-03-23 08:08:59',NULL,'Poeta y dramaturga novohispana, figura esencial del barroco hispánico.',NULL),(25,'José Eustasio Rivera','Colombia','1888-02-19','2026-03-23 08:08:59',NULL,'Escritor colombiano, autor de una novela clave sobre la selva americana.','https://covers.openlibrary.org/a/olid/OL2856993A-M.jpg'),(26,'Ricardo Palma','Perú','1833-02-07','2026-03-23 08:08:59',NULL,'Escritor peruano célebre por sus relatos históricos y costumbristas.','https://covers.openlibrary.org/a/olid/OL129457A-M.jpg'),(31,'Charles Baudelaire','Francia','1821-04-09','2026-04-29 08:44:07',NULL,'Charles Baudelaire (1821-1867) fue un poeta, ensayista y crítico de arte francés, considerado el precursor del simbolismo y el padre de la poesía moderna.  Nacido en París, su obra y su vida bohemia lo convirtieron en la figura emblemática del \"poeta maldito\".','https://covers.openlibrary.org/a/olid/OL117429A-M.jpg'),(32,'Arthur Rimbaud','Francia','1854-10-20','2026-04-29 08:59:51',NULL,'Jean Nicolas Arthur Rimbaud (Charleville, 20 de octubre de 1854-Marsella, 10 de noviembre de 1891), conocido como Arthur Rimbaud, fue un poeta francés simbolista, célebre por su poesía transgresiva y temáticas surreales que influyeron en la literatura y artes modernas como el decadentismo, la prefiguración del surrealismo y la generación beat.','https://covers.openlibrary.org/a/olid/OL44891A-M.jpg'),(33,'Vicente Aleixandre','España','1898-04-26','2026-04-29 09:04:12',NULL,'Vicente Aleixandre y Merlo (Sevilla, 26 de abril de 1898-Madrid, 13 de diciembre de 1984) fue un poeta español de la llamada generación del 27. Fue académico de la Real Academia Española desde 1950, ocupando el sillón de la letra O.','https://covers.openlibrary.org/a/olid/OL91951A-M.jpg'),(34,'Antoine de Saint-Exupéry','Francia','1900-06-29','2026-05-11 13:11:32',NULL,'Antoine de Saint-Exupéry (1900–1944) fue un aviador y escritor francés cuya vida y obra estuvieron profundamente entrelazadas por su pasión por el cielo y la naturaleza humana. Es mundialmente reconocido como el autor de El Principito (1943), un relato poético y filosófico que se ha convertido en uno de los libros más traducidos y leídos de la historia.','https://covers.openlibrary.org/a/olid/OL31901A-M.jpg'),(35,'Franz Kafka','Imperio austrohúngaro','1883-07-03','2026-05-12 09:49:37',NULL,'Franz Kafka (Praga, Imperio austrohúngaro, actual capital de República Checa; 3 de julio de 1883-Kierling, Austria; 3 de junio de 1924) fue un escritor bohemio de lengua alemana. Su obra, una de las más influyentes de la literatura universal, es una de las pioneras en la fusión de elementos realistas con fantásticos y tiene como principales temas los conflictos paternofiliales, la ansiedad, el existencialismo, la brutalidad física y psicológica, la culpa, la filosofía del absurdo, la burocracia y las transformaciones espirituales.','https://covers.openlibrary.org/a/olid/OL33146A-M.jpg'),(36,'José Ortega y Gasset','España','1883-05-09','2026-05-12 10:30:41',NULL,'José Ortega y Gasset (Madrid, 9 de mayo de 1883-Madrid, 18 de octubre de 1955) fue un filósofo y ensayista español, exponente principal de la teoría del perspectivismo y de la razón vital e histórica, situado en el movimiento del novecentismo.',NULL),(37,'prueba','España','2026-05-12','2026-05-12 13:20:57','2026-05-12 13:21:12','alskjdalsd',NULL),(38,'Federico García Lorca','España','1898-06-05','2026-05-13 14:13:51',NULL,'Federico García Lorca (Fuente Vaqueros, Granada, 5 de junio de 1898-camino de Víznar a Alfacar, Granada, 18 de agosto de 1936) fue un poeta, prosista, dramaturgo y director teatral español. García Lorca alcanzó reconocimiento internacional como miembro emblemático de la generación del 27, un grupo compuesto principalmente por poetas que introdujeron los postulados de movimientos europeos como el simbolismo, el futurismo o el surrealismo en la literatura española. Fue el poeta de mayor influencia y popularidad de la literatura española del siglo XX y como dramaturgo se le considera una de las cimas del teatro español del siglo XX.','https://covers.openlibrary.org/a/olid/OL3203135A-M.jpg'),(39,'Antonio Machado Ruiz','España','1875-07-26','2026-05-13 14:49:32',NULL,'Antonio Machado nació en Sevilla, en el seno de una familia culta y progresista. Pasó su infancia en Madrid y pronto se integró en el ambiente intelectual de la Institución Libre de Enseñanza. En 1899 viajó a París, donde trabajó como traductor y conoció a los simbolistas franceses. Su poesía inicial, recogida en Soledades (1903) y Soledades, galerías y otros poemas (1907), es de tono intimista y modernista, marcada por el simbolismo, los sueños, el tiempo y la muerte.',NULL),(40,'Emily Brontë','Reino Unido','1818-07-30','2026-05-13 15:11:14',NULL,'Emily Brontë nació en Thornton, Yorkshire, en 1818. Fue la quinta de seis hermanos, en una familia marcada por la muerte y el aislamiento. Junto a sus hermanas Charlotte y Anne, publicó poemas bajo seudónimos masculinos (Ellis Bell). Cumbres borrascosas, su única novela, fue incomprendida en su época por su crudeza y oscuridad. Emily murió de tuberculosis a los 30 años, sin saber que su obra se convertiría en un clásico universal de la literatura inglesa.','https://covers.openlibrary.org/a/olid/OL24529A-M.jpg'),(41,'Henry David Thoreau','Estados Unidos','1817-07-12','2026-05-13 15:20:51',NULL,'Henry David Thoreau (Concord, Massachusetts, 12 de julio de 1817-Concord, 6 de mayo de 1862) fue un escritor, poeta y filósofo estadounidense, de tendencia trascendentalista y origen puritano, autor de Walden y Desobediencia civil. Thoreau fue agrimensor, naturalista, conferencista y fabricante de lápices. Uno de los padres fundadores de la literatura estadounidense, es también el conceptualizador de las prácticas de desobediencia civil.','https://covers.openlibrary.org/a/olid/OL19690A-M.jpg'),(42,'Joseph Conrad','Polonia','1857-12-03','2026-05-13 15:25:30',NULL,'Joseph Conrad nació en Polonia, se hizo marinero y viajó por todo el mundo, estableciéndose finalmente en Inglaterra. Escribió en inglés, su tercera lengua, y se convirtió en uno de los grandes novelistas de la literatura universal. Sus obras, como El corazón de las tinieblas, Lord Jim y Nostromo, exploran la soledad, la corrupción moral y el choque cultural. Murió en Canterbury en 1924.',NULL),(43,'Antón Chéjov','Rusia','1860-01-29','2026-05-13 15:28:27',NULL,'Antón Chéjov nació en Taganrog, Rusia, en 1860. Fue médico, escritor y dramaturgo, considerado uno de los grandes maestros del cuento y del teatro moderno. Renovó el drama con obras como La gaviota, Tío Vania, Las tres hermanas y El jardín de los cerezos, donde sustituyó el drama tradicional por la acción interna, el subtexto y la atmósfera. Murió de tuberculosis en Alemania en 1904.',NULL),(44,'Lyman Frank Baum','Estados Unidos','1856-05-15','2026-05-13 15:34:02',NULL,'Lyman Frank Baum nació en Chittenango, Nueva York, en 1856. Fue un escritor estadounidense de libros infantiles. Alcanzó el éxito comercial con su primer libro, Father Goose (1899), al que siguió un año después El maravilloso mago de Oz (1900), su obra más famosa. Escribió otros trece libros sobre la serie de Oz y su obra comprende más de 200 poemas, 82 relatos cortos y otras 55 novelas. Falleció en Hollywood, California, en 1919.',NULL),(45,'Mary Wollstonecraft Shelley','Reino Unido','1797-08-30','2026-05-13 15:39:52',NULL,'Mary Shelley nació en Londres en 1797, hija de la filósofa feminista Mary Wollstonecraft y del pensador político William Godwin. A los 16 años huyó a Europa con el poeta Percy Bysshe Shelley, con quien se casó tras la muerte de su primera esposa. La idea de Frankenstein surgió en 1816 durante una velada en Suiza con Lord Byron y su futuro esposo, como parte de un concurso para escribir historias de terror. Publicó la novela anónimamente a los 20 años. Tras la muerte de Shelley en 1822, se dedicó a escribir y a preservar la obra de su marido. Falleció en Londres en 1851.',NULL),(46,'Johanna Spyri','Suiza','1827-07-12','2026-05-13 15:48:41',NULL,'Johanna Spyri nació en Hirzel, Suiza, en 1827. Era hija de un médico rural y poeta, y creció rodeada de naturaleza y literatura. A los quince años se trasladó a Zúrich para estudiar y, tras casarse con el jurista Bernhard Spyri, comenzó a escribir relatos infantiles. Su obra más famosa, Heidi, surgió de sus propias experiencias en los Alpes suizos y se publicó en 1880, alcanzando un éxito internacional inmediato. Spyri murió en Zúrich en 1901.',NULL),(47,'Oscar Wilde','Irlanda','1854-10-16','2026-05-13 15:53:36',NULL,'Oscar Wilde nació en Dublín en 1854. Fue un escritor, poeta y dramaturgo irlandés, conocido por su ingenio mordaz y su estilo decadente. Estudió en el Trinity College de Dublín y en Oxford. Su novela El retrato de Dorian Gray (1890) y sus comedias como La importancia de llamarse Ernesto y El abanico de Lady Windermere lo consagraron como una figura clave del esteticismo. En 1895 fue condenado a trabajos forzados por \"indecencia grave\" debido a su homosexualidad, lo que arruinó su carrera. Murió en París en 1900, pobre y exiliado.','https://covers.openlibrary.org/a/olid/OL20646A-M.jpg'),(48,'H. P. Lovecraft','Estados Unidos','1890-08-20','2026-05-13 15:57:55',NULL,'H. P. Lovecraft nació en Providence, Rhode Island en 1890. De salud frágil, tuvo una infancia marcada por la muerte de su padre en un sanatorio mental. Se dedicó por completo a la literatura, creando el ciclo de los Mitos de Cthulhu y definiendo el género del horror cósmico, donde los seres humanos son insignificantes frente a las entidades arcanas. Su estilo epistolar y su énfasis en la locura y lo desconocido influyeron profundamente en el terror moderno. Murió en la pobreza en 1937, víctima de un cáncer intestinal, y no fue hasta décadas después que su obra alcanzó el reconocimiento masivo y se convirtió en un pilar de la cultura popular.',NULL),(49,'Miguel de Unamuno','España','1864-09-29','2026-05-14 07:14:21',NULL,'Miguel de Unamuno y Jugo nació en Bilbao en 1864 y falleció en Salamanca en 1936. Fue un escritor, filósofo, poeta y académico español, miembro destacado de la Generación del 98. Ocupó el cargo de rector de la Universidad de Salamanca en dos ocasiones. Su pensamiento, de profundo carácter existencialista, gira en torno a temas como la fe, la razón, la inmortalidad del alma y la identidad española. Sus obras más importantes incluyen Del sentimiento trágico de la vida (1913), La agonía del cristianismo (1925), la novela San Manuel Bueno, mártir (1930) y, por supuesto, Niebla. Su estilo se caracteriza por la pasión intelectual, la paradoja y una constante introspección psicológica, lo que le convierte en uno de los autores más influyentes de la literatura en español.','https://covers.openlibrary.org/a/olid/OL33442A-M.jpg'),(50,'Jane Austen','Reino Unido','1775-12-16','2026-05-14 07:24:08',NULL,'Jane Austen nació en Steventon, Hampshire, en 1775, en el seno de una familia de la nobleza rural. Fue una novelista británica que vivió durante la época georgiana. Es conocida por su aguda ironía y su capacidad para retratar la vida de la gentry rural, centrándose siempre en el matrimonio de sus protagonistas. Aunque sus obras se consideran clásicos de la literatura inglesa, durante su vida publicó de forma anónima. Murió en Winchester en 1817, a los 41 años.','https://covers.openlibrary.org/a/olid/OL21594A-M.jpg'),(51,'Virginia Woolf','Reino Unido','1882-01-25','2026-05-14 07:30:34',NULL,'Virginia Woolf, nacida en Londres en 1882, fue una escritora, ensayista y figura central del modernismo anglosajón del siglo XX. Perteneció al influyente Círculo de Bloomsbury, un grupo de intelectuales que promovían ideas liberales sobre el arte, la política y la sexualidad.  Woolf es reconocida por sus innovadoras novelas como La señora Dalloway, Al faro y Las olas, así como por sus ensayos feministas, entre los que destaca Una habitación propia.',NULL);
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenido` text NOT NULL,
  `fecha_comentario` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `id_obra` int NOT NULL,
  `revisado` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_usuario_coment` (`id_usuario`),
  KEY `fk_obra_coment` (`id_obra`),
  CONSTRAINT `fk_obra_coment` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_usuario_coment` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (1,'Como docente, recomiendo esta edición a mis alumnos. La estructura de la novela -con sus historias intercaladas- es un prodigio de construcción narrativa. Cervantes inventó la novela moderna y esto es evidencia palpable.','2026-04-13 14:14:59',NULL,2,1,1),(2,'El personaje de Dulcinea del Toboso es fascinante desde el punto de vista literario. Es un amor idealizado, una quimera que impulsa toda la trama. El capítulo de la cueva de Montesinos es pura genialidad metaficcional.','2026-04-13 14:14:59',NULL,2,1,1),(3,'La segunda parte del Quijote es aún mejor que la primera, algo poco común en las novelas de la época. Cervantes respondió a la continuación apócrifa de Avellaneda con una obra maestra de auto-consciencia literaria.','2026-04-13 14:14:59',NULL,2,1,1),(4,'Reseña completa en mi blog: este libro merece cada página de sus 800+ hojas. La relación entre amo y escudero evoluciona de manera tan natural que te hace reflexionar sobre la amistad verdadera. ⭐⭐⭐⭐⭐','2026-04-13 14:14:59',NULL,3,1,1),(5,'Lo que más me impresiona es cómo Cervantes trata temas tan actuales hace más de 400 años: la locura y la cordura, la realidad vs la ficción, el envejecimiento... Una obra atemporal.','2026-04-13 14:14:59',NULL,3,1,1),(22,'p','2026-04-27 13:28:54',NULL,10,1,1),(24,'Me pareció una lectura fascinante, especialmente el desarrollo de los personajes secundarios.','2026-04-30 10:45:15',NULL,1,1,0),(25,'La prosa es densa pero recompensa la paciencia del lector atento.','2026-04-30 10:45:15',NULL,2,2,0),(26,'No estoy de acuerdo con la interpretación habitual del final.','2026-04-30 10:45:15',NULL,3,3,0),(27,'El simbolismo de los paisajes es extraordinario en esta obra.','2026-04-30 10:45:15',NULL,8,4,0),(28,'Recomiendo leer la edición crítica para apreciar las notas al pie.','2026-04-30 10:45:15',NULL,9,5,0),(29,'La estructura circular de la novela es brillante y subestimada.','2026-04-30 10:45:15',NULL,11,1,0),(30,'Los diálogos entre los protagonistas reflejan tensiones sociales de la época.','2026-04-30 10:45:15',NULL,12,2,0),(31,'Una obra que mejora con cada relectura, sin duda.','2026-04-30 10:45:15',NULL,1,3,0),(32,'Este comentario debería ser reportado por contenido ofensivo número 1.','2026-04-30 10:45:15',NULL,1,1,0),(33,'Spam publicitario no deseado en la plataforma número 2.','2026-04-30 10:45:15',NULL,2,2,0),(34,'Comentario con lenguaje inapropiado para la comunidad número 3.','2026-04-30 10:45:15',NULL,3,3,1),(35,'Publicidad encubierta de productos comerciales número 4.','2026-04-30 10:45:15','2026-05-06 08:26:23',8,4,1),(36,'Acoso verbal hacia otro usuario de la plataforma número 5.','2026-04-30 10:45:15',NULL,9,5,0),(37,'Contenido irrelevante que nada tiene que ver con la obra número 6.','2026-04-30 10:45:15',NULL,11,1,0),(38,'Información falsa sobre el autor de la obra número 7.','2026-04-30 10:45:15',NULL,12,2,0),(39,'Comentario duplicado con intención de manipular valoraciones número 8.','2026-04-30 10:45:15',NULL,1,3,0),(40,'comentario','2026-05-06 07:55:58',NULL,10,1,0),(41,'Comentario','2026-05-11 15:48:53',NULL,10,41,0);
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etiquetas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` VALUES (39,'Aforismo'),(22,'Amor'),(34,'Arte'),(36,'Autobiografía'),(6,'Aventuras'),(23,'Caballerías'),(13,'Ciencia ficción'),(1,'Clásico'),(9,'Comedia'),(5,'Costumbrismo'),(14,'Criollismo'),(10,'Cuento'),(32,'Decadentismo'),(8,'Drama'),(40,'Educación'),(33,'Estética'),(38,'Existencialismo'),(21,'Fantasía'),(15,'Feminismo'),(17,'Filosofía'),(45,'Generación del 98'),(37,'Humanismo'),(18,'Identidad'),(46,'Ilustración'),(20,'Infantil'),(26,'Lírico'),(11,'Modernismo'),(42,'Nacionalismo'),(3,'Naturalismo'),(44,'Paisaje'),(24,'Picaresca'),(41,'Política'),(25,'Político'),(28,'Psicológico'),(2,'Realismo'),(4,'Romanticismo'),(16,'Rural'),(7,'Sátira'),(12,'Simbolismo'),(19,'Social'),(29,'Spleen'),(43,'Surrealismo'),(47,'Terror'),(30,'Traducción'),(27,'Tragedia'),(31,'Urbano'),(35,'Vanguardias');
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_obras`
--

DROP TABLE IF EXISTS `lista_obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_obras` (
  `id_lista` int NOT NULL,
  `id_obra` int NOT NULL,
  `fecha_adicion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lista`,`id_obra`),
  KEY `fk_obra_lo` (`id_obra`),
  CONSTRAINT `fk_lsita_lo` FOREIGN KEY (`id_lista`) REFERENCES `listas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_obra_lo` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_obras`
--

LOCK TABLES `lista_obras` WRITE;
/*!40000 ALTER TABLE `lista_obras` DISABLE KEYS */;
INSERT INTO `lista_obras` VALUES (1,1,'2026-04-15 10:19:23'),(1,5,'2026-04-15 10:19:23'),(2,16,'2026-04-15 10:19:23'),(2,29,'2026-04-15 10:19:23'),(3,6,'2026-04-15 10:19:23'),(3,7,'2026-04-15 10:19:23'),(3,24,'2026-04-15 10:19:23'),(4,2,'2026-04-15 10:19:23'),(4,4,'2026-04-15 10:19:23'),(5,10,'2026-04-15 10:19:23'),(5,17,'2026-04-15 10:19:23'),(14,1,'2026-04-21 10:35:45'),(14,9,'2026-04-21 10:35:45'),(14,10,'2026-04-21 10:35:45'),(14,11,'2026-04-21 10:35:45'),(14,12,'2026-04-21 10:35:45'),(15,3,'2026-04-21 10:35:45'),(15,6,'2026-04-21 10:35:45'),(15,7,'2026-04-21 10:35:45'),(15,8,'2026-04-21 10:35:45'),(15,13,'2026-04-21 10:35:45'),(15,15,'2026-04-21 10:35:45'),(16,2,'2026-04-21 10:35:45'),(16,4,'2026-04-21 10:35:45'),(16,5,'2026-04-21 10:35:45'),(16,14,'2026-04-21 10:35:45'),(16,16,'2026-04-21 10:35:45'),(17,18,'2026-04-21 10:35:45'),(17,23,'2026-04-21 10:35:45'),(17,24,'2026-04-21 10:35:45'),(17,26,'2026-04-21 10:35:45'),(17,28,'2026-04-21 10:35:45'),(18,17,'2026-04-21 10:35:45'),(18,21,'2026-04-21 10:35:45'),(18,22,'2026-04-21 10:35:45'),(18,25,'2026-04-21 10:35:45'),(18,27,'2026-04-21 10:35:45'),(18,30,'2026-04-21 10:35:45'),(19,4,'2026-04-21 10:35:45'),(19,7,'2026-04-21 10:35:45'),(19,15,'2026-04-21 10:35:45'),(19,26,'2026-04-21 10:35:45'),(19,29,'2026-04-21 10:35:45'),(24,1,'2026-05-07 11:37:07'),(24,5,'2026-05-07 11:37:07'),(27,1,'2026-05-11 10:46:08'),(27,9,'2026-05-11 10:46:08'),(27,10,'2026-05-11 10:46:08'),(27,11,'2026-05-11 10:46:08'),(27,12,'2026-05-11 10:46:08'),(29,1,'2026-05-14 15:39:38'),(29,9,'2026-05-14 15:39:38'),(29,10,'2026-05-14 15:39:38'),(29,11,'2026-05-14 15:39:38'),(29,12,'2026-05-14 15:39:38'),(30,6,'2026-05-14 15:39:44'),(30,7,'2026-05-14 15:39:44'),(30,8,'2026-05-14 15:39:44'),(30,13,'2026-05-14 15:39:44'),(30,15,'2026-05-14 15:39:44');
/*!40000 ALTER TABLE `lista_obras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listas`
--

DROP TABLE IF EXISTS `listas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `listas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` text,
  `id_original` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_lista` (`id_usuario`),
  KEY `fk_lista_original` (`id_original`),
  CONSTRAINT `fk_lista_original` FOREIGN KEY (`id_original`) REFERENCES `listas` (`id`),
  CONSTRAINT `fk_usuario_lista` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listas`
--

LOCK TABLES `listas` WRITE;
/*!40000 ALTER TABLE `listas` DISABLE KEYS */;
INSERT INTO `listas` VALUES (1,'Clásicos Imprescindibles',1,'2026-04-15 10:19:23',NULL,NULL),(2,'Novelas de Aventuras',1,'2026-04-15 10:19:23',NULL,NULL),(3,'Poesía para el Alma',1,'2026-04-15 10:19:23',NULL,NULL),(4,'Literatura Femenina',1,'2026-04-15 10:19:23',NULL,NULL),(5,'Libros Cortos para Viajar',1,'2026-04-15 10:19:23',NULL,NULL),(14,'El siglo de oro español',10,'2026-04-21 10:35:45','Obras representativas del teatro y narrativa del Siglo de Oro español (siglos XVI-XVII). Incluye la primera novela moderna, el precursor del teatro clásico y las grandes obras filosóficas del barroco.',NULL),(15,'Romanticismo hispánico',10,'2026-04-21 10:35:45','Movimiento romántico en España e Hispanoamérica (1800-1880). Poesía lírica, teatro romántico, novela sentimental y el costumbrismo crítico que marca la transición del Neoclasicismo al Romanticismo.',NULL),(16,'Narrativa del realismo y naturalismo',10,'2026-04-21 10:35:45','Obras del Realismo español (1870-1900) y su extensión americana. Las tres grandes novelas realistas españolas, el poema gauchesco argentino y el cuento modernista como transición.',NULL),(17,'Modernismo y vanguardismo hispanoamericano',10,'2026-04-21 10:35:45','El Modernismo (1880-1920) y su evolución hacia la vanguardia. Incluye al príncipe de las letras castellanas, el poeta que revolucionó la métrica, y el poema hermético barroco que anticipa el simbolismo.',NULL),(18,'Ensayos y pensamiento latinoamericano',10,'2026-04-21 10:35:45','Pensamiento crítico, ensayo político y literatura de difusión cultural. Desde el análisis sociológico de Sarmiento hasta el idealismo de Rodó, el americanismo de Martí y la literatura popular.',NULL),(19,'Mujeres escritoras en la literatura hispánica',10,'2026-04-21 10:35:45','Recuperación de voces femeninas y obras con fuerte componente femenino. Tres autoras fundamentales y obras donde el protagonismo femenino es central.',NULL),(24,'Copia de Clásicos Imprescindibles',12,'2026-05-07 11:37:07','',1),(27,'El siglo de oro español',12,'2026-05-11 10:46:08','Obras representativas del teatro y narrativa del Siglo de Oro español (siglos XVI-XVII). Incluye la primera novela moderna, el precursor del teatro clásico y las grandes obras filosóficas del barroco.',14),(29,'El siglo de oro español',46,'2026-05-14 15:39:38','Obras representativas del teatro y narrativa del Siglo de Oro español (siglos XVI-XVII). Incluye la primera novela moderna, el precursor del teatro clásico y las grandes obras filosóficas del barroco.',14),(30,'Romanticismo hispánico',46,'2026-05-14 15:39:44','Movimiento romántico en España e Hispanoamérica (1800-1880). Poesía lírica, teatro romántico, novela sentimental y el costumbrismo crítico que marca la transición del Neoclasicismo al Romanticismo.',15);
/*!40000 ALTER TABLE `listas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `megusta_comentario`
--

DROP TABLE IF EXISTS `megusta_comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `megusta_comentario` (
  `id_usuario` int NOT NULL,
  `id_comentario` int NOT NULL,
  `fecha_megusta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`,`id_comentario`),
  KEY `fk_comentario_mc` (`id_comentario`),
  CONSTRAINT `fk_comentario_mc` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id`),
  CONSTRAINT `fk_usuario_mc` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `megusta_comentario`
--

LOCK TABLES `megusta_comentario` WRITE;
/*!40000 ALTER TABLE `megusta_comentario` DISABLE KEYS */;
INSERT INTO `megusta_comentario` VALUES (1,40,'2026-05-14 14:14:31'),(1,41,'2026-05-14 13:56:44'),(2,40,'2026-05-14 14:14:31'),(2,41,'2026-05-14 13:56:44'),(3,40,'2026-05-14 14:14:31'),(3,41,'2026-05-14 13:56:44'),(8,40,'2026-05-14 14:14:31'),(8,41,'2026-05-14 13:56:44'),(9,40,'2026-05-14 14:14:31'),(9,41,'2026-05-14 13:56:44'),(10,40,'2026-05-14 14:15:03'),(10,41,'2026-05-11 15:49:03'),(11,40,'2026-05-14 14:14:31'),(11,41,'2026-05-14 13:56:44'),(12,40,'2026-05-07 10:17:08');
/*!40000 ALTER TABLE `megusta_comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `megusta_lista`
--

DROP TABLE IF EXISTS `megusta_lista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `megusta_lista` (
  `id_usuario` int NOT NULL,
  `id_lista` int NOT NULL,
  `fecha_megusta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`,`id_lista`),
  KEY `fk_lista_mg` (`id_lista`),
  CONSTRAINT `fk_lista_mg` FOREIGN KEY (`id_lista`) REFERENCES `listas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_usuario_mg` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `megusta_lista`
--

LOCK TABLES `megusta_lista` WRITE;
/*!40000 ALTER TABLE `megusta_lista` DISABLE KEYS */;
INSERT INTO `megusta_lista` VALUES (12,1,'2026-05-07 11:36:37');
/*!40000 ALTER TABLE `megusta_lista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obra_autores`
--

DROP TABLE IF EXISTS `obra_autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obra_autores` (
  `id_autor` int NOT NULL,
  `id_obra` int NOT NULL,
  PRIMARY KEY (`id_autor`,`id_obra`),
  KEY `fk_obra_oa` (`id_obra`),
  CONSTRAINT `fk_autor_oa` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`),
  CONSTRAINT `fk_obra_oa` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obra_autores`
--

LOCK TABLES `obra_autores` WRITE;
/*!40000 ALTER TABLE `obra_autores` DISABLE KEYS */;
INSERT INTO `obra_autores` VALUES (1,1),(2,2),(2,3),(3,4),(4,5),(5,6),(6,7),(7,8),(8,9),(9,10),(10,11),(11,12),(12,13),(13,14),(14,15),(15,16),(15,17),(16,18),(17,19),(18,20),(19,21),(20,22),(21,23),(22,24),(23,25),(24,26),(17,27),(16,28),(25,29),(26,30),(1,31),(31,39),(33,41),(34,42),(32,44),(31,45),(35,46),(36,47),(35,48),(38,49),(39,50),(10,51),(15,52),(40,53),(41,54),(42,55),(43,56),(44,57),(45,58),(46,59),(47,60),(48,61),(49,62),(50,63),(51,64),(45,65),(38,66);
/*!40000 ALTER TABLE `obra_autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obra_etiquetas`
--

DROP TABLE IF EXISTS `obra_etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obra_etiquetas` (
  `id_obra` int NOT NULL,
  `id_etiqueta` int NOT NULL,
  PRIMARY KEY (`id_obra`,`id_etiqueta`),
  KEY `fk_etiqueta_oe` (`id_etiqueta`),
  CONSTRAINT `fk_obra_oe` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `obra_etiquetas_ibfk_1` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiquetas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obra_etiquetas`
--

LOCK TABLES `obra_etiquetas` WRITE;
/*!40000 ALTER TABLE `obra_etiquetas` DISABLE KEYS */;
INSERT INTO `obra_etiquetas` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(51,1),(59,1),(2,2),(3,2),(5,2),(52,2),(62,2),(4,3),(52,3),(6,4),(8,4),(15,4),(52,4),(53,4),(58,4),(63,4),(13,5),(30,5),(1,6),(17,6),(25,6),(42,6),(55,6),(57,6),(59,6),(1,7),(13,7),(25,7),(60,7),(63,7),(8,8),(9,8),(10,8),(11,8),(12,8),(15,8),(16,8),(24,8),(29,8),(41,8),(46,8),(48,8),(49,8),(56,8),(60,8),(66,8),(12,9),(51,9),(56,9),(60,9),(63,9),(16,10),(17,10),(30,10),(42,10),(52,10),(61,10),(18,11),(23,11),(28,11),(18,12),(23,12),(26,12),(28,12),(39,12),(44,12),(46,12),(49,12),(55,12),(25,13),(58,13),(14,14),(20,15),(64,15),(65,15),(4,16),(7,16),(14,16),(20,16),(29,16),(49,16),(11,17),(21,17),(22,17),(24,17),(26,17),(47,17),(48,17),(54,17),(62,17),(64,17),(65,17),(7,18),(14,18),(19,18),(21,18),(22,18),(27,18),(30,18),(46,18),(2,19),(3,19),(4,19),(5,19),(10,19),(20,19),(27,19),(29,19),(48,19),(50,19),(54,19),(55,19),(56,19),(63,19),(65,19),(66,19),(17,20),(16,21),(17,21),(42,21),(57,21),(3,22),(6,22),(9,22),(15,22),(19,22),(31,22),(39,22),(41,22),(42,22),(49,22),(51,22),(53,22),(62,22),(1,23),(9,24),(10,25),(13,25),(21,25),(22,25),(27,25),(6,26),(7,26),(18,26),(19,26),(23,26),(24,26),(26,26),(28,26),(8,27),(11,27),(12,27),(39,27),(49,27),(52,27),(53,27),(66,27),(2,28),(5,28),(52,28),(55,28),(56,28),(39,29),(44,29),(45,29),(39,30),(45,30),(46,30),(44,31),(45,31),(39,32),(44,35),(48,38),(62,38),(64,40),(47,41),(50,41),(54,41),(64,41),(65,41),(47,42),(50,44),(59,44),(50,45),(58,47),(61,47);
/*!40000 ALTER TABLE `obra_etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `sinopsis` text,
  `paginas` int DEFAULT NULL,
  `anio_publicacion` int DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `ruta_pdf` varchar(200) DEFAULT NULL,
  `ruta_epub` varchar(200) DEFAULT NULL,
  `genero` enum('Narrativa','Ensayo','Poesía','Teatro','Infantil') NOT NULL,
  `portada` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` VALUES (1,'Don Quijote de la Mancha','Novela sobre un hidalgo que enloquece leyendo libros de caballerías y decide convertirse en caballero andante.',863,1605,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/DonQuijoteDeLaMancha.pdf','obras/recursosEPUB/Don_Quijote_de_la_Mancha.epub','Narrativa','OL47103623M'),(2,'Fortunata y Jacinta','Novela realista sobre clases sociales, matrimonio, deseo y vida urbana en el Madrid del siglo XIX.',1050,1887,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Fortunata_y_Jacinta.pdf','obras/recursosEPUB/Fortunata_y_Jacinta.epub','Narrativa','OL9145696M'),(3,'Marianela','Novela breve sobre amor, pobreza y apariencia en un entorno minero.',240,1878,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Marianela.pdf','obras/recursosEPUB/Marianela.epub','Narrativa','OL7160322M'),(4,'Los pazos de Ulloa','Novela naturalista ambientada en la Galicia rural, centrada en decadencia, poder y violencia.',340,1886,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Los_pazos_de_Ulloa.pdf','obras/recursosEPUB/Los_pazos_de_Ulloa.epub','Narrativa','OL1605837M'),(5,'La Regenta','Novela de análisis psicológico y crítica social ambientada en una ciudad de provincias.',700,1884,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/La_Regenta.pdf','obras/recursosEPUB/La_Regenta.epub','Narrativa','OL23309551M'),(6,'Rimas','Colección de poemas breves de tono íntimo, amoroso y reflexivo.',120,1871,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Rimas.pdf','obras/recursosEPUB/Rimas.epub','Poesía','OL4451330M'),(7,'Cantares gallegos','Libro poético fundamental del renacimiento literario gallego.',180,1863,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Cantares_gallegos.pdf','obras/recursosEPUB/Cantares_gallegos.epub','Poesía','OL4339466M'),(8,'Don Juan Tenorio','Drama romántico sobre el mito del seductor y la redención.',200,1844,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Don_Juan_Tenorio.pdf','obras/recursosEPUB/Don_Juan_Tenorio.epub','Teatro','OL2589574M'),(9,'La Celestina','Tragicomedia sobre pasión, codicia y manipulación.',220,1499,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/La_Celestina.pdf','obras/recursosEPUB/La_Celestina.epub','Teatro','OL5559445M'),(10,'Fuenteovejuna','Drama teatral basado en un levantamiento colectivo contra el abuso de poder.',180,1619,'2026-03-23 08:08:59',NULL,NULL,NULL,'Teatro','OL43488022M'),(11,'La vida es sueño','Drama filosófico sobre libertad, destino, poder y apariencia.',170,1635,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/La_vida_es_sueño.pdf','obras/recursosEPUB/La_vida_es_sueño.epub','Teatro','OL9130046M'),(12,'El burlador de Sevilla','Obra teatral asociada al mito de Don Juan.',160,1630,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/El_burlador_de_Sevilla.pdf','obras/recursosEPUB/El_burlador_de_Sevilla.epub','Teatro','OL47259330M'),(13,'Vuelva usted mañana','Artículo satírico sobre la burocracia y las costumbres sociales.',35,1833,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Vuelva_usted_mañana.pdf','obras/recursosEPUB/Vuelva_usted_mañana.epub','Ensayo',NULL),(14,'Martín Fierro','Poema narrativo gauchesco sobre injusticia, marginalidad y vida en la frontera.',350,1872,'2026-03-23 08:08:59',NULL,NULL,NULL,'Poesía','OL13206601M'),(15,'María','Novela romántica sobre amor idealizado, naturaleza y tragedia.',260,1867,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/María.pdf','obras/recursosEPUB/María.epub','Narrativa','OL9466912M'),(16,'Cuentos de amor de locura y de muerte','Colección de relatos sobre obsesión, violencia, enfermedad y destino.',220,1917,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Cuentos_de_amor_de_locura_y_de_muerte.pdf','obras/recursosEPUB/Cuentos_de_amor_de_locura_y_de_muerte.epub','Narrativa','OL1013564M'),(17,'Cuentos de la selva','Relatos para público joven ambientados en la selva con animales y aventura.',160,1918,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Cuentos_de_la_selva.pdf','obras/recursosEPUB/Cuentos_de_la_selva.epub','Infantil','OL6830148M'),(18,'Azul...','Libro clave del modernismo hispánico, mezcla de poesía y prosa poética.',180,1888,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Azul.pdf','obras/recursosEPUB/Azul.epub','Poesía','OL47268909M'),(19,'Versos sencillos','Poemario de expresión clara, emocional y meditativa.',130,1891,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Versos_sencillos.pdf','obras/recursosEPUB/Versos_sencillos.epub','Poesía','OL675972M'),(20,'Aves sin nido','Novela de denuncia social sobre opresión e injusticia en los Andes.',240,1889,'2026-03-23 08:08:59',NULL,NULL,NULL,'Narrativa','OL901234M'),(21,'Facundo','Ensayo sobre civilización, barbarie y construcción nacional en Argentina.',300,1845,'2026-03-23 08:08:59',NULL,NULL,NULL,'Ensayo','OL344738M'),(22,'Ariel','Ensayo sobre cultura, juventud y valores espirituales en Hispanoamérica.',150,1900,'2026-03-23 08:08:59',NULL,NULL,NULL,'Ensayo','OL2389946M'),(23,'Nocturno','Poema emblemático de tono melancólico y musicalidad modernista.',20,1894,'2026-03-23 08:08:59',NULL,NULL,NULL,'Poesía','OL17725045M'),(24,'Los heraldos negros','Libro poético marcado por el dolor, la existencia y la experiencia humana.',140,1919,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Los_heraldos_negros.pdf','obras/recursosEPUB/Los_heraldos_negros.epub','Poesía','OL33070958M'),(25,'Viaje maravilloso del señor Nic-Nac al planeta Marte','Relato pionero de ciencia ficción en español con viaje interplanetario y tono satírico.',90,1875,'2026-03-23 08:08:59',NULL,NULL,NULL,'Narrativa','OL22745554M'),(26,'Primero sueño','Poema filosófico y barroco sobre el conocimiento y los límites humanos.',60,1692,'2026-03-23 08:08:59',NULL,NULL,NULL,'Poesía','OL1285663M'),(27,'Nuestra América','Ensayo sobre identidad, emancipación intelectual y realidad latinoamericana.',40,1891,'2026-03-23 08:08:59',NULL,NULL,NULL,'Ensayo','OL4458890M'),(28,'Prosas profanas','Poemario modernista de gran musicalidad e imaginería.',170,1896,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/Prosas_profanas.pdf','obras/recursosEPUB/Prosas_profanas.epub','Poesía','OL21017417M'),(29,'La vorágine','Novela sobre la violencia, la explotación y la selva como fuerza destructora.',300,1924,'2026-03-23 08:08:59',NULL,'obras/recursosPDF/La_vorágine.pdf','obras/recursosEPUB/La_vorágine.epub','Narrativa','OL1631053M'),(30,'Tradiciones peruanas','Conjunto de relatos breves de tono histórico, anecdótico y costumbrista.',400,1872,'2026-03-23 08:08:59',NULL,NULL,NULL,'Narrativa','OL6678848M'),(31,'Libro prueba1','un libro de prueba',25,2018,'2026-04-22 07:47:22','2026-05-14 13:47:04',NULL,NULL,'Teatro',NULL),(39,'Las flores del Mal','Las flores del mal (título original en francés: Les Fleurs du mal) es una colección de poemas de Charles Baudelaire. Considerada la obra máxima de su autor, abarca casi la totalidad de su producción poética desde 1840 hasta la fecha de su primera publicación.',350,1857,'2026-04-29 08:47:22',NULL,'/obras/recursosPDF/Las_flores_del_Mal.pdf','obras/recursosEPUB/Las_flores_del_Mal.epub','Poesía','OL47106182M'),(41,'La destrucción o el amor','La temática del libro, expresada en su título, es el amor, entendido como oposición o como complemento a la muerte. La técnica del poemario es esencialmente surrealista, al igual que en sus libros Espadas como labios y Mundo a solas, y en él predomina el verso libre, aunque también se emplean estrofas de corte clásico, como la lira.',140,1935,'2026-04-29 09:09:06',NULL,'obras/recursosPDF/La_destrucción_o_el_amor.pdf','obras/recursosEPUB/La_destrucción_o_el_amor.epub','Poesía','OL33287658M'),(42,'El principito','Un aviador perdido en el desierto conoce a un misterioso niño que viaja de planeta en planeta. A través de sus conversaciones, el pequeño le enseña el verdadero valor del amor, la amistad y las cosas sencillas de la vida que los adultos suelen olvidar.',96,1943,'2026-05-11 13:18:07',NULL,'obras/recursosPDF/El_principito.pdf','obras/recursosEPUB/El_principito.epub','Infantil','OL47116985M'),(44,'Iluminaciones','uminaciones (o Las Iluminaciones) es una colección de poemas en prosa del poeta francés Arthur Rimbaud, aparecida parcialmente en la revista literaria parisina La Vogue entre mayo y junio de 1886. El texto fue reimpreso en forma de libro en octubre de 1886 bajo el título Les Iluminations propuesto por el poeta Paul Verlaine, antiguo amigo y amante de Rimbaud. En el prefacio, Verlaine explicó que el título venía de la palabra inglesa iluminations, que era el subtítulo que Rimbaud había elegido para el libro. Verlaine fechó la composición del mismo entre 1873 y 1875.',160,1886,'2026-05-12 07:23:57',NULL,'obras/recursosPDF/Iluminaciones.pdf','obras/recursosEPUB/Iluminaciones.epub','Poesía','OL9446462M'),(45,'El spleen de París','El spleen de París es una colección de 50 poemas en prosa que retratan la vida moderna en París durante el siglo XIX. A través de visiones urbanas, melancólicas y a menudo crueles, Charles Baudelaire explora temas como el spleen (una profunda melancolía y hastío existencial), la hipocresía social, la belleza, el paso del tiempo y el deseo de escapar de la realidad.',180,1869,'2026-05-12 07:41:00',NULL,'obras/recursosPDF/El_spleen_de_París.pdf','obras/recursosEPUB/El_spleen_de_París.epub','Poesía','OL32969867M'),(46,'La metamorfosis','La metamorfosis (en alemán: Die Verwandlung, también traducido como La transformación) es una novela corta escrita por Franz Kafka en 1915. La historia trata sobre Gregorio Samsa, cuya repentina transformación en una monstruosa alimaña dificulta cada vez más la comunicación de su entorno social con él, hasta que es considerado intolerable por su familia.',70,1915,'2026-05-12 09:53:37',NULL,'obras/recursosPDF/La_metamorfosis.pdf','obras/recursosEPUB/La_metamorfosis.epub','Narrativa','OL47467327M'),(47,'La España invertebrada','Publicado en 1921, este ensayo de José Ortega y Gasset es un diagnóstico sobre la crisis política y social de la España de su tiempo, cuyas causas atribuye a la \"invertebración\" o descomposición del cuerpo social. Para Ortega, España sufre un \"particularismo\": cada grupo (regiones, gremios) actúa por su propio interés, en lugar de sentirse parte de un proyecto de nación común. En la parte central de la obra, \"La ausencia de los mejores\", el filósofo profundiza en una supuesta \"aristofobia\" u odio a los mejores, que identifica como un defecto en el \"alma nacional\". Así, la obra se erige como un análisis de las élites, el separatismo y la identidad nacional, planteando un debate que, un siglo después, sigue siendo central en el pensamiento político español.',144,1921,'2026-05-12 10:48:41',NULL,'obras/recursosPDF/La_España_invertebrada.pdf','obras/recursosEPUB/La_España_invertebrada.epub','Ensayo','OL3523980M'),(48,'El proceso','La historia comienza con el arresto de Josef K., un oficinista de banco que es detenido una mañana sin saber por qué ni qué delitos se le imputan.  Aunque es puesto en libertad, queda atrapado en un laberinto judicial absurdo e incomprensible donde las altas instancias de la justicia resultan inaccesibles, convirtiéndose la novela en una metáfora de la alienación y la burocracia opresiva del hombre moderno.',300,1925,'2026-05-13 13:16:24',NULL,'obras/recursosPDF/El_proceso.pdf','obras/recursosEPUB/El_proceso.epub','Narrativa','OL9019142M'),(49,'Bodas de sangre','\"Bodas de sangre\" es una tragedia escrita por Federico García Lorca en 1932 y estrenada en 1933 en Madrid. La obra, que forma parte de la llamada \"trilogía rural\" del autor junto con Yerma y La casa de Bernarda Alba, explora las pasiones humanas más profundas y el implacable poder del destino.',176,1933,'2026-05-13 14:44:45',NULL,'obras/recursosPDF/Bodas_de_sangre.pdf','obras/recursosEPUB/Bodas_de_sangre.epub','Teatro','OL22098197M'),(50,'Campos de Castilla','Campos de Castilla es uno de los libros más emblemáticos de Antonio Machado y de la Generación del 98. Publicado en 1912 y ampliado en 1917, el poemario refleja la profunda transformación del autor tras su traslado a Soria, donde conoce el paisaje austero, la tierra árida y las gentes de Castilla. La obra se divide en tres partes: poemas dedicados a la descripción y meditación sobre el paisaje soriano y castellano (con piezas como A orillas del Duero), elegías por la muerte de su esposa Leonor (A un olmo seco), y poemas posteriores de crítica social y política (Proverbios y cantares). Machado abandona el modernismo inicial para adoptar un tono sobrio, reflexivo y desnudo, donde el paisaje se convierte en espejo del alma española. Es un canto de amor y denuncia a una Castilla vieja, atrasada, pero también cuna de valores eternos.',240,1912,'2026-05-13 14:56:43',NULL,'obras/recursosPDF/Campos_de_Castilla.pdf','obras/recursosEPUB/Campos_de_Castilla.epub','Poesía','OL6820918M'),(51,'Casa con dos puertas, mala es de guardar','Esta comedia de capa y espada plantea un enredo amoroso con puertas que se abren y se cierran. Lisardo se aloja en casa de su amigo Félix, sin saber que la hermana de este, Marcela, está enamorada de él. A partir de ahí, los personajes se ven envueltos en una serie de confusiones y malentendidos. A diferencia de lo que sugiere el refrán, la moraleja de la obra es que no basta con tener una casa de muchas puertas; es preferible tener una sola puerta bien guardada que muchas puertas mal vigiladas.',140,1629,'2026-05-13 15:03:20',NULL,'obras/recursosPDF/Casa_con_dos_puertas,_mala_es_de_guardar.pdf','obras/recursosEPUB/Casa_con_dos_puertas,_mala_es_de_guardar.epub','Teatro','OL11980418M'),(52,'Cuentos de amor de locura y de muerte','Colección de dieciocho relatos donde Quiroga explora los límites de la razón humana, la pasión amorosa y la presencia implacable de la muerte. Ambientados en la selva misionera o en ambientes urbanos, cuentos como La gallina degollada, El almohadón de plumas y El hijo mezclan el realismo con lo macabro y lo psicológico, mostrando a hombres y mujeres arrastrados por la locura, la enfermedad o la fatalidad.',224,1917,'2026-05-13 15:08:39',NULL,'obras/recursosPDF/Cuentos_de_amor_de_locura_y_de_muerte.pdf','obras/recursosEPUB/Cuentos_de_amor_de_locura_y_de_muerte.epub','Narrativa','OL1013564M'),(53,'Cumbres borrascosas','En la desolada y ventosa Cumbres Borrascosas, el terrateniente Heathcliff, un niño marginado adoptado, desarrolla una pasión obsesiva y destructiva por su hermana adoptiva Catherine Earnshaw. Al no poder casarse con ella, Heathcliff trama una venganza cruel que se extiende a lo largo de dos generaciones, destruyendo a las familias Earnshaw y Linton. La novela, narrada por la sirvienta Nelly Dean, explora los límites del amor, el odio, la locura y la venganza en un paisaje salvaje que refleja el alma de sus personajes.',336,1847,'2026-05-13 15:12:49',NULL,'obras/recursosPDF/Cumbres_borrascosas.pdf','obras/recursosEPUB/Cumbres_borrascosas.epub','Narrativa',NULL),(54,'Desobediencia civil','En este ensayo, Thoreau argumenta que los individuos deben priorizar su conciencia ante las leyes injustas del gobierno, una postura inspirada por su oposición a la esclavitud y a la guerra contra México. Su negativa a pagar impuestos le llevó a pasar una noche en la cárcel, experiencia que plasmó en este texto. La obra se ha convertido en un texto fundacional sobre la protesta no violenta y ha influido profundamente en figuras como Gandhi y Martin Luther King Jr.',50,1849,'2026-05-13 15:22:34',NULL,'obras/recursosPDF/Desobediencia_civil.pdf','obras/recursosEPUB/Desobediencia_civil.epub','Ensayo','OL35627046M'),(55,'El corazón de las tinieblas','El marinero Marlow relata su viaje por el río Congo en busca de Kurtz, un agente comercial europeo perdido en la selva. A medida que avanza, descubre la brutalidad del colonialismo y la progresiva caída de Kurtz en la locura y la maldad. La novela explora la fina línea entre la civilización y la barbarie, y la oscuridad que habita en el corazón humano.',144,1899,'2026-05-13 15:26:43',NULL,'obras/recursosPDF/El_corazón_de_las_tinieblas.pdf','obras/recursosEPUB/El_corazón_de_las_tinieblas.epub','Narrativa','OL25674698M'),(56,'El jardín de los cerezos','Liubov Ranevskaya, una terrateniente arruinada, regresa a su finca familiar con el emblemático jardín de cerezos, que debe ser subastado por las deudas. Mientras ella y su familia viven anclados en el pasado sin aceptar la realidad, el comerciante Lopajín propone talar el jardín y construir casas de verano para salvar la propiedad. La obra, agridulce, retrata el fin de una era aristocrática y el ascenso de una nueva clase burguesa en la Rusia de principios del siglo XX.',112,1904,'2026-05-13 15:29:37',NULL,'obras/recursosPDF/El_jardín_de_los_cerezos.pdf','obras/recursosEPUB/El_jardín_de_los_cerezos.epub','Teatro','OL47132890M'),(57,'El maravilloso mago de Oz','Dorothy Gale, una niña huérfana que vive en una granja de Kansas, es arrastrada por un ciclón junto a su perro Totó hasta la mágica Tierra de Oz. Su casa cae sobre la Bruja Mala del Este, liberando a los Munchkins. Para volver a Kansas, Dorothy debe seguir el camino de ladrillos amarillos hasta la Ciudad Esmeralda y pedir ayuda al poderoso Mago de Oz. En su viaje se encuentra con el Espantapájaros, el Leñador de Hojalata y el León Cobarde, quienes la acompañan para pedir al mago un cerebro, un corazón y valor, respectivamente. Juntos vivirán numerosas aventuras y descubrirán que lo que buscan ya lo tienen dentro de sí mismos.',256,1900,'2026-05-13 15:36:28',NULL,'obras/recursosPDF/El_maravilloso_mago_de_Oz.pdf','obras/recursosEPUB/El_maravilloso_mago_de_Oz.epub','Infantil','OL47145224M'),(58,'Frankenstein','El joven científico Víctor Frankenstein, obsesionado por descubrir el secreto de la vida, logra crear una criatura con partes de cadáveres. Horrorizado por su propio experimento, abandona al monstruo, que sufre el rechazo de la sociedad y clama venganza contra su creador. La criatura exige a Frankenstein que le cree una compañera, desencadenando una espiral de tragedia y muerte que obliga al científico a perseguir a su propia creación hasta los confines del Ártico.',280,1818,'2026-05-13 15:41:58',NULL,'obras/recursosPDF/Frankenstein.pdf','obras/recursosEPUB/Frankenstein.epub','Narrativa','OL35649409M'),(59,'Heidi','Heidi es una niña huérfana que es llevada por su tía a vivir con su abuelo, un ermitaño que vive en lo alto de los Alpes suizos. A pesar de su carácter hosco, el abuelo termina encariñándose con la pequeña, que descubre la belleza de la naturaleza y la amistad con Pedro, el cabrero de la región. Cuando la tía regresa para llevarla a Fráncfort como compañera de una niña enferma llamada Clara, Heidi se siente atrapada por las rígidas normas de la ciudad. La nostalgia de las montañas la hará enfermar y solo el regreso a su hogar logrará devolverle la salud y la alegría.',280,1880,'2026-05-13 15:50:27',NULL,'obras/recursosPDF/Heidi.pdf','obras/recursosEPUB/Heidi.epub','Infantil','OL11665757M'),(60,'La importancia de llamarse Ernesto','Dos amigos, Jack y Algernon, llevan una doble vida para escapar de las convenciones sociales victorianas. Jack ha inventado un hermano ficticio llamado \"Ernesto\" para poder ausentarse del campo y divertirse en Londres. Algernon, por su parte, finge tener un amigo enfermo llamado \"Bunbury\". Cuando ambos se enamoran de dos jóvenes que solo aceptan casarse con un hombre llamado \"Ernesto\", la situación se enreda hasta que el final revela un secreto mucho más profundo e irónico: todos han estado buscando la importancia de llamarse, precisamente, Ernesto.',96,1895,'2026-05-13 15:54:49',NULL,'obras/recursosPDF/La_importancia_de_llamarse_Ernesto.pdf','obras/recursosEPUB/La_importancia_de_llamarse_Ernesto.epub','Teatro','OL34064528M'),(61,'La llamada de Cthulhu','El relato comienza con la muerte del profesor George Gammell Angell, un reconocido investigador de lenguas semíticas. Su sobrino, Francis Wayland Thurston, hereda sus documentos y descubre una extraña investigación sobre un culto global que adora a una entidad antigua y letal llamada Cthulhu. Reuniendo testimonios de todo el mundo —desde pesadillas compartidas por artistas hasta el testimonio de un inspector de policía de Nueva Orleans— Thurston reconstruye los intentos de una secta por despertar a este dios primigenio. La evidencia culmina con el relato de un marinero que, tras un encuentro accidental con la ciudad sumergida de R\'lyeh, se topa con la misma criatura. El cuento, clave para entender el horror cósmico, plantea que el mundo conocido es apenas un velo sobre una realidad mucho más aterradora e inconmensurable, y que el despertar de Cthulhu es solo cuestión de tiempo.',100,1928,'2026-05-13 15:59:23',NULL,'obras/recursosPDF/La_llamada_de_Cthulhu.pdf','obras/recursosEPUB/La_llamada_de_Cthulhu.epub','Narrativa','OL30619969M'),(62,'Niebla','Augusto Pérez, un joven rico y solitario, licenciado en Derecho y huérfano de madre, vive una vida sin rumbo ni propósito hasta que se enamora de Eugenia, una joven pianista. Su intento de conquista y las posteriores decepciones amorosas le llevan a una profunda crisis existencial. Al borde del suicidio, Augusto decide visitar al propio Miguel de Unamuno en Salamanca para pedirle consejo. El encuentro se convierte en un diálogo metafísico donde el creador le revela a su criatura que no es más que un «ente de ficción», un personaje de novela sin capacidad para decidir su propio destino.',304,1914,'2026-05-14 07:16:21',NULL,'obras/recursosPDF/Niebla.pdf','obras/recursosEPUB/Niebla.epub','Narrativa','OL9199641M'),(63,'Orgullo y prejuicio','La historia se centra en Elizabeth Bennet, una joven inteligente y de espíritu libre, y en su tensa relación con el rico y orgulloso señor Darcy. A través de malentendidos, prejuicios sociales y giros del destino, ambos deberán superar su propio orgullo para encontrar el amor verdadero. Ambientada en la Inglaterra rural de principios del siglo XIX, la novela explora con ingenio y agudeza temas como el matrimonio, la clase social y la condición de la mujer.',400,1813,'2026-05-14 07:26:24',NULL,'obras/recursosPDF/Orgullo_y_prejuicio.pdf','obras/recursosEPUB/Orgullo_y_prejuicio.epub','Narrativa','OL47163671M'),(64,'Una habitación propia','Basado en dos conferencias que Woolf impartió en las universidades femeninas de Cambridge en 1928, la obra parte de una pregunta central: ¿qué necesitan las mujeres para escribir buenas novelas? La respuesta de Woolf es lapidaria e innovadora: \"una mujer debe tener dinero y una habitación propia para poder escribir\". A través de un recorrido histórico y literario, la autora analiza las dificultades y los prejuicios que han enfrentado las escritoras a lo largo de los siglos, y defiende la necesidad de que las mujeres alcancen una independencia tanto económica como personal para poder desarrollar su creatividad y contribuir a la cultura.',160,1929,'2026-05-14 07:32:19',NULL,'obras/recursosPDF/Una_habitación_propia.pdf','obras/recursosEPUB/Una_habitación_propia.epub','Ensayo',NULL),(65,'Vindicación de los derechos de la mujer','Publicada en 1792, esta obra es considerada uno de los textos fundacionales del feminismo. Wollstonecraft sostiene que las mujeres no son inferiores a los hombres por naturaleza, sino que lo parecen por su falta de educación. Critica la concepción de la mujer como un mero adorno o un ser puramente emocional y sentimental, argumentando que la razón no es exclusiva de los varones. Defiende que mujeres y hombres deben ser educados juntos y tener los mismos derechos civiles y políticos, pues la virtud y la inteligencia no entienden de sexos. Es una respuesta directa a los pensadores ilustrados (como Rousseau) que limitaban el rol de la mujer al ámbito doméstico.',352,1792,'2026-05-14 07:37:06',NULL,'obras/recursosPDF/Vindicación_de_los_derechos_de_la_mujer.pdf','obras/recursosEPUB/Vindicación_de_los_derechos_de_la_mujer.epub','Ensayo','OL13320978M'),(66,'Yerma','Yerma, una mujer campesina, vive atormentada por su incapacidad para concebir hijos a pesar de llevar tres años casada con Juan, un hombre práctico y poco apasionado. Su deseo de maternidad se convierte en una obsesión que la aísla socialmente y la enfrenta a las estrictas convenciones del honor y la fertilidad en la España rural.',144,1934,'2026-05-14 07:40:32',NULL,'obras/recursosPDF/Yerma.pdf','obras/recursosEPUB/Yerma.epub','Teatro','OL1088575M');
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntuaciones`
--

DROP TABLE IF EXISTS `puntuaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puntuaciones` (
  `valor` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_obra` int NOT NULL,
  `fecha_puntuacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`,`id_obra`),
  KEY `fk_obra_punt` (`id_obra`),
  CONSTRAINT `fk_obra_punt` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`),
  CONSTRAINT `fk_usuario_punt` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `puntuaciones_chk_1` CHECK ((`valor` between 1 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntuaciones`
--

LOCK TABLES `puntuaciones` WRITE;
/*!40000 ALTER TABLE `puntuaciones` DISABLE KEYS */;
INSERT INTO `puntuaciones` VALUES (4,1,1,'2026-04-13 15:32:19'),(5,2,1,'2026-04-13 15:32:19'),(4,3,1,'2026-04-13 15:32:19'),(5,10,41,'2026-05-11 15:48:42');
/*!40000 ALTER TABLE `puntuaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte_comentarios`
--

DROP TABLE IF EXISTS `reporte_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reporte_comentarios` (
  `id_usuario` int NOT NULL,
  `id_comentario` int NOT NULL,
  `fecha_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `revisado` tinyint DEFAULT '0',
  PRIMARY KEY (`id_usuario`,`id_comentario`),
  KEY `fk_comentario_rc` (`id_comentario`),
  CONSTRAINT `fk_comentario_rc` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id`),
  CONSTRAINT `fk_usuario_rc` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte_comentarios`
--

LOCK TABLES `reporte_comentarios` WRITE;
/*!40000 ALTER TABLE `reporte_comentarios` DISABLE KEYS */;
INSERT INTO `reporte_comentarios` VALUES (10,32,'2026-04-30 10:45:15',NULL,0),(10,33,'2026-04-30 10:45:15',NULL,0),(10,34,'2026-04-30 10:45:15',NULL,0),(10,36,'2026-04-30 10:45:15',NULL,0),(10,37,'2026-04-30 10:45:15',NULL,0),(10,38,'2026-04-30 10:45:15',NULL,0),(10,39,'2026-04-30 10:45:15',NULL,0),(10,41,'2026-05-11 15:49:07',NULL,0),(12,40,'2026-05-06 14:24:33',NULL,0);
/*!40000 ALTER TABLE `reporte_comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguidores`
--

DROP TABLE IF EXISTS `seguidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguidores` (
  `id_seguidor` int NOT NULL,
  `id_seguido` int NOT NULL,
  `fecha_seguimiento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_seguidor`,`id_seguido`),
  KEY `fk_seguido` (`id_seguido`),
  CONSTRAINT `fk_seguido` FOREIGN KEY (`id_seguido`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_seguidor` FOREIGN KEY (`id_seguidor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguidores`
--

LOCK TABLES `seguidores` WRITE;
/*!40000 ALTER TABLE `seguidores` DISABLE KEYS */;
INSERT INTO `seguidores` VALUES (1,2,'2026-04-14 08:14:01'),(1,3,'2026-04-14 08:14:01'),(1,9,'2026-04-14 14:21:42'),(1,12,'2026-05-08 10:34:54'),(2,1,'2026-04-14 08:14:01'),(3,1,'2026-04-14 08:14:01'),(12,1,'2026-05-08 10:38:37'),(12,2,'2026-05-08 10:15:28'),(12,3,'2026-05-08 10:34:26');
/*!40000 ALTER TABLE `seguidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `es_admin` tinyint(1) DEFAULT '0',
  `moderado` tinyint(1) DEFAULT '0',
  `bio` text,
  `ruta_foto` varchar(255) DEFAULT 'assets/img/default/imgperfil.png',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Ana García López','ana_lectora','ana.garcia@email.com','$2y$10$8oan7VxH65z9ZyrR0X3EL.ds8oQfwCdMJV6Z4WeEiUxjSZk4ek21q',1,0,0,'Amante de la literatura clásica y el café. Leo todos los días antes de dormir.','assets/img/default/imgperfil.png','2026-04-13 14:10:32'),(2,'Carlos Martínez Ruiz','carlos_bookworm','carlos.mtz@email.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',1,0,0,'Profesor de literatura y escritor aficionado. Especialista en Siglo de Oro.','assets/img/default/imgperfil.png','2026-04-13 14:10:32'),(3,'María Elena Sousa','maria_elena_reads','maria.sousa@email.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',1,0,0,'Bloguera literaria. Comparto reseñas y recomendaciones semanales.','assets/img/default/imgperfil.png','2026-04-13 14:10:32'),(8,'perico palotes','pe_pa','pepa@mail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',1,0,0,NULL,'assets/img/default/imgperfil.png','2026-04-14 11:55:12'),(9,'Marcos Pozo','marcoselpop','elpop@mail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',1,0,0,NULL,'assets/img/default/imgperfil.png','2026-04-14 14:20:56'),(10,'Admin','usuario_admin','admin@email.com','$2y$10$52KPG/sbdHOl1UEWXhBUd.cPkdQHp04dFr6qL1ra664wKCpxmik1q',1,1,1,NULL,'assets/img/imgperfil/usuario_10_75b5df4c0f576533.png','2026-04-20 13:44:12'),(11,'inactivo prueba mod','prueba_inactivo','inactivo@email.com','$2y$10$HFhQWZB/j07lekkn4oSvy.CWqX2t0K5PaGRYpFjc53LHQdfls4kAS',0,0,0,NULL,'assets/img/default/imgperfil.png','2026-04-16 15:29:58'),(12,'Usuario de Prueba','usuario_prueba','usuarioprueba@email.com','$2y$10$YHNMeS/rwEGQQfynxvo3T.MeoO7D8uBHnKU76Fv995W5XlVnUwjXC',1,0,0,'Apasionado de la lectura y la cocina.','assets/img/imgperfil/usuario_12_1778167415.webp','2026-04-20 09:39:56'),(14,'Lucía Fernández','lucia_fdez','lucia.fdez@mail.com','$2y$10$dummyhash1',1,0,0,'Amante de la literatura clásica',NULL,'2026-04-30 10:52:36'),(15,'Pablo Ruiz','pablo_ruiz','pablo.ruiz@mail.com','$2y$10$dummyhash2',1,0,1,'Escritor aficionado',NULL,'2026-04-30 10:52:36'),(16,'Carmen Delgado','carmen_d','carmen.d@mail.com','$2y$10$dummyhash3',0,0,0,NULL,NULL,'2026-04-30 10:52:36'),(17,'Javier Moreno','javi_moreno','javi.moreno@mail.com','$2y$10$dummyhash4',1,0,0,'Profesor de literatura',NULL,'2026-04-30 10:52:36'),(18,'Isabel Torres','isa_torres','isa.torres@mail.com','$2y$10$dummyhash5',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(19,'Diego Sánchez','diego_sanchez','diego.s@mail.com','$2y$10$dummyhash6',1,0,1,'Crítico literario amateur',NULL,'2026-04-30 10:52:36'),(20,'Laura Gómez','laura_gomez','laura.g@mail.com','$2y$10$dummyhash7',0,0,0,NULL,NULL,'2026-04-30 10:52:36'),(21,'Andrés Martín','andres_martin','andres.m@mail.com','$2y$10$dummyhash8',1,0,0,'Bibliotecario',NULL,'2026-04-30 10:52:36'),(22,'Sofía Navarro','sofia_nav','sofia.nav@mail.com','$2y$10$dummyhash9',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(23,'Miguel Ángel Herrero','miguelangel_h','ma.herrero@mail.com','$2y$10$dummyhash10',1,0,0,'Lector compulsivo',NULL,'2026-04-30 10:52:36'),(24,'Elena Jiménez','elena_jim','elena.jim@mail.com','$2y$10$dummyhash11',1,0,1,NULL,NULL,'2026-04-30 10:52:36'),(25,'Roberto Vega','roberto_vega','r.vega@mail.com','$2y$10$dummyhash12',0,0,0,'Escritor de relatos',NULL,'2026-04-30 10:52:36'),(26,'Clara Muñoz','clara_munoz','clara.m@mail.com','$2y$10$dummyhash13',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(27,'Fernando López','fer_lopez','fer.lopez@mail.com','$2y$10$dummyhash14',1,0,0,'Historiador y lector',NULL,'2026-04-30 10:52:36'),(28,'Marta Díaz','marta_diaz','marta.d@mail.com','$2y$10$dummyhash15',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(29,'Álvaro Castro','alvaro_castro','alvaro.c@mail.com','$2y$10$dummyhash16',1,0,1,'Poeta',NULL,'2026-04-30 10:52:36'),(30,'Natalia Ortiz','natalia_ortiz','natalia.o@mail.com','$2y$10$dummyhash17',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(31,'Sergio Blanco','sergio_blanco','sergio.b@mail.com','$2y$10$dummyhash18',1,0,0,'Editor',NULL,'2026-04-30 10:52:36'),(32,'Adriana Reyes','adri_reyes','adri.reyes@mail.com','$2y$10$dummyhash19',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(33,'Tomás Medina','tomas_medina','tomas.m@mail.com','$2y$10$dummyhash20',1,0,0,'Traductor literario',NULL,'2026-04-30 10:52:36'),(34,'Paula Romero','paula_romero','paula.r@mail.com','$2y$10$dummyhash21',1,0,1,NULL,NULL,'2026-04-30 10:52:36'),(35,'Ricardo Serrano','ricky_serrano','ricky.s@mail.com','$2y$10$dummyhash22',0,0,0,'Estudiante de filología',NULL,'2026-04-30 10:52:36'),(36,'Beatriz Gil','bea_gil','bea.gil@mail.com','$2y$10$dummyhash23',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(37,'Óscar Flores','oscar_flores','oscar.f@mail.com','$2y$10$dummyhash24',1,0,0,'Crítico teatral',NULL,'2026-04-30 10:52:36'),(38,'Inés Rubio','ines_rubio','ines.r@mail.com','$2y$10$dummyhash25',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(39,'Guillermo Prieto','guille_prieto','guille.p@mail.com','$2y$10$dummyhash26',1,0,1,'Dramaturgo',NULL,'2026-04-30 10:52:36'),(40,'Teresa Molina','teresa_molina','teresa.m@mail.com','$2y$10$dummyhash27',0,0,0,NULL,NULL,'2026-04-30 10:52:36'),(41,'Raúl Izquierdo','raul_izq','raul.i@mail.com','$2y$10$dummyhash28',1,0,0,'Periodista cultural',NULL,'2026-04-30 10:52:36'),(42,'Silvia Herrera','silvia_herra','silvia.h@mail.com','$2y$10$dummyhash29',1,0,0,NULL,NULL,'2026-04-30 10:52:36'),(43,'Emilio Vargas','emilio_vargas','emilio.v@mail.com','$2y$10$dummyhash30',1,0,0,'Cuentacuentos',NULL,'2026-04-30 10:52:36'),(44,'usuario app','usuario_app','correo@prueba.com','$2y$10$XTZCXX/uYy4Bum/dgM/rh.R8v7Rqky6nXwhggnH4yb82uemvB0pKC',1,0,0,NULL,'assets/img/default/imgperfil.png','2026-04-30 11:25:53'),(45,'Marcos','marcopop','mpozma@g.educaand.es','$2y$10$Z3qmt9tMzheJNJM6Tmk0DO7GEjGhjuCY6N.Wx2X4s0rStXKe5dl5.',1,0,0,NULL,'assets/img/imgperfil/usuario_45_1778591148.png','2026-05-12 13:05:33'),(46,'asdasd','asdasd','asdasd@adasda.com','$2y$10$0CvYFQSc1UedeiLTCOgMAusK9aAnjt/p0QigGcGRa1wuEQ8K3upW6',1,0,0,NULL,'assets/img/default/imgperfil.png','2026-05-14 15:39:25');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-15  9:11:34
