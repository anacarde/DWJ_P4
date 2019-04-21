<?php

namespace App\Router;

use Zend\Diactoros\ServerRequest;
use Src\Controller\PageController;

class RouterException extends \Exception
{
    public function __construct($message)
    {
        return (new PageController(null, $message))->error();
    }
}