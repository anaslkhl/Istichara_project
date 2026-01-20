<?php
// src/public/index.php - UPDATED WITH DEBUG

// DEBUG MODE - add ?debug=1 to any URL
$debug = isset($_GET['debug']);

if ($debug) {
    echo "<pre style='background:#f0f0f0;padding:10px;border:1px solid #ccc;'>";
    echo "=== ROUTING DEBUG ===\n";
    echo "REQUEST_URI (raw): " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
    echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "\n";
    echo "PHP_SELF: " . ($_SERVER['PHP_SELF'] ?? 'N/A') . "\n";
}

require_once __DIR__ . "/../autoload.php";
require_once "../Routing/Routing.php";

$router = Routing::load('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($debug) {
    echo "URI after parse_url: " . htmlspecialchars($uri) . "\n";
    echo "Method: $method\n";
    echo "---\n";
}

try {
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
    http_response_code(404);
    
    if ($debug) {
        echo "❌ Route NOT FOUND\n";
        echo "Error: " . htmlspecialchars($e->getMessage()) . "\n";
        echo "URI attempted: " . htmlspecialchars($uri) . "\n";
        
        // Show available routes
        echo "\nAvailable routes for $method:\n";
        // We need to add a getRoutes method to Routing class
        echo "Add this to your Routing class:\n";
        echo "public function getRoutes() { return \$this->routes; }\n";
        echo "</pre>";
    } else {
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The page you requested was not found.</p>";
        echo '<p><small><a href="?debug=1">Debug routing</a> | <a href="/">Go home</a></small></p>';
    }
}