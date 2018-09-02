<?php

namespace PAB2;

/**
 * Class AbstractReader
 * @package PAB2
 */
abstract class AbstractReader implements ReaderInterface
{
    /**
     * @param string $class
     * @param string $interface
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function validateClass(string $class, string $interface)
    {
        ReflectionClass::create($class)
            ->throwExceptionOnError()
            ->isInstantiable()
            ->implementsInterface($interface);
    }
}