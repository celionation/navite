<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\DataMapper;

use NaviteCore\LiquidOrm\DataMapper\Exception\DataMapperInvalidArguementException;

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
     * Get the User define Database Connection array.
     * 
     * @param string $driver
     * @return array
     */
    public function getDatabaseCredentials(string $driver): array
    {
        $connectionArray = [];
        $this->isCredentialValid($driver);
        foreach($this->credentials as $credential) {
            if(array_key_exists($driver, $credential)) {
                $connectionArray = $credential[$driver];
            }
        }
        return $connectionArray;
    }

    /**
     * Check Credentials for Validity
     *
     * @param string $driver
     * @return boolean
     */
    private function isCredentialValid(string $driver)
    {
        if(empty($driver) && !is_string($driver)) {
            throw new DataMapperInvalidArguementException("Invalid arguement, This is either missing or off the invalid data type.");
        }
        if(!is_array($this->credentials)) {
            throw new DataMapperInvalidArguementException("Invalid Credentials.");
        }
        if(!in_array($driver, array_keys($this->credentials[$driver]))) {
            throw new DataMapperInvalidArguementException("Invalid or Unsupported Database Driver.");
        }
    }
}