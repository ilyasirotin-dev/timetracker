<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DbProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $dbConfig = $di->getShared('config')->get('database');
        $di->setShared('db', function () use ($dbConfig){
            $adapter = 'Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            unset ($dbConfig['adapter']);
            unset ($dbConfig['charset']);

            return new $adapter($dbConfig);
        });
    }
}