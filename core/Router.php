<?php

namespace Core;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public static function load($routesFile)
    {
        $router = new self();

        require $routesFile;

        return $router;
    }

    public function direct($uri, $method)
    {
        if (! array_key_exists($uri, $this->routes[$method])) 
        {
            throw new \Exception('That route are not define');
        }

        $this->callAction(
            ...explode('@', $this->routes[$method][$uri])
        );
    }

    private function callAction($controller, $action)
    {
        require "app/controllers/$controller.php";

        $controller = "Controllers\\$controller";
        $controller = new $controller;

        if (! method_exists($controller, $action))
        {
            throw new \Exception('Controller does not exists');
        }

        return $controller->$action();
    }
}