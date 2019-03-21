<?php

namespace Src\Model;

class ChaptersManager
{
    protected $db;
    
    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
    }

    public function getChaptersList()
    {
        $db = $this->db;
        $req = $db->query('SELECT id, chapter_number, title FROM billets_jf ORDER BY chapter_number');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\model\Chapter');
        $chapters = $req->fetchAll();
        return $chapters;
    }

    public function getChapterContent($page)
    {
        $db = $this->db;
        $req = $db->prepare('SELECT id, title, content, date_added FROM billets_jf WHERE id = ?');
        $req->execute(array($page));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\model\Chapter');
        $rep = $req->fetch();
        return $rep;
    }
}


