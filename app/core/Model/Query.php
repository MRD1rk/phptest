<?php

namespace Core\Model;

use Core\Db;

class Query
{
    /**
     * @var Db
     */
    protected $db;
    protected $query;

    public function __construct($sql, $container)
    {
        $db = $container->get('db');
        if (!$db) {
            throw new \Exception('Database is not available');
        }
        $this->query = $sql;
        $this->db = $container->get('db');
    }
    public function query()
    {
        $query = $this->db->query($this->query);
        return $query;
    }

    public function prepare()
    {
        $query = $this->db->prepare($this->query);
        return $query;
    }
}