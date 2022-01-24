<?php

namespace MvcSkillet\Core\Service;

use MvcSkillet\Http;
use MvcSkillet\ServiceFactory;
use MvcSkillet\ServiceLocator;

class BaseAuthorizationService implements AuthorizationServiceInterface {


    private const SESSION_NAME_KEY = 'PHPSESSID';

    protected BasicToolsService $_toolsService;

    private const AUTH_COOKIES_NAMES = ['user', 'application'];

    public function __construct() {

    }

    public function cookieAuthorization() {
    }

    public function authorize(array $dataForStore): bool {

    }

    public function authorizeSession() {
        $sessionName = $_SESSION[self::SESSION_NAME_KEY] ?? null;
        if ($sessionName !== null) {
            session_destroy();
            unset($_SESSION[self::SESSION_NAME_KEY]);
        }

        session_start();
        $sessionId = session_name();
        return $sessionId;
    }

    protected function _initialize(): void {
        $this->_toolsService = ServiceLocator::tools();
    }

    private function authorizeByUserName(string $userName): bool {

    }
}