<?php

declare(strict_types=1);

namespace NaviteCore\Response;

interface ResponseInterface
{
    public function statusCode(int $code): int;

    public static function redirect($location);
}
