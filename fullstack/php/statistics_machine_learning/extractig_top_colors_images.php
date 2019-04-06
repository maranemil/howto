<?php
// File and new size
#$filename = 'artichokes-1246858_960_720.jpg';
$filename = 'lake-at-the-cottage-1372381.jpg';
$percent = 0.05;
// Content type
header('Content-Type: image/jpeg');
// Get new sizes
list($width, $height) = getimagesize($filename);
$newWidth = $width * $percent;
$newHeight = $height * $percent;
echo "Img Size: ".PHP_EOL;
print_r(array($width,$height));
echo "---------------------------------".PHP_EOL;
$thumb = imagecreatetruecolor($newWidth, $newHeight);
$source = imagecreatefromjpeg($filename);
// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
// get max w/h pixels
$imgw = imagesx($thumb);
$imgh = imagesy($thumb);
echo "Img Resize: ".PHP_EOL;
print_r( array( $imgw, $imgh ) );
echo "---------------------------------".PHP_EOL;
// n = total number or pixels
$n = $imgw*$imgh;
$histo = array();
for ($i=0; $i<$imgw; $i++)
{
        for ($j=0; $j<$imgh; $j++)
        {
       // get the rgb value for current pixel
                $rgb = ImageColorAt($thumb, $i, $j);
                // extract each value for r, g, b
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                // get the Value from the RGB value
                $V = round(($r + $g + $b) / 3);
                $arrV[] = array(
                    "r"=> intval($r),
                    "g"=> intval($g),
                    "b"=> intval($b)
                );
                $arrHex[] = sprintf("#%02x%02x%02x", $r, $g, $b);
                // add the point to the histogram
                //$histo[$V] += intval($V/$n);
        }
}
//print_r($arrV[0]);
echo "---------------------------------".PHP_EOL;
$countHex = array_count_values($arrHex);
$arReference = array_filter($countHex);
$average = array_sum($arReference)/count($arReference);
echo "Average:".$average.PHP_EOL;
$max = max($arReference);
echo "Max: ".$max.PHP_EOL;
echo "---------------------------------".PHP_EOL;
echo "Top 5 hex colors: ".PHP_EOL;
arsort($countHex);
$top5 = array_slice($countHex,0, 5);
print_r($top5);
echo "---------------------------------".PHP_EOL;
// print_r( hexdec( key($top5))); //
echo "Top color: ".PHP_EOL;
list($r, $g, $b) = sscanf(key($top5), "#%02x%02x%02x");
echo key($top5)."-> $r $g $b"; // rgb color nr 1
print PHP_EOL;

// print colors in terminal
// exec("printf '\e]4;1;%s\a\e[0;41m \n\e[m' '#ff0000'");
// xlogo -bg '#ff0000'
// https://misc.flogisoft.com/bash/tip_colors_and_formatting

$strHTML = '<img src="stat.jpg"  width="300px"/>';
$jsonColors = json_encode($top5);
$arrColors = json_decode($jsonColors,true);
foreach($arrColors as $hexColor => $count){
	$strHTML.= '<div style="background: '.$hexColor.';width:300px"><span style="color:white">'.$hexColor . "( ".$count.')</span></div>';
}

file_put_contents(__FILE__.".html",$strHTML);
imagejpeg($thumb, 'stat.jpg');
imagedestroy($thumb);
