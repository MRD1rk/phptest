<?php

namespace Core\View;


class Engine
{
    public $file_extension;
    public function __construct($file_extension = null)
    {
        $this->file_extension = $file_extension;
    }
}