<?php

namespace MvcSkillet\Core\Service;

use MvcSkillet\Core;
use MvcSkillet\ServiceLocator;

class UrlService {

    private Core\Routing\Router $_router;

    public function __construct() {
        $this->_router = Core\Routing\Router::_instance();
    }

    public function generateUrlByName(string $routeName, array $params = []) {
        return $this->_router->generateRoute($routeName, $params);
    }


}