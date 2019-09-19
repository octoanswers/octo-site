<?php

/**
 * @return bool
 */
spl_autoload_register(function ($class_name) {
    $class_map = [

        'SlimApp' => 'app/SlimApp.php',

        // Helpers

        'Lang'              => 'app/Helper/Lang.php',

    ];

    if (array_key_exists($class_name, $class_map)) {
        if (file_exists($class_map[$class_name])) {
            require_once $class_map[$class_name];
            if (class_exists($class_name)) {
                return true;
            }
        }
    }

    // Auto-include classes as Show_Question_PageController
    if (strpos($class_name, '_') !== false) {
        $pieces = explode('_', $class_name);
        $pathPieces = array_reverse($pieces);
        $classPath = 'app/' . implode('/', $pathPieces) . '.php';

        if (file_exists($classPath)) {
            require_once $classPath;
            if (class_exists($class_name)) {
                return true;
            }
        }
    }

    return false;
});
