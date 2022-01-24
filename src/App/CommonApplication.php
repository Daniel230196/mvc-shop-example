<?php

namespace MvcSkillet\App;

use MvcSkillet;

class CommonApplication extends AbstractApplication {

    private const DEFAULT_CONTROLLER_CLASS = MvcSkillet\Controller\Common\BaseCommonController::class;

    protected function _processRequest() {
        echo 'process_request';
    }

    protected function _createController(string $controllerClassName): MvcSkillet\Controller\AbstractController {
        $templatesPath = $this->_config['paths']['templates'] ?? null;
        if ($controllerClassName === 'default') {
            $defaultControllerClass = self::DEFAULT_CONTROLLER_CLASS;
            return new $defaultControllerClass($this->_request, $this->_response, $templatesPath);
        }

        return new $controllerClassName($this->_request, $this->_response, $templatesPath);
    }

    protected function _initRoutes(): void {
        require_once PROJECT_SOURCE . 'routes.php';
    }
}