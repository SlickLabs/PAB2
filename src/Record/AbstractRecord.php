<?php

namespace PAB2\Record;

use PAB2\FormatterInterface;

/**
 * Class AbstractRecord
 * @package PAB2\Record
 */
abstract class AbstractRecord implements RecordInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var array
     */
    protected $values = [];

    public static $fields = [];

    /**
     * @var integer
     */
    protected $fileId;

    /**
     * AbstractRecord constructor.
     * @param string $line
     */
    public function __construct(int $fileId, array $values)
    {
        $this->fileId = $fileId;

        $this->setValues($values);
    }

    /**
     * @param string $line
     */
    public function setLine(string $line)
    {
        $this->line = $line;
    }

    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'title' => $this->getTitle(),
            'values' => $this->getValues()
        ];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $data
     * @return array
     */
    public function setValues(array $data)
    {
        $this->values = [];
        foreach ($this->getFields() as $key => $field) {
            if (isset($data[$field['key']])) {
                $format = (isset($field['format'])) ? $field['format'] : null;

                $this->values[$field['key']] = $this->formatValue($format, $data[$field['key']]);
            }
        }
        return $this->values;
    }

    /**
     * @param $format
     * @param $value
     * @return \DateTime|float|int|null
     */
    public function formatValue($format, $value)
    {
        if (!$value) {
            return null;
        }

        switch ($format) {
            case 'integer':
                $value = (int)$value;
                break;
            case 'date':
                $value = new \DateTime($value);
                break;
            case 'currency':
                $value = ($value / 100);
                break;
        }

        return $value;
    }

    /**
     * @return array
     */
    public static function getFields()
    {
        return static::$fields;
    }
    /**
     * @return integer
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function getValue(string $key, $default = null)
    {
        return (isset($this->values[$key]))? $this->values[$key] : $default;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $string = '';
        $values = $this->getValues();

        foreach (self::$fields as $field) {

            $value = '';
            if ($values[$field['key']]) {
                $value = $values[$field['key']];
            }

            $string .= str_pad($value, $field['length'], ' ', STR_PAD_RIGHT);
        }

        return $string;
    }
}
