<?php

namespace PAB2\Record;

use PAB2\Enum\AbstractEnum;

/**
 * Class RecordTypes
 * @package PAB2
 */
class RecordTypes extends AbstractEnum
{
    const PRODUCT = 'Product';

    /**
     * @var string
     */
    protected static $namespace = __NAMESPACE__ . '\\Record\\';

    /**
     * @param string $key
     * @return mixed|string
     * @throws \ReflectionException
     */
    public static function get(string $key = '')
    {
        $result = self::getConstants();

        if (!$key) {
            return $result;
        }

        if (!is_string($key)) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects a string argument; received "%s"',
                __METHOD__,
                (is_object($key) ? get_class($key) : gettype($key))
            ));
        }

        if (self::isValidKey($key)) {
            $result = self::$namespace . $key;
        }

        return $result;
    }
}