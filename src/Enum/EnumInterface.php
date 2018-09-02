<?php

namespace PAB2\Enum;

/**
 * Interface EnumInterface
 * @package PAB2\Enum
 */
interface EnumInterface
{
    /**
     * @param string $name
     * @param bool $strict
     * @return mixed
     */
    public static function isValidKey(string $name, $strict = false);

    /**
     * @param mixed $value
     * @param bool $strict
     * @return mixed
     */
    public static function isValidValue($value, $strict = true);
}
