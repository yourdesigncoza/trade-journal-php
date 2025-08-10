<?php

class App
{
    private static $instance = null;
    private $config = [];
    
    private function __construct()
    {
        $this->loadEnvironment();
        $this->loadConfig();
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function loadEnvironment()
    {
        $envFile = __DIR__ . '/../../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
                
                if (!array_key_exists($name, $_ENV)) {
                    $_ENV[$name] = $value;
                }
            }
        }
    }
    
    private function loadConfig()
    {
        $configDir = __DIR__ . '/../../config/';
        $configFiles = ['app', 'database'];
        
        foreach ($configFiles as $file) {
            $filePath = $configDir . $file . '.php';
            if (file_exists($filePath)) {
                $this->config[$file] = require $filePath;
            }
        }
    }
    
    public function config($key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->config;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        
        return $value;
    }
    
    public function run()
    {
        $router = new Router();
        $router->dispatch();
    }
}