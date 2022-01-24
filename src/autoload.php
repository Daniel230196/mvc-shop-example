<?php

$composerLoader = require_once __DIR__ . '/../vendor/autoload.php';

/** @var $composerLoader Composer\Autoload\ClassLoader */
$composerLoader->register();


spl_autoload_register('autoload_common');

function autoload_common($className): void {
    $rootFrameworkPath = __DIR__;
    $rootFrameworkNamespace = 'MvcSkillet';
	$classPath = str_replace(["\\", $rootFrameworkNamespace], [DIRECTORY_SEPARATOR, ''], $className);
	if (file_exists("{$rootFrameworkPath}{$classPath}.php")) {
		require_once "{$rootFrameworkPath}{$classPath}.php";
	}
}

function autoload_different() {
	/**
	 * For different implementation
	 */
}