<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\LoginForm;
use App\Models\Users;
use Phalcon\Exception;

class LoginController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Login');
    }

    public function indexAction(): void
    {
        $this->view->form = new LoginForm();
    }

    public function loginAction(): void
    {
        if($this->request->isPost()) {
            if ($this->security->checkToken()) {

                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                try {
                    $user = Users::findFirst(
                        [
                            "email = :email: AND password = :password: AND active = 1",
                            'bind' => [
                                'email' => $email,
                                'password' => md5($password),
                            ],
                        ]
                    );
                } catch (Exception $e) {
                    echo $e->getMessage();
                }

                if ($user) {
                    $this->registerSession($user);
                    $user->is_admin === 1 ?
                        $userRole = 'admin' :
                        $userRole = 'user';
                }

                $this->flash->error('Wrong email/password');

                $this->dispatcher->forward(
                    [
                        'controller' => 'login',
                        'action' => 'login',
                    ]
                );
            }
        }
    }

    private function logoutAction(): void
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye');

        $this->dispatcher->forward(
            [
                'controller' => 'login',
                'action' => 'index'
            ]
        );
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