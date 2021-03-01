<?php
declare(strict_types=1);

namespace App\Plugins;

use Exception;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

class ExceptionPlugin extends Injectable
{
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        if ($exception instanceof DispatcherException) {
            switch ($exception->getCode()) {
                case DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
                case DispatcherException::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
                        'controller' => 'error',
                        'action' => 'show404',
                    ]);

                    return false;
            }
        }

        if ($dispatcher->getControllerName() !== 'error') {
            $dispatcher->forward([
                'controller' => 'error',
                'action' => 'show500',
            ]);
        }

        return !$event->isStopped();
    }
}
