<?php


class Routing
{

    public $routes = [
        'GET' => [],
        'POST' => []
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

    public function post(string $url, string $controller)
    {
        $this->routes['POST'][$this->normalize($url)] = $controller;
    }

    public function direct($uri, $method)
    {
        foreach ($this->routes[$method] as $route => $action) {

            $pattern = preg_replace('#\{[a-zA-Z]+\}#', '([0-9]+)', $route);

            if (preg_match("#^{$pattern}$#", $uri, $matches)) {
                array_shift($matches);
                return [$action, $matches];
            }
        }

        throw new Exception("No route defined for this URI");
    }

    private function normalize(string $url): string
    {
        $url = parse_url($url, PHP_URL_PATH);
        $url = str_replace('/index.php', '', $url);
        $url = rtrim($url, '/');

        return $url === '' ? '/' : $url;
    }
}
