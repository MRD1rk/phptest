<?php

namespace Core;

class Controller extends Kernel
{
    final public function __construct()
    {
        if (method_exists($this, "onConstruct")) {
            $this->{"onConstruct"}();
        }
    }
}