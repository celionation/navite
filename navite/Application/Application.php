<?php

declare(strict_types=1);

namespace NaviteCore\Application;

use Exception;
use NaviteCore\Container\Container;
use NaviteCore\Router\Router;
use NaviteCore\Request\Request;
use NaviteCore\Response\Response;
use NaviteCore\Service\Provider;
use NaviteCore\Service\ProviderInterface;

class Application
{
    /**
     * The Navite framework version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static Application $app;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    protected Container $container;

    public function __construct(Container $container, $rootDir)
    {
        $this->container = $container;
        self::$app = $this;
        self::$ROOT_DIR = $rootDir;
        $this->request = new Request();
        $this->request = $this->request::createFromGlobals();
        $this->response = new Response();
        $this->router = new Router($this->container, $this->request, $this->response);

        $this->container->set(ProviderInterface::class, Provider::class);
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }
}