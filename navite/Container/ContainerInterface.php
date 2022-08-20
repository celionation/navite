<?php

declare(strict_types=1);

namespace NaviteCore\Container;

interface ContainerInterface
{
    public function get(string $id);

    public function has(string $id): bool;

    public function set(string $id, callable|string $concrete): void;

    public function resolve(string $id);
}