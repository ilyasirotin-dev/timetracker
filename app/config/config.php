<?php

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'mysql',
        'username'    => 'root',
        'password'    => 'passwd',
        'dbname'      => 'timetracker',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'viewsDir'       => APP_PATH . '/views/',
        'partialsDir'    => APP_PATH . '/views/partials/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ],
    'roles' => [
        'Admin',
        'User',
        'Guest',
    ],
    'components' => [
        'error' => [
            'show404',
            'show500',
            'show401',
        ],
        'holidays' => [
            'index',
            'create',
        ],
        'index' => [
            'index',
        ],
        'latecomers' => [
            'index',
            'setTime',
            'delete',
        ],
        'log' => [
            'index',
            'start',
            'stop',
            'update',
        ],
        'session' => [
            'index',
            'logout',
            'register',
        ],
        'user' => [
            'list',
            'create',
            'suspend',
            'password',
        ],
    ],
    'accesslist' => [
        'Guest' => [
            'error' => [
                'show404',
                'show500',
                'show401',
            ],
            'index' => [
                'index',
            ],
            'session' => [
                'index',
            ]
        ],
        'Admin' => [
            'holidays' => [
                'index',
                'create',
            ],
            'latecomers' => [
                'index',
                'setTime',
                'delete',
            ],
            'log' => [
                'index',
                'start',
                'stop',
                'update',
            ],
            'session' => [
                'logout',
                'register',
            ],
            'user' => [
                'list',
                'create',
                'suspend',
                'password',
            ],
        ],
        'User' => [
            'holidays' => [
                'index',
            ],
            'log' => [
                'index',
                'start',
                'stop',
            ],
            'session' => [
                'index',
                'logout',
                'register',
            ],
            'user' => [
                'password',
            ],
        ],
    ],
]);
