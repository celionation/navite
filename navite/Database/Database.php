<?php

declare(strict_types=1);

namespace NaviteCore\Database;

use NaviteCore\Database\Exception\DatabaseException;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    /**
     * The Database Handler.
     *
     * @var PDO
     */
    protected PDO $dbh;

    protected array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @inheritDoc
     *
     * @return PDO
     */
    public function open(): PDO
    {
        try {
            $params = [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
            ];

            $this->dbh = new PDO(
                $this->credentials['dsn'],
                $this->credentials['username'],
                $this->credentials['password'],
                $params
            );
        } catch (PDOException $e) {
            throw new DatabaseException($e->getMessage(), (int) $e->getCode());
        }
        return $this->dbh;
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function close(): void
    {
        $this->dbh = null;
    }
}