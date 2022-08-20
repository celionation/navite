<?php

declare(strict_types=1);

namespace NaviteCore\Request;


interface RequestInterface
{
    public function getUrl();

    /**
     * This get the Request Method of a Particular Route.
     * it can be GET, POST, PUT, DELETE.
     *
     * @return string
     */
    public function getMethod(): string;

    public function getBody($input = false);

    public function sanitize($dirty);

    public function setParams($params): Request;

    public function getParam($param, $default = null);

    public function param(): array;

    public function isGet(): bool;

    public function isPost(): bool;

    public function isPut(): bool;

    public function isPatch(): bool;

    public function isDelete(): bool;
}