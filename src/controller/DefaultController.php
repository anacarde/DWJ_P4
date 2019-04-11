<?php

namespace Src\Controller;

use Src\Model\Chapter;
use Src\Model\Comment;
use Src\Manager\ChapterManager;
use Src\Manager\CommentManager;
use App\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        echo $this->view("visitorView.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "topPagination" => ceil($this->getManager(CommentManager::class)->countComments($this->args['page'])/10),
            "chapterContent" => $this->getManager(ChapterManager::class)->getChapterContent($this->args['page'])
        ]);
    }

    public function getChapterCommentsAction()
    {
        $this->getManager(CommentManager::class)->getPageComments($this->args['page'], $this->args['commentsPage']);
    }

    public function postCommentAction()
    {
/*        var_dump("ici stop");
        return;*/
        $comment = $this->getManager(Comment::class, $this->request->getPost());
        // var_dump($comment);
        // return;
        $this->getManager(CommentManager::class)->postComment($comment);
        echo $this->getManager(CommentManager::class)->countComments($this->args['page']);
    }

    public function adminAction()
    {
        echo $this->view("adminView.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "commentsList" => $this->getManager(CommentManager::class)->getCommentsList(),
            ""
        ]);
    }

    public function showChapterAction()
    {
        echo $this->getManager(ChapterManager::class)->getChapterContent($this->args['id'])->getContent();
    }

    public function addChapterAction()
    {    

        $chapter = $this->getManager(Chapter::class, $this->request->getPost());
        $this->getManager(ChapterManager::class)->addChapter($chapter);
        $this->redirect("/admin");     
    }

    public function updateChapterAction()
    {

        $chapter = $this->getManager(Chapter::class, $this->request->getPost());
        $this->getManager(ChapterManager::class)->updateChapter($chapter);
        $this->redirect("/admin");
    }

    public function deleteChapterAction()
    {
        $this->getManager(ChapterManager::class)->deleteChapter($this->args['id']);
        $this->redirect("/admin");
    }

    public function showCommentAction()
    {
        $this->getManager(CommentManager::class)->getOneComment($this->args['id']);
    }

    public function updateCommentAction()
    {
        $comment = $this->getManager(Comment::class, $this->request->getPost());
        $this->getManager(CommentManager::class)->updateComment($comment);
        $this->redirect("/admin");
    }

    public function deleteCommentAction()
    {
        $this->getManager(CommentManager::class)->deleteComment($this->args['id']);
        $this->redirect("/admin");
    }
}