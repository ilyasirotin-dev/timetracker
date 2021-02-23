<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\LateTimeForm;
use App\Helpers\Tables\LatecomersTable;
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
        $form = new LateTimeForm();
        $this->view->form = $form;

        $table = new LatecomersTable((int)$this->selectedYear, (int)$this->selectedMonth);

        $this->view->usersList = $table->users->toArray();
        $this->view->records = $table->tableData;
    }

    public function setTimeAction(): void
    {
        if($this->request->isPost()) {
            $hours = $this->request->get('hours', 'absint');
            $minutes = $this->request->get('minutes', 'absint');

            $lateTime = LateTime::findFirst();

            if($lateTime === null) {
                $lateTime = new LateTime();
                $lateTime->assign(
                    [
                        'hours' => $hours,
                        'minutes' => $minutes,
                    ]
                );
                $lateTime->save();
            } else {
                $lateTime->hours = $hours;
                $lateTime->minutes = $minutes;
                $lateTime->update();

            }
            $this->response->redirect('/latecomers');
        }
    }
}