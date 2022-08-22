<?php

declare(strict_types=1);

namespace NaviteCore\Base;

use NaviteCore\Base\Exception\BaseInvalidArguementException;
use NaviteCore\LiquidOrm\DataRepository\DataRepository;
use NaviteCore\LiquidOrm\DataRepository\DataRepositoryFactory;

class BaseModel
{
    /**
     *
     * @var string
     */
    private string $tableSchema;

    /**
     *
     * @var string
     */
    private string $tableSchemaId;

    /**
     * 
     * @var DataRepository
     */
    private DataRepository $repository;

    /**
     * BaseMode Constructor.
     *
     * @param string $tableSchema
     * @param string $tableSchemaId
     * @throws BaseInvalidArguementException
     */
    public function __construct(string $tableSchema, string $tableSchemaId)
    {
        if(empty($tableSchema) || empty($tableSchemaId)) {
            throw new BaseInvalidArguementException("These arguements are required.");
        }
        $factory = new DataRepositoryFactory('', $tableSchema, $tableSchemaId);
        $this->repository = $factory->create(DataRepository::class);
    }

    public function getRepo()
    {
        return $this->repository;
    }

}