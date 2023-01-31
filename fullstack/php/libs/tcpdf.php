<?php

# composer file
/*
{
    "require": {
        "php": ">=7.4",
        "tecnickcom/tcpdf": "^6.6",
        "jeroendesloovere/vcard": "^1.7"
    }
    ,
    "require-dev": {
        "roave/security-advisories": "dev-latest"
    }
}
*/



require_once('vendor/autoload.php');
use JeroenDesloovere\VCard\VCard;


define('APP_PATH', __DIR__);

$pdf = new TCPDF(
    'P',
    'pt',
    array(220, 308), // E7 A7
    true,
    'UTF-8',
    false
);
$pdf->SetCreator(PDF_CREATOR);


// Basic general setup
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setImageScale(1);
#$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(0, PDF_MARGIN_TOP, 0);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetDisplayMode(
    'default', //  fullwidth fullpage real real default
    'SinglePage', // SinglePage OneColumn
    'UseNone' // UseThumbs UseNone
);
$pdf->SetAutoPageBreak(false, 0);
#$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


# add page
$pdf->AddPage();
$width = $pdf->getPageWidth();
$height = $pdf->getPageHeight();

$pdf->Image(
     APP_PATH . '/Test.png',
    0,
    0,
    $width,
    $height,
    'PNG',
    '',
    '',
    true,
    900,
    '',
    false,
    false,
    1,
    false,
    false,
    false
);


/*
https://github.com/jeroendesloovere/vcard
https://packagist.org/packages/jeroendesloovere/vcard
*/

$lastname = '';
$firstname = '';
// define vcard
$vcard = new VCard();
$vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

$text_vcard = $vcard->getOutput();
// set style for barcode
$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => array(255, 255, 255),
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode(
    $text_vcard,
    'QRCODE,H',
    61.5,
    25.5,
    56,
    56,
    $style,
    'N'
);

# write pdf
$strVcFullNameFR = str_replace(" ", "_", $strVCDFullName);
# F - write file
# D - download
# I - print output in browser
$pdf->Output(__DIR__ . "/pdfs/Test.pdf", "F");