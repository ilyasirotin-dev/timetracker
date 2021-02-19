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
    '/user',
    [
        'controller' => 'user',
        'action' => 'index',
    ]
);

$router->add(
    '/admin',
    [
        'controller' => 'admin',
        'action' => 'index',
    ]
);

$router->add(
    '/admin/create',
    [
        'controller' => 'user',
        'action' => 'create',
    ]
);

$router->addPost(
    'admin/suspend/:params',
    [
        'controller' => 'admin',
        'action' => 'suspend',
        'params' => 1
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
