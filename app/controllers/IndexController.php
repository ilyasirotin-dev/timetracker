<?php
declare(strict_types=1);

namespace App\Controllers;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Index');
        parent::initialize();
    }

    public function indexAction()
    {

    }

}

