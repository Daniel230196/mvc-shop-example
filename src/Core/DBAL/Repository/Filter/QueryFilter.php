<?php

namespace MvcSkillet\Core\DBAL\Repository\Filter;

use MvcSkillet\Core\Exception;

class QueryFilter {

    private string $_expression;

    private const OPERATOR_EQUALS       = '=';
    private const OPERATOR_GREATER      = '>';
    private const OPERATOR_LOWER        = '<';
    private const OPERATOR_IN_CONDITION = 'in';

    public function __construct(string $fieldName, string $operator, mixed $value) {
        switch ($operator) {
            case self::OPERATOR_EQUALS:
            case self::OPERATOR_GREATER:
            case self::OPERATOR_LOWER:
                $this->_expression = "WHERE {$fieldName}{$operator}`{$value}`";
            case self::OPERATOR_IN_CONDITION:
                if (!is_array($value)) {
                    throw new Exception\DBAL\RuntimeException('In-condition filter error. Value must be an array');
                }
                $targetValues      = implode(', ', $value);
                $this->_expression = "WHERE {$fieldName} IN ({$targetValues})";
            default:
                throw new Exception\DBAL\RuntimeException("Unsupported filter operator: {$operator}");
        }
    }

    public function expression(): string {
        return $this->_expression;
    }
}