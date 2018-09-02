<?php

namespace PAB2\Record;

/**
 * Interface RecordInterface
 * @package PAB2\RecordType
 */
interface RecordInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getKey();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return mixed
     */
    public static function getFields();

    /**
     * @return mixed
     */
    public function getValues();

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function getValue(string $key, $default = null);
}
