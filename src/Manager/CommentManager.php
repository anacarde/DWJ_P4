<?php

namespace Src\Manager;

use App\Manager;

class CommentManager extends Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = Manager::dbConnect();
    }

    public function countComments($page)
    {
        $db = $this->db;
        $req = $db->prepare('SELECT COUNT(*) AS comments_nb FROM comments_jf WHERE comment_chapter = :page ');
        $req->bindValue(':page', $page, \PDO::PARAM_INT);
        $req->execute();
        $commentsNb = $req->fetch(\PDO::FETCH_ASSOC); 
        return (int) $commentsNb['comments_nb'];
    }

    public function getPageComments($page, $commentsPage)
    {
        // var_dump($commentsPage);
        $db = $this->db;
        $req = $db->prepare('SELECT id, comment_chapter, author, content,  DATE_FORMAT(date_added, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_added, DATE_FORMAT(date_modified, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_modified FROM comments_jf WHERE comment_chapter = :page ORDER BY id DESC LIMIT '. ((int)$commentsPage-1)*5 .', 5');
        // var_dump($req);
        $req->bindValue(':page', $page, \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Comment');
        $comments = $req->fetchAll();
        // var_dump($comments);
        return $comments;
    }

    public function getCommentsList()
    {
        $db = $this->db;
        $req = $db->query('SELECT id, comment_chapter, author, content, date_added FROM comments_jf ORDER BY date_added DESC');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Comment');
        $comments = $req->fetchAll();
/*        var_dump($comments);
        return;*/
        return $comments;
    }
}