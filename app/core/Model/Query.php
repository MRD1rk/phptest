<?php

namespace Core\Model;

class Query
{
    protected $db;
    protected $query;

    public function __construct($sql, $container)
    {
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