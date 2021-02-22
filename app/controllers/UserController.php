<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\ChangePasswordForm;
use App\Forms\CreateUserForm;
use App\Models\Users;
use Phalcon\Exception;

class UserController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
    }

    public function listAction(): void
    {
        $this->tag->setTitle('Users list');
        $users = Users::find(
            [
                'columns' => 'id, fname, lname, username, email, is_admin, active',
            ]
        );
        $this->view->usersList = $users;
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

                if ($user->validation() !== false) {
                    $messages = $user->getMessages();

                    foreach ($messages as $message) {
                        $this->flash->error($message->getMessage());
                    }
                } else {
                    $user->save();
                    $this->dispatcher->forward(
                        [
                            'controller' => 'user',
                            'action' => 'create',
                        ]
                    );
                }
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
            $user->update();
        }
        $this->response->redirect('/list');
    }

    public function passwordAction(): void
    {
        $this->tag->setTitle('Change password');
        $form = new ChangePasswordForm();
        $this->view->form = $form;

        if($this->request->isPost()) {
            $newPassword = $this->request->get('newPassword');

            if($form->isValid($_POST) === false) {
                $formMessages = $form->getMessages();

                foreach ($formMessages as $message) {
                    $this->flash->error($message->getMessage());
                }
            } else {
                $userId = $this->session->get('auth')['id'];

                $user = Users::findFirst(
                    [
                        "id = :id:",
                        'bind' => [
                            'id' => $userId,
                        ],
                    ]
                );

                $user->password = $this->security->hash($newPassword);
                try {
                    $user->update();
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
                $this->dispatcher->forward(
                    [
                        'controller' => 'user',
                        'action' => 'password',
                    ]
                );
            }
        }
    }
}
