<?php

declare(strict_types=1);

namespace NaviteCore\Router;

interface RouterInterface
{
    /**
     * Get the routes and store them in the routes array.
     *
     * @param [type] $method
     * @return array
     */
    public function getRouteMap($method): array;

    /**
     * This Route method get all routes params and send to resolve.
     *
     * @return void
     */
    public function getCallback();

    public function resolve();
}