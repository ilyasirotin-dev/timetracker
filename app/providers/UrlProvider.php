<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Url;

class UrlProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $baseUrl = $di->getShared('config')->application->baseUri;
        $di->setShared('url', function () use ($baseUrl) {
            $url = new Url();
            $url->setBaseUri($baseUrl);

            return $url;
        });
    }
}