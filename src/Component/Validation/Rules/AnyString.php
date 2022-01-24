<?php

namespace MvcSkillet\Component\Validation\Rules;

class AnyString extends AbstractRule {

    public function validate(mixed $value): bool {
        if ($value === null || is_string($value)) {
            return true;
        }

        $this->_errors[] = 'Value is not a string';
        return false;
    }
}