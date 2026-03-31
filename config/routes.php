<?php

/**
 * Archivo de definición de rutas
 * 
 * QUÉ: Define todas las rutas de la aplicación y las mapea a controladores
 * CÓMO: Usa el Router para registrar rutas con sus métodos HTTP
 * POR QUÉ: Centraliza la configuración de rutas para fácil mantenimiento
 */

// Cargar el Router
require_once __DIR__ . '/../core/Router.php';

// Crear instancia del Router
// QUÉ: Instancia el objeto Router que gestionará todas las rutas
// CÓMO: Usa new Router()
// POR QUÉ: Necesitamos un objeto para registrar y despachar rutas
$router = new Router();

// ============================================================================
// RUTAS PÚBLICAS (No requieren autenticación)
// ============================================================================

/**
 * Ruta: Página de inicio
 * QUÉ: Muestra la landing page de eBiblioteca
 * CÓMO: Carga directamente la vista index
 * POR QUÉ: Es la primera página que ven los usuarios
 */
$router->get('/', function() {
    require __DIR__ . '/../src/Views/index.php';
});

/**
 * Ruta: Catálogo de obras
 * QUÉ: Muestra el catálogo completo de obras disponibles
 * CÓMO: Llama al controlador BibliotecaController método catalogo()
 * POR QUÉ: Permite a usuarios no registrados explorar el catálogo
 */
$router->get('/catalogo', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->catalogo();
});

/**
 * Ruta: Ver obra específica
 * QUÉ: Muestra los detalles de una obra por su ID
 * CÓMO: Captura {id} de la URL y lo pasa al controlador
 * POR QUÉ: Permite ver información detallada, comentarios y puntuaciones
 */
$router->get('/obra/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->verObra($id);
});

/**
 * Ruta: Leer obra en el navegador
 * QUÉ: Abre el visor de lectura para una obra
 * CÓMO: Captura {id} y carga el visor PDF/EPUB
 * POR QUÉ: Funcionalidad core - lectura sin descarga
 */
$router->get('/obra/{id}/leer', function($id) {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->leerObra($id);
});

/**
 * Ruta: Descargar obra
 * QUÉ: Permite descargar el archivo PDF/EPUB de una obra
 * CÓMO: Captura {id} y {formato} (pdf o epub)
 * POR QUÉ: Usuarios pueden descargar para leer offline
 */
$router->get('/obra/{id}/descargar/{formato}', function($id, $formato) {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->descargarObra($id, $formato);
});

/**
 * Ruta: Listado de autores
 * QUÉ: Muestra todos los autores disponibles
 * CÓMO: Llama al controlador para listar autores
 * POR QUÉ: Permite explorar obras por autor
 */
$router->get('/autores', function() {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->autores();
});

/**
 * Ruta: Perfil de autor
 * QUÉ: Muestra la biografía y obras de un autor
 * CÓMO: Captura {id} del autor
 * POR QUÉ: Permite ver todas las obras de un autor específico
 */
$router->get('/autor/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/BibliotecaController.php';
    $controller = new BibliotecaController();
    $controller->verAutor($id);
});

/**
 * Ruta: Colecciones/Listas públicas
 * QUÉ: Muestra listas de lectura públicas de usuarios
 * CÓMO: Llama al controlador de listas
 * POR QUÉ: Permite descubrir nuevas obras a través de listas curadas
 */
$router->get('/colecciones', function() {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->coleccionesPublicas();
});

/**
 * Ruta: Ver lista específica
 * QUÉ: Muestra el contenido de una lista de lectura
 * CÓMO: Captura {id} de la lista
 * POR QUÉ: Permite ver obras en una lista y copiarla si está registrado
 */
$router->get('/lista/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->verLista($id);
});

// ============================================================================
// RUTAS DE AUTENTICACIÓN
// ============================================================================

/**
 * Ruta: Procesar login
 * QUÉ: Autentica al usuario con email y contraseña
 * CÓMO: POST con credenciales, verifica y crea sesión
 * POR QUÉ: Permite acceso a funcionalidades de usuarios registrados
 */
$router->post('/login', function() {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();
});

/**
 * Ruta: Procesar registro
 * QUÉ: Crea una nueva cuenta de usuario
 * CÓMO: POST con datos del formulario, valida y guarda en BD
 * POR QUÉ: Permite que nuevos usuarios se registren
 */
$router->post('/registro', function() {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->registro();
});

/**
 * Ruta: Cerrar sesión
 * QUÉ: Cierra la sesión del usuario actual
 * CÓMO: Destruye la sesión y redirige a inicio
 * POR QUÉ: Permite a usuarios salir de forma segura
 */
$router->get('/logout', function() {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
});

// ============================================================================
// RUTAS PROTEGIDAS (Requieren autenticación)
// ============================================================================

/**
 * Ruta: Perfil de usuario
 * QUÉ: Muestra el perfil de un usuario con sus listas y actividad
 * CÓMO: Captura {id} del usuario, requiere autenticación
 * POR QUÉ: Permite ver perfiles propios y de otros usuarios
 */
$router->get('/usuario/{id}', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->verPerfil($id);
});

/**
 * Ruta: Editar perfil
 * QUÉ: Permite al usuario editar su información personal
 * CÓMO: POST con datos actualizados
 * POR QUÉ: Usuarios pueden actualizar bio, foto, etc.
 */
$router->post('/usuario/editar', function() {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->editarPerfil();
});

/**
 * Ruta: Seguir usuario
 * QUÉ: Permite seguir a otro usuario
 * CÓMO: POST con id del usuario a seguir
 * POR QUÉ: Funcionalidad de red social
 */
$router->post('/usuario/{id}/seguir', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->seguir($id);
});

/**
 * Ruta: Dejar de seguir usuario
 * QUÉ: Deja de seguir a un usuario
 * CÓMO: DELETE o POST con id del usuario
 * POR QUÉ: Permite gestionar la lista de seguidos
 */
$router->post('/usuario/{id}/dejar-seguir', function($id) {
    require_once __DIR__ . '/../src/Controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->dejarSeguir($id);
});

/**
 * Ruta: Crear lista de lectura
 * QUÉ: Crea una nueva lista personalizada
 * CÓMO: POST con nombre de la lista
 * POR QUÉ: Permite organizar obras favoritas
 */
$router->post('/lista/crear', function() {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->crear();
});

/**
 * Ruta: Agregar obra a lista
 * QUÉ: Añade una obra a una lista existente
 * CÓMO: POST con id_lista e id_obra
 * POR QUÉ: Permite construir listas de lectura
 */
$router->post('/lista/{id}/agregar-obra', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->agregarObra($id);
});

/**
 * Ruta: Eliminar obra de lista
 * QUÉ: Quita una obra de una lista
 * CÓMO: DELETE o POST con id_obra
 * POR QUÉ: Permite gestionar contenido de listas
 */
$router->post('/lista/{id}/eliminar-obra', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->eliminarObra($id);
});

/**
 * Ruta: Dar me gusta a lista
 * QUÉ: Marca una lista como favorita
 * CÓMO: POST con id de la lista
 * POR QUÉ: Funcionalidad de red social
 */
$router->post('/lista/{id}/me-gusta', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->meGusta($id);
});

/**
 * Ruta: Copiar lista
 * QUÉ: Duplica una lista de otro usuario a tu perfil
 * CÓMO: POST con id de la lista a copiar
 * POR QUÉ: Permite adoptar listas de otros usuarios
 */
$router->post('/lista/{id}/copiar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->copiar($id);
});

/**
 * Ruta: Eliminar lista
 * QUÉ: Borra una lista propia
 * CÓMO: DELETE o POST con id de la lista
 * POR QUÉ: Permite gestionar listas propias
 */
$router->post('/lista/{id}/eliminar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ListaController.php';
    $controller = new ListaController();
    $controller->eliminar($id);
});

/**
 * Ruta: Crear comentario
 * QUÉ: Añade un comentario a una obra
 * CÓMO: POST con id_obra y contenido
 * POR QUÉ: Permite discusión sobre obras
 */
$router->post('/comentario/crear', function() {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->crear();
});

/**
 * Ruta: Reportar comentario
 * QUÉ: Marca un comentario como inapropiado
 * CÓMO: POST con id del comentario
 * POR QUÉ: Permite moderación comunitaria
 */
$router->post('/comentario/{id}/reportar', function($id) {
    require_once __DIR__ . '/../src/Controllers/ComentarioController.php';
    $controller = new ComentarioController();
    $controller->reportar($id);
});

/**
 * Ruta: Puntuar obra
 * QUÉ: Asigna una puntuación (1-5) a una obra
 * CÓMO: POST con id_obra y valor
 * POR QUÉ: Sistema de valoración de obras
 */
$router->post('/puntuacion/crear', function() {
    require_once __DIR__ . '/../src/Controllers/PuntuacionController.php';
    $controller = new PuntuacionController();
    $controller->puntuar();
});

// ============================================================================
// RUTAS DE ADMINISTRACIÓN (Requieren rol admin)
// ============================================================================

/**
 * Ruta: Panel de administración
 * QUÉ: Dashboard principal del admin
 * CÓMO: Muestra estadísticas y accesos rápidos
 * POR QUÉ: Centro de control para administradores
 */
$router->get('/admin', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->dashboard();
});

/**
 * Ruta: Gestión de obras (admin)
 * QUÉ: Lista todas las obras con opciones de edición
 * CÓMO: Muestra tabla con CRUD de obras
 * POR QUÉ: Permite administrar el catálogo
 */
$router->get('/admin/obras', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->gestionarObras();
});

/**
 * Ruta: Crear obra (admin)
 * QUÉ: Añade una nueva obra al catálogo
 * CÓMO: POST con datos de la obra y archivos
 * POR QUÉ: Permite expandir la biblioteca
 */
$router->post('/admin/obra/crear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->crearObra();
});

/**
 * Ruta: Editar obra (admin)
 * QUÉ: Modifica datos de una obra existente
 * CÓMO: POST con id y datos actualizados
 * POR QUÉ: Permite corregir información
 */
$router->post('/admin/obra/{id}/editar', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarObra($id);
});

/**
 * Ruta: Eliminar obra (admin)
 * QUÉ: Borra una obra del catálogo (soft delete)
 * CÓMO: DELETE o POST con id
 * POR QUÉ: Permite remover contenido inapropiado
 */
$router->post('/admin/obra/{id}/eliminar', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->eliminarObra($id);
});

/**
 * Ruta: Gestión de autores (admin)
 * QUÉ: Lista todos los autores con opciones de edición
 * CÓMO: Muestra tabla con CRUD de autores
 * POR QUÉ: Permite administrar autores
 */
$router->get('/admin/autores', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->gestionarAutores();
});

/**
 * Ruta: Crear autor (admin)
 * QUÉ: Añade un nuevo autor
 * CÓMO: POST con datos del autor
 * POR QUÉ: Necesario antes de agregar sus obras
 */
$router->post('/admin/autor/crear', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->crearAutor();
});

/**
 * Ruta: Gestión de usuarios (admin)
 * QUÉ: Lista usuarios con opciones de moderación
 * CÓMO: Muestra tabla con acciones (banear, hacer admin, etc.)
 * POR QUÉ: Permite moderar la comunidad
 */
$router->get('/admin/usuarios', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->gestionarUsuarios();
});

/**
 * Ruta: Banear usuario (admin)
 * QUÉ: Desactiva la cuenta de un usuario
 * CÓMO: POST con id del usuario
 * POR QUÉ: Permite sancionar usuarios problemáticos
 */
$router->post('/admin/usuario/{id}/banear', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->banearUsuario($id);
});

/**
 * Ruta: Hacer administrador (admin)
 * QUÉ: Otorga permisos de admin a un usuario
 * CÓMO: POST con id del usuario
 * POR QUÉ: Permite delegar tareas administrativas
 */
$router->post('/admin/usuario/{id}/hacer-admin', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->hacerAdmin($id);
});

/**
 * Ruta: Reportes pendientes (admin/moderador)
 * QUÉ: Muestra comentarios reportados pendientes de revisión
 * CÓMO: Lista reportes con opciones de acción
 * POR QUÉ: Sistema de moderación de contenido
 */
$router->get('/admin/reportes', function() {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->verReportes();
});

/**
 * Ruta: Revisar reporte (admin/moderador)
 * QUÉ: Marca un reporte como revisado
 * CÓMO: POST con id del comentario y acción (eliminar/ignorar)
 * POR QUÉ: Permite procesar reportes de la comunidad
 */
$router->post('/admin/reporte/{id}/revisar', function($id) {
    require_once __DIR__ . '/../src/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->revisarReporte($id);
});

// ============================================================================
// DESPACHAR LA RUTA ACTUAL
// ============================================================================

/**
 * QUÉ: Ejecuta el router para procesar la petición actual
 * CÓMO: Llama al método dispatch() que compara la URL con las rutas registradas
 * POR QUÉ: Sin esto, las rutas no se ejecutarían
 */
$router->dispatch();
