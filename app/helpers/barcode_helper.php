<?php

require_once FCPATH."vendor/picqer/php-barcode-generator/src/BarcodeGenerator.php"; 
require_once FCPATH."vendor/picqer/php-barcode-generator/src/BarcodeGeneratorHTML.php"; 
require_once FCPATH."vendor/picqer/php-barcode-generator/src/BarcodeGeneratorJPG.php"; 
require_once FCPATH."vendor/picqer/php-barcode-generator/src/BarcodeGeneratorPNG.php"; 
require_once FCPATH."vendor/picqer/php-barcode-generator/src/BarcodeGeneratorSVG.php"; 

function svgBarcode($code, $type = 'C128', $widthFactor = 2, $totalHeight = 30, $color = 'black')
{
    $barcode = new Picqer\Barcode\BarcodeGeneratorSVG();
    return $barcode->getBarcode($code, $type, $widthFactor, $totalHeight, $color);
}

function pngBarcode($code, $type = 'C128', $widthFactor = 2, $totalHeight = 30, $color = array(0, 0, 0))
{
    $barcode = new Picqer\Barcode\BarcodeGeneratorPNG();
    return $barcode->getBarcode($code, $type, $widthFactor, $totalHeight, $color);
}

function jpgBarcode($code, $type = 'C128', $widthFactor = 2, $totalHeight = 30, $color = array(0, 0, 0))
{
    $barcode = new Picqer\Barcode\BarcodeGeneratorJPG();
    return $barcode->getBarcode($code, $type, $widthFactor, $totalHeight, $color);
}

function htmlBarcode($code, $type = 'C128', $widthFactor = 2, $totalHeight = 30, $color = 'black')
{
    $barcode = new Picqer\Barcode\BarcodeGeneratorHTML();
    return $barcode->getBarcode($code, $type, $widthFactor, $totalHeight, $color);
}

?>