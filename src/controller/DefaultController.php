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
            $commentManager = new CommentManager;
            $comments_nb = $commentManager->countComments($page);
            if (isset($this->request->getGet()["commentsPage"])){
                $commentsPage = $this->request->getGet()["commentsPage"];
                $chapterComments = $commentManager->getComments($page, $commentsPage);
                // var_dump($chapterComments);
                // return;
            } else {
                $chapterComments = $commentManager->getComments($page);
            }

            require ("src/View/postsView.php");
        } else {
            throw new \Exception("Argument manquant");
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