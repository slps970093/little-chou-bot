<?php
/**
 * Bot Framework
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 上午 01:32
 */

require_once 'global_config.php';
require_once 'vendor/autoload.php';

use System\RouteManager\Manager as RouteManage;


$route = new RouteManage();

$controllerName = $route->getControllerNameFromRoute();
$object = $controllerName;

if ( $controllerName == false ){
    $controllerName = ucfirst($route->getControllerName()) . 'Controller';
    $object = "\\App\\Controllers\\".$controllerName;
}


if ( class_exists($object)) {
    /** @var \System\Controller\BaseController $controller */
    $controller = new $object();
    $controller->init()->run();
}
