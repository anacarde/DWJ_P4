<?php

namespace App\Router;

use Zend\Diactoros\ServerRequest;

class Route
{
    private $name;
    private $path;
    private $parameters;
    private $args = [];
    private $defaults;

    public function __construct($name, $path, array $parameters, $controller, $action, $defaults = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->parameters = $parameters;
        $this->controller = $controller;
        $this->action = $action;
        $this->defaults = $defaults;
    }

    public function match($requestUri)
    {

        $path = preg_replace_callback("/:(\w+)/", [$this, "parameterMatch"], $this->path);

        $path = str_replace("/", "\/", $path);

        if (!preg_match_all("/^$path$/i", $requestUri, $matches)) {
            return false;
        }

        $this->args = array_slice($matches, 1);

        foreach ($this->args as $key => $value) {
            if (isset($this->defaults) && array_key_exists($key, $this->defaults) && empty($this->args[$key][0])) {
                $this->args[$key] = $this->defaults[$key];
            } else {
                $this->args[$key] = $this->args[$key][0];
            }        
        }    

        return true;
    }

    public function parameterMatch($match)
    {
        if (isset($this->parameters[$match[1]])) {
            return sprintf("(%s)", $this->parameters[$match[1]]);
        }
        return "([^/]+)";
    }

    public function call(ServerRequest $request){

        $controller = $this->controller;

        $controller = new $controller($request, $this->args);

        return call_user_func([$controller, $this->action]);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

} 