<?php

namespace Core;


use Core\Di\Di;

class Dispatcher
{

    protected $controller_suffix = 'Controller';
    protected $action_suffix = 'Action';
    protected $namespace = 'Controllers';
    protected $action;
    protected $controller;
    protected $params = [];

    public function dispatch()
    {
        $controller = new $this->controller();
        if (!method_exists($controller,$this->action))
            throw new \Exception('Can not call method');
        return call_user_func_array([$controller,$this->getActionName()],$this->params);
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = $action . $this->action_suffix;
    }

    /**
     * @param $controller
     */
    public function setController($controller)
    {
        $this->controller = $this->namespace . '\\' . ucfirst($controller) . $this->controller_suffix;
    }


    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->action;
    }

    /**
     * @param $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $param
     * @param $filter
     * @return null
     */
    public function getParam($param, $filter = null)
    {
        if (key_exists($param, $this->params)) {
            $value = $this->params[$param];
            $filter_obj = Di::getDefault()->get('filter');
            $value = $filter_obj->sanitize($value, $filter);
            return $value;
        }
        return null;
    }

    public function setDefaultNamespace($namespace)
    {
        $this->namespace = ucfirst($namespace);
    }

}