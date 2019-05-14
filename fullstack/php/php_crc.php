 
<?php

function CRC_CCITT_V5($str)
{
    static $CRC16_Lookup = array(
            0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50A5, 0x60C6, 0x70E7, 
            0x8108, 0x9129, 0xA14A, 0xB16B, 0xC18C, 0xD1AD, 0xE1CE, 0xF1EF, 
            0x1231, 0x0210, 0x3273, 0x2252, 0x52B5, 0x4294, 0x72F7, 0x62D6, 
            0x9339, 0x8318, 0xB37B, 0xA35A, 0xD3BD, 0xC39C, 0xF3FF, 0xE3DE, 
            0x2462, 0x3443, 0x0420, 0x1401, 0x64E6, 0x74C7, 0x44A4, 0x5485, 
            0xA56A, 0xB54B, 0x8528, 0x9509, 0xE5EE, 0xF5CF, 0xC5AC, 0xD58D, 
            0x3653, 0x2672, 0x1611, 0x0630, 0x76D7, 0x66F6, 0x5695, 0x46B4, 
            0xB75B, 0xA77A, 0x9719, 0x8738, 0xF7DF, 0xE7FE, 0xD79D, 0xC7BC, 
            0x48C4, 0x58E5, 0x6886, 0x78A7, 0x0840, 0x1861, 0x2802, 0x3823, 
            0xC9CC, 0xD9ED, 0xE98E, 0xF9AF, 0x8948, 0x9969, 0xA90A, 0xB92B, 
            0x5AF5, 0x4AD4, 0x7AB7, 0x6A96, 0x1A71, 0x0A50, 0x3A33, 0x2A12, 
            0xDBFD, 0xCBDC, 0xFBBF, 0xEB9E, 0x9B79, 0x8B58, 0xBB3B, 0xAB1A, 
            0x6CA6, 0x7C87, 0x4CE4, 0x5CC5, 0x2C22, 0x3C03, 0x0C60, 0x1C41, 
            0xEDAE, 0xFD8F, 0xCDEC, 0xDDCD, 0xAD2A, 0xBD0B, 0x8D68, 0x9D49, 
            0x7E97, 0x6EB6, 0x5ED5, 0x4EF4, 0x3E13, 0x2E32, 0x1E51, 0x0E70, 
            0xFF9F, 0xEFBE, 0xDFDD, 0xCFFC, 0xBF1B, 0xAF3A, 0x9F59, 0x8F78, 
            0x9188, 0x81A9, 0xB1CA, 0xA1EB, 0xD10C, 0xC12D, 0xF14E, 0xE16F, 
            0x1080, 0x00A1, 0x30C2, 0x20E3, 0x5004, 0x4025, 0x7046, 0x6067, 
            0x83B9, 0x9398, 0xA3FB, 0xB3DA, 0xC33D, 0xD31C, 0xE37F, 0xF35E, 
            0x02B1, 0x1290, 0x22F3, 0x32D2, 0x4235, 0x5214, 0x6277, 0x7256, 
            0xB5EA, 0xA5CB, 0x95A8, 0x8589, 0xF56E, 0xE54F, 0xD52C, 0xC50D, 
            0x34E2, 0x24C3, 0x14A0, 0x0481, 0x7466, 0x6447, 0x5424, 0x4405, 
            0xA7DB, 0xB7FA, 0x8799, 0x97B8, 0xE75F, 0xF77E, 0xC71D, 0xD73C, 
            0x26D3, 0x36F2, 0x0691, 0x16B0, 0x6657, 0x7676, 0x4615, 0x5634, 
            0xD94C, 0xC96D, 0xF90E, 0xE92F, 0x99C8, 0x89E9, 0xB98A, 0xA9AB, 
            0x5844, 0x4865, 0x7806, 0x6827, 0x18C0, 0x08E1, 0x3882, 0x28A3, 
            0xCB7D, 0xDB5C, 0xEB3F, 0xFB1E, 0x8BF9, 0x9BD8, 0xABBB, 0xBB9A, 
            0x4A75, 0x5A54, 0x6A37, 0x7A16, 0x0AF1, 0x1AD0, 0x2AB3, 0x3A92, 
            0xFD2E, 0xED0F, 0xDD6C, 0xCD4D, 0xBDAA, 0xAD8B, 0x9DE8, 0x8DC9, 
            0x7C26, 0x6C07, 0x5C64, 0x4C45, 0x3CA2, 0x2C83, 0x1CE0, 0x0CC1, 
            0xEF1F, 0xFF3E, 0xCF5D, 0xDF7C, 0xAF9B, 0xBFBA, 0x8FD9, 0x9FF8, 
            0x6E17, 0x7E36, 0x4E55, 0x5E74, 0x2E93, 0x3EB2, 0x0ED1, 0x1EF0
    );
    
    $crc16 = 0xFFFF; // the CRC
    $len = strlen($str);
    
    for($i = 0; $i < $len; $i++ )
    {
        $t = ($crc16 >> 8) ^ ord($str[$i]); // High byte Xor Message Byte to get index
        $crc16 = (($crc16 << 8) & 0xffff) ^ $CRC16_Lookup[$t]; // Update the CRC from table
    }
    
    // crc16 now contains the CRC value
    return $crc16;
}


function CRC_CCITT_V4($string)
{
    static $table = [
            0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50A5, 0x60C6, 0x70E7,
            0x8108, 0x9129, 0xA14A, 0xB16B, 0xC18C, 0xD1AD, 0xE1CE, 0xF1EF,
            0x1231, 0x0210, 0x3273, 0x2252, 0x52B5, 0x4294, 0x72F7, 0x62D6,
            0x9339, 0x8318, 0xB37B, 0xA35A, 0xD3BD, 0xC39C, 0xF3FF, 0xE3DE,
            0x2462, 0x3443, 0x0420, 0x1401, 0x64E6, 0x74C7, 0x44A4, 0x5485,
            0xA56A, 0xB54B, 0x8528, 0x9509, 0xE5EE, 0xF5CF, 0xC5AC, 0xD58D,
            0x3653, 0x2672, 0x1611, 0x0630, 0x76D7, 0x66F6, 0x5695, 0x46B4,
            0xB75B, 0xA77A, 0x9719, 0x8738, 0xF7DF, 0xE7FE, 0xD79D, 0xC7BC,
            0x48C4, 0x58E5, 0x6886, 0x78A7, 0x0840, 0x1861, 0x2802, 0x3823,
            0xC9CC, 0xD9ED, 0xE98E, 0xF9AF, 0x8948, 0x9969, 0xA90A, 0xB92B,
            0x5AF5, 0x4AD4, 0x7AB7, 0x6A96, 0x1A71, 0x0A50, 0x3A33, 0x2A12,
            0xDBFD, 0xCBDC, 0xFBBF, 0xEB9E, 0x9B79, 0x8B58, 0xBB3B, 0xAB1A,
            0x6CA6, 0x7C87, 0x4CE4, 0x5CC5, 0x2C22, 0x3C03, 0x0C60, 0x1C41,
            0xEDAE, 0xFD8F, 0xCDEC, 0xDDCD, 0xAD2A, 0xBD0B, 0x8D68, 0x9D49,
            0x7E97, 0x6EB6, 0x5ED5, 0x4EF4, 0x3E13, 0x2E32, 0x1E51, 0x0E70,
            0xFF9F, 0xEFBE, 0xDFDD, 0xCFFC, 0xBF1B, 0xAF3A, 0x9F59, 0x8F78,
            0x9188, 0x81A9, 0xB1CA, 0xA1EB, 0xD10C, 0xC12D, 0xF14E, 0xE16F,
            0x1080, 0x00A1, 0x30C2, 0x20E3, 0x5004, 0x4025, 0x7046, 0x6067,
            0x83B9, 0x9398, 0xA3FB, 0xB3DA, 0xC33D, 0xD31C, 0xE37F, 0xF35E,
            0x02B1, 0x1290, 0x22F3, 0x32D2, 0x4235, 0x5214, 0x6277, 0x7256,
            0xB5EA, 0xA5CB, 0x95A8, 0x8589, 0xF56E, 0xE54F, 0xD52C, 0xC50D,
            0x34E2, 0x24C3, 0x14A0, 0x0481, 0x7466, 0x6447, 0x5424, 0x4405,
            0xA7DB, 0xB7FA, 0x8799, 0x97B8, 0xE75F, 0xF77E, 0xC71D, 0xD73C,
            0x26D3, 0x36F2, 0x0691, 0x16B0, 0x6657, 0x7676, 0x4615, 0x5634,
            0xD94C, 0xC96D, 0xF90E, 0xE92F, 0x99C8, 0x89E9, 0xB98A, 0xA9AB,
            0x5844, 0x4865, 0x7806, 0x6827, 0x18C0, 0x08E1, 0x3882, 0x28A3,
            0xCB7D, 0xDB5C, 0xEB3F, 0xFB1E, 0x8BF9, 0x9BD8, 0xABBB, 0xBB9A,
            0x4A75, 0x5A54, 0x6A37, 0x7A16, 0x0AF1, 0x1AD0, 0x2AB3, 0x3A92,
            0xFD2E, 0xED0F, 0xDD6C, 0xCD4D, 0xBDAA, 0xAD8B, 0x9DE8, 0x8DC9,
            0x7C26, 0x6C07, 0x5C64, 0x4C45, 0x3CA2, 0x2C83, 0x1CE0, 0x0CC1,
            0xEF1F, 0xFF3E, 0xCF5D, 0xDF7C, 0xAF9B, 0xBFBA, 0x8FD9, 0x9FF8,
            0x6E17, 0x7E36, 0x4E55, 0x5E74, 0x2E93, 0x3EB2, 0x0ED1, 0x1EF0,
    ];

    $crc16 = 0xFFFF;
    $string = (string) $string;
    $len = strlen($string);

    for ($i = 0; $i < $len; $i++ ) {
        $index = ($crc16 >> 8) ^ ord($string[$i]);
        $crc16 = (($crc16 << 8) & 0xFFFF) ^ $table[$index];
    }

    #$crc16 = sprintf('%04x', $crc16);
    return $crc16;
}


# CRC-CCITT(0xFFFF) 
function CRC_CCITT($data)
 {
   $crc = 0xFFFF;
   for ($i = 0; $i < strlen($data); $i++)
   {
     $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
     $x ^= $x >> 4;
     $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
   }
   return $crc;
 }
 
 function CRC_CCITT_V2($buffer) {
    $result = 0xFFFF;
    if ( ($length = strlen($buffer)) > 0) {
        for ($offset = 0; $offset < $length; $offset++) {
            $result ^= (ord($buffer[$offset]) << 8);
            for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                if (($result <<= 1) & 0x10000) $result ^= 0x1021;
                $result &= 0xFFFF; /* gut the overflow as php has no 16 bit types */
            }
        }
    }
    return $result;
}
# crc16
function CRC_CCITT_V3($data)
 {
   $crc = 0xFFFF;
   for ($i = 0; $i < strlen($data); $i++)
   {
     $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
     $x ^= $x >> 4;
     $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
   }
   return $crc;
 }

 /**
 KERMIT
width=16 poly=0x1021 init=0x0000 refin=true refout=true xorout=0x0000 check=0x2189 name="KERMIT"

XMODEM
width=16 poly=0x1021 init=0x0000 refin=false refout=false xorout=0x0000 check=0x31c3 name="XMODEM"

CRC-16/CCITT-FALSE
width=16 poly=0x1021 init=0xffff refin=false refout=false xorout=0x0000 check=0x29b1 name="CRC-16/CCITT-FALSE"
*/

function CRC16($sStr,  $aParams = array(), $crcType){ 

    
    switch($crcType){
        case "XModem": # CRC-CCITT(XModem)       de28
            $init = 0x0000; 
            break;
        case "0xFFFF": # CRC-CCITT(0xFFFF)       6d49 CRC-16/CCITT-FALSE
            $init = 0xFFFF; 
            break;
        case "0x1D0F": # CRC-CCITT(0x1D0F)       e9f1  
            $init = 0x1D0F;
            break;
        default:
            $init = 0x0000;
    }

    $aDefaults = array( 
        "polynome" => 0x1021, //, 
        "init" => $init,
        "xor_out" => 0, 
    ); 

    foreach ($aDefaults as $key => $val){ 
        if (!isset($aParams[$key])){ 
            $aParams[$key] = $val; 
        } 
    } 

    $sStr .= ""; 
    $crc = $aParams['init']; 
    $len = strlen($sStr); 
    $i = 0; 

    while ($len--){ 
        $crc ^= ord($sStr[$i++]) << 8; 
        $crc &= 0xffff; 

        for ($j = 0; $j < 8; $j++){ 
            $crc = ($crc & 0x8000) ? ($crc << 1) ^ $aParams['polynome'] : $crc << 1; 
            $crc &= 0xffff; 
        } 
    } 

    $crc ^= $aParams['xor_out']; 
    return $crc; 
}

#CRC-16 (Modbus)
function crc16Modbus($string) { 
  $crc = 0xFFFF; 
  for ($x = 0; $x < strlen ($string); $x++) { 
    $crc = $crc ^ ord($string[$x]); 
    for ($y = 0; $y < 8; $y++) { 
      if (($crc & 0x0001) == 0x0001) { 
        $crc = (($crc >> 1) ^ 0xA001); 
      } else { $crc = $crc >> 1; } 
    } 
  } 
  return $crc; 
} 
 
 
 
# CRC-16 / CRC-16 (Modbus)
function CRC_16($data, $generatorPolynomial, $seed = 0x0000)
{
    $reverseBitOrder = function ($data) {
        return bindec(
            strrev(
                str_pad(
                    decbin($data),
                    16,
                    '0',
                    STR_PAD_LEFT
                )
            )
        );
    };

    // Generator polynomial
    $gp = $reverseBitOrder($generatorPolynomial);

    // Remainder polynomial
    $rp = $seed;

    $len = strlen($data);

    for ($i = 0; $i < $len; $i++) {
        $rp ^= ord($data[$i]);

        for ($bit = 0; $bit <= 7; $bit++) {
            if ($rp & 0x0001) {
                $rp >>= 1;
                $rp ^= $gp;
            } else {
                $rp >>= 1;
            }
        }
    }

    return $rp;
}

    function dec2hexConv($strIn, $nrChars) {
      //return $strIn;
      $strHexa = str_pad(strtoupper(dechex($strIn)), $nrChars, "0", STR_PAD_LEFT); 
    // strtoupper
      if (strlen($strHexa) != $nrChars) {
         throw new Exception("Number of Hexa Chars not match!");
      }
      return $strHexa;
   }

    echo dec2hexConv("90", 4);
    echo "<br>";
    echo dec2hexConv("9191", 4);
    echo "<br>";
    echo dec2hexConv("9279", 4);
    echo "<br>";
    echo dec2hexConv("9280", 4);
    echo "<br>";
    echo dec2hexConv("450", 4);
    echo "<br>";
    echo dec2hexConv("232", 4);
    echo "<br>";

    /*
    Beispiel für Produktschlüssel:
    ’00 5A’ Dialogpost/Katalog Standard (dez. 90)
    ’23 E7’ Dialogpost/Katalog Standard Premiumadress Basis (dez. 9191)
    ’24 3F’ Pressesendung E+0 mit PREMIUMADRESS Basis (dezimal 9279)
    ’24 40’ Pressesendung E+1 mit PREMIUMADRESS Basis (dezimal 9280)
    ’01 C2’ PSdg E+0 ohne PREMIUMADRESS (dezimal 450)
    Darstellung in hexadezimaler Form.
    */




//0A312C288013B5A94B02XF
//A0014C9F3000043E892EXD
//01030E092806011E011EXV

/*
Python
CRC-CCITT(XModem)       DE28
CRC-CCITT(0xFFFF)       6D49
CRC-CCITT(0x1D0F)       E9F1
CRC-16                  ABC4
CRC-16 (Modbus)         8FE0
CRC-16 (SICK)           301D
CRC-DNP                 CEDC
CRC-32              C3C570E0
CRC-16 (Kermit)         C312
*/


$str = "1234556778";
echo "........................"."\n";
#echo "CRC-CCITT(0xFFFF)" . dec2hexConv(CRC_CCITT($str),4)."\n";
echo "CRC-CCITT(XModem) : ". dec2hexConv(CRC16($str,null,"XModem"),4)."\n";
echo "CRC-CCITT(0xFFFF) : ". dec2hexConv(CRC16($str,null,"0xFFFF"),4)."\n";
echo "CRC-CCITT(0x1D0F) : ". dec2hexConv(CRC16($str,null,"0x1D0F"),4)."\n";
echo 'CRC-16            : ' . sprintf('%04X', CRC_16($str, 0x8005, 0x0000)), "\n";
echo 'CRC-16 (Modbus)   : ' . sprintf('%04X', CRC_16($str, 0x8005, 0xFFFF)), "\n";



echo "........................"."\n";
#echo "ccc : ". dec2hexConv(yyy($str),4)."\n";
#echo "ccc : ". dec2hexConv(xxx($str),4)."\n";

class CRC16 {
    private static $CRC16_Table = array
        (   0x0000, 0x2110, 0x4220, 0x6330, 0x8440, 0xa550, 0xc660, 0xe770,
            0x0881, 0x2991, 0x4aa1, 0x6bb1, 0x8cc1, 0xadd1, 0xcee1, 0xeff1,
            0x3112, 0x1002, 0x7332, 0x5222, 0xb552, 0x9442, 0xf772, 0xd662,
            0x3993, 0x1883, 0x7bb3, 0x5aa3, 0xbdd3, 0x9cc3, 0xfff3, 0xdee3,
            0x6224, 0x4334, 0x2004, 0x0114, 0xe664, 0xc774, 0xa444, 0x8554,
            0x6aa5, 0x4bb5, 0x2885, 0x0995, 0xeee5, 0xcff5, 0xacc5, 0x8dd5,
            0x5336, 0x7226, 0x1116, 0x3006, 0xd776, 0xf666, 0x9556, 0xb446,
            0x5bb7, 0x7aa7, 0x1997, 0x3887, 0xdff7, 0xfee7, 0x9dd7, 0xbcc7,
            0xc448, 0xe558, 0x8668, 0xa778, 0x4008, 0x6118, 0x0228, 0x2338,
            0xccc9, 0xedd9, 0x8ee9, 0xaff9, 0x4889, 0x6999, 0x0aa9, 0x2bb9,
            0xf55a, 0xd44a, 0xb77a, 0x966a, 0x711a, 0x500a, 0x333a, 0x122a,
            0xfddb, 0xdccb, 0xbffb, 0x9eeb, 0x799b, 0x588b, 0x3bbb, 0x1aab,
            0xa66c, 0x877c, 0xe44c, 0xc55c, 0x222c, 0x033c, 0x600c, 0x411c,
            0xaeed, 0x8ffd, 0xeccd, 0xcddd, 0x2aad, 0x0bbd, 0x688d, 0x499d,
            0x977e, 0xb66e, 0xd55e, 0xf44e, 0x133e, 0x322e, 0x511e, 0x700e,
            0x9fff, 0xbeef, 0xdddf, 0xfccf, 0x1bbf, 0x3aaf, 0x599f, 0x788f,
            0x8891, 0xa981, 0xcab1, 0xeba1, 0x0cd1, 0x2dc1, 0x4ef1, 0x6fe1,
            0x8010, 0xa100, 0xc230, 0xe320, 0x0450, 0x2540, 0x4670, 0x6760,
            0xb983, 0x9893, 0xfba3, 0xdab3, 0x3dc3, 0x1cd3, 0x7fe3, 0x5ef3,
            0xb102, 0x9012, 0xf322, 0xd232, 0x3542, 0x1452, 0x7762, 0x5672,
            0xeab5, 0xcba5, 0xa895, 0x8985, 0x6ef5, 0x4fe5, 0x2cd5, 0x0dc5,
            0xe234, 0xc324, 0xa014, 0x8104, 0x6674, 0x4764, 0x2454, 0x0544,
            0xdba7, 0xfab7, 0x9987, 0xb897, 0x5fe7, 0x7ef7, 0x1dc7, 0x3cd7,
            0xd326, 0xf236, 0x9106, 0xb016, 0x5766, 0x7676, 0x1546, 0x3456,
            0x4cd9, 0x6dc9, 0x0ef9, 0x2fe9, 0xc899, 0xe989, 0x8ab9, 0xaba9,
            0x4458, 0x6548, 0x0678, 0x2768, 0xc018, 0xe108, 0x8238, 0xa328,
            0x7dcb, 0x5cdb, 0x3feb, 0x1efb, 0xf98b, 0xd89b, 0xbbab, 0x9abb,
            0x754a, 0x545a, 0x376a, 0x167a, 0xf10a, 0xd01a, 0xb32a, 0x923a,
            0x2efd, 0x0fed, 0x6cdd, 0x4dcd, 0xaabd, 0x8bad, 0xe89d, 0xc98d,
            0x267c, 0x076c, 0x645c, 0x454c, 0xa23c, 0x832c, 0xe01c, 0xc10c,
            0x1fef, 0x3eff, 0x5dcf, 0x7cdf, 0x9baf, 0xbabf, 0xd98f, 0xf89f,
            0x176e, 0x367e, 0x554e, 0x745e, 0x932e, 0xb23e, 0xd10e, 0xf01e
        );

    public static function calculate( $buffer ) {
        $length = strlen($buffer);

        $crc = 0x0000;
        $i = 0;
        while( $length-- ) {
            $crc = (( $crc >> 8) & 0xff) ^ (self::$CRC16_Table[(ord($buffer[$i++]) ^ $crc) & 0xFF]);
        }

        return (($crc & 0xFFFF) ^ 0x8000) - 0x8000;
    }    
}

echo dec2hexConv ( CRC16::calculate( $str )  ,4 )."\n";





function CRC16yxc($str) 
{ 
    static $CRC16_Lookup = array( 
              0X0000, 0XC0C1, 0XC181, 0X0140, 0XC301, 0X03C0, 0X0280, 0XC241, 
        0XC601, 0X06C0, 0X0780, 0XC741, 0X0500, 0XC5C1, 0XC481, 0X0440, 
        0XCC01, 0X0CC0, 0X0D80, 0XCD41, 0X0F00, 0XCFC1, 0XCE81, 0X0E40, 
        0X0A00, 0XCAC1, 0XCB81, 0X0B40, 0XC901, 0X09C0, 0X0880, 0XC841, 
        0XD801, 0X18C0, 0X1980, 0XD941, 0X1B00, 0XDBC1, 0XDA81, 0X1A40, 
        0X1E00, 0XDEC1, 0XDF81, 0X1F40, 0XDD01, 0X1DC0, 0X1C80, 0XDC41, 
        0X1400, 0XD4C1, 0XD581, 0X1540, 0XD701, 0X17C0, 0X1680, 0XD641, 
        0XD201, 0X12C0, 0X1380, 0XD341, 0X1100, 0XD1C1, 0XD081, 0X1040, 
        0XF001, 0X30C0, 0X3180, 0XF141, 0X3300, 0XF3C1, 0XF281, 0X3240, 
        0X3600, 0XF6C1, 0XF781, 0X3740, 0XF501, 0X35C0, 0X3480, 0XF441, 
        0X3C00, 0XFCC1, 0XFD81, 0X3D40, 0XFF01, 0X3FC0, 0X3E80, 0XFE41, 
        0XFA01, 0X3AC0, 0X3B80, 0XFB41, 0X3900, 0XF9C1, 0XF881, 0X3840, 
        0X2800, 0XE8C1, 0XE981, 0X2940, 0XEB01, 0X2BC0, 0X2A80, 0XEA41, 
        0XEE01, 0X2EC0, 0X2F80, 0XEF41, 0X2D00, 0XEDC1, 0XEC81, 0X2C40, 
        0XE401, 0X24C0, 0X2580, 0XE541, 0X2700, 0XE7C1, 0XE681, 0X2640, 
        0X2200, 0XE2C1, 0XE381, 0X2340, 0XE101, 0X21C0, 0X2080, 0XE041, 
        0XA001, 0X60C0, 0X6180, 0XA141, 0X6300, 0XA3C1, 0XA281, 0X6240, 
        0X6600, 0XA6C1, 0XA781, 0X6740, 0XA501, 0X65C0, 0X6480, 0XA441, 
        0X6C00, 0XACC1, 0XAD81, 0X6D40, 0XAF01, 0X6FC0, 0X6E80, 0XAE41, 
        0XAA01, 0X6AC0, 0X6B80, 0XAB41, 0X6900, 0XA9C1, 0XA881, 0X6840, 
        0X7800, 0XB8C1, 0XB981, 0X7940, 0XBB01, 0X7BC0, 0X7A80, 0XBA41, 
        0XBE01, 0X7EC0, 0X7F80, 0XBF41, 0X7D00, 0XBDC1, 0XBC81, 0X7C40, 
        0XB401, 0X74C0, 0X7580, 0XB541, 0X7700, 0XB7C1, 0XB681, 0X7640, 
        0X7200, 0XB2C1, 0XB381, 0X7340, 0XB101, 0X71C0, 0X7080, 0XB041, 
        0X5000, 0X90C1, 0X9181, 0X5140, 0X9301, 0X53C0, 0X5280, 0X9241, 
        0X9601, 0X56C0, 0X5780, 0X9741, 0X5500, 0X95C1, 0X9481, 0X5440, 
        0X9C01, 0X5CC0, 0X5D80, 0X9D41, 0X5F00, 0X9FC1, 0X9E81, 0X5E40, 
        0X5A00, 0X9AC1, 0X9B81, 0X5B40, 0X9901, 0X59C0, 0X5880, 0X9841, 
        0X8801, 0X48C0, 0X4980, 0X8941, 0X4B00, 0X8BC1, 0X8A81, 0X4A40, 
        0X4E00, 0X8EC1, 0X8F81, 0X4F40, 0X8D01, 0X4DC0, 0X4C80, 0X8C41, 
        0X4400, 0X84C1, 0X8581, 0X4540, 0X8701, 0X47C0, 0X4680, 0X8641, 
        0X8201, 0X42C0, 0X4380, 0X8341, 0X4100, 0X81C1, 0X8081, 0X4040 
    ); 

    $crc16 = 0xffff; // the CRC 
    $len = strlen($str); 

    for($i = 0; $i < $len; $i++ ) 
    { 
        $t = ($crc16 >> 8) ^ ord($str[$i]); // High byte Xor Message Byte to get index 
        $crc16 = (($crc16 << 8) & 0xff) ^ $CRC16_Lookup[$t]; // Update the CRC from table 
    } 

    // crc16 now contains the CRC value 
    return $crc16; 
} 

echo dec2hexConv ( CRC16yxc( $str )  ,4 )."\n";


function CRC16Inverse($buffer) {
$result = 0x1021;
if ( ($length = strlen($buffer)) > 0) {
for ($offset = 0; $offset < $length; $offset++) {
$result ^= ord($buffer[$offset]);
for ($bitwise = 0; $bitwise < 8; $bitwise++) {
$lowBit = $result & 0x0001;
$result >>= 1;
if ($lowBit) {
$result ^= 0xFFFF;
}
}
}
}
return $result;
}

echo dec2hexConv ( CRC16Inverse( $str )  ,4 )."\n";


function modbus_crc($modbus_msg,$N){
        
        /** CRC table for the CRC-16. The poly is 0x8005 (x^16 + x^15 + x^2 + 1) */
        // Uses irreducible polynomial:  1 + x^2 + x^15 + x^16

        $modbus_crc_tbl = [0x0000, 0xC0C1, 0xC181, 0x0140, 0xC301, 0x03C0, 0x0280, 0xC241,
    0xC601, 0x06C0, 0x0780, 0xC741, 0x0500, 0xC5C1, 0xC481, 0x0440,
    0xCC01, 0x0CC0, 0x0D80, 0xCD41, 0x0F00, 0xCFC1, 0xCE81, 0x0E40,
    0x0A00, 0xCAC1, 0xCB81, 0x0B40, 0xC901, 0x09C0, 0x0880, 0xC841,
    0xD801, 0x18C0, 0x1980, 0xD941, 0x1B00, 0xDBC1, 0xDA81, 0x1A40,
    0x1E00, 0xDEC1, 0xDF81, 0x1F40, 0xDD01, 0x1DC0, 0x1C80, 0xDC41,
    0x1400, 0xD4C1, 0xD581, 0x1540, 0xD701, 0x17C0, 0x1680, 0xD641,
    0xD201, 0x12C0, 0x1380, 0xD341, 0x1100, 0xD1C1, 0xD081, 0x1040,
    0xF001, 0x30C0, 0x3180, 0xF141, 0x3300, 0xF3C1, 0xF281, 0x3240,
    0x3600, 0xF6C1, 0xF781, 0x3740, 0xF501, 0x35C0, 0x3480, 0xF441,
    0x3C00, 0xFCC1, 0xFD81, 0x3D40, 0xFF01, 0x3FC0, 0x3E80, 0xFE41,
    0xFA01, 0x3AC0, 0x3B80, 0xFB41, 0x3900, 0xF9C1, 0xF881, 0x3840,
    0x2800, 0xE8C1, 0xE981, 0x2940, 0xEB01, 0x2BC0, 0x2A80, 0xEA41,
    0xEE01, 0x2EC0, 0x2F80, 0xEF41, 0x2D00, 0xEDC1, 0xEC81, 0x2C40,
    0xE401, 0x24C0, 0x2580, 0xE541, 0x2700, 0xE7C1, 0xE681, 0x2640,
    0x2200, 0xE2C1, 0xE381, 0x2340, 0xE101, 0x21C0, 0x2080, 0xE041,
    0xA001, 0x60C0, 0x6180, 0xA141, 0x6300, 0xA3C1, 0xA281, 0x6240,
    0x6600, 0xA6C1, 0xA781, 0x6740, 0xA501, 0x65C0, 0x6480, 0xA441,
    0x6C00, 0xACC1, 0xAD81, 0x6D40, 0xAF01, 0x6FC0, 0x6E80, 0xAE41,
    0xAA01, 0x6AC0, 0x6B80, 0xAB41, 0x6900, 0xA9C1, 0xA881, 0x6840,
    0x7800, 0xB8C1, 0xB981, 0x7940, 0xBB01, 0x7BC0, 0x7A80, 0xBA41,
    0xBE01, 0x7EC0, 0x7F80, 0xBF41, 0x7D00, 0xBDC1, 0xBC81, 0x7C40,
    0xB401, 0x74C0, 0x7580, 0xB541, 0x7700, 0xB7C1, 0xB681, 0x7640,
    0x7200, 0xB2C1, 0xB381, 0x7340, 0xB101, 0x71C0, 0x7080, 0xB041,
    0x5000, 0x90C1, 0x9181, 0x5140, 0x9301, 0x53C0, 0x5280, 0x9241,
    0x9601, 0x56C0, 0x5780, 0x9741, 0x5500, 0x95C1, 0x9481, 0x5440,
    0x9C01, 0x5CC0, 0x5D80, 0x9D41, 0x5F00, 0x9FC1, 0x9E81, 0x5E40,
    0x5A00, 0x9AC1, 0x9B81, 0x5B40, 0x9901, 0x59C0, 0x5880, 0x9841,
    0x8801, 0x48C0, 0x4980, 0x8941, 0x4B00, 0x8BC1, 0x8A81, 0x4A40,
    0x4E00, 0x8EC1, 0x8F81, 0x4F40, 0x8D01, 0x4DC0, 0x4C80, 0x8C41,
    0x4400, 0x84C1, 0x8581, 0x4540, 0x8701, 0x47C0, 0x4680, 0x8641,
    0x8201, 0x42C0, 0x4380, 0x8341, 0x4100, 0x81C1, 0x8081, 0x4040

];
        $yy = 0;
        $reg = 0x1021;  
        while( $N-- > 0 ) 
        {
            $reg = $reg ^ $modbus_crc_tbl[$yy];
            $yy = $yy + 1;
            for( $bit=0; $bit<=7; $bit++)
            {
                $flag=$reg & 0x0001;
                $reg=$reg>> 1;
                if ( $flag == 1 )
                    $reg = $reg ^ 0xa001;
            }
        }
        return $reg;
    }

function CRC16HexDigest($str){
        return sprintf('%04X', $str);
}

$modbus_msg=$str;
$crc=modbus_crc($modbus_msg,strlen($modbus_msg),8);
echo CRC16HexDigest($crc)."\n";







/*
Python
CRC-CCITT(XModem)       DE28
CRC-CCITT(0xFFFF)       6D49
CRC-CCITT(0x1D0F)       E9F1
CRC-16                  ABC4
CRC-16 (Modbus)         8FE0
CRC-16 (SICK)           301D
CRC-DNP                 CEDC
CRC-32              C3C570E0
CRC-16 (Kermit)         C312
*/

/*
name    polynomial  initial val  reverse byte?  reverse result?  swap result?
CCITT         1021         ffff             no               no            no
XModem        1021         0000             no               no            no
Kermit        1021         0000            yes              yes           yes
CCITT 1D0F    1021         1d0f             no               no            no
IBM           8005         0000            yes              yes            no
*/

# https://barrgroup.com/Embedded-Systems/How-To/CRC-Calculation-C-Code
# http://www-stud.rbi.informatik.uni-frankfurt.de/~haase/crc.html
# https://www.can-cia.org/can-knowledge/can/crc/
# https://www.lammertbies.nl/comm/info/crc-calculation.html
# https://github.com/maranemil/howto/blob/9a47ec930c7b891928cfbce3da65709205d0b55f/utiles/howto_crc_check_string.txt




https://github.com/lamario/CRC_Simulation/blob/624cdc18fc091daf8814da86f7b1fc53cf4c8777/crc_simulation/crc_simulation/crc_simulation.py
https://github.com/AdrianSiwiec/audio-comunicator/blob/468102c348d413622af7cfd3a0dde2b0f92905a1/encoder.py
https://github.com/PetreCatalin/Proiecte-Facultate/blob/788cf4e725637f114c9034d8ff0a036ebb3480bc/CRC/serverCRC.py
https://github.com/L4mbd4/inlk-13/blob/0aa9dff9ced7a3058504b739ee6804b848e1e39a/Netzwerke/Buchstaben.py
https://github.com/kejriwalrahul/Channel-Transmission-Simulation/blob/fa1b69589c2b9046393f54ae61c8051683419164/code/crc.cpp
https://github.com/emukans/lu-computer-networks/blob/c534e66a42a701fe28781443eb9e0b9e29188d84/md2/task1.py
https://github.com/soupyman/tsf/blob/98dbee73f65b04679c62e23af1f3dfd1549ccc45/win/code/Utility/CRC.h
https://github.com/blahlt/notes/wiki/CRC

function crc4($strHexCode) {
      $sequence = "";
      $gp = "10011";

      for ($i = 0; $i < strlen($strHexCode); $i++ ) {
         $strBinChar = "";
         $charAsInt = $strHexCode[$i];
         $strBinChar.= decbin(ord($charAsInt));
         // prepend with zeros to get 8 bit binary strings
         $fillBy = 8 - strlen($strBinChar);
         for ($l=0; $l < $fillBy; $l++) {
            $strBinChar="0".$strBinChar;
         }
         $sequence.=$strBinChar;
      }
      if(substr($sequence,0,1)== 0){
         $sequence = substr($sequence,1,strlen($sequence));
      }
      $sequence.="0000";
      while (strlen($sequence) >= strlen($gp) ) {
         $remainder = "";
         $part = substr($sequence,0, strlen($gp) );
         $sequence = substr($sequence, strlen($gp), strlen($sequence));
         for ($j=0; $j < strlen($part); $j++) {
            if ($part[$j] != $gp[$j] ) {
               $remainder.="1";
            }
            else if (strlen($remainder) > 0) {
               $remainder.="0";
            }
         }

         $sequence = $remainder.$sequence;
      }

      return dechex(bindec($sequence));
   }

echo crc4('2222');
