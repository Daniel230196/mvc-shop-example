<?php

namespace MvcSkillet\Core\DBAL;

use MvcSkillet\Config;
use MvcSkillet\Core\Exception\DBAL\ConnectionParamsException;
use MvcSkillet\Core\Exception\DBAL\NoDriversFoundException;

class Connection {
    private array $_connectionPool;
    private static $_self;
    private array $_drivers;

    private const MYSQL_DRIVER = 'mysql';

    private function __construct() {}

    public static function instance(): static {
        return self::$_self ?? self::$_self = new static();
    }

    public function configurate(array $drivers): static {
        $this->_drivers = $drivers;
        return $this;
    }

    public function getConnection(string $driverName, string $dbName): \PDO  {
        switch ($driverName){
            case self::MYSQL_DRIVER:
                ['user' => $user, 'password' => $password, 'host' => $host, 'port' => $port] = $this->_drivers[$driverName] ?? null;

                if ($user === null || $password === null || $host === null || $port === null) {
                    throw new ConnectionParamsException('Host or user data can not be empty for successful connection');
                }

                $dsn     = "{$driverName}:host={$host};port={$port};dbname={$dbName}";
                $options = Config::isDevMode() ? [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION] : [];
                $this->_connectionPool[self::MYSQL_DRIVER] = new \PDO($dsn, $user, $password, $options);
                return $this->_connectionPool[self::MYSQL_DRIVER];
            default:
                throw new NoDriversFoundException("Driver {$driverName} unsupported");
        }
    }
}