<?php
namespace App\Core;
class Router {
    private $routes = [];
    public function add($method, $path, $controller, $controllerMethod) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            $routePattern = preg_replace('/{([a-zA-Z0-9]+)}/', '([^/]+)', $route['path']);
            $routeRegex = "#^$routePattern$#";

            if (preg_match($routeRegex, $requestUri, $matches)) {
                if ($route['method'] === $requestMethod) {
                    array_shift($matches);
                    $controllerInstance = new $route['controller']();
                    return call_user_func_array(
                        [$controllerInstance, $route['controllerMethod']], 
                        $matches
                    );
                }
            }
        }
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
?>