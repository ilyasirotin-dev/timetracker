<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;

class ViewProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $config = $di->getShared('config');
        $viewsDir = $config->application->viewsDir;
        $partialsDir = $config->application->partialsDir;

        $di->setShared('view', function () use($viewsDir, $partialsDir) {
            $view = new View();
            $view->setViewsDir($viewsDir);
            $view->setPartialsDir($partialsDir);
            $view->registerEngines(
                [
                    '.volt' => 'volt'
                ]
            );

            return $view;
        });
    }
}