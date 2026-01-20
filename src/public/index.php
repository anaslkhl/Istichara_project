<?php
// src/public/index.php - UPDATED WITH PROPER LARAGON SUPPORT

// ========== ENABLE DEBUGGING ==========
$debug = isset($_GET['debug']) || isset($_SERVER['HTTP_DEBUG']);

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    
    echo "<pre style='background:#f0f0f0;padding:10px;border:1px solid #ccc;'>";
    echo "=== LARAGON/APACHE DEBUG ===\n";
    echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
    echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "\n";
    echo "SCRIPT_FILENAME: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'N/A') . "\n";
    echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
    echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";
}

// ========== FIX LARAGON URL PATHS ==========
function getNormalizedUri(): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    
    // Remove query string
    if (($pos = strpos($uri, '?')) !== false) {
        $uri = substr($uri, 0, $pos);
    }
    
    // Debug original URI
    if ($debug) {
        echo "Original URI: $uri\n";
    }
    
    // Handle different Laragon access methods:
    
    // 1. Virtual host: http://istichara.test/dashboard
    //    → URI is already clean: /dashboard
    
    // 2. Subdirectory: http://localhost/istichara/public/dashboard
    //    → Need to remove /istichara/public
    
    // 3. Direct: http://localhost/istichara/src/public/dashboard
    //    → Need to remove /istichara/src/public
    
    $possiblePrefixes = [
        '/istichara/public',      // Laragon subdirectory
        '/istichara/src/public',  // Direct access
        '/public',                // If in public folder directly
        '/istichara',             // Root of project
    ];
    
    foreach ($possiblePrefixes as $prefix) {
        if (strpos($uri, $prefix) === 0) {
            $uri = substr($uri, strlen($prefix));
            if ($debug) {
                echo "Removed prefix '$prefix', new URI: $uri\n";
            }
            break;
        }
    }
    
    // Also handle direct index.php in URL
    if (strpos($uri, '/index.php') === 0) {
        $uri = substr($uri, 10); // Remove '/index.php'
    }
    
    // Ensure root path
    if ($uri === '' || $uri === '/index.php') {
        $uri = '/';
    }
    
    // Remove trailing slash (except root)
    $uri = rtrim($uri, '/');
    if ($uri === '') {
        $uri = '/';
    }
    
    if ($debug) {
        echo "Normalized URI: $uri\n";
    }
    
    return $uri;
}

// ========== LOAD ROUTER ==========
try {
    require_once __DIR__ . "/../autoload.php";
    require_once __DIR__ . "/../Routing/Routing.php";
    
    $router = Routing::load(__DIR__ . '/../Routing/routes.php');
    $uri = getNormalizedUri();
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    
    if ($debug) {
        echo "Method: $method\n";
        echo "---\n";
    }
    
    [$action, $params] = $router->direct($uri, $method);
    [$controller, $methodName] = explode('@', $action);
    
    $controller = "Controllers\\$controller";
    
    if ($debug) {
        echo "✅ Route matched!\n";
        echo "Controller: $controller\n";
        echo "Method: $methodName\n";
        echo "Params: ";
        print_r($params);
        echo "</pre>";
    }
    
    $controllerInstance = new $controller();
    call_user_func_array([$controllerInstance, $methodName], $params);
    
} catch (Exception $e) {
    if ($debug) {
        echo "❌ Route error: " . htmlspecialchars($e->getMessage()) . "\n";
        echo "Available routes for $method:\n";
        
        // Show available routes
        if (isset($router) && method_exists($router, 'getRoutes')) {
            $routes = $router->getRoutes();
            if (isset($routes[$method])) {
                foreach ($routes[$method] as $route => $action) {
                    echo "  $route => $action\n";
                }
            }
        }
        echo "</pre>";
    }
    
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo '<p><a href="/">Go Home</a> | <a href="/?debug=1">Debug</a></p>';
}