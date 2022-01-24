<?php

namespace MvcSkillet\Component\Validation\Rules;

abstract class AbstractRule {

    protected array $_errors;

    abstract public function validate(mixed $value): bool;

    public function errors(): array {
        return $this->_errors ?? [];
    }
}