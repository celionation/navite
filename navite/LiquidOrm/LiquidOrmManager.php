<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm;

use NaviteCore\Database\Database;
use NaviteCore\LiquidOrm\DataMapper\DataMapperEnvironmentConfiguration;
use NaviteCore\LiquidOrm\DataMapper\DataMapperFactory;
use NaviteCore\LiquidOrm\EntityManager\Crud;
use NaviteCore\LiquidOrm\EntityManager\EntityManagerFactory;
use NaviteCore\LiquidOrm\QueryBuilder\QueryBuilder;
use NaviteCore\LiquidOrm\QueryBuilder\QueryBuilderFactory;

class LiquidOrmManager
{
    protected string $tableSchema;

    protected string $tableSchemaId;

    protected array $options;

    protected DataMapperEnvironmentConfiguration $environmentConfiguration;

    public function __construct(DataMapperEnvironmentConfiguration $environmentConfiguration, string $tableSchema, string $tableSchemaId, array $options = [])
    {
        $this->$environmentConfiguration = $environmentConfiguration;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaId = $tableSchemaId;
        $this->options = $options;
    }
    
    public function initialize()
    {
        $dataMapperFactory = new DataMapperFactory();
        $dataMapper = $dataMapperFactory->create(Database::class, DataMapperEnvironmentConfiguration::class);
        if($dataMapper) {
            $queryBuilderFactory = new QueryBuilderFactory();
            $queryBuilder = $queryBuilderFactory->create(QueryBuilder::class);
            if($queryBuilder) {
                $entityManagerFactory = new EntityManagerFactory($dataMapper, $queryBuilder);
                return $entityManagerFactory->create(Crud::class, $this->tableSchema, $this->tableSchemaId, $this->options);
            }
        }
    }
}