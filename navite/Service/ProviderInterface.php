<?php

declare(strict_types=1);

namespace NaviteCore\Service;

interface ProviderInterface
{
    public function link($url);
}