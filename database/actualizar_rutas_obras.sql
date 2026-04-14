USE eBiblioteca;

-- ============================================
-- 1. RENOMBRAR ruta_html A ruta_epub
-- ============================================
ALTER TABLE obras CHANGE ruta_html ruta_epub VARCHAR(200);

-- ============================================
-- 2. ACTUALIZAR RUTAS DE OBRAS CON ARCHIVOS EXISTENTES
-- Las rutas son relativas desde /public (la raíz web)
-- ============================================

-- 1. Azul (Darío) - ID 18
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Azul.pdf',
    ruta_epub = 'obras/recursosEPUB/Azul.epub'
WHERE id = 18;

-- 2. Cantares gallegos (Rosalía) - ID 7
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Cantares_gallegos.pdf',
    ruta_epub = 'obras/recursosEPUB/Cantares_gallegos.epub'
WHERE id = 7;

-- 3. Claros del bosque (Zambrano) - No está en obras (es María Zambrano, no está en la lista)
-- NOTA: Este archivo existe pero no hay obra correspondiente en la BD actual

-- 4. Cuentos de amor de locura y de muerte (Quiroga) - ID 16
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Cuentos_de_amor_de_locura_y_de_muerte.pdf',
    ruta_epub = 'obras/recursosEPUB/Cuentos_de_amor_de_locura_y_de_muerte.epub'
WHERE id = 16;

-- 5. Cuentos de la selva (Quiroga) - ID 17
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Cuentos_de_la_selva.pdf',
    ruta_epub = 'obras/recursosEPUB/Cuentos_de_la_selva.epub'
WHERE id = 17;

-- 6. Don Quijote de la Mancha (Cervantes) - ID 1
-- Hay dos archivos: DonQuijoteDeLaMancha.pdf y Don_Quijote_de_la_Mancha.pdf
-- Usaremos el que está sin espacios extra
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/DonQuijoteDeLaMancha.pdf',
    ruta_epub = 'obras/recursosEPUB/Don_Quijote_de_la_Mancha.epub'
WHERE id = 1;

-- 7. Don Juan Tenorio (Zorrilla) - ID 8
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Don_Juan_Tenorio.pdf',
    ruta_epub = 'obras/recursosEPUB/Don_Juan_Tenorio.epub'
WHERE id = 8;

-- 8. El burlador de Sevilla (Tirso) - ID 12
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/El_burlador_de_Sevilla.pdf',
    ruta_epub = 'obras/recursosEPUB/El_burlador_de_Sevilla.epub'
WHERE id = 12;

-- 9. Fortunata y Jacinta (Galdós) - ID 2
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Fortunata_y_Jacinta.pdf',
    ruta_epub = 'obras/recursosEPUB/Fortunata_y_Jacinta.epub'
WHERE id = 2;

-- 10. La Celestina (Rojas) - ID 9
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/La_Celestina.pdf',
    ruta_epub = 'obras/recursosEPUB/La_Celestina.epub'
WHERE id = 9;

-- 11. La Regenta (Clarín) - ID 5
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/La_Regenta.pdf',
    ruta_epub = 'obras/recursosEPUB/La_Regenta.epub'
WHERE id = 5;

-- 12. La vida es sueño (Calderón) - ID 11
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/La_vida_es_sueño.pdf',
    ruta_epub = 'obras/recursosEPUB/La_vida_es_sueño.epub'
WHERE id = 11;

-- 13. La vorágine (Rivera) - ID 29
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/La_vorágine.pdf',
    ruta_epub = 'obras/recursosEPUB/La_vorágine.epub'
WHERE id = 29;

-- 14. Los heraldos negros (Vallejo) - ID 24
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Los_heraldos_negros.pdf',
    ruta_epub = 'obras/recursosEPUB/Los_heraldos_negros.epub'
WHERE id = 24;

-- 15. Los pazos de Ulloa (Pardo Bazán) - ID 4
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Los_pazos_de_Ulloa.pdf',
    ruta_epub = 'obras/recursosEPUB/Los_pazos_de_Ulloa.epub'
WHERE id = 4;

-- 16. Marianela (Galdós) - ID 3
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Marianela.pdf',
    ruta_epub = 'obras/recursosEPUB/Marianela.epub'
WHERE id = 3;

-- 17. María (Isaacs) - ID 15
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/María.pdf',
    ruta_epub = 'obras/recursosEPUB/María.epub'
WHERE id = 15;

-- 18. Prosas profanas (Darío) - ID 28
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Prosas_profanas.pdf',
    ruta_epub = 'obras/recursosEPUB/Prosas_profanas.epub'
WHERE id = 28;

-- 19. Rimas (Bécquer) - ID 6
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Rimas.pdf',
    ruta_epub = 'obras/recursosEPUB/Rimas.epub'
WHERE id = 6;

-- 20. Versos sencillos (Martí) - ID 19
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Versos_sencillos.pdf',
    ruta_epub = 'obras/recursosEPUB/Versos_sencillos.epub'
WHERE id = 19;

-- 21. Vuelva usted mañana (Larra) - ID 13
UPDATE obras SET 
    ruta_pdf = 'obras/recursosPDF/Vuelva_usted_mañana.pdf',
    ruta_epub = 'obras/recursosEPUB/Vuelva_usted_mañana.epub'
WHERE id = 13;

-- ============================================
-- 3. RESUMEN DE OBRAS SIN ARCHIVOS
-- ============================================
-- Las siguientes obras están en la BD pero NO tienen archivos PDF/EPUB:
-- ID 10: Fuenteovejuna (Lope de Vega)
-- ID 14: Martín Fierro (Hernández) 
-- ID 20: Aves sin nido (Matto de Turner)
-- ID 21: Facundo (Sarmiento)
-- ID 22: Ariel (Rodó)
-- ID 23: Nocturno (Silva)
-- ID 25: Viaje maravilloso... (Holmberg)
-- ID 26: Primero sueño (Sor Juana)
-- ID 27: Nuestra América (Martí)
-- ID 30: Tradiciones peruanas (Palma)

-- ============================================
-- 4. VERIFICACIÓN
-- ============================================
SELECT id, titulo, ruta_pdf, ruta_epub FROM obras WHERE ruta_pdf IS NOT NULL;
