<?php

namespace PAB2\Record;

/**
 * Class ArtPr2
 * @package PAB2\Record
 */
class ArtPr2 extends AbstractRecord
{
    /**
     * @var array
     */
    public static $fields = [
        1 => [
            'key' => 'MutationCode',
            'name' => 'Mutatiecode',
            'length' => 1,
            'format' => 'N',
            'required' => true,
            'start' => 1,
            'end' => 1,
        ],
        2 => [
            'key' => 'TradeItemId',
            'name' => 'Artikelcode leverancier',
            'length' => 20,
            'format' => 'A',
            'required' => true,
            'start' => 2,
            'end' => 21,
        ],
        3 => [
            'key' => 'SupplierGLN',
            'name' => 'GLN leverancier',
            'length' => 13,
            'format' => 'N',
            'required' => true,
            'start' => 22,
            'end' => 34,
        ],
        4 => [
            'key' => 'StartDatePriceInformation',
            'name' => 'Ingangsdatum prijsinformatie',
            'length' => 8,
            'format' => 'N',
            'required' => false,
            'start' => 35,
            'end' => 42,
        ],
        5 => [
            'key' => 'GrossPriceInOrderUnit',
            'name' => 'Bruto prijs',
            'length' => 16,
            'format' => 'D 11.4',
            'required' => false,
            'start' => 43,
            'end' => 58,
        ],
        6 => [
            'key' => 'NetPriceInOrderUnit',
            'name' => 'Netto prijs',
            'length' => 16,
            'format' => 'D 11.4',
            'required' => false,
            'start' => 59,
            'end' => 74,
        ],
        7 => [
            'key' => 'NumberOfUnitsInPriceBasis',
            'name' => 'Aantal prijsbasis',
            'length' => 10,
            'format' => 'D 6.3',
            'required' => false,
            'start' => 75,
            'end' => 84,
        ],
        8 => [
            'key' => 'PriceUnitMeasureUnitCode',
            'name' => 'Prijseenheid',
            'length' => 3,
            'format' => 'A',
            'required' => false,
            'start' => 85,
            'end' => 87,
        ],
        9 => [
            'key' => 'CurrencyCode',
            'name' => 'Valutacode',
            'length' => 3,
            'format' => 'A',
            'required' => false,
            'start' => 88,
            'end' => 90,
        ],
        10 => [
            'key' => 'GrossPriceAllowanceGroup',
            'name' => 'Bruto prijs bewerkingstoeslag',
            'length' => 16,
            'format' => 'D 11.4',
            'required' => false,
            'start' => 91,
            'end' => 106,
        ],
        11 => [
            'key' => 'FollowManufacturerPriceIndication',
            'name' => 'Indicatie fabrikantprijs volgen',
            'length' => 3,
            'format' => 'A',
            'required' => false,
            'start' => 107,
            'end' => 109,
        ],
        12 => [
            'key' => 'VatRate',
            'name' => 'Code BTW-tarief',
            'length' => 1,
            'format' => 'A',
            'required' => false,
            'start' => 110,
            'end' => 110,
        ],
        13 => [
            'key' => 'VatPercentage',
            'name' => 'BTW-percentage',
            'length' => 18,
            'format' => 'D 13.4',
            'required' => false,
            'start' => 111,
            'end' => 128,
        ],
    ];

    /**
     * @var string
     */
    protected $type = 'ArtPr2';

    /**
     * @var integer
     */
    protected $fileId;

    /**
     * ArtPr2 constructor.
     * @param array $values
     */
    public function __construct($fileId, array $values)
    {
        $this->key = 'art_pr2';
        $this->title = 'ArtPr2';

        parent::__construct($fileId, $values);
    }

}
