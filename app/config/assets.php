<?php

$assets = $di->getShared('assets');

$headerCollectionCss = $assets->collection('headerCss');
$footerCollectionJs = $assets->collection('footerJs');

$headerCollectionCss->addCss('css/bootstrap.min.css');
$headerCollectionCss->addCss('css/errors.css');

$footerCollectionJs->addJs('js/jquery-3.5.1.min.js');
$footerCollectionJs->addJs('js/bootstrap.min.js');
$footerCollectionJs->addJs('js/script.js');