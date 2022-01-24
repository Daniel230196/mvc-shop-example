<?php

namespace MvcSkillet\Core\Service;

use http\Exception\RuntimeException;

class BasicToolsService {

    public function __construct() {}

    /**
     * @param mixed $data
     * @return string
     * @throws \JsonException
     */
    public function makeJson(mixed $data): string {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }

    /**
     * @param mixed $json
     * @return mixed|null
     * @throws \JsonException
     */
    public function unpackJson(mixed $json): ?string {
        return ($json === null || $json = '') ? null : json_decode($json, true,512, JSON_THROW_ON_ERROR);
    }

    public function isAny(array $values, $callback = 'is_null'): bool {
        foreach ($values as $value) {
            if (call_user_func($callback, $value)) {
                 return true;
            }
        }

        return false;
    }

    public function asyncExecute(callable $callback, array $arguments) {
        register_shutdown_function(function () use ($callback, $arguments) {
            fastcgi_finish_request();
            $callback(...$arguments);
        });
    }

    public function extractFilName(string $path): ?string {
        $pathParts = pathinfo($path);
        if (!is_array($pathParts)) {
            return null;
        }
        return $pathParts['filename'] ?? null;
    }

    public function validateJson(string $json): string {
        json_encode(json_decode($json));
        $error = json_last_error_msg();
        if ($error !== 'No error') {
            throw new \JsonException($error);
        }

        return $json;
    }

    /**
     * @param array|object $target
     * @param string[]|string $key
     * @return bool
     */
    public function keysExists(array|object $target, array|string $key): bool {
        $fields       = is_array($key) ? $key : [$key];
        $checkResults = [];
        if (is_object($target)) {
            foreach ($fields as $field) {
                $checkResults[] = property_exists($target, $field);
            }
            return array_reduce($checkResults, function ($previous, $current) {
                return ($previous && $current);
            });
        } else if (is_array($target)) {
            return in_array($target, $fields, true);
        }

        throw new RuntimeException();
    }

    public function collapseArrays(array $arrays): array {
        return count($arrays) > 1 ? call_user_func_array('array_merge', array_map('array_values', $arrays)) : [];
    }


    public function normalizePhone(string $phone): string {
        //@TODO: implement method
        return $phone;
    }

    public function normalizeEmail(string $email): string {
        return $email;
    }
}