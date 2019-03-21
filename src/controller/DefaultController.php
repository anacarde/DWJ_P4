<?php

namespace Src\Controller;

use Src\Model\ChaptersManager;

class DefaultController
{
    private $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function indexAction($page = 1)
    {
        $chaptersList = (new ChaptersManager())->getChaptersList();
        $chapterContent = (new ChaptersManager())->getChapterContent($page);
        require ("src/View/postsView.php");
        return;
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