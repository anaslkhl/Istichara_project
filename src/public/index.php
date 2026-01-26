<?php

require_once __DIR__ . "/../autoload.php";
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../Routing/Routing.php";
// Get URI and fix Laragon paths
$uri = $_SERVER['REQUEST_URI'] ?? '/';

require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../autoload.php';


// 3️⃣ Charger le router
require_once __DIR__ . '/../Routing/Routing.php';

// 4️⃣ Récupérer l’URI
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Remove query string
// Supprimer les query params
if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}

// Fix for Laragon subdirectory
if (strpos($uri, '/istichara/public') === 0) {
    $uri = substr($uri, strlen('/istichara/public'));
}
// for abdelhafid problem
if (strpos($uri, '/Istichara_project') === 0) {
    $uri = substr($uri, strlen('/Istichara_project'));
    // Corriger les chemins Laragon / Docker
    $basePaths = [
        '/istichara/public',
        '/Istichara_project',
        '/index.php'
    ];

    foreach ($basePaths as $base) {
        if (strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }
    }

    // Ensure not empty
    if ($uri === '') {
        $uri = '/';
    }
    // for abdellah problem, plz dont remove it
    if ($uri === '/index.php') {
        $uri = '/';
    }

    // Debug mode
    // Debug optionnel
    if (isset($_GET['debug'])) {
        echo "<pre>Debug: $uri</pre>";
        echo "<pre>URI: $uri</pre>";
    }

    // 5️⃣ Routing
    try {
        $router = Routing::load(__DIR__ . '/../Routing/routes.php');
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        //var_dump([$method, $uri]);exit;

        [$action, $params] = $router->direct($uri, $method);
        [$controller, $methodName] = explode('@', $action);

        $controller = "Controllers\\$controller";
        $controllerInstance = new $controller();
        [$controller, $methodName] = explode('@', $action);
        $controllerClass = "Controllers\\$controller";

        $controllerInstance = new $controllerClass();
        call_user_func_array([$controllerInstance, $methodName], $params);
    } catch (Exception $e) {
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
