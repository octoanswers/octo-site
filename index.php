<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('UTC');
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

define('ANSWEROPEDIA', 'ANSWEROPEDIA');

require_once 'local-settings.php';
require_once 'vendor/autoload.php';

session_start(); // deprecate?

require_once __DIR__ . '/app/functions.php';

// Get lang code from URL
// $GLOBALS['lang_code'] = \Helper\Lang::get_lang_code_from_URI();

// // Prepare the FileLoader
// $file_system = new \Illuminate\Filesystem\Filesystem();
// $loader = new \Illuminate\Translation\FileLoader($file_system, ROOT_PATH . '/lang');

// // Register the Translator
// $GLOBALS['illuminate_translation'] = new \Illuminate\Translation\Translator($loader, lang());

$app = (new SlimApp())->get_app();

// $app->add(function ($req, $res, $next) {
//     $response = $next($req, $res);

//     return $response
//         ->withHeader('Access-Control-Allow-Origin', 'https://upload.answeropedia.org')
//         ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
//         ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
// });

$app->run();
