<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle('Hours Log | ');
        $this->view->setTemplateAfter('main');
    }

    public function indexAction()
    {
        $auth = $this->session->get('auth');

        if ($auth !== null) {
            $this->response->redirect('/log');
        }
    }
}
