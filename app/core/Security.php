<?php

namespace Core;


class Security
{

    protected $cost = 12;

    public function __construct($cost = null)
    {
        if ($cost)
            $this->cost = $cost;
    }

    public function crypt($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT, $this->getOptions());
        return $hash;
    }

    public function checkHash($password, $hash)
    {
        if (!password_verify($password, $hash))
            return false;
        return true;
    }

    public function getOptions()
    {
        $options = [
            'cost' => $this->cost
        ];
        return $options;
    }
}