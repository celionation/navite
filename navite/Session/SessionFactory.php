<?php

declare(strict_types=1);

namespace NaviteCore\Session;

use NaviteCore\Session\SessionInterface;
use NaviteCore\Session\Storage\SessionStorageInterface;
use NaviteCore\Session\Exception\SessionStorageInvalidArguementException;

class SessionFactory
{
    /**
     * SessionFactory Constructor.
     */
    public function __construct()
    {
        
    }

    public function create(string $sessionName, string $storageString, array $options = []): SessionInterface
    {
        $storageObject = new $storageString($options);
        if(!$storageObject instanceof SessionStorageInterface) {
            throw new SessionStorageInvalidArguementException($storageString . " Is not a Valid Session Storage Object.");
        }
        return new Session($sessionName, $storageObject);
    }
}