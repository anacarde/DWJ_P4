<?php

namespace Src\Manager;

use App\Manager;

class ConnexionManager extends Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = Manager::dbConnect();
    }

    public function getPassword()
    {
        $req = $this->db->query('SELECT password FROM password_jf');
        $password = $req->fetch(\PDO::FETCH_ASSOC);
        return $password['password'];
    }

}