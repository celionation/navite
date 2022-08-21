<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\DataMapper;

class DataMapperEnvironmentConfiguration
{
    /**
     * @var array
     */
    private array $credentials = [];

    /**
     * The Class Constructor.
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * 
     */
    
    // public function getDatabaseCredentials(string $driver): array
    // {
    //     $connectionArray = [];
    //     foreach($this->credentials as $credentials) {

    //     }
    // }
}