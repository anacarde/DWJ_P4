<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Router\Router;
// use App\Request;
use Src\Model\Manager;
use Src\Model\ChaptersManager;
use Src\Controller\Controller;
// use Zend\Diactoros\Request;
use Zend\Diactoros\ServerRequestFactory;

$request = ServerRequestFactory::fromGlobals();



// var_dump($request->getParsedBody());
// var_dump($request->getUri());

/*var_dump($request->getUri()->getPath());

return;*/
/*echo "<pre>";

var_dump(get_class_methods($request));

return;

echo "</pre>";
*/

$router = new Router($request);

$router->loadYaml(__DIR__."/../config/routing.yml");
/*
echo "salut";
return;*/

try {
    $route = $router->getRouteByRequest();


    $route->call($request);

} catch (\Exception $e) {
    echo $e->getMessage();
}



