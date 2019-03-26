<?php

namespace Src\Controller;

use Src\Manager\ChapterManager;
use Src\Manager\CommentManager;

class DefaultController
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
            $page = $this->args['page'];
            $chapterManager = new ChapterManager;
            $chaptersList = $chapterManager->getChaptersList();
            $chapterContent = $chapterManager->getChapterContent($page);
            require ("src/View/views/visitorView.php");
        } else {
            throw new \Exception("Argument manquant");
        }
    }

    public function commentsAction()
    {
        if (isset($this->args['page']) && isset($this->args['commentsPage']) ) {
            $page = $this->args['page'];
            $commentsPage = $this->args['commentsPage'];
            $commentManager = new CommentManager;
            $comments_nb = $commentManager->countComments($page);
            $chapterComments = $commentManager->getComments($page, $commentsPage);
            require ("src/View/views/commentsView.php");
        } else {
            throw new \Exception("Argument(s) manquant(s)");
        }

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