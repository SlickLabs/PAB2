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
            'length' => 14,
        ],
        4 => [
            'key' => 'StartDate',
            'name' => 'Ingangsdatum',
            'start' => 48,
            'length' => 8,
        ],
        5 => [
            'key' => 'Description',
            'name' => 'Productomschrijving',
            'start' => 56,
            'length' => 70,
        ],
        6 => [
            'key' => 'StatusCode',
            'name' => 'Statuscode',
            'start' => 126,
            'length' => 3,
        ],
        7 => [
            'key' => 'SuccessorGTIN',
            'name' => 'GTIN product opvolger',
            'start' => 129,
            'length' => 14,
        ],
        8 => [
            'key' => 'SuccessorProductcode',
            'name' => 'Productcode opvolger',
            'start' => 143,
            'length' => 20,
        ],
        9 => [
            'key' => 'PredecessorGTIN',
            'name' => 'GTIN product voorganger',
            'start' => 163,
            'length' => 14,
        ],
        10 => [
            'key' => 'PredecessorProductcode',
            'name' => 'Productcode voorganger',
            'start' => 177,
            'length' => 20,
        ],
        11 => [
            'key' => 'WeightQuantity',
            'name' => 'Netto gewicht',
            'start' => 197,
            'length' => 19,
        ],
        12 => [
            'key' => 'WeightMeasureUnitCode',
            'name' => 'Eenheid gewicht',
            'start' => 216,
            'length' => 3,
        ],
        13 => [
            'key' => 'Brand',
            'name' => 'Fabrikaat',
            'start' => 219,
            'length' => 35,
        ],
        14 => [
            'key' => 'Model',
            'name' => 'Productserie',
            'start' => 254,
            'length' => 35,
        ],
        15 => [
            'key' => 'Version',
            'name' => 'Producttype',
            'start' => 289,
            'length' => 35,
        ],
        16 => [
            'key' => 'ProductgroupCode',
            'name' => 'Code productgroep',
            'start' => 324,
            'length' => 4,
        ],
        17 => [
            'key' => 'SequenceNumberProductClass',
            'name' => 'Volgnummer productklasse',
            'start' => 328,
            'length' => 3,
        ],
        18 => [
            'key' => 'StandardSheetVersion',
            'name' => 'Versie normblad',
            'start' => 331,
            'length' => 2,
        ],
        19 => [
            'key' => 'StandardSheetStatus',
            'name' => 'Status normblad',
            'start' => 333,
            'length' => 1,
        ],
        20 => [
            'key' => 'Deeplink',
            'name' => 'Deeplink',
            'start' => 334,
            'length' => 512,
        ],
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
