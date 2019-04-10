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
            "topPagination" => ceil($this->getManager(CommentManager::class)->countComments($this->args['page'])/5),
            "chapterContent" => $this->getManager(ChapterManager::class)->getChapterContent($this->args['page'])
        ]);
    }

    public function getChapterCommentsAction()
    {
        $this->getManager(CommentManager::class)->getPageComments($this->args['page'], $this->args['commentsPage']);
    }

    public function adminAction()
    {
        // $this->chapterManager = new ChapterManager;
        // $this->commentManager = new CommentManager;
        // $this->commentsList = $this->commentManager->getCommentsList();
        // require "../src/View/adminView.php";
/*
        $bidule = $this->getManager(ChapterManager::class)->getChaptersList();

        foreach ($bidule as $key => $je) {
            var_dump($je->getTitle());
            echo "<br/>";
        };
        return;
*/
        echo $this->view("adminView.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "commentsList" => $this->getManager(CommentManager::class)->getCommentsList(),
            ""
        ]);
    }

    public function showChapterAction()
    {
        if (isset($this->args['id'])) {
            $this->id = $this->args['id'];
            $this->chapterManager = new ChapterManager;
            $this->chapterContent = $this->chapterManager->getChapterContent($this->id);
            echo $this->chapterContent->getContent();
        } else {
            throw new \Exception("Argument manquant");
        }
    }

    public function addChapterAction()
    {
        $this->post = $this->request->getPost();
        $this->chapter = new Chapter($this->post);
        $this->chapterManager = new ChapterManager;
        $this->chapterManager->addChapter($this->chapter);
        $this->redirect("/admin");
    }

    public function updateChapterAction()
    {
        if (isset($this->args['id'])) {
            $this->post = $this->request->getPost();
/*            var_dump($this->post);
            return;*/
            $this->chapter = new Chapter($this->post);
            $this->chapterManager = new ChapterManager;
            $this->chapterManager->updateChapter($this->chapter);
            $this->redirect("/admin");
        } else {
            throw new \Exception("Argument manquant");
        }
    }

    public function deleteChapterAction()
    {
        if(isset($this->args['id'])) {
            $this->id = $this->args['id'];
            $this->chapterManager = new ChapterManager;
            $this->chapterManager->deleteChapter($this->id);
            $this->redirect("/admin");
        } else {
            throw new \Exception("Argument manquant");
        }
    }

    public function showCommentAction()
    {
        if(isset($this->args['id'])) {
            $this->id = $this->args['id'];
            $this->commentManager = new CommentManager;
            $this->commentManager->getOneComment($this->id);
        } else {
            throw new \Exception("Argument manquant");
        }        
    }

    public function updateCommentAction()
    {
        if(isset($this->args['id'])) {
            $this->post = $this->request->getPost();
            $this->comment = new Comment($this->post);
            $this->commentManager = new CommentManager;
            $this->commentManager->updateComment($this->comment);
            $this->redirect("/admin");
        } else {
            throw new \Exception("Argument manquant");
        }   
    }

    public function deleteCommentAction()
    {
        if(isset($this->args['id'])) {
            $this->id = $this->args['id'];
            $this->commentManager = new CommentManager;
            $this->commentManager->deleteComment($this->id);
            $this->redirect("/admin");
        } else {
            throw new \Exception("Argument manquant");
        }
    }
}