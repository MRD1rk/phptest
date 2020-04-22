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
        $this->add('/compare-ajax',array(
            'controller' =>'index',
            'action' =>'compareAjax'
        ))->setName('index-compareAjax');
    }
}
