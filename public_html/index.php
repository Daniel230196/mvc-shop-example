<?php


use app\core\ServiceContainer;
use app\core\Loader;

require_once 'app/core/Loader.php';

Loader::init();

define('PROT', ( !empty($_SERVER['HTTPS']) ? 'https://' : 'http://' ) ) ;
define('HOST', $_SERVER['HTTP_HOST']) ;
define('ROOT', PROT.HOST);
define ('DOC_ROOT',  $_SERVER['DOCUMENT_ROOT'] );



$config = new Config();
$service = new ServiceContainer();

$app = new \app\App($config, $service);

/* Routing URL */

app\core\Route::start();




