<?php

namespace Core\Di;


class Di
{

    protected $services;
    protected static $default;


    public function __construct()
    {
        if (!self::$default)
            self::$default = $this;
    }
    public function __call(string $method, $args)
    {
        $instance = null;
        $possible_service = null;
        if (substr($method, 0, strlen('get') === 'get')) {
            $possible_service = lcfirst(substr($method, 3));
            if (isset($this->services[$possible_service])) {
                $instance = $this->get($possible_service, $args);
                return $instance;
            }
        }
        if (substr($method, 0, strlen('set') === 'set')) {
            $possible_service = lcfirst(substr($method, 3));
            $this->set($possible_service, $args);
        }

        /**
         * The method doesn't start with set/get throw an exception
         */
        throw new \Exception(
            "Call to undefined method or service '" . $method . "'"
        );
    }

    public function set(string $name, $service, bool $shared = false)
    {
        $this->services[$name] = (new Service($service, $shared))->resolve();
    }

    public function get(string $service)
    {
        return $this->services[$service];
    }

    public static function getDefault()
    {
        if (!self::$default) {
            self::$default = new Di();
        }
        return self::$default;
    }

    public static function setDefault(Di $default)
    {
        self::$default = $default;
    }

    public function has(string $name):bool
    {
        return isset($this->services[$name]);
    }
}