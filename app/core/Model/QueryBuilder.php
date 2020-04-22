<?php

namespace Core\Model;


use Core\Di\Di;

class QueryBuilder
{
    public $limit;
    public $model;

    public function getQuery($parameters = null)
    {

        $where_conditions = '';
        $limit = '';
        $order_by = '';
        if (gettype($parameters) !== 'array') {
            $where_conditions = $parameters;
        } else {
            foreach ($parameters as $key => $parameter) {
                switch ($key) {
                    case 'conditions':
                        $where_conditions = $parameter;
                        break;
                    case 'order':
                        $order_by = $parameter;
                        break;
                    case 'limit':
                        $this->limit = $parameter;
                        break;
                }
            }
        }

        if ($where_conditions) {
            $where_conditions = ' WHERE ' . $where_conditions;
        }
        if ($order_by) {
            $order_by = ' ORDER BY '.$order_by;
        }

        if ($this->limit)
            $limit = ' LIMIT ' . $this->limit;
        $sql = 'SELECT * FROM ' . $this->model::getSource() . $where_conditions . $order_by . $limit;
        $query = new Query($sql, Di::getDefault());
        return $query;
    }

    public function from($model)
    {
        $this->model = $model;
        return $this;
    }

    public function prepareInsertQuery($data = null, $model = null)
    {
        $insert_str = ' SET ';
        $insert_arr = [];
        if (!$data){
            $data = $model->toArray();
        }
        foreach ($data as $column => $value) {
            $insert_arr[] = '`' . $column . '`=' . '"' . $value . '"';
        }
        $insert_str .= implode(', ', $insert_arr);
        $sql = 'INSERT INTO ' . $this->model::getSource() . $insert_str;
        $query = new Query($sql, Di::getDefault());
        return $query;
    }

    public function prepareUpdateQuery($data = null, $model = null, array $condition)
    {
        $update_str = ' SET ';
        $update_arr = [];
        $where_str = ' WHERE ';
        if (!$data) {
            $data = $model->toArray();
        }
        foreach ($condition as $column =>  $value) {
            $where_str .= '`'.$column.'`='.$value;

        }
        foreach ($data as $column => $value) {
            $update_arr[] = '`' . $column . '`=' . '"' . $value . '"';
        }
        $update_str .= implode(', ',$update_arr);
        $sql = 'UPDATE '.$this->model::getSource().$update_str.$where_str;
        $query = new Query($sql, Di::getDefault());
        return $query;
    }
}