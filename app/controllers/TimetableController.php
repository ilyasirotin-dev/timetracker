<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\DateGenerator;
use App\Helpers\Table;

class TimetableController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Log');
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
        $timeTable = new Table($selectedMonth, $selectedYear, 1, 0);

        $this->view->usersList = $timeTable->users->toArray();
        $this->view->monthList = $monthNamesList;
        $this->view->yearsList = $timeTable->years;
        $this->view->records = $timeTable->timeRecords;
    }

}