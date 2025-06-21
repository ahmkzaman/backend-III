<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function get(string $uri, string $controllerAction, ?string $middleware = null): void
    {
        $this->routes['GET'][$uri] = [
            'uses' => $controllerAction,
            'middleware' => $middleware
        ];
    }

    public function dispatch(string $uri): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $url = rtrim($uri, '/') ?: '/'; // Ensure URL ends with a slash

        $route = $this->routes[$method][$url] ?? null;

        if (!$route) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        // Check for middleware
        if ($route['middleware']) {
            $middlewareClass = "App\\Middleware\\" . $route['middleware'];
            (new $middlewareClass())->handle();
        }

        // Call the controller action
        [$controller, $action] = explode('@', $route['uses']);
        $controllerClass = "App\\Controllers\\" . $controller;

        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            $controllerInstance->$action();
        } else {
            echo "Controller not found: ";
        }
    }
}
