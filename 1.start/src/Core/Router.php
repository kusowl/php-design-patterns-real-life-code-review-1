<?php

namespace App\Core;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Router
{
    private static ?self $instance = null;
    /**
     * @var array<string, array<string, Route>> $routes
     */
    private array $routes = [];

    public function get(string $path, string $controller, string $action): void
    {
        $this->routes[$path][RouteMethod::GET->value] = new Route(
            RouteMethod::GET->value,
            $path,
            $controller,
            $action);
    }

    public function post(string $path, string $controller, string $action): void
    {
        $this->routes[$path][RouteMethod::POST->value] = new Route(
            RouteMethod::POST->value,
            $path,
            $controller,
            $action);
    }

    public function resolve(string $requestMethod, string $requestUri): mixed
    {
        $route = $this->routes[$requestUri][$requestMethod] ?? null;
        if ($route == null) {
            throw new NotFoundHttpException('Page not found');
        }

        return $route->resolve();
    }

    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone(): void
    {
        // Make the class singleton
    }

    private function __wakeup(): void
    {
        // Make the class singleton
    }
}