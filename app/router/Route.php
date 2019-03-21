<?php

namespace App\Router;

use App\Request;

class Route
{
    private $name;
    private $path;
    private $parameters;
    private $args;
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

        if (!preg_match_all("/^$path$/", $requestUri, $matches, PREG_PATTERN_ORDER)) {
            return false;
        }

        $this->args = array_slice($matches, 1); 

        foreach ($this->args as $key => $value) {
            if (array_key_exists($key, $this->defaults) && empty($this->args[$key][0])) {
                $this->args[$key] = $this->defaults[$key];
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

    public function call(Request $request){

        $controller = $this->controller;

        $controller = new $controller($request);

        return call_user_func_array([$controller, $this->action], $this->args);
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