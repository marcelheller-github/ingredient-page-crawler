<?php

declare(strict_types=1);

namespace SocialFood\Application\Repository;

use Exception;
use SocialFood\Application\ValueObject\MySqlProjectionValueInterface;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;
use SocialFood\Application\Wrapper\MysqlWrapper;

abstract class AbstractMysqlProjectionRepository
{
    /** @var MysqlWrapper */
    protected $mysqlWrapper;

    /** @var string | MySqlProjectionValueInterface */
    protected $mysqlAggregateObjectFqcn;

    /** @var string */
    protected $table;

    public function __construct(MysqlWrapper $mysqlWrapper, string $mysqlAggregateObjectFqcn, string $table)
    {
        $this->mysqlWrapper             = $mysqlWrapper;
        $this->mysqlAggregateObjectFqcn = $mysqlAggregateObjectFqcn;
        $this->table                    = $table;
    }

    public function read(PrimaryKeyInterface $primaryKey): ?MySqlProjectionValueInterface
    {
        $query  = "SELECT * FROM ' . $this->table . ' WHERE id = :id";
        $result = $this->mysqlWrapper->fetchOne($query, [':id' => $primaryKey->primaryKey()]);

        if (!$result) {
            return null;
        }

        return $this->mysqlAggregateObjectFqcn::fromDatabaseArray($result);
    }

    /**
     * @return MySqlProjectionValueInterface[]
     */
    public function readAll(): array
    {
        $mysqlProjectionValueObjects     = [];
        $results = $this->mysqlWrapper->fetchAll('SELECT * FROM ' . $this->table, []);

        foreach ($results as $result) {
            $mysqlProjectionValueObjects[] = $this->mysqlAggregateObjectFqcn::fromDatabaseArray($result);
        }

        return $mysqlProjectionValueObjects;
    }

    /**
     * @param array $params
     * @return MySqlProjectionValueInterface[]
     */
    public function readBy(array $params): array
    {
        $preparedParams              = [];
        $mysqlProjectionValueObjects = [];

        $where = [];
        foreach ($params as $paramName => $paramValue) {
            $where[] = ' ' . $paramName . ' = :' . $paramName;
            $preparedParams[':' . $paramName] = $paramValue;
        }

        $query = 'SELECT * FROM ' . $this->table . ' WHERE' . implode(' AND ', $where);

        $results = $this->mysqlWrapper->fetchAll($query, $preparedParams);

        foreach ($results as $result) {
            $mysqlProjectionValueObjects[] = $this->mysqlAggregateObjectFqcn::fromDatabaseArray($result);
        }

        return $mysqlProjectionValueObjects;
    }

    public function readOneBy(array $params): ?MySqlProjectionValueInterface
    {
        $objects = $this->readBy($params);
        if (count($objects) < 1) {
            return null;
        }

        if (count($objects) > 1) {
            throw new Exception('There are more Results');
        }
        return array_pop($objects);
    }

    public function save(MySqlProjectionValueInterface $mysqlProjectionValueObject): void
    {
        $primaryKey        = $mysqlProjectionValueObject->getPrimaryKey();
        $parameters        = $mysqlProjectionValueObject->getAttributesAsMysqlParameters();
        $parameters[':id'] = $primaryKey->primaryKey();

        $parameterKeysArray = array_keys($parameters);
        $parameterKeys      = implode(', ', $parameterKeysArray);

        $parameterKeysWithoutColon = str_replace(':', '', $parameterKeys);

        $queryString = 'INSERT INTO ' . $this->table . ' (' . $parameterKeysWithoutColon . ') VALUES (' .
            $parameterKeys . ')';

        $recordAlreadyExists = $this->doesRecordAlreadyExist($primaryKey);

        if ($recordAlreadyExists) {
            $queryString = $this->buildUpdateQuery($parameterKeysArray);
        }

        $this->mysqlWrapper->query($queryString, $parameters);
    }

    public function delete(MySqlProjectionValueInterface $mysqlProjectionValueObject): void
    {
        $primaryKey = $mysqlProjectionValueObject->getPrimaryKey();
        $id         = $primaryKey->primaryKey();

        if (!$this->doesRecordAlreadyExist($primaryKey)) {
            return;
        }

        $queryString = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $this->mysqlWrapper->query($queryString, [':id' => $id]);
    }

    private function doesRecordAlreadyExist(PrimaryKeyInterface $primaryKey): bool
    {
        $id = $primaryKey->primaryKey();

        $recordAlreadyExistsQuery = 'SELECT count(id) FROM ' . $this->table . ' WHERE id = :id';
        $recordAlreadyExists      = $this->mysqlWrapper->fetchOne($recordAlreadyExistsQuery, [':id' => $id]);

        return (bool)($recordAlreadyExists[0] ?? 0);
    }

    private function buildUpdateQuery(array $parameterKeysArray): string
    {
        $setters = [];

        foreach ($parameterKeysArray as $parameterKey) {
            $setters[] = str_replace(':', '', $parameterKey) . ' = ' . $parameterKey;
        }

        return 'UPDATE ' . $this->table . ' SET ' . implode(', ', $setters) . ' WHERE id = :id';
    }
}
