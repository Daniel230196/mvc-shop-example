<?php

namespace MvcSkillet;

use MvcSkillet\Controller\Common;

Core\Routing\Router::group([
    /*\MvcSkillet\Router::get('test_group_route_1'),
    \MvcSkillet\Router::get('test_group_route_2'),
    \MvcSkillet\Router::get('test_group_route_4'),
    \MvcSkillet\Router::get('test_group_route_3'),
    \MvcSkillet\Router::get('test_group_route_5'),*/
])->middleware([
    'begin' => [],
    'end'   => [],
]);


Core\Routing\Router::get('main_page', ['url' => '/main/index', 'controller' => Common\BaseCommonController::class, 'action' => 'index'])
    ->middleware([]);
Core\Routing\Router::map('user_login','GET|POST', ['url' => '/login', 'controller' => Common\UserController::class, 'action' => 'login'])
    ->middleware([]);
Core\Routing\Router::map('user_register', 'GET|POST', ['url' => '/registration', 'controller' => Common\UserController::class, 'action' => 'register'])
    ->middleware([]);
