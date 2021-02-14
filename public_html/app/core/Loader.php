<?php

namespace app\core;

class Loader
{
    private static function autoload($class_name)
    {
        $class_name = str_replace('\\', '/', $class_name);
        require_once(\DOC_ROOT.$class_name.".php");
    }
    public static function init()
    {
        return spl_autoload_register(__NAMESPACE__.'\Loader::autoload');
    }
}
