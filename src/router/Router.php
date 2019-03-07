<?php

namespace App\router;

class Router {

	private $url;

	public function __construct($url){
		$this->url = $url;
		var_dump($this->url);
		return;
	}
}