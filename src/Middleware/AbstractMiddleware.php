<?php

namespace MvcSkillet\Middleware;

use MvcSkillet\Http;

abstract class AbstractMiddleware {

    /**
     * @var AbstractMiddleware | Closure | callable | null
     */
    protected $_next;

    protected Http\Request $_request;

    protected Http\Response $_response;

    public function __construct(Http\Request $request, Http\Response $response) {
        $this->_request  = $request;
        $this->_response = $response;
        $this->_initialize();
    }

    public function __invoke() {
        $this->_processRequest();
        $next = $this->_next;
        if ($next !== null) {
            if ($next instanceof AbstractMiddleware) {
                $next();
            } else {
                $next($this->_request, $this->_response);
            }
        }
    }

    public function setNext(callable $next) {
        $this->_next = $next;
    }

    abstract protected function _processRequest();

    abstract protected function _initialize();
}