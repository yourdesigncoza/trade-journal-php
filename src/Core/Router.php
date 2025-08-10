<?php

class Router
{
    private $routes = [];
    
    public function __construct()
    {
        $this->registerRoutes();
    }
    
    private function registerRoutes()
    {
        // Main application route
        $this->routes['GET']['/'] = [HomeController::class, 'index'];
        $this->routes['GET']['/index.php'] = [HomeController::class, 'index'];
        
        // API routes - these should be handled by Router when .htaccess fails
        $this->routes['GET']['/api/trading-journal'] = [ApiController::class, 'getEntries'];
        $this->routes['GET']['/api/trading-journal/html'] = [ApiController::class, 'getEntriesHtml'];
        $this->routes['POST']['/api/trading-journal'] = [ApiController::class, 'createEntry'];
        $this->routes['PUT']['/api/trading-journal'] = [ApiController::class, 'updateEntry'];
        $this->routes['DELETE']['/api/trading-journal'] = [ApiController::class, 'deleteEntry'];
        
        // Fallback API routes without leading slash
        $this->routes['GET']['api/trading-journal'] = [ApiController::class, 'getEntries'];
        $this->routes['GET']['api/trading-journal/html'] = [ApiController::class, 'getEntriesHtml'];
        $this->routes['POST']['api/trading-journal'] = [ApiController::class, 'createEntry'];
        $this->routes['PUT']['api/trading-journal'] = [ApiController::class, 'updateEntry'];
        $this->routes['DELETE']['api/trading-journal'] = [ApiController::class, 'deleteEntry'];
    }
    
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $this->getUri();
        
        // Check for exact match first
        if (isset($this->routes[$method][$uri])) {
            $this->callController($this->routes[$method][$uri]);
            return;
        }
        
        // Check for API routes with query parameters
        if (strpos($uri, '/api/trading-journal') === 0) {
            $baseUri = '/api/trading-journal';
            
            // Check for HTML endpoint first
            if ($uri === '/api/trading-journal/html' && isset($this->routes[$method][$uri])) {
                $this->callController($this->routes[$method][$uri]);
                return;
            }
            
            // Check for base endpoint with query params
            if (isset($this->routes[$method][$baseUri])) {
                $this->callController($this->routes[$method][$baseUri]);
                return;
            }
        }
        
        // 404 Not Found
        $this->notFound();
    }
    
    private function getUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Get the base path of the application
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);
        
        // Remove the application directory from the URI if present
        if ($scriptDir !== '/' && $scriptDir !== '\\') {
            // Remove the base directory from the URI
            if (strpos($uri, $scriptDir) === 0) {
                $uri = substr($uri, strlen($scriptDir));
            }
        }
        
        // Clean up the URI
        $uri = '/' . ltrim($uri, '/');
        
        // Handle index.php in the URL
        if ($uri === '/index.php' || $uri === '/') {
            return '/';
        }
        
        return $uri;
    }
    
    private function callController($handler)
    {
        list($controllerClass, $method) = $handler;
        
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $method)) {
                $controller->$method();
                return;
            }
        }
        
        $this->notFound();
    }
    
    private function notFound()
    {
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }
}