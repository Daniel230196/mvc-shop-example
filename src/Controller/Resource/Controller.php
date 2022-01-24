<?php

namespace MvcSkillet\Controller\Resource;

use MvcSkillet\Controller\AbstractController;
use MvcSkillet\Http;

abstract class Controller extends AbstractController {

    protected const HTTP_INTERNAL_ERROR_CODE = 400;

    protected function _jsonResponse(mixed $data): Http\Response {
        $response = new Http\Response();
        $response->setHeaders(['Content-Type', 'application/json; charset=utf-8']);
        try {
            $jsonData   = $this->_basicToolsService->makeJson($data);
            $statusCode = 200;
            $response->setStatus($statusCode)
                ->setData($jsonData);
        } catch (\JsonException $exception){
            $response->setStatus(static::HTTP_INTERNAL_ERROR_CODE)
                ->setData('{"status": "internal_error"}');
        } catch (\Throwable $t) {

        }
        return $response;
    }

    public function default(): Http\Response {
        return $this->_jsonResponse(['status' => 'resource_not_found']);
    }

    abstract public function create(): Http\Response;

    abstract public function read(): Http\Response;

    abstract public function update(): Http\Response;

    abstract public function delete(): Http\Response;
}