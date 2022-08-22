<?php

declare(strict_types=1);

namespace NaviteCore\Global;

use Throwable;
use NaviteCore\GlobalManager\GlobalManagerInterface;
use NaviteCore\GlobalManager\Exception\GlobalManagerException;
use NaviteCore\GlobalManager\Exception\GlobalManagerInvalidArguementException;

class GlobalManager implements GlobalManagerInterface
{
    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, $value): void
    {
        $GLOBALS[$key] = $value;
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @throws GlobalManagerException
     */
    public static function get(string $key)
    {
        self::isGlobalValid($key);
        try {
            return $GLOBALS[$key];
        } catch (Throwable $e) {
            throw new GlobalManagerException("An Exception was thrown trying to retrieve the data.");
        }
    }

    /**
     * Check if we have a valid key and is not empty
     * Else throw Exception
     *
     * @param string $key
     * @throws GlobalManagerInvalidArguementException
     */
    private static function isGlobalValid(string $key): void
    {
        if(!isset($GLOBALS[$key])) {
            throw new GlobalManagerInvalidArguementException("Invalid Global Key, Please ensure you've set the global state for " . $key);
        }
        if(empty($key)) {
            throw new GlobalManagerInvalidArguementException("Arguemennt can not be Empty.");
        }
    }
}