<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\EntityManager;

use NaviteCore\LiquidOrm\DataMapper\DataMapperInterface;
use NaviteCore\LiquidOrm\QueryBuilder\QueryBuilderInterface;
use NaviteCore\LiquidOrm\EntityManager\EntityManagerInterface;
use NaviteCore\LiquidOrm\EntityManager\Exception\CrudException;

class EntityManagerFactory
{
    protected DataMapperInterface $dataMapper;

    protected QueryBuilderInterface $queryBuilder;

    /**
     * EntityManagerFactory Constructor.
     */
    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Undocumented function
     *
     * @param string $crudString
     * @param string $tableSchema
     * @param string $tableSchemaId
     * @param array $options
     * @return EntityManagerInterface
     */
    public function create(string $crudString, string $tableSchema, string $tableSchemaId, array $options = []): EntityManagerInterface
    {
        $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaId, $options);
        if(!$crudObject instanceof CrudInterface)
        {
            throw new CrudException($crudString . " Is not a Valid Crud Object");
        }
        return new EntityManager($crudObject);
    }
}