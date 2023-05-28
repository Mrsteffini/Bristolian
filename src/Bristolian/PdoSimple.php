<?php

declare(strict_types = 1);

namespace Bristolian;

use PDO;
use Bristolian\Exception\RowNotFoundException;

class PdoSimple
{
    /** @var \PDO */
    private $pdo;

    /**
     * PdoSimple constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollback()
    {
        $this->pdo->rollBack();
    }

    /**
     * Executes some SQL.
     * Returns the number of rows affected
     */
    public function execute(string $query, array $params): int
    {
        $statement = $this->pdo->prepare($query);

        if ($statement === false) {
            throw new \Exception("Preparing statement failed");
        }

        $result = $statement->execute($params);

        if ($result === false) {
            throw new \Exception("Executing statement failed");
        }

        return $statement->rowCount();
    }

    public function insert(string $query, array $params): int
    {
        $statement = $this->pdo->prepare($query);

        if ($statement === false) {
            throw new \Exception("Preparing statement failed");
        }

        $result = $statement->execute($params);

        if ($result === false) {
            throw new \Exception("Executing statement failed");
        }

        return intval($this->pdo->lastInsertId());
    }


    public function fetchOneAsObject(string $query, array $params, string $classname)
    {
        $statement = $this->pdo->prepare($query);

        $result = $statement->execute($params);

        if ($result === false) {
            throw new \Exception("Executing statement failed");
        }

        $statement->setFetchMode(PDO::FETCH_CLASS, $classname);

        $object = $statement->fetch();

        if ($object === false) {
            throw new RowNotFoundException("The query did not result in a row");
        }

        return $object;
    }

    public function fetchOneAsObjectOrNull(string $query, array $params, string $classname)
    {
        $statement = $this->pdo->prepare($query);

        $result = $statement->execute($params);

        if ($result === false) {
            throw new \Exception("Executing statement failed");
        }

        $statement->setFetchMode(PDO::FETCH_CLASS, $classname);

        $object = $statement->fetch();

        if ($object === false) {
            return null;
        }

        return $object;
    }

    /**
     * @param string $query
     * @param array $params
     * @return array|null
     * @throws \Exception
     */
    public function fetchOneAsDataOrNull(string $query, array $params)
    {
        $statement = $this->pdo->prepare($query);

        $result = $statement->execute($params);

        if ($result === false) {
            throw new \Exception("Executing statement failed");
        }

        $result = $statement->fetch();

        if ($result === false) {
            return null;
        }

        return $result;
    }


    public function fetchAllAsObject(string $query, array $params, string $classname)
    {
        $statement = $this->pdo->prepare($query);

        $result = $statement->execute($params);

        if ($result === false) {
            throw new \Exception("Executing statement failed");
        }

        $statement->setFetchMode(PDO::FETCH_CLASS, $classname);

        $objects = $statement->fetchAll();

//        if ($object === false) {
//            throw new RowNotFoundException("The query did not result in a row");
//        }

        return $objects;
    }
}
