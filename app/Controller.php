<?php

namespace App;

Class Controller
{
    protected function view($view)
    {
        return require $view;
    }

    protected function redirect($url)
    {
        return header('location:' . $url);
    }
}