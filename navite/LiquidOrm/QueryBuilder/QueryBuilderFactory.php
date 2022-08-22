<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\QueryBuilder;

use NaviteCore\LiquidOrm\QueryBuilder\Exception\QueryBuilderException;
use NaviteCore\LiquidOrm\QueryBuilder\QueryBuilderInterface;

class QueryBuilderFactory
{
    /**
     * QueryBuilderFactory Constructor.
     */
    public function __construct()
    {
        
    }

    public function create(string $queryBuilderString): QueryBuilderInterface
    {
        $queryBuilderObject = new $queryBuilderString();
        if(!$queryBuilderObject instanceof QueryBuilderInterface) {
            throw new QueryBuilderException($queryBuilderString . " Is not a Valid Query Builder Object.");
        } 
        return $queryBuilderObject;
    }
}