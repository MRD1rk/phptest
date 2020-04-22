<?php


namespace Core\Router;


interface RouteInterface
{
    public function compilePattern( string $pattern): string ;

    public function getHttpMethods();

    public function setHttpMethods($methods): RouteInterface;
}