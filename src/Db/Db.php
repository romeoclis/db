<?php

namespace Robert\Db;

use Aigletter\Contracts\Builder\DbInterface;
use Aigletter\Contracts\Builder\QueryInterface;


class Db implements DbInterface
{
    public function connect()
    {
        return Connection::getInstance();
    }

    public function one(QueryInterface $query): object
    {
        $pdoStatement =  $this->connect()->prepare($query);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject() ? $pdoStatement->fetchObject() : new \stdClass();
    }

    public function all(QueryInterface $query): array
    {
        $pdoStatement =  $this->connect()->prepare($query);
        $pdoStatement->execute();

        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS);

    }
}