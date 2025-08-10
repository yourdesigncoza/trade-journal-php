<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include autoloader
require_once __DIR__ . '/../includes/autoloader.php';

try {
    // Initialize and run application
    $app = App::getInstance();
    $app->run();
} catch (Exception $e) {
    error_log("Application Error: " . $e->getMessage());
    
    // Check if this is an API request
    if (strpos($_SERVER['REQUEST_URI'], '/api/') !== false) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Internal Server Error']);
    } else {
        http_response_code(500);
        echo "<h1>500 Internal Server Error</h1>";
        if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG']) {
            echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}