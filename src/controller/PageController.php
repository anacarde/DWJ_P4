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
        echo $this->view("visitorView.html.twig", [
            /*"connexionStatus" => $this->checkConnexion(),*/
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "topPagination" => floor($this->getManager(CommentManager::class)->countComments($this->args['page'])/10),
            "chapterContent" => $this->getManager(ChapterManager::class)->getChapterContent($this->args['page'])
        ]);
        $this->checkConnexion();
    }

    public function adminAction()
    {
        echo $this->view("adminView.html.twig", [
            "chaptersList" => $this->getManager(ChapterManager::class)->getChaptersList(),
            "commentsList" => $this->getManager(CommentManager::class)->getCommentsList(),
            "parameters" => $this->request->getQueryParams()
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

    public function error()
    {
        echo $this->view("errorView.html.twig", [
            "message" => $this->args,
        ]);
    }
}