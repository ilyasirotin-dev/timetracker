<?php

$router = $di->getRouter();

$router->setDefaultNamespace(
    'App\Controllers'
);

$router->add(
    '/',
    [
        'controller' => 'index',
        'action' => 'index',
    ]
);

$router->add(
    '/login',
    [
        'controller' => 'login',
        'action' => 'index',
    ]
);

$router->add(
    '/log',
    [
        'controller' => 'timetable',
        'action' => 'index',
    ]
);

$router->add(
    '/account',
    [
        'controller' => 'user',
        'action' => 'changePassword',
    ]
);

$router->add(
    '/create',
    [
        'controller' => 'user',
        'action' => 'create',
    ]
);

$router->addPost(
    'admin/suspend/:params',
    [
        'controller' => 'user',
        'action' => 'suspend',
        'params' => 1
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
