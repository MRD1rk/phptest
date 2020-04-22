<?php

namespace Core\Router;


class Group implements GroupInterface
{
    public $routes = [];
    public function add(string $pattern, $path = null, $httpMethod = null)
    {
        $route = new Route($pattern, $path,$httpMethod);
        $this->routes[] = $route;
        return $route;
    }

    public function __construct()
    {
    }

    public function initialize()
    {

    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}