<?php

namespace Src\Model;

class ChaptersManager extends Manager
{

    protected $db;
    
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getChapters()
    {
        $db = $this->dbconnect();

        $req = $db->query('SELECT title FROM billets_jf ORDER BY chapter_number');

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\model\Chapter');

        $chapters = $req->fetchAll();

        return $chapters;
    }
}


