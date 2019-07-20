<?php

// Transformation
// decimal - Hex - Binary 8 bit
// 00232  - 00E8 - 11101000

/*
$preis = 0.70;
$decimal =  str_pad(number_format($preis, 2, '', ''), 4, 0,  STR_PAD_LEFT ) ; // 00070
echo $decimal;
echo "<br>";
echo str_pad(dechex($decimal), 4, "0", STR_PAD_LEFT);
echo "<br>";
echo strtoupper(str_pad(dechex(5111111111), 10, "0", STR_PAD_LEFT));
echo "<br>";


// (Beispiel: 04.05.2017, d.h. 124. Tag im Jahr 2017; dezimal: 12417; hexadezimal: ‘30 81' )
$strDateDP = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . ' +1 day'));
$strDateDP = date("Y-m-d H:i:s", strtotime("05.05.2017"));
echo date("zy", strtotime($strDateDP));
echo "<br>";
echo dechex(date("zy", strtotime($strDateDP)));
*/


// Inhalt Hexcode DataMatrix 22x22 Type DataMatrix (ECC200)
$strMatrixCode =  "444541". // Deutsche Post - DEA
		str_pad(strtoupper(dechex("18")),2,"0", STR_PAD_LEFT).	// Frankiertart und Version
		str_pad(strtoupper(dechex("36")),2,"0", STR_PAD_LEFT).	// Version Produkt und Preisliste
		str_pad(strtoupper(dechex(intval("1234567890"))),10,"0", STR_PAD_LEFT).	// Kundennummer
		str_pad(strtoupper(dechex(185)),4,"0", STR_PAD_LEFT). // Entgelt
		str_pad(dechex(date("zy",strtotime(date("Y-m-d H:i:s")))),4,"0", STR_PAD_LEFT). // Einlieferungsdatum 0091
		str_pad(strtoupper(dechex(51)),4,"0", STR_PAD_LEFT). // Produktschlüssel 51
		str_pad(strtoupper(dechex("112233")),6,"0", STR_PAD_LEFT). // Laufende Sendunsnummer
		"0A".  // Teilnahmenummer
		"0000";  // Einlieferunsgnummer  + 000000000

$strMatrixCode = trim(str_pad($strMatrixCode,56,"0",  STR_PAD_RIGHT));

echo "<br> Encode: ";
echo $strMatrixCode;
$DpCode = hex2bin ($strMatrixCode);
// $DpCode = utf8_decode(utf8_encode(hex2bin ($strMatrixCode))); // keep the same byte size length
// $matrixStrLen = strlen(utf8_decode(utf8_encode(hex2bin($strMatrixCode)))); // check if 42 bytes

echo "<br> Decode: ";
echo  $DpDeCode = strtoupper(bin2hex ($DpCode));