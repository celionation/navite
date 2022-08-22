<?php

declare(strict_types=1);

namespace NaviteCore\Base;

class BaseController
{
    protected array $routeParams;

    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
    }
}