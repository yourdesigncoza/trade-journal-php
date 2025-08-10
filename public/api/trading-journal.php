<?php

// Alternative API entry point (for servers that don't support URL rewriting)
require_once __DIR__ . '/../../includes/autoloader.php';

try {
    $app = App::getInstance();
    $apiController = new ApiController();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'GET':
            $apiController->getEntries();
            break;
        case 'POST':
            $apiController->createEntry();
            break;
        case 'PUT':
            $apiController->updateEntry();
            break;
        case 'DELETE':
            $apiController->deleteEntry();
            break;
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    }
} catch (Exception $e) {
    error_log("API Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Internal Server Error']);
}