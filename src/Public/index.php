<?php

require_once __DIR__ . "/../autoload.php";
require_once "../Routing/Routing.php";

// Function to normalize URI for different environments
function normalizeUri(string $uri): string
{
    // Remove query string if present
    if (($pos = strpos($uri, '?')) !== false) {
        $uri = substr($uri, 0, $pos);
    }

    // Get the path
    $path = parse_url($uri, PHP_URL_PATH);

    // Handle Laragon subdirectory mode
    // If we're running from /project-name/public/index.php
    if (isset($_SERVER['SCRIPT_NAME'])) {
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);

        // If script is in a subdirectory (Laragon without virtual host)
        if ($scriptDir !== '/' && $scriptDir !== '\\' && $scriptDir !== '') {
            // Remove the script directory from the path
            if (strpos($path, $scriptDir) === 0) {
                $path = substr($path, strlen($scriptDir));
            }

            // Also try removing /project-name/public if still present
            $projectPath = dirname($scriptDir); // Should be /project-name
            if ($projectPath !== '/' && strpos($path, $projectPath) === 0) {
                $path = substr($path, strlen($projectPath));
            }
        }

        // Special case: If accessing via /project-name/public/index.php
        // The REQUEST_URI might be /project-name/public/index.php/login
        if (isset($_SERVER['PHP_SELF'])) {
            $basePath = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
            if ($basePath && strpos($path, $basePath) === 0) {
                $path = substr($path, strlen($basePath));
            }
        }
    }

    // Remove /public if it's at the start
    if (strpos($path, '/public/') === 0) {
        $path = substr($path, 7);
    }

    // Remove /index.php if present
    $path = str_replace('/index.php', '', $path);

    // Ensure it starts with /
    if ($path === '' || $path[0] !== '/') {
        $path = '/' . $path;
    }

    // Remove trailing slash (except for root)
    $path = rtrim($path, '/');

    return $path === '' ? '/' : $path;
}

// Load router
$router = Routing::load('routes.php');

// Get and normalize URI
$uri = $_SERVER['REQUEST_URI'] ?? '/';
$uri = normalizeUri($uri);

// Debug output (comment out in production)
if (isset($_GET['debug']) || (isset($_SERVER['HTTP_DEBUG']) && $_SERVER['HTTP_DEBUG'] === 'true')) {
    echo "<pre style='background:#f0f0f0;padding:10px;'>";
    echo "=== DEBUG INFO ===\n";
    echo "Raw REQUEST_URI: " . htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') . "\n";
    echo "SCRIPT_NAME: " . htmlspecialchars($_SERVER['SCRIPT_NAME'] ?? '') . "\n";
    echo "PHP_SELF: " . htmlspecialchars($_SERVER['PHP_SELF'] ?? '') . "\n";
    echo "Normalized URI: " . htmlspecialchars($uri) . "\n";
    echo "Method: " . htmlspecialchars($_SERVER['REQUEST_METHOD'] ?? 'GET') . "\n";
    echo "</pre>";
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    [$action, $params] = $router->direct($uri, $method);
    [$controller, $methodName] = explode('@', $action);

    $controller = "Controllers\\$controller";
    $controllerInstance = new $controller();

    call_user_func_array([$controllerInstance, $methodName], $params);
} catch (Exception $e) {
    // Show a helpful error page
    http_response_code(404);

    // Debug view
    if (isset($_GET['debug']) || (isset($_SERVER['HTTP_DEBUG']) && $_SERVER['HTTP_DEBUG'] === 'true')) {
        echo "<h2>Routing Error</h2>";
        echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><strong>Tried URI:</strong> " . htmlspecialchars($uri) . "</p>";

        // Show all routes for debugging
        echo "<h3>Available Routes:</h3>";
        echo "<pre>";
        // You might want to add a getRoutes() method to your Routing class
        // print_r($router->getRoutes());
        echo "</pre>";
    } else {
        // Production error page
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The requested page could not be found.</p>";
    }
}
