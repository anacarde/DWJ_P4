<?php

namespace Src\model;

class Manager
{

	public static function dbConnect(){

		$db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');

		return $db;
	}

}