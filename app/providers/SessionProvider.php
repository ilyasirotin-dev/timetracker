<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;

class SessionProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('session', function () {
            $session = new SessionManager();
            $sessionSave = new SessionAdapter(
                [
                    'savePath' => sys_get_temp_dir(),
                ]
            );
            $session->setAdapter($sessionSave);
            $session->start();

            return $session;
        });
    }
}