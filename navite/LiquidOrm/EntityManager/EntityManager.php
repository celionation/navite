<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\EntityManager;

use NaviteCore\LiquidOrm\EntityManager\CrudInterface;
use NaviteCore\LiquidOrm\EntityManager\EntityManagerInterface;

class EntityManager implements EntityManagerInterface
{
    /**
     *
     * @var CrudInterface
     */
    protected CrudInterface $crud;
    /**
     * EntityManager Constructor.
     * 
     * @return void
     */
    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @inheritDoc
     *
     * @return object
     */
    public function getCrud(): object
    {
        return $this->crud;
    }
}