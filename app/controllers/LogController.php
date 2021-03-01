<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\DateRelatedHelpers;
use App\Helpers\StatisticCalculator;
use App\Helpers\Tables\LogTable;
use App\Models\Latecomers;
use App\Models\LateTime;
use App\Models\TimeTable;
use App\Models\Users;

class LogController extends TableControllerBase
{
    protected function initialize()
    {
        parent::initialize();
    }

    public function indexAction(): void
    {
        parent::indexAction();

        // Calculate user statistic for the selected month and year
        $this->statistic = new StatisticCalculator(
            $this->session->get('auth')['id'],
            (int)$this->selectedMonth,
            (int)$this->selectedYear
        );

        // Pass statistic vars to view
        $this->view->total = $this->statistic->getTotalUserHours();
        $this->view->required = $this->statistic->getRequiredHours();
        $this->view->lates = $this->statistic->getUserLates();

        $this->table = new LogTable((int)$this->selectedYear, (int)$this->selectedMonth);

        $this->view->usersList = $this->table->users->toArray();
        $this->view->tableData = $this->table->tableData;
    }

    public function startAction(): void
    {
        if ($this->request->isPost()) {

            $id = $this->request->get('id');
            $user = Users::findFirstById($id);

            if ($user !== null) {
                $time = null;

                $exist = TimeTable::findFirst([
                    'conditions' => 'user_id = :id: AND created_at = :date: AND [end] IS NULL',
                    'bind' => [
                        'id' => $id,
                        'date' => strtotime(date('Y-m-d')),
                    ],
                ]);

                if ($exist === null) {

                    $record = new TimeTable();
                    $record->assign([
                        'start' => strtotime(date('H:i')),
                        'end' => null,
                        'created_at' => strtotime(date("Y-m-d")),
                        'total' => null,
                    ]);

                    $user->timetable = [
                        $record
                    ];

                    $late_time = LateTime::findFirst();

                    if ($late_time !== null) {
                        if (date('H:i') >= date('H:i', (int)$late_time->time)) {
                            $latecomer = Latecomers::findFirstByCreatedAt(strtotime(date("Y-m-d")));

                            if ($latecomer === null) {
                                $latecomer = new Latecomers();
                                $latecomer->assign([
                                    'created_at' => strtotime(date("Y-m-d")),
                                ]);

                                $user->latecomers = [
                                    $latecomer,
                                ];
                            }
                        }
                    }
                    $time = date('H:i', (int)$record->start);

                    $user->save();

                }
            }

            $this->view->disable();
            $this->response->setJsonContent(['time' => $time, 'recordId' => $record->id])->send();
        } else {
            $this->response->redirect('/log');
        }
    }

    public function stopAction(): void
    {
        if ($this->request->isPost()) {
            $id = $this->request->get('id');
            $user = Users::findFirstById($id);

            if ($user !== null) {
                $time = null;
                $record = TimeTable::findFirst([
                    'conditions' => 'user_id = :id: AND created_at = :date: AND [end] IS NULL',
                    'bind' => [
                        'id' => $id,
                        'date' => strtotime(date('Y-m-d')),
                    ],
                ]);

                if ($record !== null) {
                    $startTime = $record->start;

                    $startTime = date("H:i", (int)$startTime);
                    $endTime = date("H:i");

                    $duration = DateRelatedHelpers::getDuration($startTime, $endTime);

                    $record->total = $duration;
                    $record->end = strtotime($endTime);

                    $user->timetable = [
                        $record,
                    ];

                    $user->save();

                }
            }

            $this->view->disable();
            $this->response->setJsonContent(['time' => $endTime, 'recordId' => $record->id])->send();

        } else {
            $this->response->setJsonContent('Invalid request')->send();
        }
    }

    public function updateAction(): void
    {
        if ($this->request->isPost()) {
            $recordId = $this->request->get('recordId');
            $record = TimeTable::findFirstById($recordId);
            if ($record !== null) {
                $type = $this->request->get('type');
                $time = $this->request->get('time');

                $record->$type = strtotime($time);

                $record->update();
            }

            $this->view->disable();
            $this->response->setJsonContent('success')->send();
        } else {
            $this->response->setJsonContent('Invalid request')->send();
        }
    }
}