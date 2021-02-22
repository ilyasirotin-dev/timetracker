<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\LoginForm;
use App\Models\Users;

class SessionController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Login');
        $this->view->setTemplateAfter('pass_content');
    }

    public function indexAction(): void
    {
            $form = new LoginForm();

        if($this->request->isPost()) {
            if ($this->security->checkToken()) {

                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                 $user = Users::findFirst(
                     [
                         'columns' => 'id, username, is_admin, password',
                         "email = :email: AND active = 1",
                         'bind' => [
                             'email' => $email,
                         ],
                     ]
                 );

                if($user !== null) {
                    $checkPassword = $this->security->checkHash($password, $user->password);
                    if($checkPassword === true) {
                        $this->registerSession($user);
                        $this->response->redirect('/log');
                    } else {
                        $this->flash->error('Wrong password');
                    }
                } else {
                    $this->flash->error('Wrong email');
                }
            }
        }

        $this->view->form = $form;
    }

    public function logoutAction(): void
    {
        $this->session->remove('auth');
        $this->response->redirect('/');
    }

    private function registerSession($user): void
    {
        $this->session->set('auth',
            [
                'id' => $user->id,
                'username' => $user->username,
                'is_admin' => $user->is_admin,
            ]
        );
    }
}