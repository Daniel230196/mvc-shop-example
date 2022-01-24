<?php

namespace MvcSkillet\Component\User;

use MvcSkillet\Core;

class Repository extends Core\DBAL\Repository\Repository {

    private const TABLE = 'user';

    public function loadUserByName(string $login): ?User {
        $table        = $this->_tableName(User::class);
        $escapedValue = $this->_escape($login);
        $stmt         = $this->_connection->prepare("SELECT * FROM {$table} WHERE login=?;");
        $stmt->bindParam(1, $escapedValue);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS,User::class);
        return count($result) === 1 ? current($result) : null;
    }

    /**
     * @param User $user
     * @throws Core\Exception\DBAL\SqlExecutionException
     */
    public function storeUser(User $user) {
        $this->_store($user);
    }

    //@TODO: refactor method with more useful logic in future
    protected function _tableName(string $entityClass): string {
        return self::TABLE;
    }
}