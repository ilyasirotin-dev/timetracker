<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\DateGenerator;
use App\Helpers\TimeTable;

class UserController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('User');
        $this->view->setTemplateAfter('panel');
    }

    public function indexAction()
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
}
