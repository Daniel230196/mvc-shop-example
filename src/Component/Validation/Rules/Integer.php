<?php

namespace MvcSkillet\Component\Validation\Rules;

class Integer extends AbstractRule {

    public function validate(mixed $value): bool {
        if ($value === null) {
            return  true;
        }

        if (!is_int($value)) {
            $this->_errors[] = 'Value must be valid num';
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}