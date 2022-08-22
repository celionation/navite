<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\DataRepository;

use NaviteCore\LiquidOrm\DataRepository\Exception\DataRepositoryException;

class DataRepositoryFactory
{
    protected string $tableSchema;

    protected string $tableSchemaId;

    protected string $crudIdentifier;

    public function __construct(string $crudIdentifier, string $tableSchema, string $tableSchemaId)
    {
        $this->crudIdentifier = $crudIdentifier;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaId = $tableSchemaId;
    }

    /**
     * Undocumented function
     *
     * @param string $dataRespositoryString
     */
    public function create(string $dataRespositoryString)
    {
        $dataRespositoryObject = new $dataRespositoryString();
        if(!$dataRespositoryObject instanceof DataRepositoryInterface) {
            throw new DataRepositoryException($dataRespositoryString . " Is not a Valid Respository Object.");
        }
        return $dataRespositoryObject;
    }
}