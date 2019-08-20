<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('UTC');
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

define('ASKWIKI', 'ASKWIKI');

require_once 'local-settings.php';
require_once 'app/spl_autoload_register.php';
require_once 'vendor/autoload.php';

session_start(); // deprecate?

$app = (new AWApp())->getApp();

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);

    return $response
            ->withHeader('Access-Control-Allow-Origin', 'https://upload.answeropedia.org')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();
