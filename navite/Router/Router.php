<?php

declare(strict_types=1);

namespace NaviteCore\Router;

use Exception;
use NaviteCore\Application\Application;
use NaviteCore\Container\Container;
use NaviteCore\Error\Errors;
use NaviteCore\Request\Request;
use NaviteCore\Response\Response;
use \NaviteCore\Router\RouterInterface;

class Router implements RouterInterface
{
    /**
     * This Store array of routes parameters
     * from the routing table.
     *
     * @var array
     */
    protected static array $routeMap = [];

    private Container $container;
    private Request $request;
    private Response $response;

    public function __construct(Container $container, Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
        $this->container = $container;
    }

    public function getRouteMap($method): array
    {
        return self::$routeMap[$method] ?? [];
    }

    public function getCallback()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        // Trim slashes
        $url = trim($url, '/');

        // Get all routes for current request method
        $routes = $this->getRouteMap($method);

        $routeParams = false;

        // Start iterating register routes
        foreach ($routes as $route => $callback) {
            // Trim slashes
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            // Find all route names from route and save in $routeNames
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            // Convert route name into regex pattern
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn ($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            // Test and match current route against $routeRegex
            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setParams($routeParams);
                return $callback;
            }
        }

        return false;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = self::$routeMap[$method][$url] ?? false;
        if (!$callback) {

            $callback = $this->getCallback();

            if ($callback === false) {
                throw new Exception(Errors::get('1001'), 1001);
            }
        }
        if (is_string($callback)) {
            // return View::make($callback);
        }

        if (is_callable($callback)) {
            return call_user_func($callback);
        }

        if (is_array($callback)) {

            [$class, $method] = $callback;

            if (class_exists($class)) {
                $class = $this->container->get($class);

                /** @var $controller Controller */
                $controller = $class;
                Application::$app->controller = $controller;

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], [$this->request, $this->response]);
                }
            }
        }
        throw new Exception(Errors::get('1000'), 1000);
    }
}