<?php
declare(strict_types=1);

namespace App\Controllers;

class IndexController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
    }

    public function indexAction(): void
    {
        $this->response->redirect('/login');
    }

}

