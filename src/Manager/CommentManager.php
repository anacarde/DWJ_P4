<?php

namespace Src\Manager;

class CommentManager extends Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
    }

    public function getComments($page)
    {
        $db = $this->db;
        $req = $db->prepare('SELECT id, comment_chapter, author, content,  DATE_FORMAT(date_added, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_added, DATE_FORMAT(date_modified, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_modified FROM comments_jf WHERE comment_chapter = :page ORDER BY id');
        $req->bindValue(':page', $page, \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Comment');
        $comments = $req->fetchAll();
        return $comments;
    }
}