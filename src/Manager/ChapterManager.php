<?php

namespace Src\Manager;

use App\Manager;
use src\Model\Chapter;

class ChapterManager extends Manager
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Manager::dbConnect();
    }

    public function getChaptersList()
    {
        $req = $this->db->query('SELECT id, chapter_number, title, date_added, date_modified FROM billets_jf ORDER BY chapter_number');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Chapter');
        $chapters = $req->fetchAll();
        return $chapters;
    }

    public function getChapterContent($page)
    {
        $req = $this->db->prepare('SELECT id, chapter_number, title, content, date_added FROM billets_jf WHERE id = ?');
        $req->execute(array($page));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Chapter');
        $rep = $req->fetch();
        return $rep;
    }

    public function addChapter(Chapter $chapter)
    {
        $req = $this->db->prepare('INSERT INTO billets_jf(chapter_number, title, content, date_added, date_modified) VALUES (:chapter_number, :title, :content, NOW(), NOW())');
        $req->bindValue(':chapter_number', $chapter->getChapterNumber(), \PDO::PARAM_INT);
        $req->bindValue(':title', $chapter->getTitle());
        $req->bindValue(':content', $chapter->getContent());
        $req->execute();
    }

    
}


