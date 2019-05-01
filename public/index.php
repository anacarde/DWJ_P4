<?php

echo "indexA";
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__."/../vendor/autoload.php";

echo "indexB";

use App\Router\Router;
use Src\Model\Manager;
use Src\Model\ChaptersManager;
use Src\Controller\Controller;
use Zend\Diactoros\ServerRequestFactory;

echo "indexC";

$request = ServerRequestFactory::fromGlobals();

echo "indexD";

$router = new Router($request);

echo "indexE";

$router->loadYaml(__DIR__."/../config/routing.yml");

echo "indexF";

try {
    $route = $router->getRouteByRequest();

    $route->call($request);

    echo "indexG";

} catch (\Exception $e) {
    echo "indexH";
}



