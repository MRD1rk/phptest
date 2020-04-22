<?php

use Core\App;
use Core\Di\Di;
define('ENVIRONMENT', 'development');
define('APP_PATH', '../app/');
session_start();
switch (ENVIRONMENT) {
    case 'development':
        ini_set('display_errors', 'On');
        ini_set('display_startup_errors', 'On');
        ini_set('error_reporting', 'E_ALL');
        ini_set('log_errors', 'On');
        error_reporting(E_ALL);
        break;
    case 'production':
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', 'Off');
        ini_set('error_reporting', '0');
        ini_set('log_errors', 'On');
        break;
}
require_once '../vendor/autoload.php';
$config = include_once APP_PATH . 'config/config.php';

try {
    $di = Di::getDefault();
    include APP_PATH . 'config/services.php';
    $app = new App($di);
    $app->handle();
} catch (Exception $e) {
    $e->getMessage();
}