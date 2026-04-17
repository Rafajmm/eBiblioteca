USE eBiblioteca;

-- ============================================
-- ACTUALIZAR URLS COMPLETAS DE IMAGENES PARA AUTORES CON NULL
-- Formato: https://covers.openlibrary.org/a/olid/{KEY}-M.jpg
-- Búsquedas en https://openlibrary.org/search/authors.json?q=
-- ============================================

-- 3. Emilia Pardo Bazán (key: OL5036661A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL5036661A-M.jpg' WHERE id = 3;

-- 4. Leopoldo Alas "Clarín" (key: OL5408351A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL5408351A-M.jpg' WHERE id = 4;

-- 5. Gustavo Adolfo Bécquer (key: OL2622337A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2622337A-M.jpg' WHERE id = 5;

-- 6. Rosalía de Castro (key: OL6245293A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL6245293A-M.jpg' WHERE id = 6;

-- 7. José Zorrilla (key: OL2454497A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2454497A-M.jpg' WHERE id = 7;

-- 8. Fernando de Rojas (key: OL2633093A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2633093A-M.jpg' WHERE id = 8;

-- 9. Lope de Vega (key: OL2679357A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2679357A-M.jpg' WHERE id = 9;

-- 10. Pedro Calderón de la Barca (key: OL2679366A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2679366A-M.jpg' WHERE id = 10;

-- 11. Tirso de Molina (key: OL2646663A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2646663A-M.jpg' WHERE id = 11;

-- 12. Mariano José de Larra (key: OL2641903A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2641903A-M.jpg' WHERE id = 12;

-- 13. José Hernández (key: OL2679363A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2679363A-M.jpg' WHERE id = 13;

-- 14. Jorge Isaacs (key: OL322631A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL322631A-M.jpg' WHERE id = 14;

-- 15. Horacio Quiroga (key: OL2647643A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2647643A-M.jpg' WHERE id = 15;

-- 16. Rubén Darío (key: OL5029401A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL5029401A-M.jpg' WHERE id = 16;

-- 17. José Martí (key: OL2064618A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2064618A-M.jpg' WHERE id = 17;

-- 18. Clorinda Matto de Turner (key: OL25829A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL25829A-M.jpg' WHERE id = 18;

-- 19. Domingo Faustino Sarmiento (key: OL5313143A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL5313143A-M.jpg' WHERE id = 19;

-- 20. José Enrique Rodó (key: OL162728A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL162728A-M.jpg' WHERE id = 20;

-- 21. José Asunción Silva (key: OL2679376A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2679376A-M.jpg' WHERE id = 21;

-- 22. César Vallejo (key: OL91716A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL91716A-M.jpg' WHERE id = 22;

-- 23. Eduardo Ladislao Holmberg (key: OL2679385A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL2679385A-M.jpg' WHERE id = 23;

-- 24. Sor Juana Inés de la Cruz (key: OL4394828A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL4394828A-M.jpg' WHERE id = 24;

-- 25. José Eustasio Rivera (key: OL157323A)
UPDATE autores SET ruta_foto = 'https://covers.openlibrary.org/a/olid/OL157323A-M.jpg' WHERE id = 25;

-- Verificación final
SELECT 'URLS ACTUALIZADAS' AS resultado;
SELECT id, nombre, ruta_foto 
FROM autores 
ORDER BY id;
