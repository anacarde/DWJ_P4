<?php

require_once "vendor/autoload.php";

use App\router\Router;
use App\Request;
use Src\model\Manager;
use Src\model\ChaptersManager;
use Src\controller\Controller;

$request = new Request();

// echo ($request->getUri());

$dbconnect = Manager::dbConnect();

$router = new Router($request);

$chaptersManager = new ChaptersManager($dbconnect);

$controller = (new Controller($chaptersManager))->showChapters();


























