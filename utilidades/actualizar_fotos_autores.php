<?php
require_once __DIR__ . '/config/Database.php';

$db = Database::conectar();

$stmt = $db->prepare("SELECT id, nombre FROM autores WHERE ruta_foto IS NULL ORDER BY id");
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Autores con ruta_foto NULL: " . count($autores) . "\n\n";

$actualizados = 0;
$sinFoto = 0;

foreach ($autores as $autor) {
    $id = $autor['id'];
    $nombre = $autor['nombre'];
    
    echo "Procesando: $nombre (ID: $id)\n";
    
    $consulta = urlencode($nombre);
    $urlBusqueda = "https://openlibrary.org/search/authors.json?q=" . $consulta;
    
    $response = @file_get_contents($urlBusqueda);
    if ($response === FALSE) {
        echo "  - Error al buscar en OpenLibrary\n";
        $sinFoto++;
        continue;
    }
    
    $data = json_decode($response, true);
    if (!isset($data['docs'][0]['key'])) {
        echo "  - No se encontró key para este autor\n";
        $sinFoto++;
        continue;
    }
    
    $key = $data['docs'][0]['key']; 
    echo $key . "\n";
    $olid = str_replace('/authors/', '', $key);
    
    echo "  - Key encontrada: $olid\n";
    
    $urlImagen = "https://covers.openlibrary.org/a/olid/" . $olid . "-M.jpg?default=false";
    
    $headers = @get_headers($urlImagen);
    if ($headers === FALSE) {
        echo "  - Error al verificar imagen\n";
        $sinFoto++;
        continue;
    }
    
    $httpCode = intval(substr($headers[0], 9, 3));
    echo "  - HTTP code: $httpCode\n";
    
    if ($httpCode === 200 || $httpCode === 302) {
        $urlGuardar = "https://covers.openlibrary.org/a/olid/" . $olid . "-M.jpg";
        
        $stmtUpdate = $db->prepare("UPDATE autores SET ruta_foto = ? WHERE id = ?");
        $stmtUpdate->execute([$urlGuardar, $id]);
        
        echo "  - ✓ Foto guardada: $urlGuardar\n";
        $actualizados++;
    } else {
        echo "  - ✗ No tiene foto real (HTTP $httpCode)\n";
        $sinFoto++;
    }
    
    echo "\n";
    
    usleep(500000); 
}

echo "==========================================\n";
echo "RESUMEN:\n";
echo "- Autores actualizados con foto: $actualizados\n";
echo "- Autores sin foto disponible: $sinFoto\n";
echo "==========================================\n";
?>
