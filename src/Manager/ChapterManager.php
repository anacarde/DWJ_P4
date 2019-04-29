<?php

namespace Src\Manager;

use App\Manager;
use src\Model\Chapter;

class ChapterManager extends Manager
{
    private function classChapObj($req, $fetchType)
    {
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Chapter');
        $rep = $req->$fetchType();
        return $rep;
    }

    public function getChaptersList()
    {
        $req = Manager::dbConnect()->query('SELECT id, chapter_number, title, DATE_FORMAT(date_added, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_added, DATE_FORMAT(date_modified, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_modified FROM billets_jf ORDER BY chapter_number');
        return $this->classChapObj($req, 'fetchAll');
    }

    public function getChapterContent($id)
    {
        $req = Manager::dbConnect()->prepare('SELECT id, chapter_number, title, content, date_added FROM billets_jf WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        return $this->classChapObj($req, 'fetch');
    }

    public function getNextChapterId($id)
    {
        $req = Manager::dbConnect()->prepare('SELECT id FROM billets_jf WHERE id > :id LIMIT 1');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        return $this->classChapObj($req, 'fetch');
    }

    public function getPrevChapterId($id)
    {
        $req = Manager::dbConnect()->prepare('SELECT id FROM billets_jf WHERE id < :id  ORDER BY id DESC LIMIT 1');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        return $this->classChapObj($req, 'fetch');
    }

    public function add(Chapter $chapter)
    {
        $req = Manager::dbConnect()->prepare('INSERT INTO billets_jf(chapter_number, title, content, date_added, date_modified) VALUES (:chapter_number, :title, :content, NOW(), NOW())');
        $req->bindValue(':chapter_number', $chapter->getChapterNumber(), \PDO::PARAM_INT);
        $req->bindValue(':title', $chapter->getTitle());
        $req->bindValue(':content', $chapter->getContent());
        $req->execute();
    }

    public function update(Chapter $chapter)
    {
        $req = Manager::dbConnect()->prepare('UPDATE billets_jf SET chapter_number = :chapter_number, title = :title, content = :content, date_modified = NOW() WHERE id = :id');
        $req->bindValue(':chapter_number', $chapter->getChapterNumber(), \PDO::PARAM_INT);
        $req->bindValue(':title', $chapter->getTitle());
        $req->bindValue(':content', $chapter->getContent());
        $req->bindValue(':id', $chapter->getId(),  \PDO::PARAM_INT);
        $rep = $req->execute();
    }

    public function delete($id)
    {
        $req = Manager::dbConnect()->prepare('DELETE FROM billets_jf WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }
}


