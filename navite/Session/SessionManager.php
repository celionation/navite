<?php

declare(strict_types=1);

namespace NaviteCore\Session;

use NaviteCore\Session\SessionFactory;

class SessionManager
{
    public function initialize()
    {
        $factory = new SessionFactory();
        return $factory->create('', \NaviteCore\Session\Storage\NativeSessionStorage::class, []);
    }
}