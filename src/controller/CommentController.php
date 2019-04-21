<?php

namespace Src\Controller;

use Src\Model\Comment;
use Src\Manager\CommentManager;
use App\Controller;

class CommentController extends Controller
{

    public function getChapterCommentsAction()
    {
        echo json_encode($this->getManager(CommentManager::class)->getPageComments($this->args['page'], $this->args['commentsPage']));
    }

    public function signalCommentAction()
    {
        $this->getManager(CommentManager::class)->signalComment($this->args['id']);
    }

    public function postCommentAction()
    {
        $comment = $this->getManager(Comment::class, $this->request->getParsedBody());
        $this->getManager(CommentManager::class)->add($comment);
        echo $this->getManager(CommentManager::class)->countComments($this->args['page']);
    }

    public function showCommentAction()
    {
        echo json_encode($this->getManager(CommentManager::class)->getOneComment($this->args['id']));
    }

    public function updateCommentAction()
    {
        $comment = $this->getManager(Comment::class, $this->request->getParsedBody());
        $this->getManager(CommentManager::class)->update($comment);
        $this->redirect("/admin?action=comUpdate");
    }

    public function deleteCommentAction()
    {
        $this->getManager(CommentManager::class)->delete($this->args['id']);
        $this->redirect("/admin?action=comDelete");
    }

}