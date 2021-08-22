<?php

// http://www.thematrixer.com/binary.php
// http://phptester.net/

$argv = $_SERVER['argv'];

//print_r($_SERVER['argv']);

if (count($argv) != 4) {
    throw new Exception("missing arguments");
    // argv expected: php test.php encode bin text
}

$direction = $argv[1];
$encodeType = $argv[2];
$strText = $argv[3];


if ($direction == 'encode') {
    switch ($encodeType) {

        case 'bin':
            $arr = str_split($strText);
            foreach ($arr as $letter) {
                echo decbin(ord($letter)) . "\x20";
            }
            break;
        case 'hex':
            // echo trim( chunk_split(bin2hex($strText), 2, ' ') );   // alternative 
            echo trim(wordwrap(bin2hex($strText), 2, ' ', true));
            break;
    }
}
if ($direction == 'decode') {
    switch ($encodeType) {

        case 'bin':
            // input: 1110100 1100101 1111000 1110100
            $arr = explode(' ', $strText);
            foreach ($arr as $letter) {
                echo chr(bindec($letter));
            }
            break;

        case 'hex':
            // input: 74 65 78 74
            $arr = explode(' ', $strText);
            foreach ($arr as $letter) {
                echo (hex2bin($letter));
            }

            break;
    }
}

/*

https://www.browserling.com/tools/binary-to-text
https://www.browserling.com/tools/text-to-binary

https://www.browserling.com/tools/text-to-hex
https://www.browserling.com/tools/hex-to-text


text2bin
https://stackoverflow.com/questions/6382738/convert-string-to-binary-then-back-again-using-php

$bin = decbin(ord($char));
$char = chr(bindec($bin));

// Convert a string into binary
// Should output: 0101001101110100011000010110001101101011
$value = unpack('H*', "Stack");
echo base_convert($value[1], 16, 2);

// Convert binary into a string
// Should output: Stack
echo pack('H*', base_convert('0101001101110100011000010110001101101011', 2, 16));

http://www.inanzzz.com/index.php/post/swf8/converting-string-to-binary-and-binary-to-string-with-php

function strigToBinary($string)
{
    $characters = str_split($string);
 
    $binary = [];
    foreach ($characters as $character) {
        $data = unpack('H*', $character);
        $binary[] = base_convert($data[1], 16, 2);
    }
 
    return implode(' ', $binary);    
}
 
function binaryToString($binary)
{
    $binaries = explode(' ', $binary);
 
    $string = null;
    foreach ($binaries as $binary) {
        $string .= pack('H*', dechex(bindec($binary)));
    }
 
    return $string;    
}



*/