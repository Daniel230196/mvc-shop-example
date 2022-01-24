<?php

namespace MvcSkillet;

class ServiceFactory {

    public function __construct() {}

	public function getService(string $className): mixed {
		return $this->_getServiceRecursive($className, 1);
	}

	private function _getServiceRecursive(string $className, int $recursionDepth): mixed {
		if ($recursionDepth > 256) {
			throw new \Exception('Recursion depth limit exceeded');
		}

		$classReflection = new \ReflectionClass($className);
		$constructorReflection = $classReflection->getConstructor();
		if ($constructorReflection->getNumberOfRequiredParameters() !== 0) {
            $dependencies = [];
			foreach ($constructorReflection->getParameters() as $parameterReflection) {
                $dependencyParamName = $parameterReflection->name;
                $parameterType       = $parameterReflection->getType();
				$dependencies[$dependencyParamName] = !$parameterType->allowsNull()
                    ? $this->_getServiceRecursive($parameterType->getName(), ++$recursionDepth)
                    : null;
			}
            return new $className(...$dependencies);
		}

		return new $className();
	}
}