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
            // require ("../src/View/visitorView.php");
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
            // var_dump($this->args['page']);
            // var_dump($this->args['commentsPage']);
            $this->commentManager = new CommentManager;
            // $comments_nb = $commentManager->countComments($page);
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
/*        var_dump($this->commentManager);
        var_dump($this->commentsList);
        return;*/
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

/*    public function commentsPageAction()
    {
        if (isset($this->args['page']) && isset($this->args['commentsPage'])) {
            $page = $this->args['page'];
            $commentsPage = $this->args['commentsPage'];
            $chapterManager = new ChapterManager;
            $chaptersList = $chapterManager->getChaptersList();
            $chapterContent = $chapterManager->getChapterContent($page);
            $commentManager = new CommentManager;
            $chapterComments = $commentManager->getComments($page, $commentsPage);


        } else {
            throw new \Exception("Un ou plusieurs arguments se trouvent manquants");
        }
    }*/

/*    public function showAction()
    {

    }

    public function addAction()
    {

    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }*/
}