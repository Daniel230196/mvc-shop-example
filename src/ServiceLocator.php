<?php

namespace MvcSkillet;

use MvcSkillet\Component\Validation\Validator;
use MvcSkillet\Core\Service\BasicToolsService;
use MvcSkillet\Core\Service\UrlService;

class ServiceLocator {

    /**
     * @var ServiceFactory
     */
    protected static  $_factory;

    protected static array $_serviceStorage;

    private static function _serviceFactory(): ServiceFactory {
        if (null === self::$_factory) {
            self::$_factory = new ServiceFactory();
        }

        return self::$_factory;
    }

    public static function validator(): Validator {
        return self::_createServiceWithCache(Validator::class);
    }

    public static function tools(): BasicToolsService {
        return self::_createServiceWithCache(BasicToolsService::class);
    }

    public static function applicationConfig(): Config {
        return self::_createServiceWithCache(Config::class);
    }

    public static function userComponent(): Component\User\Facade {
        return self::_createServiceWithCache(Component\User\Facade::class);
    }

    public static function urlService(): UrlService {
        return self::_createServiceWithCache(UrlService::class);
    }

    private static function _createServiceWithCache(string $serviceName): mixed {
        return self::$_serviceStorage[$serviceName] ?? self::$_serviceStorage[$serviceName] = self::_serviceFactory()->getService($serviceName);
    }
}