<?php

require_once "vendor/autoload.php";

use App\Router\Router;
use App\Request;
use Src\Model\Manager;
use Src\Model\ChaptersManager;
use Src\Controller\Controller;

$request = new Request();

// echo ($request->getUri() . "<br/>");

$router = new Router($request);

$router->loadYaml(__DIR__ . "/config/routing.yml");

try {
    $route = $router->getRouteByRequest();

    echo "<pre>";
    var_dump($route);
    echo "</pre>";

    $route->call();

} catch (\Exception $e) {
    echo $e->getMessage();
}

















/*$chaptersManager = new ChaptersManager($dbconnect);

$controller = (new Controller($chaptersManager))->showChapters();*/

// echo ($request->getUri());

// $dbconnect = Manager::dbConnect();
