<?php

$router = $di->getRouter();

$router->add(
    '/',
    [
        'namespace' => 'App\Controllers',
        'controller' => 'session',
        'action' => 'index',
    ]
);

$router->add(
    '/send',
    [
        'namespace' => 'App\Controllers',
        'controller' => 'session',
        'action' => 'send',
    ]
);

$router->add(
    '/user',
    [
        'namespace' => 'App\Controllers',
        'controller' => 'user',
        'action' => 'index',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
