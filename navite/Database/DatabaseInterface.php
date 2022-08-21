<?php

declare(strict_types=1);

namespace NaviteCore\Database;

use PDO;

interface DatabaseInterface
{
    /**
     * Open / Create a new Database Connection.
     *
     * @return PDO
     */
    public function open(): PDO;

    /**
     * This Close the Database Connection.
     *
     * @return void
     */
    public function close(): void;
}