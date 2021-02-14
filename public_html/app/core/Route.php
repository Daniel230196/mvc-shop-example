<?php

namespace app\core;

require_once 'Loader.php';


class Route
{
    private static $path = DOC_ROOT.'app/controllers/';
    private static $namespace = 'app\\controllers\\';
    private static $action;
    private static $saveRoutes = [
        'Main' => ['about','welcome','login','registration','personal'],
        'Shop' => [ '' ],
        'Ajax' => ['post','get']
    ];
    private static $defaultController = 'app\\controllers\\Main';

    public static function start()
    {

        $contrName = self::getRoutes();
        $fileContr = self::$path.$contrName.'.php';
        $contr = self::$namespace.$contrName;
        $action = self::$action;
        if (file_exists($fileContr) && in_array($action,self::$saveRoutes[$contrName])  ) {

                $oContr = new $contr();
                $oContr->$action();


            } else {

                header('Location: /main/welcome');
            }

        }

    private static function getRoutes()
    {
        $request = trim($_SERVER['REQUEST_URI'],'/');
        $expUri = explode('/',$request);
        if ( count($expUri) < 2 ) {
            self::$action = 'default';
            return ucfirst(trim($expUri[0],'/'));
        }

        self::$action = $expUri[1];
        return  ucfirst($expUri[0]);
    }

}
