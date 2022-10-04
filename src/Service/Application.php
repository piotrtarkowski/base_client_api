<?php

namespace BaseClientApi\Service;


class Application
{
    private array $routes;

    private string $routePath = '';

    public function __construct()
    {
        $this->routePath = dirname(__DIR__) . '/Router/';

        $this->initRoute();
    }

    private function initRoute()
    {
        $routeFile = scandir($this->routePath);

        foreach ($routeFile as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            if (is_dir($this->routePath) && file_exists($this->routePath . $file)) {
                $routerList = require $this->routePath . $file;

                foreach ($routerList as $routeName => $routeItem) {

                    $route = new Route();
                    $route->setName($routeName);
                    $route->setRoute($routeItem['route']);
                    $route->setClass($routeItem['controller']);
                    $route->setAction($routeItem['action']);
                    if (array_key_exists('constraints', $routeItem)) {
                        $route->setConstraints($routeItem['constraints']);
                    }

                    $this->routes[$routeName] = $route;
                }

            }
        }
    }

    private function prePattern($pattern, $constraints)
    {
        $pattern = str_replace('/', '\/', $pattern);
        if (is_null($constraints)) {
            return "/^" . $pattern . "/";
        }

        foreach ($constraints as $key => $value) {
            $pattern = str_replace('{' . $key . '}', '(?P<' . $key . '>' . $value . ')', $pattern);
        }

        return '/' . $pattern . '/';
    }

    private function matchRoute($urlRequest)
    {
        $filterRoute = array_filter($this->routes, function (Route $route) use ($urlRequest) {
            $pattern = $this->prePattern($route->getRoute(), $route->getConstraints());

            preg_match($pattern, $urlRequest, $matches);
            if (!empty($route->getConstraints())) {
                foreach ($route->getConstraints() as $paramKey => $paramValue) {
                    if (isset($matches[$paramKey])) {

                        $route->addParams($paramKey, $matches[$paramKey]);
                    }
                }
            }


            return !empty($matches) && $matches[0] === $urlRequest;
        });

        if (!empty($filterRoute) && is_array($filterRoute)) {
            return $filterRoute[array_key_first($filterRoute)];
        }

        throw new \Exception('Podany adres url nie istnieje', 404);
    }

    public function run(string $urlRequest)
    {
        $route = $this->matchRoute($urlRequest);

        $className = $route->getClass();
        $obj = new $className();
        call_user_func_array([$obj, $route->getAction()], $route->getParams());

    }
}