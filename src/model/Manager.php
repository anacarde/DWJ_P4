<?php

namespace App\model;

class dbConnect(){

	protected function dbConnect(){

		$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');

	}

}