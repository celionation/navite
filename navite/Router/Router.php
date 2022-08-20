<?php

declare(strict_types=1);

namespace NaviteCore\Router;

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

    public function getRouteMap($method): array
    {
        
    }
}