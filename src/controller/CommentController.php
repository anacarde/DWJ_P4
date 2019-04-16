<?php

namespace Src\Controller;

use Src\Model\Comment;
use Src\Manager\CommentManager;
use App\Controller;

class CommentController extends Controller
{

    public function getChapterCommentsAction()
    {
        $this->getManager(CommentManager::class)->getPageComments($this->args['page'], $this->args['commentsPage']);
    }

    public function postCommentAction()
    {
        $comment = $this->getManager(Comment::class, $this->request->getParsedBody());
        $this->getManager(CommentManager::class)->postComment($comment);
        echo $this->getManager(CommentManager::class)->countComments($this->args['page']);
    }

    public function showCommentAction()
    {
        $this->getManager(CommentManager::class)->getOneComment($this->args['id']);
    }

    public function updateCommentAction()
    {
        $comment = $this->getManager(Comment::class, $this->request->getParsedBody());
        $this->getManager(CommentManager::class)->updateComment($comment);
        $this->redirect("/admin");
    }

    public function deleteCommentAction()
    {
        $this->getManager(CommentManager::class)->deleteComment($this->args['id']);
        $this->redirect("/admin");
    }

}