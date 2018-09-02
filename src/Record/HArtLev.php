<?php

namespace PAB2\Record;

/**
 * Class HArtLev
 * @package PAB2\Record
 */
class HArtLev extends AbstractRecord
{
    /**
     * @var array
     */
    public static $fields = [
        1 => [
            'key' => 'MessageVersion',
            'name' => 'Bericht versie',
            'length' => 3,
            'format' => 'A',
            'required' => true,
            'start' => 1,
            'end' => 3,
        ],
        2 => [
            'key' => 'MessageType',
            'name' => 'Bericht type',
            'length' => 3,
            'format' => 'A',
            'required' => true,
            'start' => 4,
            'end' => 6,
        ],
        3 => [
            'key' => 'ArticleMessagenumber',
            'name' => 'Artikelberichtnummer',
            'length' => 17,
            'format' => 'A',
            'required' => true,
            'start' => 7,
            'end' => 2,
        ],
        4 => [
            'key' => 'MessageDate',
            'name' => 'Berichtdatum',
            'length' => 8,
            'format' => 'N',
            'required' => true,
            'start' => 24,
            'end' => 3,
        ],
        5 => [
            'key' => 'MutationCode',
            'name' => 'Mutatiecode',
            'length' => 1,
            'format' => 'N',
            'required' => true,
            'start' => 32,
            'end' => 3,
        ],
        6 => [
            'key' => 'PriceChangeIndication',
            'name' => 'Indicatie prijswijziging',
            'length' => 3,
            'format' => 'A',
            'required' => true,
            'start' => 33,
            'end' => 3,
        ],
        7 => [
            'key' => 'SupplierGLN',
            'name' => 'GLN leverancier',
            'length' => 13,
            'format' => 'N',
            'required' => false,
            'start' => 36,
            'end' => 4,
        ],
        8 => [
            'key' => 'ConsumerGLN',
            'name' => 'GLN afnemer',
            'length' => 13,
            'format' => 'N',
            'required' => false,
            'start' => 49,
            'end' => 6,
        ],
        9 => [
            'key' => 'CentralArtGLN',
            'name' => 'GLN centraal artikelbestand',
            'length' => 13,
            'format' => 'N',
            'required' => false,
            'start' => 62,
            'end' => 7,
        ],
    ];

    /**
     * @var string
     */
    protected $type = 'HArtLev';

    /**
     * @var integer
     */
    protected $fileId;

    /**
     * HArtLev constructor.
     * @param array $values
     */
    public function __construct($fileId, array $values)
    {
        $this->fileId = $fileId;
        $this->key = 'h_art_lev';
        $this->title = 'Leverancier Artikelen';

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
