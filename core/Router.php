<?php
// core/Router.php

class Router {
    private array $routes = [];

    public function get(string $path, string $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

    public function resolve(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Strip base path (e.g. /serah/public)
        $basePath = parse_url(APP_URL, PHP_URL_PATH);
        if (str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }
        $uri = '/' . trim($uri, '/');
        if ($uri === '') $uri = '/';

        // Exact match
        if (isset($this->routes[$method][$uri])) {
            $this->dispatch($this->routes[$method][$uri], []);
            return;
        }

        // Pattern match (e.g. /rekap/{id})
        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                array_shift($matches);
                $this->dispatch($handler, $matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }

    private function dispatch(string $handler, array $params): void {
        [$class, $method] = explode('@', $handler);
        $controllerFile = APP_ROOT . '/app/controllers/' . $class . '.php';
        if (!file_exists($controllerFile)) {
            die("Controller not found: $class");
        }
        require_once $controllerFile;
        $controller = new $class();
        call_user_func_array([$controller, $method], $params);
    }
}