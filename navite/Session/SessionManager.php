<?php

declare(strict_types=1);

namespace NaviteCore\Session;

use NaviteCore\Session\SessionFactory;

class SessionManager
{
    /**
     * Create an instance of our session factory and pass in the default session storage
     * 
     * we will fetch the session name and array of options from the core yaml configuration files.
     *
     * @return void
     */
    public static function initialize()
    {
        $factory = new SessionFactory();
        return $factory->create('', \NaviteCore\Session\Storage\NativeSessionStorage::class, []);
    }
}