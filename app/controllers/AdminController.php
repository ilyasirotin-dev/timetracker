<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;

class AdminController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Admin');
        $this->view->setTemplateAfter('panel');
    }

    public function indexAction(): void
    {
    }

    public function suspendAction($userId): void
    {
        $user = Users::findFirst(
            [
                'conditions' => 'id = :id:',
                'bind' => ['id' => $userId],
            ]
        );
        if($user) {
            $user->active = 0;
            $user->save();
        }

        $this->response->redirect('admin');

    }
}