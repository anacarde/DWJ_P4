<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Router\Router;
use Src\Model\Manager;
use Src\Model\ChaptersManager;
use Src\Controller\Controller;
use Zend\Diactoros\ServerRequestFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$request = ServerRequestFactory::fromGlobals();

$router = new Router($request);

$router->loadYaml(__DIR__."/../config/routing.yml");

try {
    $route = $router->getRouteByRequest();

    $route->call($request);

} catch (\Exception $e) {
}



