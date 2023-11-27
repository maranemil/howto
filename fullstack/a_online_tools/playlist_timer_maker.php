<?php

// https://stackoverflow.com/questions/3856293/how-to-convert-seconds-to-time-format
// https://stackoverflow.com/questions/28964543/remove-all-zero-values-from-string-php
// https://stackoverflow.com/questions/4834202/convert-time-in-hhmmss-format-to-seconds-only

function time2sec($time) {
    $durations = array_reverse(explode(':', $time));
    $second = array_shift($durations);
    foreach ($durations as $duration) {
        $second += (60 * $duration);
    }
    return $second;
}
#echo time2sec('4:52'); // 292
#echo time2sec('2:01:42'); // 7302

$str = "
1.FUMIX 115 02:48
2.FUMIX 116 03:14
3.FUMIX 186 03:45
4.FUMIX 187 03:03
5.FUMIX 188 03:12
6.FUMIX 190 02:40
7.FUMIX 219 02:33
8.FUMIX 237 02:47
9.FUMIX 240 02:42
10.FUMIX 242 03:06
11.FUMIX 244 03:15";

print "<pre>";
$csv = preg_split('~\n~',$str);
print_r($csv);

foreach($csv as $line){
	if(!empty(trim($line))){
	   $arCols[] = str_getcsv($line,' ');
	}
}
$timer = 0;
foreach($arCols as $index => $element){
	$arCols[0][3] = 0;
	$arCols[0][4] = '00:01';
	$duration = ltrim($element[2],"0");
	$timer = $timer + time2sec($duration);
	if(count($arCols) > $index+1){
		$arCols[$index+1][3] =  $timer;
		$arCols[$index+1][4] =  date('i:s',$timer);
	}
}
print_r($arCols);

foreach($arCols as $index => $element){
	print $element[4]." ". $element[0]." ". $element[1]."<br>";
}