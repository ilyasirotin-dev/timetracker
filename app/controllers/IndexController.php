<?php
declare(strict_types=1);

namespace App\Controllers;

class IndexController extends ControllerBase
{
    protected function initialize()
    {
        $this->tag->setTitle('Home');
        parent::initialize();
        $this->view->setTemplateAfter('index');
    }

    public function indexAction()
    {

    }

}

