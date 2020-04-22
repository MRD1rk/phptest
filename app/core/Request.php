<?php

namespace Core;


use Core\Di\Di;

class Request
{
    final public function getHelper(array $source, string $name = null, $filter = null, $default_value = null)
    {
        if (!$name)
            return $source;
        if (!key_exists($name, $source)) {
            return $default_value;
        }
        $value = $source[$name];
        if ($filter) {
            $filter_obj = Di::getDefault()->get('filter');
            $value = $filter_obj->sanitize($value, $filter);
        }
        return $value;
    }

    public function getPost(string $name = null, $filter = null, $default_value = null)
    {
        return $this->getHelper($_POST, $name, $filter, $default_value);
    }

    public function getQuery(string $name = null, $filter = null, $default_value = null)
    {
        return $this->getHelper($_GET, $name, $filter, $default_value);
    }

    public function getUri()
    {
        $uri = '';
        if (!empty($_SERVER['REQUEST_URI']))
            $uri = $_SERVER['REQUEST_URI'];
        return $uri;
    }


    public function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            return true;
        }
        return false;
    }

    public function isPost()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
            return true;
        return false;
    }
}