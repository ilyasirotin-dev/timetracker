<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Escaper;
use Phalcon\Flash\Direct as FlashDirect;

class FlashProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('flash', function () {
            $escaper = new Escaper();
            $flash = new FlashDirect($escaper);
            $flash->setImplicitFlush(false);
            $flash->setCssClasses([
                'error' => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
                'warning' => 'alert alert-warning',
            ]);

            return $flash;
        });
    }
}