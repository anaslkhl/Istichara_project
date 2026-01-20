<?php

class Routing
{
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    private $basePath = '';

    public static function load($file)
    {
        $router = new static;

        $router->detectBasePath();

        require $file;

        return $router;
    }

    public function get($url, $controller)
    {
        $url = $this->normalize($url);
        $this->routes['GET'][$url] = $controller;
    }

    public function post(string $url, string $controller)
    {
        $url = $this->normalize($url);
        $this->routes['POST'][$url] = $controller;
    }

    public function direct($uri, $method)
    {
        // Remove base path from URI if present
        $uri = $this->removeBasePath($uri);

        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('#\{[a-zA-Z]+\}#', '([0-9]+)', $route);

            if (preg_match("#^{$pattern}$#", $uri, $matches)) {
                array_shift($matches);
                return [$action, $matches];
            }
        }

        throw new Exception("No route defined for this URI: {$uri}");
    }

    private function normalize(string $url): string
    {
        $url = parse_url($url, PHP_URL_PATH);
        $url = str_replace('/index.php', '', $url);
        $url = rtrim($url, '/');

        // Remove base path from defined routes
        if ($this->basePath && strpos($url, $this->basePath) === 0) {
            $url = substr($url, strlen($this->basePath));
        }

        return $url === '' ? '/' : $url;
    }

    private function detectBasePath(): void
    {
        // For Docker: No base path
        // For Laragon without virtual host: /project-name/public

        if (isset($_SERVER['REQUEST_URI'])) {
            $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
            $requestUri = $_SERVER['REQUEST_URI'];

            // If using Laragon without virtual host
            // SCRIPT_NAME will be like: /istichara/public/index.php
            if (strpos($scriptName, '/public/index.php') !== false) {
                $this->basePath = str_replace('/public/index.php', '', $scriptName);
            }

            // Alternative detection from REQUEST_URI
            if (!$this->basePath && strpos($requestUri, '/public/') !== false) {
                $parts = explode('/public/', $requestUri);
                $this->basePath = $parts[0];
            }
        }
    }

    private function removeBasePath(string $uri): string
    {
        if ($this->basePath && strpos($uri, $this->basePath) === 0) {
            $uri = substr($uri, strlen($this->basePath));
        }

        // Remove /public if it's still there
        if (strpos($uri, '/public/') === 0) {
            $uri = substr($uri, 7);
        }

        $uri = rtrim($uri, '/');
        return $uri === '' ? '/' : $uri;
    }

    // Helper method for debugging
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    // Helper method to get all routes (for debugging)
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
