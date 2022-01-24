<?php

namespace MvcSkillet\Controller;

use MvcSkillet\Core\Service;
use MvcSkillet\Http;
use MvcSkillet\Component;
use MvcSkillet\ServiceLocator;

abstract class AbstractController {

    protected Http\Response $_response;
    protected Http\Request  $_request;

    protected Service\AuthorizationServiceInterface $_authorizationService;
    protected Service\BasicToolsService             $_basicToolsService;
    protected Component\Validation\Validator        $_validatorComponent;

    public function __construct(Http\Request $request, Http\Response $response) {
        $this->_response = $response;
        $this->_request  = $request;
    }

    protected function _initialize() {
        $this->_basicToolsService  = ServiceLocator::tools();
        $this->_validatorComponent = ServiceLocator::validator();
    }

    public function begin(): void {
        $this->_authorizeRequest();
    }

    abstract public function end(): void;

    /**
     * @param string[] $routes
     */
    protected function targetRoutes(array $routes): void {
    }

    protected function _corsEnable(): void {
        $this->_response->setHeaders(['Access-Control-Allow-Origin: *']);
    }

    protected function _redirectResponse(string $redirectUrl, bool $isPermanent = false): Http\Response {
        $status = $isPermanent ? 301 : 302;
        return $this->_response->setStatus($status)->setHeaders(["Location: {$redirectUrl}"]);
    }

    abstract public function default(): Http\Response;

    abstract protected function _authorizeRequest();
}