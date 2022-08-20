<?php

declare(strict_types=1);

namespace NaviteCore\Response;

use NaviteCore\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;


class Response extends SymfonyResponse implements ResponseInterface
{
    public function statusCode(int $code): int
    {
        return http_response_code($code);
    }

    public static function setCode($code = 200)
    {
        Response::setStatusCode($code);
    }

    public static function redirect($location)
    {
        new RedirectResponse($location);
        exit();
    }
}