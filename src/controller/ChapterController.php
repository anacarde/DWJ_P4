<?php

namespace Src\Controller;

use Src\Model\Chapter;
use Src\Manager\ChapterManager;
use App\Controller;

class ChapterController extends Controller
{

    public function showChapterAction()
    {
        echo $this->getManager(ChapterManager::class)->getChapterContent($this->args['id'])->getContent();
    }

    public function addChapterAction()
    {    

        $chapter = $this->getManager(Chapter::class, $this->request->getParsedBody());
        $this->getManager(ChapterManager::class)->addChapter($chapter);
        $this->redirect("/admin");     
    }

    public function updateChapterAction()
    {

        $chapter = $this->getManager(Chapter::class, $this->request->getParsedBody());
        $this->getManager(ChapterManager::class)->updateChapter($chapter);
        $this->redirect("/admin");
    }

    public function deleteChapterAction()
    {
        $this->getManager(ChapterManager::class)->deleteChapter($this->args['id']);
        $this->redirect("/admin");
    }
}