<?php

namespace MvcSkillet\App;

use MvcSkillet;
use MvcSkillet\Core\Routing;

abstract class AbstractApplication {

    protected MvcSkillet\Core\Routing\Router $_router;
    protected MvcSkillet\Http\Request        $_request;
    protected MvcSkillet\Http\Response       $_response;
    protected MvcSkillet\Config              $_config;

    public function __construct() {
        $this->_initialize();
    }

    public function _registerFatalHandler(int $errno, string $errstr, string $errfile = '', int $errline = 0, array $errcontext = []): bool {

    }

    public function start(): void {
        $this->_request = MvcSkillet\Http\Request::fromGlobals();

        $this->_initRoutes();

        $this->_processRequest();

        $url = $this->_request->url();
        $httpMethod = $this->_request->method();
        $route    = $this->_router->matchRoute($url, $httpMethod);
        $response = $this->_getResponseFromController($route);
        $response();
    }

    protected function _initialize() {
        $this->_response = new MvcSkillet\Http\Response();
        $this->_config   = MvcSkillet\ServiceLocator::applicationConfig();
        $this->_router   = MvcSkillet\Core\Routing\Router::_instance();
    }

    protected function _getResponseFromController(Routing\Entity\Route $route): MvcSkillet\Http\Response {
        $controller = $this->_createController($route->controllerName());
        $action     = $route->action();

        $controller->begin();
        $response = method_exists($controller, $action) ? $controller->$action() : $controller->default();
        $controller->end();

        return $response;
    }

    abstract protected function _processRequest();

    abstract protected function _createController(string $controllerClassName): MvcSkillet\Controller\AbstractController;

    abstract protected function _initRoutes(): void;



    protected function createRequestPipeline() {

    }

    private function _buildPipeline() {

    }
}