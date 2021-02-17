<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use \Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     *  Register Providers
     */
    $providersPath = APP_PATH . '/config/providers.php';
    if (!file_exists($providersPath) || !is_readable($providersPath)) {
        throw new Exception("File providers.php does not exists or is not readable.");
    }

    /**
     * @var Array $providers
     */
    $providers = include_once $providersPath;
    foreach ($providers as $service) {
        $di->register(new $service());
    }

    /**
     * Include routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Add assets
     */
    include APP_PATH . '/config/assets.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
