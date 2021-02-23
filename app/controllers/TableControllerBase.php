<?php
declare(strict_types=1);

namespace App\Controllers;


use App\Helpers\DateRelatedHelpers;
use App\Helpers\DbRelatedHelpers;

class TableControllerBase extends ControllerBase
{
    public $selectedYear;
    public $selectedMonth;
    public $table;

    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Log');
    }

    public function indexAction()
    {
        $this->view->monthList = DateRelatedHelpers::getMonthList();
        $yearsRange = DbRelatedHelpers::getYearsFromDb();
        $this->view->yearsList = DateRelatedHelpers::getYearsList($yearsRange['min'], $yearsRange['max']);

        if ($this->request->isPost()) {
            $this->selectedMonth = $this->request->get('month', 'string');
            $this->selectedYear = $this->request->get('year', 'alnum');

        } else {
            $this->selectedMonth = date('m');
            $this->selectedYear = date('Y');
        }

        $this->view->selectedMonth = $this->selectedMonth;
        $this->view->selectedYear = $this->selectedYear;
    }
}