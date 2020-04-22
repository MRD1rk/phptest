<?php

class FrontendRoutes extends \Core\Router\Group
{

    public function __construct()
    {
        parent::__construct();
        $this->initialize();
    }

    public function initialize()
    {
	$this->add('/:controller/:action', array(
	    'controller' => 1,
	    'action' => 2));
        $this->add('/',array(
            'controller' =>'index',
            'action' =>'index'
        ))->setName('index-index');
        $this->add('/compare',array(
            'controller' =>'index',
            'action' =>'compare'
        ))->setName('index-compare');
        $this->add('/compare-ajax',array(
            'controller' =>'index',
            'action' =>'compareAjax'
        ))->setName('index-compareAjax');
        $this->add('/task/load',array(
            'controller' =>'tasks',
            'action' =>'load'
        ))->setName('tasks-load');
        $this->add('/task/add', array(
            'controller' => 'tasks',
            'action' => 'add'
        ))->setName('tasks-add');
        $this->add('/login', array(
            'controller' => 'index',
            'action' => 'login'
        ))->setName('index-login');
	    $this->add('/signup',array(
	    'controller' => 'index',
	    'action' => 'signup'
	    ))->setName('index-signup');
	    $this->add('/users',array(
            'controller' => 'index',
            'action' => 'users'
        ))->setName('index-users');
        $this->add('/logout', array(
            'controller' => 'index',
            'action' => 'logout'
        ))->setName('index-logout');
        $this->add('/task/update/:int', array(
            'controller' => 'tasks',
            'action' => 'update',
            'id_task' => 1
        ))->setName('tasks-update');
        $this->add('/users/update/:int', array(
            'controller' => 'index',
            'action' => 'update',
            'id_user' => 1
        ))->setName('index-update');
        $this->add('/users',array(
            'controller' => 'index',
            'action' => 'page'
        ))->setName('index-page');
        $this->add('/user/load',array(
            'controller' =>'index',
            'action' =>'load'
        ))->setName('index-load');
    }
}
