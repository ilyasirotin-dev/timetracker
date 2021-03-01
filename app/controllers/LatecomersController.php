<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\LateTimeForm;
use App\Helpers\Tables\LatecomersTable;
use App\Models\Latecomers;
use App\Models\LateTime;

class LatecomersController extends TableControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Latecomers');
    }

    public function indexAction(): void
    {
        parent::indexAction();

        $time = LateTime::findFirst();
        $form = new LateTimeForm($time);

        $this->view->form = $form;

        $table = new LatecomersTable((int)$this->selectedYear, (int)$this->selectedMonth);

        $this->view->usersList = $table->users->toArray();
        $this->view->tableData = $table->tableData;
    }

    public function setTimeAction(): void
    {
        if ($this->request->isPost()) {
            $hours = $this->request->get('hours', 'absint');
            $minutes = $this->request->get('minutes', 'absint');

            $lateTime = LateTime::findFirst();

            if ($lateTime === null) {
                $lateTime = new LateTime();
                $lateTime->assign([
                    'time' => mktime($hours, $minutes),
                ]);
                $lateTime->save();
            } else {
                $lateTime->time = mktime($hours, $minutes);
                $lateTime->update();

            }
            $this->response->redirect('/latecomers');
        }
    }

    public function deleteAction($id, $date): void
    {
        $latecomers = Latecomers::findFirst([
            'conditions' => 'user_id = :id: AND created_at = :date:',
            'bind' => [
                'id' => $id,
                'date' => strtotime($date),
            ]
        ]);

        if ($latecomers !== null) {
            $latecomers->delete();
        }
        $this->response->redirect('/latecomers');
    }
}