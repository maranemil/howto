<?php
########################################################################
# BandCamp time to YouTube time converter
########################################################################

// https://stackoverflow.com/questions/3856293/how-to-convert-seconds-to-time-format
// https://stackoverflow.com/questions/28964543/remove-all-zero-values-from-string-php
// https://stackoverflow.com/questions/4834202/convert-time-in-hhmmss-format-to-seconds-only

function time2sec($time)
{
    $durations = array_reverse(explode(':', $time));
    $second = array_shift($durations);
    foreach ($durations as $duration) {
        $second += (60 * $duration);
    }
    return $second;
}

#echo time2sec('4:52'); // 292
#echo time2sec('2:01:42'); // 7302

// string with bandcamp tracks and tracks time
$str = "


1.FUMIX 008 03:17
2.FUMIX 058 02:14
3.FUMIX 116 03:14
4.FUMIX 122 02:49

";


print "<pre>";
// split string into separate lines
$csv = preg_split('~\n~', $str);
// print_r($csv);

// read each line as csv
$arCols = [];
foreach ($csv as $line) {
    if (!empty(trim($line))) {
        #$arCols[] = str_getcsv($line, ' ');
		$arCols[] = array(
			0 => substr($line,0,-6),
			1 => substr($line,-6)
		);
    }
}

# debug arrays
#print_r($arCols);
#exit();

// convert BandCamp track time in seconds and create YouTube time index
$timer = 0;
foreach ($arCols as $index => $element) {
    $arCols[0][3] = 0;
    $arCols[0][4] = '00:01';
    $duration = ltrim($element[1], "0");
    $timer = $timer + time2sec($duration);
    if (count($arCols) > $index + 1) {
        $arCols[$index + 1][3] = $timer;
        $arCols[$index + 1][4] = date('i:s', $timer);
    }
}

# debug arrays
# print_r($arCols);

foreach ($arCols as $index => $element) {
    print $element[4] . " " . substr($element[0],0,-1) . "<br>";
}