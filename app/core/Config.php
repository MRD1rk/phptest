<?php

namespace Core;


class Config
{
    public function __construct($array_config = null)
    {
        foreach ($array_config as $key => $config_item) {
            $this->set($key, $config_item);
        }
    }

    public function set($index, $value)
    {
        $index = strval($index);
        if (gettype($value) === 'array') {
            $this->{$index} = new self($value);
        } else
            $this->{$index} = $value;
    }
}