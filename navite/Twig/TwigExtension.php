<?php

declare(strict_types=1);

namespace NaviteCore\Twig;

use Twig\Extension\GlobalsInterface;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [];
    }
}