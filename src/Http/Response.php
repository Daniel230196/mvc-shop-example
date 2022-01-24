<?php

namespace MvcSkillet\Http;

class Response {

    private int     $_httpStatus;
    private ?string $_body;
    private array   $_headerBag;

    public function __construct(?int $httpStatus = 200, ?string $body = null, ?array $headers = []) {
        $this->_httpStatus = $httpStatus;
        $this->_body       = $body;
        $this->_headerBag  = $headers;
    }

    public function setStatus(int $status): self {
        $this->_httpStatus = $status;
        return $this;
    }

    public function setHeaders(array $headers): self {
        $this->_headerBag = array_merge($this->_headerBag, $headers);
        return $this;
    }

    public function setData(string $data): self {
        $this->_body = $data;
        return $this;
    }

    public function __invoke() {
        $this->_sendHeaders();
        $this->_sendData();
    }

    private function _sendData() {
        echo $this->_body;
    }

    private function _sendHeaders() {
        http_response_code($this->_httpStatus);
        array_map(function(string $headerName, string $headerValue) {
            header("{$headerName}:{$headerValue}");
        }, $this->_headerBag);
    }

}