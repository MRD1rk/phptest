<?php

namespace Core\Assets;


class Manager
{
    protected $collections = [];

    public function collection(string $name)
    {
        if (!isset($this->collections[$name])) {
            $collection = new Collection();
            $this->collections[$name] = $collection;
        }
        return $this->collections[$name];
    }
}