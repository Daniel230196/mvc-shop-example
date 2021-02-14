<?php

namespace app\core;

use \PDO;


class Db
{
/*
 * Database connection class
 *
 *
 *
 * */
    private static $PDO ;

    private function __construct()
    {
    }
    private function __clone() {}
    private function __wakeup () {}
    public static function connection(array $params) : \PDO
    {
        if (is_null(self::$PDO)) {
            try {
                return self::$PDO = new \PDO($params['dsn'],$params['login'],$params['password'], $params['options']);

            } catch (\PDOexception $e) {


                  echo "Date base connection error ".$e->getMessage();
                }
      }

         return self::$PDO;

    }
}
