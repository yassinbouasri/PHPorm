<?php

declare(strict_types=1);

namespace App\routes;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;
    public function register(string $requestMethod,string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('GET', $route, $action);
    }
    public function post(string $route, callable|array $action): self
    {
        return $this->register('POST', $route, $action);
    }
    public function put(string $route, callable|array $action): self
    {
        return $this->register('PUT', $route, $action);
    }
    public function delete(string $route, callable|array $action): self
    {
        return $this->register('DELETE', $route, $action);
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $uri, string $requestMethod)
    {
        $route = explode('?', $uri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;
        if(!$action){
            throw new RouteNotFoundException();
        }
        if(is_callable($action)){
            return call_user_func($action);
        }
        if (is_array($action)){
            [$class, $method] = $action;
            if(class_exists($class)){
                $class = new $class();
                if (method_exists($class, $method)) {

                    return call_user_func([$class, $method], []);
                }
            }
        }
        throw new RouteNotFoundException();

    }
}