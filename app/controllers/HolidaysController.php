<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\CreateHolidayForm;
use App\Models\Holidays;

class HolidaysController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Holidays');
    }

    public function indexAction(): void
    {
        $holidaysList = Holidays::find([
            'columns' => 'id, name, date, description',
        ]);
        $holidaysList = $holidaysList->toArray();

        foreach ($holidaysList as &$holiday) {
            $holiday['date'] = date('Y-m-d', (int)$holiday['date']);
        }
        $this->view->holidaysList = $holidaysList;
    }

    public function createAction(): void
    {
        $form = new CreateHolidayForm();
        $this->view->form = $form;

        if ($this->request->isPost()) {
            if ($form->isValid($_POST) === false) {
                $formMessages = $form->getMessages();

                foreach ($formMessages as $message) {
                    $this->flash->error($message->getMessage());
                }
            } else {
                $holiday = new Holidays();

                $holiday->name = $this->request->get('name', 'string');
                $holiday->date = strtotime($this->request->get('date', 'string'));
                $holiday->description = $this->request->get('description', 'string');
                $holiday->repeatable = $this->request->get('repeatable', 'alnum');

                if ($holiday->create() === false) {
                    $messages = $holiday->getMessages();

                    foreach ($messages as $message) {
                        $this->flash->error($message->getMessage());
                    }

                    return;
                } else {
                    $this->response->redirect('/holidays');
                }
            }
        }
    }
}