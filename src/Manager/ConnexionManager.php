<?php

namespace Src\Manager;

use App\Manager;

class ConnexionManager extends Manager
{

    public function getPassword()
    {
        $req = Manager::dbConnect()->query('SELECT password FROM password_jf');
        $password = $req->fetch(\PDO::FETCH_ASSOC);
        return $password['password'];
    }

}