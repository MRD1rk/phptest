<?php

namespace Core;

use Core\Di\Di;
use Core\Model\ModelInterface;
use Core\Model\QueryBuilder;

class Model implements ModelInterface
{

    public $errors = [];

    public function __construct($container = null)
    {
    }

    public static function getSource()
    {

    }

    public static function findFirst($parameters = null)
    {
        if (gettype($parameters) !== 'array') {
            $params = [];
            if ($parameters !== null) {
                $params[] = $parameters;
            }
        } else
            $params = $parameters;

        $query = static::getPreparedQuery($params, 1);
        $result = $query->query()->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        if ($result)
            $result = current($result);
        return $result;
    }

    public static function find($parameters = null)
    {
        if (gettype($parameters) !== 'array') {
            $params = [];
            if ($parameters !== null) {
                $params['conditions'] = $parameters;
            }
        } else
            $params = $parameters;

        $query = static::getPreparedQuery($params);
        $result = $query->query()->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        return $result;
    }


    public function columnMap()
    {

    }

    public static function getPreparedQuery($parameters = null, $limit = null)
    {
        $builder = new QueryBuilder();
        $builder->from(get_called_class());

        if ($limit)
            $builder->limit = $limit;
        $query = $builder->getQuery($parameters);
        return $query;
    }

    public function save($data = null)
    {
        if ($this->hasError())
            return false;
        $changed_properties = $this->prepareObject($data);
        $exist = $this->exists();
        if (!$exist) {
            $result = $this->doInsert($data);
        } else
            $result = $this->doUpdate($changed_properties, $this->getPrimary());

        return $result;
    }


    public function hasError()
    {
        return !empty($this->errors);
    }
    public function prepareObject($data = null)
    {

        $changed_properties = [];
        if ($data) {
            $properties = $this->columnMap();
            foreach ($data as $property => $value) {
                if (key_exists($property, $properties)) {
                    $this->{$property} = $value;
                    $changed_properties[$property] = $value;
                }
            }
        }
        return $changed_properties;
    }

    public function doInsert($data)
    {
        $builder = new QueryBuilder();
        $builder->from(get_called_class());
        try {
            $status = $builder->prepareInsertQuery($data, $this)->prepare()->execute();
        } catch (\Exception $e) {
            $status = false;
            $this->errors[] = $e->getMessage();
        }
        return $status;
    }

    public function getMessages()
    {
        if (!empty($this->errors)) {
            return $this->errors;
        }
        return null;
    }

    public function setMessage($message)
    {
        $this->errors[] = $message;
    }
    public function doUpdate($data = null, $key)
    {
        $builder = new QueryBuilder();
        $builder->from(get_called_class());
        try {
            $status = $builder->prepareUpdateQuery($data, $this, [$key => $this->{$key}])->prepare()->execute();
        } catch (\Exception $e) {
            $status = false;
            $this->errors[] = $e->getMessage();
        }
        return $status;
    }

    public function toArray()
    {
        $vars = get_object_vars($this);
        $array = array();
        foreach ($vars as $key => $value) {
            $array [ltrim($key, '_')] = $value;
        }
        return array_filter($array);
    }


    public function getPrimary()
    {
        $db = Di::getDefault()->get('db');
        $primary_key = null;
        $result = $db->query('SELECT COLUMN_NAME as `column` FROM INFORMATION_SCHEMA.key_column_usage 
                              WHERE table_name ="' . $this->getSource() . '" AND CONSTRAINT_NAME = "PRIMARY"')->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            $primary_key = $result['column'];
        return $primary_key;
    }

    public function exists()
    {
        $primary_key = $this->getPrimary();
        if (!$primary_key)
            return false;
        return $this->{$primary_key} ? true : false;

    }

    public function __get($property)
    {
        return $this->{$property};
    }


}