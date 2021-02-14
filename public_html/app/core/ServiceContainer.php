<?php
namespace app\core;

//require_once __DIR__.'/Loader.php';

use \app\core\interfaces\Crud;

class ServiceContainer
{
/*
 * @services array
 * */
    private $services = [
        'model' => [
            'User',
            'Product',

        ],
        'provider' => [],

    ];

    public function __construct()
    {

    }
    public function set(array $instance , $object=null) : ServiceContainer
    {
        list($type,$name) = $instance;
        $this->services[$type][$name] = $object;
        return $this;

    }
    public function get(string $type, string $name)
    {
        return $this->services[$type][$name];
    }

}
/*

*/

