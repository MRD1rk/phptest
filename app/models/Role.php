<?php

namespace Models;


use Core\Model;

class Role extends Model
{
    /**
     * @var integer
     */
    protected $id_role;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var integer
     */
    protected $active;

    /**
     * @var string
     */
    protected $date_add;

    public static function getSource()
    {
        return 'roles';
    }


    public static function findFirst($params = null)
    {
        return parent::findFirst($params);
    }

    public static function find($params = null)
    {
        return parent::find($params);
    }


    public function columnMap()
    {
        return [
            'id_role' => 'id_role',
            'name' => 'name',
            'description' => 'description',
            'active' => 'active',
            'date_add' => 'date_add'
        ];
    }

}