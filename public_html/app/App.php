<?php

namespace app;

use \app\core\ServiceContainer;
use \app\core\Db;

class App
{
    private static $appService;

    public function __construct( \Config $oConfig, ServiceContainer $container)
    {

        self::$appService = $container;
        $configs = $oConfig->getConf('database','mysql');
        $container->set(['provider', 'connection'], Db::connection($configs));
    }
    public static function getService(string $type, string $name)
    {
        $container = self::$appService;
        return $container->get($type,$name);
    }

}