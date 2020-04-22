<?php

namespace Core\Di;


class Service
{
    protected $definition;
    protected $is_shared;


    final public function __construct($definition, $is_shared = false)
    {
        $this->definition = $definition;
        $this->is_shared = $is_shared;
    }

    public function resolve()
    {
        $definition = $this->definition;
        $instance = call_user_func($definition);
        return $instance;
    }
}