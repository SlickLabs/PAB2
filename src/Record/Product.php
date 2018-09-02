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

        1 => [
            'key' => 'Mutationcode',
            'name' => 'Mutatiecode',
            'length' => 1,
            'format' => 'N',
            'required' => true,
            'start' => 1,
            'end' => 1,
        ],
        2 => [
            'key' => 'Productcode',
            'name' => 'Productcode fabrikant',
            'length' => 20,
            'format' => 'A',
            'required' => true,
            'start' => 2,
            'end' => 21,
        ],
        3 => [
            'key' => 'ManufacturerGLN',
            'name' => 'GLN fabrikant',
            'length' => 13,
            'format' => 'N',
            'required' => true,
            'start' => 22,
            'end' => 34,
        ],
        4 => [
            'key' => 'GTIN',
            'name' => 'GTIN product',
            'length' => 14,
            'format' => 'N',
            'required' => false,
            'start' => 35,
            'end' => 48,
        ],
        5 => [
            'key' => 'StartDate',
            'name' => 'Ingangsdatum',
            'length' => 8,
            'format' => 'N',
            'required' => false,
            'start' => 49,
            'end' => 56,
        ],
        6 => [
            'key' => 'Description',
            'name' => 'Productomschrijving',
            'length' => 70,
            'format' => 'A',
            'required' => false,
            'start' => 57,
            'end' => 126,
        ],
        7 => [
            'key' => 'StatusCode',
            'name' => 'Statuscode',
            'length' => 3,
            'format' => 'A',
            'required' => false,
            'start' => 127,
            'end' => 129,
        ],
        8 => [
            'key' => 'SuccessorGTIN',
            'name' => 'GTIN product opvolger',
            'length' => 14,
            'format' => 'N',
            'required' => false,
            'start' => 130,
            'end' => 143,
        ],
        9 => [
            'key' => 'SuccessorProductcode',
            'name' => 'Productcode opvolger',
            'length' => 20,
            'format' => 'A',
            'required' => false,
            'start' => 144,
            'end' => 163,
        ],
        10 => [
            'key' => 'PredecessorGTIN',
            'name' => 'GTIN product voorganger',
            'length' => 14,
            'format' => 'N',
            'required' => false,
            'start' => 164,
            'end' => 177,
        ],
        11 => [
            'key' => 'PredecessorProductcode',
            'name' => 'Productcode voorganger',
            'length' => 20,
            'format' => 'A',
            'required' => false,
            'start' => 178,
            'end' => 197,
        ],
        12 => [
            'key' => 'WeightQuantity',
            'name' => 'Netto gewicht',
            'length' => 19,
            'format' => 'D 15.3',
            'required' => true,
            'start' => 198,
            'end' => 216,
        ],
        13 => [
            'key' => 'WeightMeasureUnitCode',
            'name' => 'Eenheid gewicht',
            'length' => 3,
            'format' => 'A',
            'required' => true,
            'start' => 217,
            'end' => 219,
        ],
        14 => [
            'key' => 'Brand',
            'name' => 'Fabrikaat',
            'length' => 35,
            'format' => 'A',
            'required' => false,
            'start' => 220,
            'end' => 254,
        ],
        15 => [
            'key' => 'Model',
            'name' => 'Productserie',
            'length' => 35,
            'format' => 'A',
            'required' => false,
            'start' => 255,
            'end' => 289,
        ],
        16 => [
            'key' => 'Version',
            'name' => 'Producttype',
            'length' => 35,
            'format' => 'A',
            'required' => false,
            'start' => 290,
            'end' => 324,
        ],
        17 => [
            'key' => 'ProductgroupCode',
            'name' => 'Code productgroep',
            'length' => 4,
            'format' => 'Z',
            'required' => false,
            'start' => 325,
            'end' => 328,
        ],
        18 => [
            'key' => 'SequenceNumberProductClass',
            'name' => 'Volgnummer productklasse',
            'length' => 3,
            'format' => 'Z',
            'required' => false,
            'start' => 329,
            'end' => 331,
        ],
        19 => [
            'key' => 'StandardSheetVersion',
            'name' => 'Versie normblad',
            'length' => 2,
            'format' => 'Z',
            'required' => false,
            'start' => 332,
            'end' => 333,
        ],
        20 => [
            'key' => 'StandardSheetStatus',
            'name' => 'Status normblad',
            'length' => 1,
            'format' => 'N',
            'required' => false,
            'start' => 334,
            'end' => 334,
        ],
        21 => [
            'key' => 'Deeplink',
            'name' => 'Deeplink',
            'length' => 512,
            'format' => 'A',
            'required' => false,
            'start' => 335,
            'end' => 846,
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
