<?php

namespace MvcSkillet\Component\User;

use MvcSkillet\Core\DBAL;

class User extends DBAL\AbstractEntity {

    public function __construct(public string $login, public string $password, public string $email, public ?string $phone = null, bool $online = true) {}
}