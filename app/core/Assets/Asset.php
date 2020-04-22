<?php

namespace Core\Assets;


class Asset implements AssetInterface
{
    public function __construct($type, $path, $local, $version, $auto_version)
    {
        $this->type = $type;
        $this->path = $path;
        $this->local = $local;
        $this->version = $version;
        $this->auto_version = $auto_version;
    }

    public function getFullUri()
    {

    }
}