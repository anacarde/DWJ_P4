<?php

namespace Src\Manager;

class Manager
{
    public static $PDO = null;

    public static function dbConnect() {
        if (Manager::$PDO == null) {
            Manager::$PDO = new \PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
            return Manager::$PDO;
        }  
        return Manager::$PDO;
    }
}