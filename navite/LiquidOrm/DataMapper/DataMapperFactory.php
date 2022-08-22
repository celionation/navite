<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\DataMapper;

use NaviteCore\Database\DatabaseInterface;
use NaviteCore\LiquidOrm\DataMapper\DataMapperInterface;
use NaviteCore\LiquidOrm\DataMapper\Exception\DataMapperException;

class DataMapperFactory
{
    /**
     * DataMapperFactory Constructor.
     */
    public function __construct()
    {
        
    }

    public function create(string $databaseConnectionString, string $dataMapperEnvironmentConfiguration): DataMapperInterface
    {
        $credentials = (new $dataMapperEnvironmentConfiguration([]))->getDatabaseCredentials('mysql');
        $databaseConnectionObject = new $databaseConnectionString($credentials);
        if(!$databaseConnectionObject instanceof DatabaseInterface) {
            throw new DataMapperException($databaseConnectionString . " Is not a valid Database connection object.");
        }
        return new DataMapper($databaseConnectionObject);
    }
}