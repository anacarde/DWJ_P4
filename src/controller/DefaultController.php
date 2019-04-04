<?php

namespace Src\Controller;

use Src\Model\Chapter;
use Src\Manager\ChapterManager;
use Src\Manager\CommentManager;
use App\Controller;

class DefaultController extends Controller
{
    private $request;

    private $args;
    
    public function __construct($request, $args)
    {
        $this->request = $request;
        $this->args = $args;
    }

    public function indexAction()
    {
        if (isset($this->args['page'])) {
            $this->page = $this->args['page'];
            $this->chapterManager = new ChapterManager;
            $this->commentManager = new CommentManager;
            $this->chaptersList = $this->chapterManager->getChaptersList();
            $this->comments_nb = $this->commentManager->countComments($this->page);
            $this->chapterContent = $this->chapterManager->getChapterContent($this->page);
            $this->view("../src/View/visitorView.php");
        } else {
            throw new \Exception("Argument manquant");
        }
    }

    public function pageCommentsAction()
    {
        if (isset($this->args['page']) && isset($this->args['commentsPage']) ) {
            $this->page = $this->args['page'];
            $this->commentsPage = $this->args['commentsPage'];
            $this->commentManager = new CommentManager;
            $this->chapterComments = $this->commentManager->getPageComments($this->page, $this->commentsPage);
            $this->view("../src/View/commentsView.php");
        } else {
            throw new \Exception("Argument(s) manquant(s)");
        }
    }

    public function adminAction()
    {
        $this->chapterManager = new ChapterManager;
        $this->commentManager = new CommentManager;
        $this->chaptersList = $this->chapterManager->getChaptersList();
        $this->commentsList = $this->commentManager->getCommentsList();
        $this->view("../src/View/adminView.php");
    }

    public function addAction()
    {
        $this->post = $this->request->getPost();
        $this->chapter = new Chapter($this->post);
        $this->chapterManager = new ChapterManager;
        $this->chapterManager->addChapter($this->chapter);
        $this->redirect("/admin");
    }

    public function showChapterContentAction()
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

    public function updateAction()
    {
        if (isset($this->args['id'])) {
            $this->post = $this->request->getPost();
            $this->chapter = new Chapter($this->post);
            $this->chapterManager = new ChapterManager;
            $this->chapterManager->updateChapter($this->chapter);
            $this->redirect("/admin");
        } else {
            throw new \Exception("Argument manquant");
        }
    }

    public function deleteAction()
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

}