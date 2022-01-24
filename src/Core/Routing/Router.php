<?php

namespace MvcSkillet\Core\Routing;

use MvcSkillet\Core;
use MvcSkillet\Core\Service\BasicToolsService;
use MvcSkillet\ServiceLocator;

/** @TODO: implement more useful wrapping above AltoRouter */

/**
 * @method Router map(string $name, string $method, array $params)
 */
class Router {

    private const HTTP_POST = 'POST';
    private const HTTP_GET  = 'GET';

    private \AltoRouter $_altoRouter;

    /**
     * @var Router
     */
    private static $_instance;

    private BasicToolsService $_basicToolsService;

    private static array $_existingRoutesByNames;

	private function __construct() {
        $this->_basicToolsService = ServiceLocator::tools();
        $this->_altoRouter        = new \AltoRouter();
	}

    public static function _instance(): self {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function middleware(array $middlewares): self {
        /**
         * @TODO: Handle middleware for routes
         */

        return $this;
    }

    public function matchRoute(string $url, string $method = 'GET'): Entity\Route {
        $matchData = $this->_altoRouter->match($url, $method);
        if (!$matchData) {
            return new Entity\Route();
        }

        return $this->_createRouteFromMatchData($matchData);
    }

    /**
     * @param string $method
     * @param array $args
     * @return $this
     * @throws Core\Exception\MethodNotFound
     */
    public static function __callStatic(string $method, array $args): self {
        $self = self::_instance();
        switch ($method) {
            case 'map':
                $self->_map(...$args);
                return $self;
            case 'middleware':
                return $self->middleware(...$args);
            case 'get':
                return $self->_get(...$args);
            case 'post':
                return $self->_post(...$args);
            case 'group':
                return $self->_group(...$args);
            default:
                throw new Core\Exception\MethodNotFound("Method '{$method}' not found in class ".__CLASS__);
        }
    }

    public function generateRoute(string $routeName, array $parameters = []): string {
        return $this->_altoRouter->generate($routeName, $parameters);
    }

    private function _createRouteFromMatchData(array $matchData): Entity\Route {
        $name       = $matchData['name'] ?? null;
        $action     = $matchData['target']['action'] ?? null;
        $params     = $matchData['params'] ?? null;
        $controller = $matchData['target']['_controller'] ?? null;
        return new Entity\Route($name, $controller, $action, $params);
    }

    private function _map(string $name, string $method, array $routeData): self {
        $this->_processRouteData($method, $name, $routeData);
        return $this;
    }

    private function _get(string $routeName, array $route = []): self {
        $this->_processRouteData(self::HTTP_GET, $routeName, $route);
        return $this;
    }

    private function _post(string $routeName, array $route = [], ): self {
        $this->_processRouteData(self::HTTP_POST, $routeName, $route);
        return $this;
    }

    private function _group(array $routes): self {
        /**
         *
         * @TODO: implement different type of route groups
         *
         */

        return $this;
    }

    private function _processRouteData(string $method, string $routeName, array $routeData): void {
        $url        = $routeData['url'] ?? null;
        $action     = $routeData['action'] ?? null;
        $controller = $routeData['controller'] ?? null;

        if ($this->_basicToolsService->isAny([$url, $controller, $action])) {
            throw new Core\Exception\Routing\InvalidRouteFormat("{$url} {$method}");
        }

        $this->_altoRouter->map($method, $url, ['_controller' => $controller, 'action' => $action], $routeName);
        self::$_existingRoutesByNames[$routeName] = $url;
    }

}