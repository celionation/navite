<?php

declare(strict_types=1);

namespace NaviteCore\Database\Exception;

use PDOException;

class DatabaseException extends PDOException
{
    /**
     * DatabaseException.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = null, $code = null)
    {
        $this->message = $message;
        $this->code = $code;
    }
}