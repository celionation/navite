<?php

declare(strict_types=1);

namespace NaviteCore\Service;

class Provider implements ProviderInterface
{
    public function link($url)
    {
        return 'Hello from the Service Provider';
    }
}