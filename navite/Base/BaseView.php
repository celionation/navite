<?php

declare(strict_types=1);

namespace NaviteCore\Base;

use Exception;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Twig\Loader\FilesystemLoader;
use NaviteCore\Twig\TwigExtension;
use Twig\Extension\DebugExtension;

class BaseView
{
    /**
     * Get the context of a view template using twig.
     *
     * @param string $template The template file
     * @param array $context Associative array of data to display in the view (optional)
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
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