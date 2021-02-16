<?php

$assets = $di->getShared('assets');

$headerCollection = $assets->collection('headerCss');
$footerCollection = $assets->collection('footerJs');

$headerCollection->addCss('css/bootstrap.min.css');
$headerCollection->addCss('css/errors.css');
$headerCollection->addCss('css/styles.css');

$footerCollection->addJs('js/bootstrap.min.js');
$footerCollection->addJs('js/jquery-3.5.1.min.js');