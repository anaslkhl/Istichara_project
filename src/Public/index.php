<?php

if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/istichara/public') === 0) {
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen('/istichara/public'));
}

require_once __DIR__ . "/../autoload.php";
require_once "../Routing/Routing.php";

$router = Routing::load('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

[$action, $params] = $router->direct($uri, $method);
[$controller, $methodName] = explode('@', $action);

$controller = "Controllers\\$controller";
$controllerInstance = new $controller();

call_user_func_array([$controllerInstance, $methodName], $params); 