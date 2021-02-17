<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\LogInForm;

class SessionController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('LogIn');
        $this->view->setTemplateAfter('session');
    }

    public function indexAction()
    {
        $this->view->form = new LogInForm();
    }

    public function sendAction()
    {
        if(!$this->request->isPost()) {
            $this->dispatcher->forward(
                [
                    'controller' => 'session',
                    'action' => 'index',
                ]
            );
            return;
        }

    }
}