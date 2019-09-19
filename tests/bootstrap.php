<?php

define('ASKWIKI', 'ASKWIKI');

require_once './app/spl_autoload_register.php';

require_once './local-settings.test.php';
require_once 'tests/Abstract_DB_TestCase.php';
require_once 'tests/Abstract_Frontend_TestCase.php';

// load composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';
