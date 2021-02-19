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

    public function indexAction(): void
    {
        if ($this->request->isPost()) {
            $selectedMonth = $this->request->get('month');
            $selectedYear = $this->request->get('year');

        } else {
            $selectedMonth = date('m');
            $selectedYear = date('Y');
        }

        $monthNamesList = DateGenerator::getMonthNamesList($selectedMonth);
        $timeTable = new TimeTable($selectedMonth, $selectedYear);


        $this->view->usersList = $timeTable->usersList;
        $this->view->table = $timeTable->getTimeTable();

        $this->view->monthNamesList = $monthNamesList;
        $this->view->yearsList = $timeTable->yearsList;

    }

    public function createAction(): void
    {
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

                $user->fname = $this->request->get('fname');
                $user->lname = $this->request->get('lname');
                $user->username = $this->request->get('username');
                $user->email = $this->request->get('email');
                $user->is_admin = $this->request->get('role');
                $user->password = $this->request->get('password');

                if ($user->save() === false) {
                    $messages = $user->getMessages();

                    foreach ($messages as $message) {
                        $this->flash->error($message->getMessage());
                    }

                    return;
                }

                $this->response->redirect('admin');
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
