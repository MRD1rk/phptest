<?php

namespace Plugins;

use Core\Di\Di;
use Models\Resource;

class SecurityPlugin
{
    protected $resources;

    protected $id_role;

    public function __construct()
    {
        $this->id_role = $this->getRole();
        $this->getResources();
    }

    public function getResources()
    {
        $resources = Resource::find('id_role=' . $this->id_role.' OR type="public"');

        foreach ($resources as $resource) {
            $action_list = json_decode($resource->action_list);
            foreach ($action_list as $action) {
                $this->allow($this->id_role, $resource->controller, $action);
            }
        }

    }

    public function getRole()
    {
        $session = Di::getDefault()->get('session');
        $auth = $session->get('auth');
        if ($auth)
            $id_role = $auth['id_role'];
        else
            $id_role = 1;//guest
        return $id_role;
    }

    public function allow($id_role, $controller, $action)
    {
        $this->resources[$id_role][$controller][] = $action;
    }

    public function isAllow($controller, $action)
    {
        if (isset($this->resources[$this->id_role][$controller]) && (in_array('*', $this->resources[$this->id_role][$controller])
                || in_array($action, $this->resources[$this->id_role][$controller])))
            return true;
        return false;
    }
}