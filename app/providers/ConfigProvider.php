<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Exception;

class ConfigProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $configPath = APP_PATH . '/config/config.php';
        if(!file_exists($configPath) || !is_readable($configPath)) {
            throw new Exception("Config does not exist or not readable: " . $configPath);
        }

        $di->setShared('config', function () use ($configPath) {
            return require_once $configPath;
        });
    }
}