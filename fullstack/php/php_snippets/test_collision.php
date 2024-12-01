<?php

// http://phptester.net/
// https://beautifytools.com/php-beautifier.php

$start = 1730157135;
$end = 1730157435;

$arrMd5 = [];
$arrMd5Collide = 0;

foreach (range($start, $end) as $i)
{

    $md5sub = str_shuffle(substr(str_shuffle(base64_encode((string)time())) , 0, 5) . substr(str_shuffle(crc32(bin2hex((string)time()))) , 0, 3));

    if (in_array($md5sub, $arrMd5))
    {
        echo "collision " . $md5sub;
        ++$arrMd5Collide;
    }
    else
    {
        $arrMd5[] = $md5sub;
    }

}

print ("\r\n" . $arrMd5Collide);
