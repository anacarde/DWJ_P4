<?php

namespace App\router;

use App\Request;

class Router {

	private $routes = [];

	private $request;

	public function __construct($request){

		$this->request = $request;

		var_dump($this->request->geturi());
	}

	public function get($path){

		return $this->add($path);

	}

	public function add($path){

		$route = new Route($path);

		$this->routes[] = $route;

	}
}