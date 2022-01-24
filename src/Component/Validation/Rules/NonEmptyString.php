<?php

namespace MvcSkillet\Component\Validation\Rules;

class NonEmptyString extends AbstractRule {

    public function validate(mixed $value): bool {
        if (is_string($value) && $value !== '') {
            return true;
        }

        $this->_errors[] = 'Value must be not empty string';
        return false;
    }
}