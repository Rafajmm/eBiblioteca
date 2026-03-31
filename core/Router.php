<?php

/**
 * Router - Sistema de enrutamiento para URLs limpias
 * 
 * QUÉ: Clase que gestiona el enrutamiento de la aplicación, mapeando URLs a controladores
 * CÓMO: Registra rutas con sus métodos HTTP y las despacha al controlador correspondiente
 * POR QUÉ: Permite URLs amigables (/obra/123) en lugar de archivos directos (obra.php?id=123)
 */
class Router {
    /**
     * Almacena todas las rutas registradas organizadas por método HTTP
     * Estructura: ['GET' => [...], 'POST' => [...], etc.]
     */
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    /**
     * Almacena middlewares globales que se ejecutan antes de cada ruta
     */
    private $middlewares = [];

    /**
     * Registra una ruta GET
     * 
     * QUÉ: Añade una ruta que responde a peticiones GET (lectura de datos)
     * CÓMO: Almacena el patrón de URL y el callback en el array de rutas GET
     * POR QUÉ: GET se usa para mostrar páginas, catálogos, perfiles, etc.
     * 
     * @param string $path - Patrón de la URL (ej: '/obra/{id}')
     * @param callable $callback - Función o array [Controller, 'metodo'] a ejecutar
     * @param array $middleware - Middlewares específicos para esta ruta
     */
    public function get($path, $callback, $middleware = []) {
        $this->addRoute('GET', $path, $callback, $middleware);
    }

    /**
     * Registra una ruta POST
     * 
     * QUÉ: Añade una ruta que responde a peticiones POST (envío de datos)
     * CÓMO: Almacena el patrón de URL y el callback en el array de rutas POST
     * POR QUÉ: POST se usa para login, registro, crear comentarios, etc.
     * 
     * @param string $path - Patrón de la URL
     * @param callable $callback - Función o array [Controller, 'metodo'] a ejecutar
     * @param array $middleware - Middlewares específicos para esta ruta
     */
    public function post($path, $callback, $middleware = []) {
        $this->addRoute('POST', $path, $callback, $middleware);
    }

    /**
     * Registra una ruta PUT
     * 
     * QUÉ: Añade una ruta que responde a peticiones PUT (actualización completa)
     * CÓMO: Almacena el patrón de URL y el callback en el array de rutas PUT
     * POR QUÉ: PUT se usa para actualizar recursos completos (editar perfil, obra, etc.)
     * 
     * @param string $path - Patrón de la URL
     * @param callable $callback - Función o array [Controller, 'metodo'] a ejecutar
     * @param array $middleware - Middlewares específicos para esta ruta
     */
    public function put($path, $callback, $middleware = []) {
        $this->addRoute('PUT', $path, $callback, $middleware);
    }

    /**
     * Registra una ruta DELETE
     * 
     * QUÉ: Añade una ruta que responde a peticiones DELETE (eliminación)
     * CÓMO: Almacena el patrón de URL y el callback en el array de rutas DELETE
     * POR QUÉ: DELETE se usa para eliminar comentarios, listas, etc.
     * 
     * @param string $path - Patrón de la URL
     * @param callable $callback - Función o array [Controller, 'metodo'] a ejecutar
     * @param array $middleware - Middlewares específicos para esta ruta
     */
    public function delete($path, $callback, $middleware = []) {
        $this->addRoute('DELETE', $path, $callback, $middleware);
    }

    /**
     * Método interno para añadir rutas al array correspondiente
     * 
     * QUÉ: Almacena la ruta con su patrón convertido a regex
     * CÓMO: Convierte {id} en expresiones regulares y guarda la ruta
     * POR QUÉ: Permite capturar parámetros dinámicos de la URL
     * 
     * @param string $method - Método HTTP (GET, POST, etc.)
     * @param string $path - Patrón de la URL
     * @param callable $callback - Función a ejecutar
     * @param array $middleware - Middlewares para esta ruta
     */
    private function addRoute($method, $path, $callback, $middleware = []) {
        // Convertir {id} en (?P<id>[^/]+) para capturar parámetros
        // QUÉ: Transforma patrones legibles en regex
        // CÓMO: Busca {nombre} y lo reemplaza por un grupo nombrado de regex
        // POR QUÉ: Permite extraer parámetros de la URL automáticamente
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        
        // Añadir delimitadores y anclas para match exacto
        // QUÉ: Completa la expresión regular
        // CÓMO: Añade ^ al inicio y $ al final
        // POR QUÉ: Asegura que la URL coincida exactamente con el patrón
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'callback' => $callback,
            'middleware' => $middleware
        ];
    }

    /**
     * Añade un middleware global
     * 
     * QUÉ: Registra una función que se ejecuta antes de todas las rutas
     * CÓMO: Añade el callback al array de middlewares globales
     * POR QUÉ: Útil para verificar sesiones, CSRF, logging, etc.
     * 
     * @param callable $callback - Función middleware
     */
    public function addMiddleware($callback) {
        $this->middlewares[] = $callback;
    }

    /**
     * Despacha la petición actual a la ruta correspondiente
     * 
     * QUÉ: Encuentra y ejecuta la ruta que coincide con la URL actual
     * CÓMO: Compara la URL con los patrones registrados y ejecuta el callback
     * POR QUÉ: Es el corazón del router, conecta URLs con controladores
     */
    public function dispatch() {
        // Obtener el método HTTP de la petición
        // QUÉ: Identifica si es GET, POST, PUT o DELETE
        // CÓMO: Lee $_SERVER['REQUEST_METHOD']
        // POR QUÉ: Necesitamos saber qué tipo de petición procesar
        $method = $_SERVER['REQUEST_METHOD'];

        // Obtener la URI solicitada
        // QUÉ: Extrae la ruta de la URL
        // CÓMO: Lee REQUEST_URI y elimina query strings
        // POR QUÉ: Necesitamos la ruta limpia para compararla con los patrones
        $uri = $_SERVER['REQUEST_URI'];
        
        // Eliminar query string si existe (?param=value)
        // QUÉ: Limpia la URL de parámetros GET
        // CÓMO: Divide por '?' y toma solo la primera parte
        // POR QUÉ: Los parámetros GET no forman parte de la ruta
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }

        // Decodificar la URI
        // QUÉ: Convierte %20 en espacios, etc.
        // CÓMO: Usa urldecode()
        // POR QUÉ: Las URLs pueden contener caracteres codificados
        $uri = urldecode($uri);

        // Ejecutar middlewares globales
        // QUÉ: Ejecuta todas las funciones middleware registradas
        // CÓMO: Itera sobre el array de middlewares y las ejecuta
        // POR QUÉ: Permite verificaciones globales (autenticación, CSRF, etc.)
        foreach ($this->middlewares as $middleware) {
            $result = call_user_func($middleware);
            // Si el middleware retorna false, detener la ejecución
            // QUÉ: Permite que un middleware bloquee la petición
            // CÓMO: Verifica el valor de retorno
            // POR QUÉ: Útil para redirigir usuarios no autenticados
            if ($result === false) {
                return;
            }
        }

        // Buscar ruta que coincida con la URI
        // QUÉ: Encuentra la ruta registrada que coincide con la URL
        // CÓMO: Itera sobre las rutas del método HTTP y compara patrones
        // POR QUÉ: Necesitamos saber qué controlador ejecutar
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route) {
                // Intentar hacer match con el patrón
                // QUÉ: Compara la URL con el patrón regex
                // CÓMO: Usa preg_match para capturar parámetros
                // POR QUÉ: Extrae los parámetros dinámicos de la URL
                if (preg_match($route['pattern'], $uri, $matches)) {
                    // Extraer solo los parámetros nombrados
                    // QUÉ: Filtra los parámetros capturados
                    // CÓMO: Elimina índices numéricos del array de matches
                    // POR QUÉ: Solo queremos los parámetros con nombre ({id}, {slug}, etc.)
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                    // Ejecutar middlewares específicos de la ruta
                    // QUÉ: Ejecuta middlewares solo para esta ruta
                    // CÓMO: Itera sobre los middlewares de la ruta
                    // POR QUÉ: Permite protecciones específicas (ej: solo admin)
                    foreach ($route['middleware'] as $middleware) {
                        $result = call_user_func($middleware);
                        if ($result === false) {
                            return;
                        }
                    }

                    // Ejecutar el callback de la ruta
                    // QUÉ: Llama al controlador correspondiente
                    // CÓMO: Usa call_user_func_array para pasar parámetros
                    // POR QUÉ: Ejecuta la lógica de negocio de la ruta
                    return call_user_func_array($route['callback'], $params);
                }
            }
        }

        // Si no se encontró ninguna ruta, mostrar 404
        // QUÉ: Maneja URLs no encontradas
        // CÓMO: Llama al método notFound()
        // POR QUÉ: Informa al usuario que la página no existe
        $this->notFound();
    }

    /**
     * Maneja errores 404 (página no encontrada)
     * 
     * QUÉ: Muestra una página de error cuando no se encuentra la ruta
     * CÓMO: Establece el código HTTP 404 y muestra un mensaje
     * POR QUÉ: Mejora la experiencia de usuario al informar errores claramente
     */
    private function notFound() {
        http_response_code(404);
        
        // Verificar si existe una vista personalizada de 404
        // QUÉ: Intenta cargar una página de error personalizada
        // CÓMO: Busca el archivo 404.php en Views
        // POR QUÉ: Permite tener una página de error con el diseño de la app
        $view404 = __DIR__ . '/../src/Views/404.php';
        if (file_exists($view404)) {
            require $view404;
        } else {
            // Vista por defecto si no existe personalizada
            // QUÉ: Muestra un mensaje básico de error
            // CÓMO: Imprime HTML simple
            // POR QUÉ: Siempre debe haber una respuesta al usuario
            echo '<h1>404 - Página no encontrada</h1>';
            echo '<p>La página que buscas no existe.</p>';
            echo '<a href="/">Volver al inicio</a>';
        }
    }

    /**
     * Redirige a una URL específica
     * 
     * QUÉ: Redirige al navegador a otra URL
     * CÓMO: Usa header() con Location
     * POR QUÉ: Útil para redirigir después de login, registro, etc.
     * 
     * @param string $url - URL de destino
     * @param int $code - Código HTTP de redirección (301, 302, etc.)
     */
    public static function redirect($url, $code = 302) {
        http_response_code($code);
        header("Location: $url");
        exit;
    }

    /**
     * Genera una URL basada en el nombre de la ruta
     * 
     * QUÉ: Crea URLs dinámicamente reemplazando parámetros
     * CÓMO: Reemplaza {param} con valores del array
     * POR QUÉ: Evita hardcodear URLs en las vistas
     * 
     * @param string $path - Patrón de la ruta (ej: '/obra/{id}')
     * @param array $params - Parámetros a reemplazar (ej: ['id' => 123])
     * @return string - URL generada
     */
    public static function url($path, $params = []) {
        // Reemplazar parámetros en el patrón
        // QUÉ: Sustituye {id} por el valor real
        // CÓMO: Itera sobre los parámetros y usa str_replace
        // POR QUÉ: Genera URLs dinámicas de forma segura
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }
        return $path;
    }
}
