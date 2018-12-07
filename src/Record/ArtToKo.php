<?php

namespace PAB2\Record;

/**
 * Class ArtToKo
 * @package PAB2\Record
 */
class ArtToKo extends AbstractRecord
{
    /**
     * @var array
     */
    public static $fields = [

        1 => [
            'key' => 'TradeItemId',
            'name' => 'Artikelcode leverancier',
            'length' => 20,
            'format' => 'A',
            'required' => true,
            'start' => 1,
            'end' => 20,
        ],
        2 => [
            'key' => 'SupplierGLN',
            'name' => 'GLN leverancier',
            'length' => 13,
            'format' => 'N',
            'required' => true,
            'start' => 21,
            'end' => 33,
        ],
        3 => [
            'key' => 'AllowanceType',
            'name' => 'Soort toeslag / korting',
            'length' => 3,
            'format' => 'A',
            'required' => true,
            'start' => 34,
            'end' => 36,
        ],
        4 => [
            'key' => 'StartDate',
            'name' => 'Ingangsdatum toeslag / korting',
            'length' => 8,
            'format' => 'N',
            'required' => false,
            'start' => 37,
            'end' => 44,
        ],
        5 => [
            'key' => 'SequenceNumber',
            'name' => 'Volgnummer',
            'length' => 2,
            'format' => 'N',
            'required' => false,
            'start' => 45,
            'end' => 46,
        ],
        6 => [
            'key' => 'AllowanceCode',
            'name' => 'Toeslag- / kortingcode',
            'length' => 1,
            'format' => 'A',
            'required' => true,
            'start' => 47,
            'end' => 47,
        ],
        7 => [
            'key' => 'AllowanceDescription',
            'name' => 'Omschrijving overige toeslag / korting',
            'length' => 35,
            'format' => 'A',
            'required' => false,
            'start' => 48,
            'end' => 82,
        ],
        8 => [
            'key' => 'NVT',
            'name' => 'n.v.t.',
            'length' => 2,
            'format' => 'A',
            'required' => false,
            'start' => 83,
            'end' => 84,
        ],
        9 => [
            'key' => 'AllowancePercentage',
            'name' => 'Toeslag- / kortingpercentage',
            'length' => 11,
            'format' => 'D',
            'required' => false,
            'start' => 85,
            'end' => 95,
        ],
        10 => [
            'key' => 'AllowanceAmount',
            'name' => 'Toeslag- / kortingbedrag',
            'length' => 16,
            'format' => 'D',
            'required' => true,
            'start' => 96,
            'end' => 111,
        ],
        11 => [
            'key' => 'CurrencyCode',
            'name' => 'Valutacode',
            'length' => 3,
            'format' => 'A',
            'required' => false,
            'start' => 112,
            'end' => 114,
        ],
        12 => [
            'key' => 'LowerLimitScale',
            'name' => 'Ondergrens staffel',
            'length' => 19,
            'format' => 'D',
            'required' => false,
            'start' => 115,
            'end' => 133,
        ],
        13 => [
            'key' => 'LowerLimitScaleUnit',
            'name' => 'Eenheid ondergrens staffel',
            'length' => 3,
            'format' => 'A',
            'required' => false,
            'start' => 134,
            'end' => 136,
        ],
    ];

    /**
     * @var string
     */
    protected $type = 'ArtToKo';

    /**
     * @var integer
     */
    protected $fileId;

    /**
     * ArtToKo constructor.
     * @param array $values
     */
    public function __construct($fileId, array $values)
    {
        $this->key = 'art_to_ko';
        $this->title = 'ArtToKo';

        parent::__construct($fileId, $values);
    }

}
