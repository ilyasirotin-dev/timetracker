<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\CreateUserForm;
use App\Models\Users;

class UserController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
    }

    public function createAction(): void
    {
        $this->tag->setTitle("User creation");
        $form = new CreateUserForm();
        $this->view->form = $form;

        if($this->request->isPost()) {

            if($form->isValid($_POST) === false) {
                $formMessages = $form->getMessages();

                foreach ($formMessages as $message) {
                    $this->flash->error($message->getMessage());
                }

            } else {

                $user = new Users();

                $user->fname = $this->request->get('fname', 'alpha');
                $user->lname = $this->request->get('lname', 'alpha');
                $user->username = $this->request->get('username', 'alnum');
                $user->email = $this->request->get('email', 'email');
                $user->is_admin = $this->request->get('is_admin', 'int');
                $user->password = $this->request->get('password');

                if ($user->save() === false) {
                    $messages = $user->getMessages();

                    foreach ($messages as $message) {
                        $this->flash->error($message->getMessage());
                    }

                    return;
                }
                $this->response->redirect('/admin/create');
            }
        }
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
            $user->active = false;
            $user->save();
        }
    }
}
