<?php

declare(strict_types=1);

namespace SocialFood\Application\Wrapper;

use Exception;
use PDO;
use PDOStatement;

class MysqlWrapper
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function query(string $queryString, array $parameters)
    {
        $statement = $this->pdo->prepare($queryString);
        $this->executeStatement($statement, $parameters);

        return $statement;
    }

    public function fetchAll(string $queryString, array $parameters): array
    {
        $statement = $this->pdo->prepare($queryString);
        $this->executeStatement($statement, $parameters);

        return $statement->fetchAll();
    }

    public function fetchOne(string $queryString, array $parameters)
    {
        $statement = $this->pdo->prepare($queryString);
        $this->executeStatement($statement, $parameters);

        return $statement->fetch();
    }

    protected function executeStatement(PDOStatement $statement, array $parameters): void
    {
        $hasExecuted = $statement->execute($parameters);

        if (!$hasExecuted) {
            throw new Exception(json_encode($statement->errorInfo(), true));
        }
    }
}
