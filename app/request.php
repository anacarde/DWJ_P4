<?php

namespace App;

class Request
{
    private $post,
            $get,
            $files,
            $request,
            $server;

    public function __construct()
    {
        $this->post = $_POST;
        $this->get = $_GET;
        $this->files = $_FILES;
        $this->request = $_REQUEST;
        $this->server = $_SERVER;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getGet()
    {
        return $this->get;
    }

    public function getFiles()
    {
        return $_COOKIE;
    }

    public function getSession()
    {
        return $_SESSION;
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getUri()
    {
        return $this->server['REQUEST_URI'];
    }
}