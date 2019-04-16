<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

Class Controller
{
    private static $managers = [];

    protected $request;

    protected $args;

    private $twig;

    public function __construct($request, $args)
    {
        session_start();
        $this->request = $request;
        $this->args = $args;

        $loader = new FilesystemLoader(__DIR__. '/../src/View');
        $this->twig = new Environment($loader);
    }

    protected function getManager($manager, $request = null)
    {
        if (!isset(self::$managers[$manager])) {
            self::$managers[$manager] = new $manager($request);
        }

        return self::$managers[$manager];
    }

    protected function connexionManage() {
        if (!isset($_SESSION['connexion'])) {
            $_SESSION['connexion'] = TRUE;
        }
    }

    protected function checkConnexion() {
        if (null != $this->request->getQueryParams()) {
            $_SESSION['connexion'] = null;
        }
        return isset($_SESSION['connexion']);
    }

    protected function view($view, $data = [])
    {
        return $this->twig->render($view, $data);
    }

    protected function redirect($url)
    {
        return header('location:' . $url);
    }
}