<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\Tables\StatisticTable;
use App\Models\TimeTable;

class StatisticController extends TableControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Log');
    }

    public function indexAction(): void
    {
        parent::indexAction();

        $this->table = new StatisticTable((int)$this->selectedYear, (int)$this->selectedMonth);
        $this->view->usersList = $this->table->users->toArray();
        $this->view->records = $this->table->tableData;
    }

    public function startAction(): void
    {
        $record = new TimeTable();
        $record->assign(
            [
                'user_id' => $this->session->get('auth')['id'],
                'start' => time(),
                'end' => null,
                'created_at' => strtotime(date('Y-m-d')),
            ]
        );
        $record->save();
    }
}