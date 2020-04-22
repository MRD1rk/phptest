<?php

namespace Models;


use Core\Model;

class Resource extends Model
{
    /**
     * @var integer
     */
    protected $id_resource;

    /**
     * @var integer
     */
    protected $id_role;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action_list;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $date_add;


    public static function getSource()
    {
        return 'resources';
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
            'id_resource' => 'id_resource',
            'id_role' => 'id_role',
            'controller' => 'controller',
            'action_list' => 'action_list',
            'type' => 'type',
            'date_add' => 'date_add'
        ];
    }

    /**
     * @return string
     */
    public function getActionList(): string
    {
        return $this->action_list;
    }

    /**
     * @param string $action_list
     */
    public function setActionList(string $action_list): void
    {
        $this->action_list = $action_list;
    }
}