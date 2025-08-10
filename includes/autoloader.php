<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/../src/';
    
    // Convert class name to file path
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = $baseDir . $classPath . '.php';
    
    // Check if file exists and include it
    if (file_exists($file)) {
        require $file;
        return true;
    }
    
    // Try different locations for core classes
    $locations = [
        $baseDir . 'Core/' . $class . '.php',
        $baseDir . 'Models/' . $class . '.php',
        $baseDir . 'Controllers/' . $class . '.php',
    ];
    
    foreach ($locations as $location) {
        if (file_exists($location)) {
            require $location;
            return true;
        }
    }
    
    return false;
});