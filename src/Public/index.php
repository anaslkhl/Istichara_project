<?php

require_once __DIR__ . "/../autoload.php";

require_once "../Routing/Routing.php";

$router = Routing::load('routes.php');


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = $router->direct($url, $requestMethod);


// var_dump($url ,$requestMethod , $action);
// exit;

if (!$action) {
    http_response_code(404);
    die('404 - file not found !');
}

[$controller, $method] = explode('@', $action);

if (class_exists($controller)) {
    $controllerInstance = new $controller();

    if (method_exists($controllerInstance, $method)) {
        $controllerInstance->$method();
    } else {
        die("Method '$method' does not exist in controller '$controller'");
    }
} else {
    die("Controller class '$controller' does not exist");
}


echo 'hello everyone';
