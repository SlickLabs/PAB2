<?php

use PAB2\Record\RecordInterface;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('memory_limit', '1280M');

require 'vendor/autoload.php';

$dir = getcwd();
$productReaderSettings = [
    PAB2\Reader::SETTING_FORMATTER => \PAB2\ArrayFormatter::class,
    PAB2\Reader::SETTING_RECORD_CLASS => \PAB2\Record\Product::class,
];
$productFile = new \PAB2\File('product', $dir . '/files/test/Product.txt');
$productReader = new PAB2\Reader($productFile, $productReaderSettings);

echo '---- File; LINE COUNT ----' . PHP_EOL;
echo $productReader->lineCount() . PHP_EOL . PHP_EOL;

echo '---- File; A CHUNK OF 5 ----' . PHP_EOL;
/** @var \Tightenco\Collect\Support\Collection $lineChunk */
foreach ($productReader->linesPerChunk(5)->read() as $lineChunk) {
    $lineChunk->each(function($line, $key) {
        /** @var RecordInterface $line */
        echo ($key + 1) .": ";
        print_r($line->getValues());
        echo PHP_EOL;
    });
    $productReader->resetSettings();
    break;
}
echo PHP_EOL . PHP_EOL;

echo '---- File; Product; MAX LINES 1 ----' . PHP_EOL;
/**
 * @var RecordInterface $line
 * @var \PAB2\Reader $productReader
 */
foreach ($productReader->maxLines(1)->read() as $line) {
    print_r($line->getValues());
}
echo PHP_EOL . PHP_EOL;

echo '---- File; Product; MAX LINES 3 ----' . PHP_EOL;
/**
 * @var RecordInterface $line
 * @var \PAB2\Reader $productReader
 */
foreach ($productReader->maxLines(3)->read() as $key => $line) {
    echo ($key + 1) .": ";
    print_r($line->getValues());
}
echo PHP_EOL . PHP_EOL;

$artLevReaderSettings = [
    PAB2\Reader::SETTING_FORMATTER => \PAB2\ArrayFormatter::class,
    PAB2\Reader::SETTING_RECORD_CLASS => \PAB2\Record\ArtLev::class,
];
$artLevFile = new \PAB2\File('artLev', $dir . '/files/test/ArtLev.txt');
$artLevReader = new PAB2\Reader($artLevFile, $artLevReaderSettings);

echo '---- File; Leveranciers Product; LINE COUNT ----' . PHP_EOL;
echo $artLevReader->lineCount() . PHP_EOL . PHP_EOL;

echo '---- File; Leveranciers Product; CHUNKS OF 5 ----' . PHP_EOL;
/** @var \Tightenco\Collect\Support\Collection $lineChunk */
foreach ($artLevReader->linesPerChunk(5)->read() as $lineChunk) {
    $lineChunk->each(function($line, $key) {
        /** @var RecordInterface $line */
        echo ($key + 1) .": ";
        print_r($line->getValues());
        echo PHP_EOL;
    });
    $artLevReader->resetSettings();
    break;
}
echo PHP_EOL . PHP_EOL;


//echo '---- File; TEST ----' . PHP_EOL;
///** @var \Tightenco\Collect\Support\Collection $lineChunk */
//$groupCount = 0;
//foreach ($productReader->linesPerChunk(10)->read() as $lineChunk) {
//    $groupCount++;
//
//    $lineChunk->each(function($line, $key) {
//        /** @var RecordInterface $line */
//        echo ($key + 1) .": ";
//        print_r($line->getValue('Productcode'));
//        echo PHP_EOL;
//    });
//
//    echo '> Line end' . PHP_EOL . PHP_EOL;
//
//    if ($groupCount === 10) {
//        $productReader->resetSettings();
//        break;
//    }
//}
//echo PHP_EOL . PHP_EOL;

//echo '---- File; All lines ----' . PHP_EOL;
///** @var \Tightenco\Collect\Support\Collection $lines */
//foreach ($productReader->read() as $lines) {
//    $lines->each(function($line) {
//        echo $line->getValue('Productcode') . PHP_EOL;
//
//    });
//}
//echo PHP_EOL . PHP_EOL;

exit('DONE');