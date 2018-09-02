<?php

namespace PAB2\Record;

/**
 * Class Product
 * @package PAB2\Record
 */
class Product extends AbstractRecord
{
    /**
     * @var array
     */
    public static $fields = [
        0 => [
            'key' => 'Mutationcode',
            'name' => 'Mutatatiecode',
            'start' => 0,
            'length' => 1,
        ],
        1 => [
            'key' => 'Productcode',
            'name' => 'Productcode fabrikant',
            'start' => 1,
            'length' => 20,
        ],
        2 => [
            'key' => 'ManufacturerGLN',
            'name' => 'GLN fabrikant',
            'start' => 21,
            'length' => 13,
        ],
        3 => [
            'key' => 'GTIN',
            'name' => 'GTIN product',
            'start' => 34,
            'length' => 14
        ],
        4 => [
            'key' => 'StartDate',
            'name' => 'Ingangsdatum',
            'start' => 48,
            'length' => 8
        ],
        5 => [
            'key' => 'Description',
            'name' => 'Productomschrijving',
            'start' => 56,
            'length' => 70
        ],
        6 => [
            'key' => 'StatusCode',
            'name' => 'Statuscode',
            'start' => 126,
            'length' => 3
        ],
        // TODO the rest of the specifications
    ];

    /**
     * @var string
     */
    protected $type = 'Product';

    /**
     * @var integer
     */
    protected $fileId;

    /**
     * Product constructor.
     * @param array $values
     */
    public function __construct($fileId, array $values)
    {
        $this->fileId = $fileId;
        $this->key = 'product';
        $this->title = 'Products';

        parent::__construct($values);
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
