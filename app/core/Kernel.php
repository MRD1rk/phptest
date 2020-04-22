<?php

namespace Core;

use Core\Di\Di;

/**
 * @property Dispatcher dispatcher
 * @property Request request
 * @property View view
 * @property Session session
 * @property Security security
 * @property Response response
 * @property Alert alert
 */
class Kernel
{
    protected $container;

    public function getDI()
    {
        $container = $this->container;
        if (gettype($container) !== 'object') {
            $container = Di::getDefault();
        }
        return $container;
    }

    public function __get(string $property_name)
    {
        $container = $this->container;
        if (gettype($container) !== 'object') {
            $container = Di::getDefault();
        }
        if ($container->has($property_name)){
            $service = $container->get($property_name);
            $this->{$property_name} = $service;
            return $service;
        }
        return null;
    }
}