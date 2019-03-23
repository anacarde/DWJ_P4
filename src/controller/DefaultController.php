<?php

namespace Src\Controller;

use Src\Manager\ChapterManager;
use Src\Manager\CommentManager;

class DefaultController
{
    private $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function indexAction($page)
    {
        $chapterManager = new ChapterManager;
        $chaptersList = $chapterManager->getChaptersList();
        $chapterContent = $chapterManager->getChapterContent($page);
        $commentManager = new CommentManager;
        $chapterComments = $commentManager->getComments($page);
        require ("src/View/postsView.php");
    }

    public function showAction()
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

    }
}