<?php

namespace Src\Manager;

use App\Manager;
use Src\Model\Comment;

class CommentManager extends Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = Manager::dbConnect();
    }

    public function countComments($page)
    {
        $req = $this->db->prepare('SELECT COUNT(*) AS comments_nb FROM comments_jf WHERE comment_chapter = :page ');
        $req->bindValue(':page', $page, \PDO::PARAM_INT);
        $req->execute();
        $commentsNb = $req->fetch(\PDO::FETCH_ASSOC); 
        return (int) $commentsNb['comments_nb'];
    }

    public function postComment(Comment $comment)
    {
        $req = $this->db->prepare('INSERT INTO comments_jf(comment_chapter, author, content, date_added, date_modified) VALUES (:chpNb, :author, :content, NOW(), NOW())');
        // var_dump($comment->getCommentChapter());
        $req->bindValue(':chpNb', $comment->getCommentChapter(), \PDO::PARAM_INT);
        $req->bindValue(':author', $comment->getAuthor());
        $req->bindValue(':content', $comment->getContent());
        $req->execute();
    }

    public function getPageComments($page, $commentsPage)
    {
        $req = $this->db->prepare('SELECT id, comment_chapter, author, content, DATE_FORMAT(date_added, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_added, DATE_FORMAT(date_modified, \'le %d/%m/%Y à %Hh%imin%ss\') AS date_modified FROM comments_jf WHERE comment_chapter = :page ORDER BY id DESC LIMIT '. ((int)$commentsPage-1)*10 .', 10');
        $req->bindValue(':page', $page, \PDO::PARAM_INT);
        $req->execute();
        $rep = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $rep;
    }

    public function signalComment($id)
    {
        $req = $this->db->prepare('UPDATE comments_jf SET signaled = signaled + 1 WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }

    public function getCommentsList()
    {
        $req = $this->db->query('SELECT id, comment_chapter, author, content, date_added FROM comments_jf ORDER BY signaled DESC, date_added DESC');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Model\Comment');
        $comments = $req->fetchAll();
        return $comments;
    }

    public function getOneComment($id)
    {
        $req = $this->db->prepare('SELECT id, author, content FROM comments_jf WHERE id= :id');
        $req->bindValue(":id", $id, \PDO::PARAM_INT);
        $req->execute();
        $comData = $req->fetch(\PDO::FETCH_ASSOC);
        return $comData;
    }

    public function updateComment(Comment $comment)
    {
        $req = $this->db->prepare('UPDATE comments_jf SET author = :author, content = :content WHERE id = :id');
        $req->bindValue(":id", $comment->getId(), \PDO::PARAM_INT);
        $req->bindValue(":author", $comment->getAuthor());
        $req->bindValue(":content", $comment->getContent());
        $req->execute();
    }

    public function deleteComment($id)
    {
        $req = $this->db->prepare('DELETE FROM comments_jf WHERE id = :id');
        $req->bindValue(":id", $id, \PDO::PARAM_INT);
        $req->execute();
    }
}