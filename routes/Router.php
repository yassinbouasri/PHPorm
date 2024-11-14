<?php

declare(strict_types=1);

namespace routes;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;
    public function register(string $route, callable|array $action): self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $uri): void
    {
        $route = explode('/', $uri)[0];
        $action = $this->routes[$route] ?? null;

        if(!$action){
            throw new RouteNotFoundException();
        }
    }
}