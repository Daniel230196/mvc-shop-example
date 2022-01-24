<?php

namespace MvcSkillet\Component\Validation\Rules;

class Required extends AbstractRule {

    public function validate(mixed $value): bool {
        if ($value !== null) {
            return true;
        }

        $this->_errors[] = 'Value must not be null';
        return false;
    }
}