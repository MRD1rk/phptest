<?php

namespace Core;

use Core\Router\GroupInterface;
use Core\Router\Route;
use Core\Router\RouteInterface;
use Core\Router\RouterInterface;
use Plugins\SecurityPlugin;

class Router implements RouterInterface
{
    const POSITION_FIRST = 0;
    const POSITION_LAST = 1;

    protected $action = 'index';
    protected $controller = 'index';
    protected $params = [];
    protected $routes = [];
    protected $container;
    protected $hostname;

    public function add(string $pattern, $path = null, $httpMethod = null)
    {
        $route = new Route($pattern, $path, $httpMethod);
        $this->attach($route);
        return $route;
    }

    public function mount(GroupInterface $group)
    {
        $group_routes = $group->getRoutes();
        $routes = $this->routes;
        $this->routes = array_merge($routes, $group_routes);
        return $this;
    }

    public function attach(RouteInterface $route, $position = Router::POSITION_LAST)
    {
        switch ($position) {
            case self::POSITION_LAST:
                {
                    $this->routes[] = $route;
                    break;
                }
            case self::POSITION_FIRST:
                {
                    $this->routes = array_merge([$route], $this->routes);
                    break;
                }
            default:
                {
                    throw new \Exception('Invalid route position');
                }
        }
        return $this;
    }


    public function getControllerName()
    {
        return $this->controller;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function handle(string $uri = null)
    {
        $exploded_uri = explode('?', $uri);
        $handledUri = array_shift($exploded_uri);
        if ($handledUri != '/') {
            $handledUri = trim($uri, '/');
        }
        $request = null;
        $found_route = null;

        foreach ($this->routes as $route) {
            $pattern = $route->getCompiledPattern();
            $paths = $route->getPaths();

            $matches = [];
            if ((strpos($pattern, '^') !== false)) {
                $found_route = preg_match($pattern, $handledUri, $matches);
            } else
                $found_route = $pattern == $handledUri;

            if ($found_route) {
                $controller = array_shift($paths);
                $action = array_shift($paths);
                $security = new SecurityPlugin();
                $allow = $security->isAllow($controller, $action);
                if (!$allow) {
                    $controller = 'error';
                    $action = 'show401';
                }
                $this->setController($controller);
                $this->setAction($action);
                $params = array_map(function () use ($matches) {
                    return end($matches);
                }, $paths);
                $this->params = $params;
                break;
            }
        }
        if (!$found_route) {
            $controller = 'error';
            $action = 'show404';
            $this->setController($controller);
            $this->setAction($action);
        }
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getActionName()
    {
        return $this->action;
    }


}