<?php

namespace App\Router;

use App\Http\Controllers\HomeController;

class Router {

    public static function getURI() : array
    {
        $path_info = $_SERVER['REQUEST_URI'] ?? '/';
        $routes = explode('/', $path_info);
        unset($routes[0]);

        return array_values($routes);
    }

    private static function processURI() : array
    {
        $controllerPart = self::getURI()[0] ?? '';
        $methodPart = self::getURI()[1] ?? '';
        $numParts = count(self::getURI());
        $argsPart = [];

        for ($i = 2; $i < $numParts; $i++) {
            $argsPart[] = self::getURI()[$i] ?? '';
        }

        $controller = !empty($controllerPart) ?
            'App\\Http\\Controllers\\'. ucwords($controllerPart) . 'Controller' :
            'App\\Http\\Controllers\\HomeController';

        if ($controllerPart === 'keyresult') {
            $controller = 'App\\Http\\Controllers\\KeyResultController';
        }

        $method = !empty($methodPart) ?
            $methodPart :
            'index';

        $args = !empty($argsPart) ?
            $argsPart :
            [];

        return [
            'controller' => $controller,
            'method' => $method,
            'args' => $args
        ];
    }

    public static function contentToRender()
    {
        $uri = self::processURI();

        if (class_exists($uri['controller'])) {
            $controller = $uri['controller'];
            $method = $uri['method'];
            $args = $uri['args'];

            $args ? (new $controller)->{$method}(...$args) :
                (new $controller)->{$method}();
            die;
        }

        (new HomeController)->{'fail'}();
    }
}
