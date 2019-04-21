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
        $this->getManager(ChapterManager::class)->add($chapter);
        $this->redirect("/admin?action=chaAdd");     
    }

    public function updateChapterAction()
    {

        $chapter = $this->getManager(Chapter::class, $this->request->getParsedBody());
        $this->getManager(ChapterManager::class)->update($chapter);
        $this->redirect("/admin?action=chaUpdate");
    }

    public function deleteChapterAction()
    {
        $this->getManager(ChapterManager::class)->delete($this->args['id']);
        $this->redirect("/admin?action=chaDelete");
    }
}