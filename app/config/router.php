<?php

$router = $di->getRouter();

$router->add(
    '/',
    [
        'namespace' => 'App\Controllers',
        'controller' => 'index',
        'action' => 'index',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
