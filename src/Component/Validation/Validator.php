<?php

namespace MvcSkillet\Component\Validation;

use MvcSkillet;
use MvcSkillet\Core\Service;

class Validator {

    public Service\BasicToolsService $_basicToolsService;

    public function __construct() {
        $this->_initialize();
    }

    public function _initialize(): void {
        $this->_basicToolsService = MvcSkillet\ServiceLocator::tools();
    }

    /**
     * @param MvcSkillet\Http\Request $request
     * @param Rules\AbstractRule[][] $validationParameters [field => AbstractRule[][]]
     * @return array
     */
    public function validateRequest(MvcSkillet\Http\Request $request, array $validationParameters): array {
        $dataFromRequest = $request->getData();
        $errors          = [];
        foreach ($validationParameters as $fieldName => $rules) {
            $fieldValue = $dataFromRequest[$fieldName] ?? null;
            $errors[] = $this->_validateField($fieldValue, $fieldName, $rules);
        }
        return $this->_basicToolsService->collapseArrays($errors);
    }

    /**
     * @param mixed $value
     * @param Rules\AbstractRule[] $rules
     * @return array
     */
    private function _validateField(mixed $value, string $fieldName, array $rules): array {
        $validationErrors = [];
        foreach ($rules as $rule) {
            if (!$rule->validate($value)) {
                $validationErrors[$fieldName] = $rule->errors();
            }
        }

        return $this->_basicToolsService->collapseArrays($validationErrors);
    }
}