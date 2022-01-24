<?php

namespace MvcSkillet\Middleware\Pipeline;

use MvcSkillet\Middleware\AbstractMiddleware;
use MvcSkillet\ServiceLocator;
use MvcSkillet\Core\Service;

class Pipeline {

    /** @var AbstractMiddleware[] */
    private array $_before;

    /** @var AbstractMiddleware[] */
    private array $_end;

    private Service\BasicToolsService $_basicToolsService;

    public function __construct(array $onStartMiddlewares, array $onEndMiddleware) {
        $this->_basicToolsService = ServiceLocator::tools();
        $this->_before            = $onStartMiddlewares;
        $this->_end               = $onEndMiddleware;
        $this->_build();
    }

    public function executeBegin() {
        $list = new \SplDoublyLinkedList();
        foreach ($this->_before as $index => $middleware) {
            $currentValue = class_exists($middleware)
                ? new $middleware()
                : $middleware;
            $list->add($index, $currentValue);
            $list->prev();
        }
    }

    public function executeEnd() {

    }

    private function _build() {
        if (!$this->_basicToolsService->keysExists()) {

        }
    }

}