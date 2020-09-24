<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('UTC');
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

define('ANSWEROPEDIA', 'ANSWEROPEDIA');

require_once 'local-settings.php';
require_once 'vendor/autoload.php';

session_start(); // @TODO deprecate?

require_once __DIR__ . '/app/functions.php';

// Get lang code from URL
// $GLOBALS['lang_code'] = \Helper\Lang::getLangCodeFromURI();

// // Prepare the FileLoader
// $file_system = new \Illuminate\Filesystem\Filesystem();
// $loader = new \Illuminate\Translation\FileLoader($file_system, ROOT_PATH . '/lang');

// // Register the Translator
// $GLOBALS['illuminate_translation'] = new \Illuminate\Translation\Translator($loader, lang());

$app = (new AnsweropediaApp())->get_app();

$app->run();
