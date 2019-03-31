<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Router\Router;
use App\Request;
use Src\Model\Manager;
use Src\Model\ChaptersManager;
use Src\Controller\Controller;

$request = new Request();



$router = new Router($request);

$router->loadYaml(__DIR__."/../config/routing.yml");

try {
    $route = $router->getRouteByRequest();


    $route->call($request);

} catch (\Exception $e) {
    echo $e->getMessage();
}



