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
        'controller' => 'session',
        'action' => 'index',
    ]
);

$router->add(
    '/logout',
    [
        'controller' => 'session',
        'action' => 'logout'
    ]
);

$router->add(
    '/log',
    [
        'controller' => 'statistic',
        'action' => 'index',
    ]
);

$router->add(
    '/log/start',
    [
        'controller' => 'statistic',
        'action' => 'start',
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

$router->add(
    '/password',
    [
        'controller' => 'user',
        'action' => 'password',
    ]
);

$router->add(
    '/list',
    [
      'controller' => 'user',
      'action' => 'list',
    ]
);

$router->addPost(
    '/suspend/:params',
    [
        'controller' => 'user',
        'action' => 'manage',
        'params' => 1
    ]
);

$router->add(
    '/latecomers',
    [
        'controller' => 'latecomers',
        'action' => 'index',
    ]
);

$router->add(
    '/latecomers/settime',
    [
        'controller' => 'latecomers',
        'action' => 'setTime',
    ]
);

$router->add(
    '/holidays/create',
    [
        'controller' => 'holidays',
        'action' => 'create',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
