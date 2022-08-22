<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\EntityManager;

interface CrudInterface
{
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getSchema(): string;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getSchemaId(): string;

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function lastId(): int;
    
    /**
     * Undocumented function
     *
     * @param array $fields
     * @return boolean
     */
    public function create(array $fields = []): bool;

    /**
     * Undocumented function
     *
     * @param array $selectors
     * @param array $conditions
     * @param array $parameters
     * @param array $optional
     * @return array
     */
    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;

    /**
     * Undocumented function
     *
     * @param array $fields
     * @param string $primaryKey
     * @return boolean
     */
    public function update(array $fields = [], string $primaryKey): bool;

    /**
     * Undocumented function
     *
     * @param array $conditions
     * @return boolean
     */
    public function delete(array $conditions = []): bool;

    /**
     * Undocumented function
     *
     * @param array $selectors
     * @param array $conditions
     * @return array
     */
    public function search(array $selectors = [], array $conditions = []): array;

    /**
     * Undocumented function
     *
     * @param string $rawQuery
     * @param array $conditions
     * @return void
     */
    public function rawQuery(string $rawQuery, array $conditions = []);
}