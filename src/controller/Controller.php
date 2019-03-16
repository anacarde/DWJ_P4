<?php

namespace Src\Controller;

use Src\model\ChaptersManager;

class Controller
{
    private $dbManager;

    private $chapters = [];

    public function __construct($dbManager)
    {
        $this->dbManager = $dbManager;
    }

    public function showChapters()
    {
        $this->chapters = $this->dbManager->getChapters();
        require ('src/view/postsView.php');
    }

}