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
    
    public function create(array $fields = []): bool;

    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;

    public function update(array $fields = [], string $primaryKey): bool;

    public function delete(array $conditions = []): bool;

    public function search(array $selectors = [], array $conditions = []): array;

    public function rawQuery(string $rawQuery, array $conditions = []);
}