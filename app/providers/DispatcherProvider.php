<?php

namespace App\Providers;

use App\Plugins\ExceptionPlugin;
use App\Plugins\SecurityPlugin;
use Phalcon\Events\Manager as EventManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DispatcherProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('dispatcher', function () {
            $eventsManager = new EventManager();

            /**
             *  Acl plugin
             */
            $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);


            /**
             *  Http exceptions handler
             */
            $eventsManager->attach('dispatch:beforeException', new ExceptionPlugin);


            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('App\Controllers');
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}