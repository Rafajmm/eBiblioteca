<?php
require_once __DIR__ . '/../core/Router.php';
$router = new Router();

// RUTAS PÚBLICAS (No requieren autenticación)
// Página de inicio
$router->get('/', function() {
    $titulo="Inicio";
    ob_start();
    require __DIR__ . '/../src/Views/index.php';
    $contenido = ob_get_clean();
    require __DIR__ . '/../src/Views/layout.php';
});

// Catálogo completo de obras
$router->get('/catalogo', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->catalogo();
});

// Detalle de una obra (info, comentarios, puntuaciones)
$router->get('/obra/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->verObra($id);
});

// Visor de lectura en el navegador (PDF/EPUB)
$router->get('/obra/{id}/leer', function($id) {
    require_once __DIR__ . '/../src/Controllers/ObraController.php';
    $controller = new ObraController();
    $controller->leerObra($id);
});

// Descarga de obra en el formato indicado
$router->get('/obra/{id}/descargar/{formato}', function($id, $formato) {
    require_once __DIR__ . '/../src/Controllers/ObraController.php';
    $controller = new ObraController();
    $controller->descargarObra($id, $formato);
});

// Listado de autores
$router->get('/autores', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->autores();
});

// Perfil de autor (biografía y obras)
$router->get('/autor/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/AutorController.php';
    $controller = new AutorController();
    $controller->verAutor($id);
});

// Listas de lectura públicas
$router->get('/colecciones', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->colecciones();
});

// Detalle de una lista de lectura
$router->get('/lista/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->verLista($id);
});

// RUTAS DE AUTENTICACIÓN
// Inicio de sesión
$router->post('/login', function() {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();
});

// Registro de nuevo usuario
$router->post('/registro', function() {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->registro();
});

// Cierre de sesión
$router->get('/logout', function() {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
});

// RUTAS PROTEGIDAS (Requieren autenticación)
// Perfil de usuario (listas y actividad)
$router->get('/usuario/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->verPerfil($id);
});

// Editar perfil propio
$router->post('/usuario/editar', function() {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->editarPerfil();
});

// Seguir a un usuario
$router->post('/usuario/{id}/seguir', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->seguir($id);
});

// Dejar de seguir a un usuario
$router->post('/usuario/{id}/dejar-seguir', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->dejarSeguir($id);
});

// Crear lista de lectura
$router->post('/lista/crear', function() {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->crear();
});

// Agregar obra a una lista
$router->post('/lista/{id}/agregar-obra', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->agregarObra($id);
});

// Quitar obra de una lista
$router->post('/lista/{id}/eliminar-obra', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->eliminarObra($id);
});

// Dar me gusta a una lista
$router->post('/lista/{id}/me-gusta', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->meGusta($id);
});

// Copiar lista de otro usuario al perfil propio
$router->post('/lista/{id}/copiar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->copiar($id);
});

// Eliminar lista propia
$router->post('/lista/{id}/eliminar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->eliminar($id);
});

// Comentar en una obra
$router->post('/comentario/crear', function() {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->crear();
});

// Reportar comentario inapropiado
$router->post('/comentario/{id}/reportar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->reportar($id);
});

// Puntuar obra (1-5)
$router->post('/puntuacion/crear', function() {
    require_once __DIR__ . '/../src/Controllers/PuntuacionController.php';
    $controller = new PuntuacionController();
    $controller->puntuar();
});

// RUTAS DE ADMINISTRACIÓN (Requieren rol admin)
// Dashboard de administración
$router->get('/admin', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->dashboard();
});

// Gestión de obras
$router->get('/admin/obras', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->gestionarObras();
});

// Crear obra
$router->post('/admin/obra/crear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->crearObra();
});

// Editar obra existente
$router->post('/admin/obra/{id}/editar', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarObra($id);
});

// Eliminar obra (soft delete)
$router->post('/admin/obra/{id}/eliminar', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->eliminarObra($id);
});

// Gestión de autores
$router->get('/admin/autores', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->gestionarAutores();
});

// Crear autor
$router->post('/admin/autor/crear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->crearAutor();
});

// Gestión de usuarios
$router->get('/admin/usuarios', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->gestionarUsuarios();
});

// Banear usuario
$router->post('/admin/usuario/{id}/banear', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->banearUsuario($id);
});

// Otorgar permisos de administrador
$router->post('/admin/usuario/{id}/hacer-admin', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->hacerAdmin($id);
});

// Comentarios reportados pendientes de revisión
$router->get('/admin/reportes', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->verReportes();
});

// Revisar y resolver un reporte
$router->post('/admin/reporte/{id}/revisar', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->revisarReporte($id);
});

// Despachar la petición actual
$router->dispatch();
