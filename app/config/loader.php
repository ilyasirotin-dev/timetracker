<?php

$loader = new \Phalcon\Loader();

/**
 * Registering a set of app files
 */
$loader->registerFiles(
    [
        APP_PATH . '/library/print_debug.php',
    ]
);

/**
 * Registering a set of app namespaces
 */
$loader->registerNamespaces(
    [
        'App'                   => APP_PATH,
        'App\Controllers'       => APP_PATH . '/controllers',
        'App\Models'            => APP_PATH . '/models',
        'App\Providers'         => APP_PATH . '/providers',
        'App\Plugins'           => APP_PATH . '/plugins',
        'App\Forms'             => APP_PATH . '/forms',
        'App\Helpers'           => APP_PATH . '/helpers',
        'App\Helpers\Tables'    => APP_PATH . '/helpers/tables',
    ]
);

$loader->register();
