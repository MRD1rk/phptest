<?php

namespace Core\Model;


interface ModelInterface
{
    public static function find($conditions = null);

    public static function findFirst($conditions = null);

    /**
     * @return string
     */
    public static function getSource() ;

    /**
     * @return array
     */
    public function columnMap();

}