<?php

use Core\Request;
use Core\Dispatcher;
use Core\View\Engine;
use Core\View;


$di->set('config', function () {
    return include APP_PATH . 'config/config.php';
});
$di->set('router', function () {
    $router = new \Core\Router();
    $router->mount(new FrontendRoutes());
    return $router;
});
$di->set('session', function () {
    $session = new \Core\Session();
    return $session;
});
$di->set('request', function () {
    $request = new Request();
    return $request;
});
$di->set('response', function () {
    $response = new \Core\Response();
    return $response;
});
$di->set('alert', function () {
    $alert = new \Core\Alert();
    return $alert;
});
$di->set('filter', function () {
    $filter = new \Core\Filter();
    return $filter;
});
$di->set('security', function () {
    $security = new \Core\Security();
    return $security;
});
$di->set('view', function () {
    $view = new View;
    $view->registerEngine(new Engine('tpl'));
    return $view;
});
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    return $dispatcher;
});
$di->set('db', function () {
    return \Core\Db::getInstance();
});