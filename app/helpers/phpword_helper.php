<?php
$vendorDirPath = FCPATH.'vendor';
require_once FCPATH."vendor/phpoffice/phpword/bootstrap.php"; 
function phpword_start()
{
    $phpWord = new \PhpOffice\PhpWord\PhpWord() ;
    return $phpWord ;
}

function phpword_font_style()
{
    $fontStyle = new \PhpOffice\PhpWord\Style\Font() ;
    return $fontStyle ;
}

function phpword_write($data, $type, $filename)
{
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter( $data, $type ) ;
    $objWriter->save( $filename ) ;
}
?>