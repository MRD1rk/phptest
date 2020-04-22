<?php

namespace Core\Router;


interface RouterInterface
{
    public function add(string $pattern, $path = null, $httpMethod);
}