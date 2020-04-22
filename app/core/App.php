<?php


namespace Core;


use Core\Di\Di;

class App
{
    protected $container;

    public function __construct(Di $di)
    {
        $this->container = $di;
    }

    public function handle()
    {
        $router = $this->container->get('router');
        $request = $this->container->get('request');
        $router->handle($request->getUri());
        $dispatcher = $this->container->get('dispatcher');
        $view = $this->container->get('view');
        $dispatcher->setController($router->getControllerName());
        $dispatcher->setAction($router->getActionName());
        $dispatcher->setParams($router->getParams());
        $view->setContent($dispatcher->dispatch());
        if (!$view->disable) {
            $view->setAction($router->getActionName());
            $view->setController($router->getControllerName());
            $view->render();
        }

    }
}