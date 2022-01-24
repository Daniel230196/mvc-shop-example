<?php

namespace MvcSkillet;

use MvcSkillet\Core\Exception\Config\InvalidJsonConfig;
use MvcSkillet\Core\Exception\Config\UnsupportedPhpConfigType;
use MvcSkillet\Core\Service\BasicToolsService;

class Config implements \ArrayAccess {

    public const DEFAULT_CONFIG_KEY = 'config';
    public const JSON_CONFIG_KEY    = 'json_configs';

    private array $_configContainer;

    private BasicToolsService $_basicToolsService;

    public function __construct() {
        $this->_basicToolsService = ServiceLocator::tools();
        $this->_configContainer   = require_once __DIR__ . '/config.default.php';
        $this->_installAdditionalConfig();
    }

    public function offsetExists($offset): bool {
        $value = $this->_configContainer[$offset];
        return $value !== null;
    }

    public function offsetGet($offset): mixed {
        return $this->offsetExists($offset) ? $this->_configContainer[$offset] : null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset !== null) {
            $this->_configContainer[$offset] = $value;
            return;
        }

        $this->_configContainer[] = $value;
    }

    public function offsetUnset($offset): void {
        unset($this->_configContainer[$offset]);
    }

    public static function isDevMode(): bool {
        //@TODO: implement via .env|common default config file
        return true;
    }

    private function _installAdditionalConfig(): void {
        $directories = $this->_configContainer['paths']['additional_config_dir'] ?? null;
        if ($directories === null || count($directories) === 0) {
            return;
        }
        foreach ($directories as $directoryPath) {
            if (!is_dir($directoryPath)) {
                continue;
            }
            $directory = dir($directoryPath);
            while (false !== $file = $directory->read()) {
                $this->_installConfigFile($file);
            }
        }
    }

    private function _installConfigFile(string $filepath) {
        if (!file_exists($filepath) || is_dir($filepath)) {
            return;
        }

        switch (true) {
            case str_contains($filepath, '.php'):
                $this->_addPhpConfigFile($filepath);
            case str_contains($filepath, '.json'):
                $this->_addJsonConfigFile($filepath);
        }
    }

    private function _addPhpConfigFile(string $filepath): void {
        $configData = require_once $filepath;
        if (!is_array($configData)) {
            $returnType = gettype($configData);
            throw new UnsupportedPhpConfigType("Config file {$filepath} must return array. Current type: {$returnType}");
        }

        $this[self::DEFAULT_CONFIG_KEY] = array_merge($this->_configContainer, $configData);
    }

    private function _addJsonConfigFile(string $filePath): void {
        $fileContent = file_get_contents($filePath);
        $fileName    = $this->_basicToolsService->extractFilName($filePath);
        try {
            $this[self::JSON_CONFIG_KEY][$fileName] = $this->_basicToolsService->validateJson($fileContent);
        } catch (\JsonException $e) {
            throw new InvalidJsonConfig("Config file {$filePath} contains invalid JSON. Msg: {$e->getMessage()}");
        }
    }
}