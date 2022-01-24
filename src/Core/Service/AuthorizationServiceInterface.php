<?php

namespace MvcSkillet\Core\Service;

use MvcSkillet\Http;

interface AuthorizationServiceInterface {

    public function authorize(array $data): bool;
}