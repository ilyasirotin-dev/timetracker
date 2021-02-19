<?php
declare(strict_types=1);

namespace App\Controllers;


use App\Forms\AddUserForm;
use App\Models\Users;
use Phalcon\Exception;

class AdminController extends PanelController
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Admin');
        $this->view->setTemplateAfter('panel');
    }

    public function indexAction(): void
    {
        $userList = Users::find(
            [
                'columns' => 'id, username, email, is_admin, active',
            ]
        )->toArray();
        $this->view->userList = $userList;
    }

    public function addAction(): void
    {
        $form = new AddUserForm();

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
                $user->username = $this->request->get('username', 'alphanum');
                $user->email = $this->request->get('email', 'email');
                $user->is_admin = $this->request->get('role');
                $user->password = md5($this->request->get('password'));
                $user->created_at = time();
                $user->active = 1;

                try {
                    $user->save();
                } catch (Exception $e) {
                    print_die($e->getMessage());
                }

                $this->response->redirect('admin');
            }
        }

        $this->view->form = $form;

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