<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Middleware.php';
$router = new Router();

// RUTAS PÚBLICAS (No requieren autenticación)
// Página de inicio
$router->get('/', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->index();
});

// Catálogo completo de obras
$router->get('/catalogo', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->catalogo();
});

// Detalle de una obra (info, comentarios, puntuaciones)
$router->get('/obra/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/ObraController.php';
    $controller = new ObraController();
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
    $controller->descargar($id, $formato);
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
},[['Middleware','autenticado']]);

// Seguir a un usuario
$router->post('/usuario/{id}/seguir', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->seguir($id);
},[['Middleware','autenticado']]);

// Dejar de seguir a un usuario
$router->post('/usuario/{id}/dejar-seguir', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->dejarSeguir($id);
},[['Middleware','autenticado']]);

//Ver una lista (no requiere autenticación)
$router->get('/lista/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->verLista($id);
});

// Crear lista de lectura
$router->post('/lista/crear', function() {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->crear();
},[['Middleware','autenticado']]);

// Agregar obra a una lista
$router->post('/lista/{id}/agregar-obra', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->agregarObra($id);
},[['Middleware','autenticado']]);

// Quitar obra de una lista
$router->post('/lista/{id}/eliminar-obra', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->eliminarObra($id);
},[['Middleware','autenticado']]);

// Dar me gusta a una lista (seguir lista)
$router->post('/lista/{id}/me-gusta', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->meGusta($id);
},[['Middleware','autenticado']]);

// Copiar lista de otro usuario al perfil propio
$router->post('/lista/{id}/copiar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->copiar($id);
},[['Middleware','autenticado']]);

// Eliminar lista propia
$router->post('/lista/{id}/eliminar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->eliminar($id);
},[['Middleware','autenticado']]);

// Comentar en una obra
$router->post('/comentario/crear', function() {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->crear();
},[['Middleware','autenticado']]);

// Reportar comentario
$router->post('/comentario/{id}/reportar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->reportar($id);
},[['Middleware','autenticado']]);

// Dar me gusta a un comentario
$router->post('/comentario/{id}/megusta', function($id) {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->meGusta($id);
},[['Middleware','autenticado']]);

// Quitar me gusta de un comentario
$router->post('/comentario/{id}/quitar-megusta', function($id) {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->quitarMeGusta($id);
},[['Middleware','autenticado']]);

// Puntuar obra (1-5)
$router->post('/puntuacion/crear', function() {
    require_once __DIR__ . '/../src/Controllers/PuntuacionController.php';
    $controller = new PuntuacionController();
    $controller->puntuar();
},[['Middleware','autenticado']]);

// RUTAS DE ADMINISTRACIÓN (Requieren rol admin)
// Dashboard de administración
$router->get('/admin', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->verPanel();
},[['Middleware','admin']]);

// Crear obra
$router->post('/admin/obra/crear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->crearObra();
},[['Middleware','admin']]);

// Editar obra existente
$router->post('/admin/obra/editar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarObra();
},[['Middleware','admin']]);

// Eliminar obra (soft delete)
$router->post('/admin/obra/eliminar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->eliminarObra();
},[['Middleware','admin']]);

// Crear autor
$router->post('/admin/autor/crear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->crearAutor();
},[['Middleware','admin']]);

// Editar autor existente
$router->post('/admin/autor/editar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarAutor();
},[['Middleware','admin']]);

// Eliminar autor (soft delete)
$router->post('/admin/autor/eliminar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->eliminarAutor();
},[['Middleware','admin']]);

// Banear usuario
$router->post('/admin/usuario/banear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->banearUsuario();
},[['Middleware','admin']]);

// Activar usuario
$router->post('/admin/usuario/activar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->activarUsuario();
},[['Middleware','admin']]);

// Editar usuario
$router->post('/admin/usuario/editar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarUsuario();
},[['Middleware','admin']]);

// Revisar comentario
$router->post('/admin/comentario/revisar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->revisarComentario();
},[['Middleware','admin']]);

// Eliminar comentario
$router->post('/admin/comentario/eliminar', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->eliminarComentario();
},[['Middleware','admin']]);

// Despachar la petición actual
$router->dispatch();
