<?php
/**
 * Router - Handles URL routing with clean URLs
 */
class Router {
    private array $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function dispatch(string $uri): void {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        // Check exact routes first
        if (isset($this->routes[$uri])) {
            $this->callAction($this->routes[$uri]);
            return;
        }

        // Check dynamic routes
        foreach ($this->routes as $pattern => $route) {
            if (strpos($pattern, '{') !== false) {
                $regex = preg_replace('/\{(\w+)\}/', '(?P<$1>[a-z0-9-]+)', $pattern);
                $regex = '#^' . $regex . '$#';
                if (preg_match($regex, $uri, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $route['params'] = array_merge($route['params'] ?? [], $params);
                    $this->callAction($route);
                    return;
                }
            }
        }

        // 404
        http_response_code(404);
        require_once __DIR__ . '/../app/controllers/PageController.php';
        $controller = new PageController();
        $controller->notFound();
    }

    private function callAction(array $route): void {
        $controllerName = $route['controller'];
        $action = $route['action'];
        $params = $route['params'] ?? [];

        require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';
        $controller = new $controllerName();
        $controller->$action($params);
    }
}
