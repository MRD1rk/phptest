<?php

namespace Core\Assets;


class Collection implements CollectionInterface
{
    protected $local;

    public function addAsset($asset)
    {

    }

    public function add($asset)
    {

    }

    public function addJs($path, $local = null, $version = null, $auto_version = false)
    {
        if (gettype($local) === 'boolean') {
            $collection_local = $local;
        } else
            $collection_local = $this->local;

        $this->add(
            new AssetJs($path, $collection_local, $version, $auto_version)
        );
        return $this;
    }
}