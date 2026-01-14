<?php


class Routing
{

    public $routes = [
        'GET' => [],
        'POST'=> []
    ];



    public static function load($file)
    {
        $router = new static;
        require $file;

        return $router;
    }

    public function get($url, $controller)
    {
        $this->routes['GET'][$this->normalize($url)] = $controller;
    }

    public function post(string $url,string $controller)
    {
        $this->routes['POST'][$this->normalize($url)] = $controller;
    }

    public function direct(string $url,string $requestType)
    {

        if (array_key_exists( $url, $this->routes[$requestType])) {
            return $this->routes[$requestType][$url];
        }
    }

    private function normalize(string $url): string
    {
        $url = parse_url($url, PHP_URL_PATH);
        $url = str_replace('/index.php', '', $url);
        $url = rtrim($url, '/');

        return $url === '' ? '/' : $url;
    }
}
