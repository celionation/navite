<?php

declare(strict_types=1);

namespace NaviteCore\Container;

use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use NaviteCore\Error\Errors;
use NaviteCore\Container\Exception\ContainerException;

class Container implements ContainerInterface
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws ContainerException
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws ContainerException
     */
    public function resolve(string $id)
    {
        // inspect the class that we are string to get from the container
        $reflectionClass = new ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException(Errors::get('6000'), 6000);
        }

        // inspect the container of the class
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }

        // inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();

        if (!$parameters) {
            return new $id;
        }

        // if the constructor parameter is a class then try to resolve that class using the container
        $dependencies = array_map(function (ReflectionParameter $params) use ($id) {
            $name = $params->getName();
            $type = $params->getType();

            if (!$type) {
                throw new ContainerException(Errors::get('6001'), 6001);
            }

            if ($type instanceof ReflectionUnionType) {
                throw new ContainerException(Errors::get('6002'), 6002);
            }

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException(Errors::get('6003'), 6003);
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}