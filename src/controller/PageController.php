<?php

namespace Src\Controller;

use Src\Manager\ChapterManager;
use Src\Manager\CommentManager;
use App\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        echo $this->view("visitorView.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "topPagination" => floor($this->getManager(CommentManager::class)->countComments($this->args['page'])/10),
            "chapterContent" => $this->getManager(ChapterManager::class)->getChapterContent($this->args['page'])
        ]);
    }

    public function adminAction()
    {
        echo $this->view("adminView.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "commentsList" => $this->getManager(CommentManager::class)->getCommentsList(),
            ""
        ]);
    }

}