<?php

declare(strict_types=1);

namespace NaviteCore\Base;

use NaviteCore\Base\BaseView;
use NaviteCore\Base\Exception\BaseLogicException;

class BaseController
{
    protected array $routeParams;

    private Object $twig;

    /**
     *
     * @param array $routeParams
     */
    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
        $this->twig = new BaseView();
    }

    /**
     *
     * @param string $template
     * @param array $context
     * @return void
     */
    public function render(string $template, array $context = [])
    {
        if($this->twig === null)
        {
            throw new BaseLogicException("You can not use the render method if the twig Bundle is not available.");
        }
        return $this->twig->getTemplate($template, $context);
    }
}