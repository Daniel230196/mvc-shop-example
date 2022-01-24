<?php

namespace MvcSkillet\Http;

class Request {

    private string $_requestUri;

    private array       $_get;
    private array       $_post;
    private array       $_cookies;
    private array       $_files;
    private array       $_headers;
    private array       $_server;
    private string|bool $_body;

    public function __construct(array $get, array $post, array $cookies, array $files, array $server) {
        $this->_get     = $get;
        $this->_post    = $post;
        $this->_cookies = $cookies;
        $this->_files   = $files;
        $this->_server  = $server;
        $this->_body    = $this->getBody();
        $this->_headers = getallheaders();
    }

    public static function fromGlobals(): self {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default): mixed {
        $valueFromGet = $this->_get[$key] ?? null;
        return $valueFromGet ?? $default;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function post(string $key, mixed $default = null): mixed {
        $valueFromPost = $this->_post[$key] ?? null;
        return $valueFromPost ?? $default;
    }

    public function getBody(): bool|string {
        return file_get_contents('php://input');
    }

    public function method(): string {
        return $this->_server['REQUEST_METHOD'];
    }

    public function url(): string {
        return $this->_server['REQUEST_URI'];
    }

    public function getData(): array {
        if (count($this->_post) < 1) {
            return $this->_get;
        }

        return $this->_post;
    }
}