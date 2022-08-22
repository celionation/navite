<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\EntityManager;

use NaviteCore\LiquidOrm\DataMapper\DataMapper;
use NaviteCore\LiquidOrm\EntityManager\CrudInterface;
use NaviteCore\LiquidOrm\QueryBuilder\QueryBuilder;

class Crud implements CrudInterface
{
    protected DataMapper $dataMapper;

    protected QueryBuilder $queryBuilder;

    protected string $tableSchema;

    protected string $tableSchemaId;

    protected array $options;

    /**
     * Crud Constructor.
     */
    public function __construct(DataMapper $dataMapper, QueryBuilder $queryBuilder, string $tableSchema, string $tableSchemaId, array $options = [])
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaId = $tableSchemaId;
        $this->options = $options;
    }

    public function getSchema(): string
    {
        return (string)$this->tableSchema;
    }

    public function getSchemaId(): string
    {
        return (string)$this->tableSchemaId;
    }

    public function lastId(): int
    {
        return (int)$this->dataMapper->getLastId();
    }

    public function create(array $fields = []): bool
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' =>'insert', 'fields' => $fields];
            $query = $this->queryBuilder->buildQuery($args)->insertQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameter($fields));
            if($this->dataMapper->rowCount() == 1) {
                return true;
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' => 'select', 'selectors' => $selectors, 'conditions' => $conditions, 'params' => $parameters, 'extras' => $optional];
            $query = $this->queryBuilder->buildQuery($args)->selectQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameter($conditions, $parameters));
            if($this->dataMapper->rowCount() > 0) {
                return $this->dataMapper->results();
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function update(array $fields = [], string $primaryKey): bool
    {
        try {
            $args = ['table' => $this->getSchema, 'type' => 'update', 'fields' => $fields, 'primary_key' => $primaryKey];
            $query = $this->queryBuilder->buildQuery($args)->updateQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameter($fields));
            if($this->dataMapper->rowCount() == 1) {
                return true;
            }
        } catch (\Throwable $e) {
            throw  $e;
        }
    }

    public function delete(array $conditions = []): bool
    {
        try {
            $args = ['table' => $this->getSchema, 'type' => 'delete', 'conditions' => $conditions];
            $query = $this->queryBuilder->buildQuery($args)->deleteQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameter($conditions));
            if($this->dataMapper->rowCount() == 1) {
                return true;
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function search(array $selectors = [], array $conditions = []): array
    {
        try {
            $args = ['table' => $this->getSchema, 'type' => 'search', 'selectors' => $selectors, 'conditions' => $conditions];
            $query = $this->queryBuilder->buildQuery($args)->searchQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameter($conditions));
            if ($this->dataMapper->rowCount() > 1) {
                return $this->dataMapper->results();
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     *
     * @param string $rawQuery
     * @param array|null $conditions
     * @return void
     */
    public function rawQuery(string $rawQuery, ?array $conditions = [])
    {
        try {
            $args = ['table' => $this->getSchema, 'type' => 'raw', 'raw' => $rawQuery, 'conditions' => $conditions];
            $query = $this->queryBuilder->buildQuery($args)->rawQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameter($conditions));
            if($this->dataMapper->rowCount()) {
                //revisit.
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}