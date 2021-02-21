<?php
declare(strict_types=1);

namespace App\Controllers;


class ErrorController extends ControllerBase
{
    protected function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Error');
    }

    public function show404Action(): void
    {
        $this->response->setStatusCode(404);
    }

    public function show401Action(): void
    {
        $this->response->setStatusCode(401);
    }

    public function show500Action(): void
    {
        $this->response->setStatusCode(500);
    }
}
