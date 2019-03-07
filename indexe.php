<?php

require_once "vendor/autoload.php";

use App\router\Router;

$router = new Router($_GET['url']);

















// use Zend\Diactoros\ServerRequestFactory;
// use Zend\Diactoros\Response\HtmlResponse;
// use Zend\Diactoros\Response\RedirectResponse;
// use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

// $request = ServerRequestFactory::fromGlobals();

// $response = new HtmlResponse('<h1> Hello world ! </h1>');

// var_dump($response->getBody()->getContents());

// echo $response->getBody()->getContents();

// $emitter = new SapiEmitter();

// $emitter->emit($response);



