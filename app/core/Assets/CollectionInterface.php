<?php

namespace Core\Assets;


interface CollectionInterface
{
    public function addAsset(AssetInterface $asset);
    public function add(AssetInterface $asset);
}