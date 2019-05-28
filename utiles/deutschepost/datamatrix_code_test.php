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


/*
Darstellung des Frankierwerts in
Euro
(E=Vorkomma- und C=Nachkommastellen).
Beispiel: 0,70 Euro:
dezimal: 00070; hexadezimal: ‘00 46'
im Format EEECC (dezimal)
EKP-Nr. 5111111111 (dezimal), ergibt ‘01 30 A5 5D C7'
*/

echo dechex("232"); // 281
echo "<br>";
echo hexdec("00E8");
echo "<br>";
$hexadecimal = "00E8";
echo base_convert($hexadecimal, 16, 2);
echo "<br>";

// Example Hex Code before Binary Transformation
// 44 45 41 12 1C 01 2B B7 45 6D 00 BE 57 8D 00 B6 00 00 0E 01 15 56 00 00 00 00 00 00
$str123 = "444541121C012BB7456D00BE578D00B600000E011556000000000000";
echo hex2bin($str123);
echo "<br>";
echo strlen(hex2bin($str123));
echo "<br>";

/*
Deutsche Post Matrixcode Checker Version 3.07.02.00
28 Datenbytes

Gesamtstring:  44 45 41 12 1C 01 2B B7 45 6D 00 BE 57 8D 00 B6 00 00 0E 01 15 56 00 00 00 00 00 00
Postunternehmen: DEA
Frankierart: 18 = DV-Freimachung, Version 1.3 (28 oder 42 Byte)
Version Produkte/Preise: 28
Kundennummer: 5028398445
Frankier-ID: 01 2FF4 5D01 55 6000 00E6
Frankierwert: 1,90
Einlieferungsdatum: 12.08.2013
Produktschlüssel: 182 -> nicht definiert
laufende Sendungsnummer: 00000014
Teilnahmenummer: 01
Entgeltabrechnungsnummer: 5462
Ankündigung Inhalt Datenelement: 0

Interpretation für den Fall, dass das Steuerbyte DVFreimachung den Wert 0 hat:
Kundenindividuelle Informationen:  00 00 00 00 00
Kundenindividuelle Informationen in ASCII:

===

012FF45D0155600000E6
*/



/*
https://www.php.net/manual/en/function.sprintf.php
https://www.php.net/manual/de/function.base-convert.php
https://www.php.net/manual/de/function.hex2bin.php

https://www.pepperl-fuchs.com/germany/de/6404.htm
https://codebeautify.org/hex-binary-converter
https://barcode.tec-it.com/de/DataMatrix?data=123

http://kryptografie.de/kryptografie/chiffre/base85-z85.htm
https://de.wikipedia.org/wiki/Hexadezimalsystem
http://grandzebu.net/informatique/codbar-en/datamatrix.htm
http://php-decimal.io/#basic-usage
https://github.com/zxing/zxing/issues/365

https://www.arenae.ch/wp-content/uploads/files/Handbuch%20Barcodes%20und%20Datatmatrix%20Codes%20fuer%20Briefsendungen-2.pdf
https://fuwa-it.de/wp-content/uploads/pdf/DataMatrix---Teil2.pdf
https://www.frama.de/fileadmin/user_upload/frama.de.at/PDF-Dateien_DE/DPAG-Informationen/Handlingsbroschuere-Datenmeldung-Infrastrukturrabatt-2017.pdf
https://www.tc.dpcom.de/downloads/Integrationshandbuch.pdf
https://www.direktmarketingcenter.de/fileadmin/Download-Center/DIALOGPOST_National_-_Produktbroschuere_-_Stand_April_2017.pdf
https://www.tc.dpcom.de/downloads/Integrationshandbuch.pdf
https://www.mikodata.de/download/sonst/dl_strichcodefibel.pdf
https://fuwa-it.de/wp-content/uploads/pdf/DataMatrix---Teil2.pdf
https://www.gs1.org/docs/barcodes/GS1_General_Specifications.pdf
https://www.deutschepost.de/content/dam/dpag/images/D_d/dialogpost/downloads/automationsfaehige-briefsendungen-2016.pdf
https://www.deutschepost.de/content/dam/dpag/images/D_d/DV-Freimachung/dp_datamatrixcode-dv-freimachung_1-5-1.pdf
https://www.deutschepost.de/content/dam/dpag/images/D_d/DV-Freimachung/dp_datamatrixcode-dv-freimachung_1.4.0.pdf
https://www.post-und-telekommunikation.de/PuT/1Fundus/Dokumente/automationsfaehige_briefsendungen_2008-1.pdf
https://www.deutschepost.de/content/dam/dpag/images/D_d/DV-Freimachung/dp_datamatrixcode-dv-freimachung_1-5-0.pdf
https://www.deutschepost.de/content/dam/dpag/images/R_r/responseplus/dp-responseplus-spezifikation-matrixcode.pdf
https://www.deutschepost.de/content/dam/dpag/images/D_d/DV-Freimachung/dp-datamatrixcode-dv-freimachung_1.5.2.pdf
https://www.deutschepost.de/content/dam/dpag/images/P_p/Premiumadress/mlfvm_8_premiumadress_1_1.pdf
https://www.deutschepost.de/content/dam/dpag/images/D_d/DV-Freimachung/dp_datamatrixcode-dv-freimachung_1.4.0.pdf
https://www.deutschepost.de/content/dam/dpag/images/P_p/Premiumadress/mlfvm_8_premiumadress_1_1.pdf
https://www.deutschepost.de/content/dam/dpag/images/R_r/responseplus/dp-responseplus-spezifikation-matrixcode.pdf
https://www.tc.dpcom.de/downloads/Integrationshandbuch.pdf
https://www.neopost.de/sites/neopost.de/files/files/Produktcodes-1_01_07_2018.pdf
*/

