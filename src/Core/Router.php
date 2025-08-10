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
        
        // API routes
        $this->routes['GET']['/api/trading-journal'] = [ApiController::class, 'getEntries'];
        $this->routes['POST']['/api/trading-journal'] = [ApiController::class, 'createEntry'];
        $this->routes['PUT']['/api/trading-journal'] = [ApiController::class, 'updateEntry'];
        $this->routes['DELETE']['/api/trading-journal'] = [ApiController::class, 'deleteEntry'];
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
        
        // Remove script name from URI if present
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }
        
        return $uri ?: '/';
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