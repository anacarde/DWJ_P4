<?php

namespace App\Router;

// use App\Request;
// use Zend\Diactoros\ServerRequest;

use Symfony\Component\Yaml\Yaml;

class Router
{

    private $routes = [];

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function loadYaml($file)
    {
        $routes = Yaml::parseFile($file);
    
        foreach ($routes as $name => $route) {
            $this->addRoute(new Route($name, $route["path"], $route["parameters"], $route["controller"], $route["action"], $route["defaults"] ?? null));
        }
    }

    public function addRoute(Route $route)
    {
        if (isset($this->routes[$route->getName()])) {
            throw new RouterException("Cette route existe déjà.");
        }

        $this->routes[$route->getname()] = $route;
    }

    public function getRouteByRequest()
    {
        foreach ($this->routes as $route) {
            // var_dump($this->request->getUri()->getPath());
            // var_dump($this->request->getRequestTarget());
            // return;
            // var_dump($this->request->getUri());
            // return;
            if ($route->match($this->request->getUri()->getPath())) {
                return $route;
            }
        }
        throw new RouterException("Cette route n'existe pas !");
    }
}