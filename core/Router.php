<?php

/**
 * Router - Sistema de enrutamiento para URLs limpias
 * 
 * Gestiona el enrutamiento de la aplicación, mapeando URLs a controladores
 * Registra rutas con sus métodos HTTP y las despacha al controlador correspondiente
 * Permite URLs amigables (/obra/123) en lugar de archivos directos (obra.php?id=123)
 */
class Router {
    // Almacena rutas registradas por método HTTP
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    // Middlewares globales que se ejecutan antes de cada ruta
    private $middlewares = [];

    // Registra una ruta GET para lectura de datos
    public function get($path, $callback, $middleware = []) {
        $this->addRoute('GET', $path, $callback, $middleware);
    }

    // Registra una ruta POST para envío de datos
    public function post($path, $callback, $middleware = []) {
        $this->addRoute('POST', $path, $callback, $middleware);
    }

    // Registra una ruta PUT para actualización de recursos
    public function put($path, $callback, $middleware = []) {
        $this->addRoute('PUT', $path, $callback, $middleware);
    }

    // Registra una ruta DELETE para eliminación de recursos
    public function delete($path, $callback, $middleware = []) {
        $this->addRoute('DELETE', $path, $callback, $middleware);
    }

    // Método interno para añadir rutas con conversión de patrones a regex
    private function addRoute($method, $path, $callback, $middleware = []) {
        // Convierte {id} en regex para capturar parámetros
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        
        // Añade delimitadores para match exacto
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'callback' => $callback,
            'middleware' => $middleware
        ];
    }

    // Añade un middleware global que se ejecuta antes de todas las rutas
    public function addMiddleware($callback) {
        $this->middlewares[] = $callback;
    }

    // Despacha la petición actual a la ruta correspondiente
    public function dispatch() {
        // Obtiene el método HTTP de la petición
        $method = $_SERVER['REQUEST_METHOD'];

        // Obtiene la URI solicitada y limpia query strings
        $uri = $_SERVER['REQUEST_URI'];
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }

        // Decodifica la URI
        $uri = urldecode($uri);

        // Ejecuta middlewares globales
        foreach ($this->middlewares as $middleware) {
            $result = call_user_func($middleware);
            // Si el middleware retorna false, detiene la ejecución
            if ($result === false) {
                return;
            }
        }

        // Busca ruta que coincida con la URI
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route) {
                // Intenta hacer match con el patrón
                if (preg_match($route['pattern'], $uri, $matches)) {
                    // Extrae solo los parámetros nombrados
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                    // Ejecuta middlewares específicos de la ruta
                    foreach ($route['middleware'] as $middleware) {
                        $result = call_user_func($middleware);
                        if ($result === false) {
                            return;
                        }
                    }

                    // Ejecutar el callback de la ruta usando call_user_func_array para pasar parámetros
                    return call_user_func_array($route['callback'], $params);
                }
            }
        }

        // Si no se encontró ninguna ruta, muestra 404
        $this->notFound();
    }

    // Maneja errores 404 (página no encontrada)
    private function notFound() {
        http_response_code(404);
        
        // Verifica si existe una vista personalizada de 404
        $view404 = __DIR__ . '/../src/Views/404.php';
        if (file_exists($view404)) {
            $title='Página no encontrada';
            ob_start();
            require $view404;
            $contenido = ob_get_clean();
            require __DIR__ . '/../src/Views/layout.php';
        } else {
            // Vista por defecto si no existe personalizada
            echo '<h1>404 - Página no encontrada</h1>';
            echo '<p>La página que buscas no existe.</p>';
            echo '<a href="/">Volver al inicio</a>';
        }
    }

    // Redirige a una URL específica con código HTTP configurable
    public static function redirect($url, $code = 302) {
        http_response_code($code);
        header("Location: $url");
        exit;
    }

    // Genera una URL reemplazando parámetros en el patrón
    public static function url($path, $params = []) {
        // Reemplaza parámetros en el patrón
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }
        return $path;
    }
}
