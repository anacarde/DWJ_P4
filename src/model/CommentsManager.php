<?php

namespace Src\Model;

class CommentsManager
{
    protected $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
    }

    public function getComments()
    {
        $db = $this->db;
        $req = $db->query('SELECT * FROM comments_jf ORDER BY id');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\model\Comment');
        $comments = $req->fetchAll();
        return $comments;
    }





}