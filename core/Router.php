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
        $uriParts = explode('/', $uri);
        foreach ($this->routes[$method] as $route => $controller) 
        {
            $routeParts = explode('/', $route);
            if ($route == $uri)
            {
                if ($method == 'POST') 
                {
                    $this->callAction(explode('@', $controller)[0], explode('@', $controller)[1], [(object)$_POST]);
                } 
                else 
                {
                    $this->callAction(...explode('@', $controller));
                }
                
                return;
            }
            else if (count($routeParts) == count($uriParts))
            {
                $params = [];
                for ($i = 0; $i < count($routeParts); $i++)
                {
                    if (preg_match('/\{\w+\}/', $routeParts[$i]))
                    {
                        $params[trim($routeParts[$i], '{}')] = $uriParts[$i];
                    }
                    else if ($uriParts[$i] != $routeParts[$i])
                    {
                        continue 2;
                    }
                }

                $this->callAction(explode('@', $controller)[0], explode('@', $controller)[1], $params);
                return;
            }
        }
        
        return view('error404');
    }

    private function callAction($controller, $action, $params = [])
    {
        $controller = "Controllers\\$controller";
        $controller = new $controller;

        if (! method_exists($controller, $action))
        {
            throw new \Exception('Controller does not exists');
        }

        return $controller->$action(...array_values($params));
    }
}