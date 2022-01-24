<?php

namespace MvcSkillet\Component\User;

use MvcSkillet;
use MvcSkillet\Core;

class Facade {

    private Core\Service\BasicToolsService $_basicToolsService;
    private Repository $_repository;

    public function __construct() {
        $this->_initialize();
    }

    private function _initialize() {
        $this->_basicToolsService = MvcSkillet\ServiceLocator::tools();
        $this->_repository        = new Repository(MvcSkillet\ServiceLocator::applicationConfig());
    }

    public function login(string $login, string $password): User {
        $user = $this->_repository->loadUserByName($login);
        if ($user === null || !$this->_validateUserPasswordHash($user->password, $password)) {
            throw new Core\Exception\UserReadable\InvalidCredentials("Invalid login or password");
        }

        return $user;
    }

    public function register(string $login, string $password, string $email, string $phone) {
        $user = new User($login, $password, $email, $phone);
        if ($this->_checkNewUserAvailability($user)) {
            $this->_repository->storeUser($user);
        }

        throw new Core\Exception\UserReadable\InvalidCredentials('Login or email is already in use');
    }

    public function logout(User $user): void {
        $user->online = false;
    }

    private function _checkNewUserAvailability(User $user): bool {

    }

    private function _validateUserPasswordHash(string $passwordHash, string $password): bool {
        return password_verify($password, $passwordHash);
    }


}