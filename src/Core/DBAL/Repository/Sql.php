<?php

namespace MvcSkillet\Core\Service\Repository;

/**
 * @TODO realize abstract query builder in future
 */
abstract class Sql {

    private const SQL_OPERATION_WHERE = 'where';
    private const SQL_OPERATION_HAVING = 'having';
    private const SQL_OPERATION_GROUP_BY = 'group_by';
    private const SQL_OPERATION_ORDER_BY = 'order_by';
    private const SQL_OPERATION_LIMIT = 'limit';
    private const SQL_OPERATION_OFFSET = 'offset';
    private const SQL_OPERATION_IN = 'between';
    private const SQL_OPERATION_SELECT = 'select';
    private const SQL_OPERATION_INSERT = 'insert_into';
    private const SQL_OPERATION_REPLACE = 'replace_into';
    private const SQL_OPERATION_TABLE_CREATE = 'create_table';
    private const SQL_OPERATION_TABLE_ALTER = 'alter_table';


    protected string $_query;
    protected array $_mappers;
    protected $_sql;
    protected \PDO $_connection;

    public function __construct($connectionData) {
        $this->_connection = $this->_connect($connectionData);
    }

    abstract protected function _connect($connectionData): \PDO;

    public function select(string $tableName) {

    }

    abstract public function delete(string $tableName);

    abstract public function insert(string $tableName);

    abstract public function update(string $tableName);

/*    public function _storeRow(AbstractEntity $entity, string $tableName) {
        $columnsData = get_object_vars($entity);

        foreach ($columnsData as $name => $value) {

        }
    }*/

    protected function _buildParts(array $parts) {

    }
}