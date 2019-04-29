<?php

namespace Src\Controller;

use Src\Manager\ChapterManager;
use Src\Manager\CommentManager;
use Src\Manager\ConnexionManager;
use App\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        echo $this->view("home.html.twig", [
            "connected" => $this->checkConnexion(),
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
        ]);
    }

    public function chapterAction()
    {
        echo $this->view("chapter.html.twig", [
            "connected" => $this->checkConnexion(),
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "chapterContent" => $this->getManager(ChapterManager::class)->getChapterContent($this->args['id']),
            "prevChapter" => $this->getManager(ChapterManager::class)->
                getPrevChapterId($this->args['id']),
            "nextChapter" => $this->getManager(ChapterManager::class)->
                getNextChapterId($this->args['id']),
            "topPagination" => floor($this->getManager(CommentManager::class)->countComments($this->args['id'])/10),
        ]);
    }

    public function adminAction()
    {
        $_SESSION['connected'] = "connected";
        echo $this->view("admin.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "commentsList" => $this->getManager(CommentManager::class)->getCommentsList(),
            "adminAction" => $this->checkAdminAction(),
        ]);
    }

    public function connexionAction()
    {
        $hash = $this->getManager(ConnexionManager::class)->getPassword();
        $passInp = $this->request->getParsedBody()['passInp'];
        if (!password_verify($passInp, $hash)) {
            echo "Mot de passe incorrect";
            return;
        }
        echo "Connexion à votre espace en cours";
    }

    public function disconnectAction()
    {
        session_destroy();
    }

    public function error()
    {
        echo $this->view("error.html.twig", [
            "message" => $this->args,
        ]);
    }
}