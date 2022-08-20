<?php

declare(strict_types=1);

namespace NaviteCore\Request;

use NaviteCore\Request\RequestInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements RequestInterface
{
    public array $params = [];

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function isPut(): bool
    {
        return $this->getMethod() === 'put';
    }

    public function isPatch(): bool
    {
        return $this->getMethod() === 'patch';
    }

    public function isDelete(): bool
    {
        return $this->getMethod() === 'delete';
    }

    /**
     * Get the JSON decoded body of the request.
     *
     * @return array
     */
    protected function json()
    {
        if (!$this->data) {
            $this->data = json_decode($this->getBody(), true);
        }

        return $this->data;
    }

    public function getBody($input = false)
    {
        if (!$input) {
            $data = [];
            foreach ($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return array_key_exists($input, $_REQUEST) ? self::sanitize($_REQUEST[$input]) : false;
    }

    public function sanitize($dirty)
    {
        return htmlentities(trim($dirty), ENT_QUOTES, "UTF-8");
    }

    public function setParams($params): Request
    {
        $this->params = $params;
        return $this;
    }

    public function getParam($param, $default = null)
    {
        return $this->params[$param] ?? $default;
    }

    public function param(): array
    {
        return $this->params;
    }

    public function oneParam($param)
    {
        return $this->query->get($param);
    }

    public function allParams()
    {
        return $this->query->all();
    }

}