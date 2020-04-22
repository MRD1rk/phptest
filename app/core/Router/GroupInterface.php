<?php

namespace Core\Router;


interface GroupInterface
{
    public function add(string $pattern, $path = null, $httpMethod = null);

    public function getRoutes();

}