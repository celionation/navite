<?php

declare(strict_types=1);

namespace NaviteCore\Base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

class BaseView
{
    public function getTemplate(string $template, array $context = [])
    {
        static $twig;
        if($twig === null)
        {
            $loader = new FilesystemLoader('templates', TEMPLATES_PATH);
            $twig = new Environment($loader, []);
            $twig->addExtension(new DebugExtension());
            $twig->addExtension(new TwigExtension());
        }
        return $twig->render($template, $context);
    }
}