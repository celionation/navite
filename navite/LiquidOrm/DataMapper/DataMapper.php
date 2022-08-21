<?php

declare(strict_types=1);

namespace NaviteCore\LiquidOrm\DataMapper;

use NaviteCore\Database\DatabaseInterface;
use NaviteCore\LiquidOrm\DataMapper\Exception\DataMapperException;
use PDO;
use PDOStatement;

class DataMapper implements DataMapperInterface
{
    /**
     * Instance of DatabaseInterface.
     *
     * @var DatabaseInterface
     */
    private DatabaseInterface $dbh;

    /**
     * PDO Statement.
     *
     * @var PDOStatement
     */
    private PDOStatement $stmt;

    public function __construct(DatabaseInterface $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @param string|null $errorMessage
     * @return boolean
     */
    private function isEmpty($value, string $errorMessage = null)
    {
        if(empty($value)) {
            throw new DataMapperException($errorMessage);
        }
    }

    /**
     * Undocumented function
     *
     * @param array $value
     * @return boolean
     */
    private function isArray(array $value)
    {
        if(!is_array($value)) {
            throw new DataMapperException('Your arguements needs to be an qrray');
        }
    }

    /**
     * Undocumented function
     *
     * @param string $sqlQuery
     * @return DataMapperInterface
     */
    public function prepare(string $sqlQuery): DataMapperInterface
    {
        $this->statement = $this->dbh->open()->prepare($sqlQuery);
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function bind($value)
    {
        try {
            switch($value){
                case is_bool($value):
                case intval($value):
                    $dataTypes = PDO::PARAM_INT;
                    break;
                case is_null($value):
                    $dataTypes = PDO::PARAM_NULL;
                    break;
                    default:
                    $dataTypes = PDO::PARAM_STR;
                    break;
                }
                return $dataTypes;
        } catch (DataMapperException $e) {
            throw $e;
        }
    }

    /**
     * Undocumented function
     *
     * @param array $fields
     * @param boolean $isSearch
     * @return self
     */
    public function bindParameters(array $fields, bool $isSearch = false): self
    {
        if(is_array($fields)) {
            $type = $isSearch === false ? $this->bindValue($fields) : $this->bindSearchValue($fields);
            if($type) {
                return $this;
            }
        }
        return false;
    }

    /**
     * Bind a Value to a correspondant name or question mark placeholder in the 
     * Sql statement. To prepare the statement.
     *
     * @param array $fields
     * @return PDOStatement
     * @throws DataMapperException
     */
    protected function bindValue($fields)
    {
        $this->isArray($fields);
        foreach($fields as $key => $value) {
            $this->statement->bindValue(":".$key, $value, $this->bind($value));
        }
        return $this->statement;
    }

    /**
     * Undocumented function
     *
     * @param [type] $fields
     * @return void
     */
    protected function bindSearchValue($fields)
    {
        $this->isArray($fields);
        foreach($fields as $key => $value) {
            $this->statement->bindValue(":".$key, "%" . $value . "%", $this->bind($value));
        }
        return $this->statement;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function execute(): void
    {
        if($this->statement) {
            $this->statement->execute();
        }
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function rowCount(): int
    {
        if($this->statement) {
            return $this->statement->rowCount();
        }
    }

    /**
     * Undocumented function
     *
     * @return object
     */
    public function result(): object
    {
        if($this->statement) {
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function results(): array
    {
        if ($this->statement) {
            return $this->statement->fetchAll();
        }
    }

    /**
     * @inheritDoc
     *
     * @return integer
     * @throws \Throwable
     */
    public function getLastId(): int
    {
        try {
            if($this->dbh->open()) {
                $lastId = $this->dbh->open()->lastInsertId();
                if(!empty($lastId)) {
                    return intval($lastId);
                }
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}