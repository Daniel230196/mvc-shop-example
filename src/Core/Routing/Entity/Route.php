<?php

namespace MvcSkillet\Core\Routing\Entity;

class Route {
    private string $_name;
    private string $_controller;
    private string $_action;
    private array $_params;

    public function __construct(string $name = 'default', string $controller = 'default', string $action = 'default', array $params = []) {
        $this->_name       = $name;
        $this->_action     = $action;
        $this->_controller = $controller;
        $this->_params     = $params;
    }

    public function controllerName(): string {
        return $this->_controller;
    }

    public function name(): string {
        return $this->_name;
    }

    public function action(): string {
        return $this->_action;
    }

    public function params(): array {
        return $this->_params;
    }
}