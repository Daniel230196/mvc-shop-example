<?php

namespace MvcSkillet\Core\DBAL\Repository;

use MvcSkillet\Component\User\User;
use MvcSkillet\Core;
use MvcSkillet\ServiceLocator;

abstract class Repository {

    protected \PDO $_connection;

    protected static string $_dbName = 'main';
    protected static string $_driverName = 'mysql';

    /**
     * @throws Core\Exception\DBAL\ConnectionParamsException
     * @throws Core\Exception\DBAL\NoDriversFoundException
     */
    public function __construct() {
       $this->_initConnection();
    }

    /**
     * @param Core\DBAL\AbstractEntity $entity
     * @throws Core\Exception\DBAL\SqlExecutionException
     */
    protected function _store(Core\DBAL\AbstractEntity $entity): void {
        $columns         = get_object_vars($entity);
        $preparedColumns = $this->_prepareSqlColumnsAsString(array_keys($columns));
        $preparedValues  = $this->_prepareSqlValues(array_values($columns));
        $query           = $this->_prepareStoreQuery($preparedColumns);
        $stmt            = $this->_connection->prepare($query);
        if (!$stmt->execute($preparedValues)) {
            throw new Core\Exception\DBAL\SqlExecutionException("Sql query was not successful: {$query}");
        }
    }

    /**
     * @param Core\DBAL\AbstractEntity $entity
     * @param Core\DBAL\Repository\Filter\QueryFilter[] $filters
     * @return mixed
     */
    protected function _select(Core\DBAL\AbstractEntity $entity, array $filters = [], array $fieldsForSelect = []): mixed {
        $fields = count($fieldsForSelect) > 0
            ? implode(', ', array_map([$this, '_escape'], $fieldsForSelect))
            : '*';
        $query = "SELECT {$fields} FROM {$this->_tableName(get_class($entity))} {$this->_buildFilters($filters)};";
        //@TODO: implement with prepared values by PDO
    }

    protected function _escape(string $value): string {
        return addslashes($value);
    }

    private function _prepareSqlColumnsAsString(array $keys, bool $withId = true): string {
        $preparedKeys = [];
        foreach ($keys as $key) {
            if ($key === Core\DBAL\AbstractEntity::FIELD_ID && !$withId) {
                continue;
            }
            $preparedKeys[] = "`{$this->_escape($key)}`";
        }

        return implode(', ', $preparedKeys);
    }

    private function _prepareSqlValues(array $values): array {
        return array_map([$this, '_escape'], $values);
    }

    private function _prepareStoreQuery(string $columns): string {
        $placeHolders = [];
        foreach (explode(', ', $columns) as $column) {
            $placeHolders[] = ":{$column}";
        }
        return "REPLACE INTO {$this->_tableName(User::class)} {$columns} VALUES ({implode(', ', $placeHolders)});";
    }

    /**
     * @param Core\DBAL\Repository\Filter\QueryFilter[] $filters
     */
    private function _buildFilters(array $filters): string {
        $result = '';
        foreach ($filters as $filter) {
            $expression = $this->_escape($filter->expression());
            $result .= strlen($result) === 0 ? $expression : " AND {$expression}";
        }

        return $result;
    }


    /**
     * @param array $conditions
     * @return Core\DBAL\Repository\Filter\QueryFilter[]
     */
    protected function _createEqualFilter(array $conditions): array {
        $filters = [];
        foreach ($conditions as $fieldName => $targetValue) {
            $filters[] = new Core\DBAL\Repository\Filter\QueryFilter($this->_escape($fieldName), '=',$this->_escape($targetValue));
        }

        return $filters;
    }

    abstract protected function _tableName(string $entityClass): string;

    private function _initConnection() {
        $config  = ServiceLocator::applicationConfig();
        $drivers = $config['database']['drivers'] ?? null;
        if ($drivers === null || count($drivers) < 1) {
            throw new Core\Exception\DBAL\NoDriversFoundException('No drivers found. At least one must be specified in configuration file');
        }

        $this->_connection = Core\DBAL\Connection::instance()
            ->configurate($drivers)
            ->getConnection(static::$_driverName, static::$_dbName);
    }
}