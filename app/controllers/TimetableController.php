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
    }

    public function showAction(): void
    {
        if ($this->request->isPost()) {
            $selectedMonth = $this->request->get('month');
            $selectedYear = $this->request->get('year');

        } else {
            $selectedMonth = date('m');
            $selectedYear = date('Y');
        }

        $monthNamesList = DateGenerator::getMonthNamesList($selectedMonth);
        $timeTable = new Table($selectedMonth, $selectedYear);

        print_die($timeTable);

        $this->view->usersList = $timeTable->usersList;
        $this->view->monthNamesList = $monthNamesList;
        $this->view->yearsList = $timeTable->yearsList;
    }

}