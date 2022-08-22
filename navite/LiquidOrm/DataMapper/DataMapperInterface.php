<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\DataMapper;

interface DataMapperInterface
{
    /**
     * Prepare Query String
     *
     * @param string $sqlQuery
     * @return self
     */
    public function prepare(string $sqlQuery): self;

    /**
     * Set Data type for parameter using PDO Param constants.
     *
     * @param [type] $value
     * @return void
     */
    public function bind($value);

    /**
     * Undocumented function
     *
     * @param array $value
     * @param boolean $isSearch
     * @return self
     */
    public function bindParameters(array $fields, bool $isSearch = false): self;

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function rowCount(): int;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function execute();

    /**
     * Undocumented function
     *
     * @return object
     */
    public function result(): object;

    /**
     * Undocumented function
     *
     * @return array
     */
    public function results(): array;

    /**
     * Return the Last inserted row id from the Database Table.
     *
     * @return integer
     */
    public function getLastId(): int;
}