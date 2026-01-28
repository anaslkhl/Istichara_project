<?php

require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();



require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../autoload.php';



require_once __DIR__ . '/../Routing/Routing.php';


$uri = $_SERVER['REQUEST_URI'] ?? '/';


if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}


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

if ($uri === '') {
    $uri = '/';
}

// Debug optionnel
if (isset($_GET['debug'])) {
    echo "<pre>URI: $uri</pre>";
}

// 5️⃣ Routing
try {
    $router = Routing::load(__DIR__ . '/../Routing/routes.php');
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    [$action, $params] = $router->direct($uri, $method);

    [$controller, $methodName] = explode('@', $action);
    $controllerClass = "Controllers\\$controller";

    $controllerInstance = new $controllerClass();
    call_user_func_array([$controllerInstance, $methodName], $params);

} catch (Exception $e) {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
