<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\CreateHolidayForm;

class HolidaysController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
    }

    public function indexAction(): void
    {

    }

    public function createAction(): void
    {
        $form = new CreateHolidayForm();
        $this->view->form = $form;
    }
}