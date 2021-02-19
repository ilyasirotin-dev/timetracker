<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\LoginForm;
use App\Models\Users;

class LoginController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Login');
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
                         'columns' => 'id, username, role',
                         "email = :email: AND password = :password: AND active = 1",
                         'bind' => [
                             'email' => $email,
                             'password' => $this->security->hash($password),
                         ],
                     ]
                 );

                if($user) {
                    $this->registerSession($user);
                    $this->response->redirect('index');
                } else {
                    $this->flash->error('Wrong email/password');

                    return;
                }

                return;
            }
        }

        $this->view->form = $form;
    }

    public function logoutAction(): void
    {
        $this->session->remove('auth');
        $this->response->redirect('/login');
    }

    private function registerSession($user): void
    {
        $this->session->set('auth',
            [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
            ]
        );
    }
}