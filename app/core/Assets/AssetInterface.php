<?php

namespace Core\Assets;


interface AssetInterface
{
    public function __construct($type, $path, $local, $version, $auto_version);
}