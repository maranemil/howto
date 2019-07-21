<?php

#####################################################
#
# Detect Pixel color in Images
#
#####################################################

/*
http://stackoverflow.com/questions/10290259/detect-main-colors-in-an-image-with-php
http://stackoverflow.com/questions/7727843/detecting-colors-for-an-image-using-php
http://stackoverflow.com/questions/8730661/how-to-find-the-dominant-color-in-image
http://bubble.ro/How_to_create_the_histogram_of_an_image_using_PHP.html
 */

$source_file = "test_image.jpg";

// histogram options
$maxheight = 300;
$barwidth = 2;

$im = ImageCreateFromJpeg($source_file);
$imgw = imagesx($im);
$imgh = imagesy($im);

// n = total number or pixels
$n = $imgw * $imgh;
$histo = array();

for ($i = 0; $i < $imgw; $i++) {
    for ($j = 0; $j < $imgh; $j++) {

        // get the rgb value for current pixel
        $rgb = ImageColorAt($im, $i, $j);

        // extract each value for r, g, b
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        // get the Value from the RGB value
        $V = round(($r + $g + $b) / 3);

        // add the point to the histogram
        $histo[$V] += $V / $n;

    }
}

// find the maximum in the histogram in order to display a normated graph
$max = 0;
for ($i = 0; $i < 255; $i++) {
    if ($histo[$i] > $max) {
        $max = $histo[$i];
    }
}

echo "<div style='width: " . (256 * $barwidth) . "px; border: 1px solid'>";
for ($i = 0; $i < 255; $i++) {
    $val += $histo[$i];

    $h = ($histo[$i] / $max) * $maxheight;

    echo "<img src=\"img.gif\" width=\"" . $barwidth . "\"
height=\"" . $h . "\" border=\"0\">";
}
echo "</div>";

#####################################################
#
# Detect Pixel color in Images
#
#####################################################

error_reporting(0);

function rgb2hex($rgb)
{
    $hex = "#";
    $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
    return $hex; // returns the hex value including the number sign (#)
}

$source_file = "image.jpg";

// histogram options
$maxheight = 300;
$barwidth = 2;

$im = ImageCreateFromJpeg($source_file);
$imgw = imagesx($im);
$imgh = imagesy($im);

// n = total number or pixels

$n = $imgw * $imgh;
$histo = array();
for ($i = 0; $i < $imgw; $i++) {
    for ($j = 0; $j < $imgh; $j++) {

        // get the rgb value for current pixel
        $rgb = ImageColorAt($im, $i, $j);

        // extract each value for r, g, b
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        // get the Value from the RGB value
        $V = round(($r + $g + $b) / 3);
        //echo $V."<br>";

        // add the point to the histogram
        $histo[$V] += $V / $n;
        $histo_color[$V] = rgb2hex([$r, $g, $b]);

    }
}

// find the maximum in the histogram in order to display a normated graph
$max = 0;
for ($i = 0; $i < 255; $i++) {
    if ($histo[$i] > $max) {
        $max = $histo[$i];
    }
}

echo "<div style='width: " . (256 * $barwidth) . "px; border: 1px solid'>";
for ($i = 0; $i < 255; $i++) {
    $val += $histo[$i];
    $h = ($histo[$i] / $max) * $maxheight;

    echo "<img src=\"img.gif\" width=\"" . $barwidth . "\"
height=\"" . $h . "\" border=\"0\">";
}
echo "</div>";

$key = array_search($max, $histo);
$col = $histo_color[$key];

#####################################################
#
# Detect Pixel color in Images
#
#####################################################

function detectColors($image, $num, $level = 5)
{
    $level = (int) $level;
    $palette = array();
    $size = getimagesize($image);
    if (!$size) {
        return false;
    }
    switch ($size['mime']) {
        case 'image/jpeg':
            $img = imagecreatefromjpeg($image);
            break;
        case 'image/png':
            $img = imagecreatefrompng($image);
            break;
        case 'image/gif':
            $img = imagecreatefromgif($image);
            break;
        default:
            return false;
    }
    if (!$img) {
        return false;
    }
    for ($i = 0; $i < $size[0]; $i += $level) {
        for ($j = 0; $j < $size[1]; $j += $level) {
            $thisColor = imagecolorat($img, $i, $j);
            $rgb = imagecolorsforindex($img, $thisColor);
            $color = sprintf('%02X%02X%02X', (round(round(($rgb['red'] / 0x33)) * 0x33)), round(round(($rgb['green'] / 0x33)) * 0x33), round(round(($rgb['blue'] / 0x33)) * 0x33));
            $palette[$color] = isset($palette[$color]) ? ++$palette[$color] : 1;
        }
    }
    arsort($palette);
    return array_slice(array_keys($palette), 0, $num);
}

$img = 'icon.png';
$palette = detectColors($img, 6, 1);
echo '<img src="' . $img . '" />';
echo '<table>';
foreach ($palette as $color) {
    echo '<tr><td style="background:#' . $color . '; width:36px;"></td><td>#' . $color . '</td></tr>';
}
echo '</table>';

/**
 * Returns the colors of the image in an array, ordered in descending order, where the keys are the colors, and the values are the count of the color.
 *
 * @return array
 */

function Get_Color()
{
    if (isset($this->image)) {
        $PREVIEW_WIDTH = 150; //WE HAVE TO RESIZE THE IMAGE, BECAUSE WE ONLY NEED THE MOST SIGNIFICANT COLORS.
        $PREVIEW_HEIGHT = 150;
        $size = GetImageSize($this->image);
        $scale = 1;
        if ($size[0] > 0) {
            $scale = min($PREVIEW_WIDTH / $size[0], $PREVIEW_HEIGHT / $size[1]);
        }

        if ($scale < 1) {
            $width = floor($scale * $size[0]);
            $height = floor($scale * $size[1]);
        } else {
            $width = $size[0];
            $height = $size[1];
        }
        $image_resized = imagecreatetruecolor($width, $height);
        if ($size[2] == 1) {
            $image_orig = imagecreatefromgif($this->image);
        }

        if ($size[2] == 2) {
            $image_orig = imagecreatefromjpeg($this->image);
        }

        if ($size[2] == 3) {
            $image_orig = imagecreatefrompng($this->image);
        }

        imagecopyresampled($image_resized, $image_orig, 0, 0, 0, 0, $width, $height, $size[0], $size[1]); //WE NEED NEAREST NEIGHBOR RESIZING, BECAUSE IT DOESN'T ALTER THE COLORS
        $im = $image_resized;
        $imgWidth = imagesx($im);
        $imgHeight = imagesy($im);
        for ($y = 0; $y < $imgHeight; $y++) {
            for ($x = 0; $x < $imgWidth; $x++) {
                $index = imagecolorat($im, $x, $y);
                $Colors = imagecolorsforindex($im, $index);
                $Colors['red'] = intval((($Colors['red']) + 15) / 32) * 32; //ROUND THE COLORS, TO REDUCE THE NUMBER OF COLORS, SO THE WON'T BE ANY NEARLY DUPLICATE COLORS!
                $Colors['green'] = intval((($Colors['green']) + 15) / 32) * 32;
                $Colors['blue'] = intval((($Colors['blue']) + 15) / 32) * 32;
                if ($Colors['red'] >= 256) {
                    $Colors['red'] = 240;
                }

                if ($Colors['green'] >= 256) {
                    $Colors['green'] = 240;
                }

                if ($Colors['blue'] >= 256) {
                    $Colors['blue'] = 240;
                }

                $hexarray[] = substr("0" . dechex($Colors['red']), -2) . substr("0" . dechex($Colors['green']), -2) . substr("0" . dechex($Colors['blue']), -2);
            }
        }
        $hexarray = array_count_values($hexarray);
        natsort($hexarray);
        $hexarray = array_reverse($hexarray, true);
        return $hexarray;

    } else {
        die("You must enter a filename! (\$image parameter)");
    }

}

/*
-----------------------------------------------------
here is exactly what you are looking for in PHP :
https://github.com/thephpleague/color-extractor

Example :*/

require 'vendor/autoload.php';
use League\ColorExtractor\Client as ColorExtractor;
$client = new ColorExtractor;
$image = $client->loadPng('./some/image.png');
// Get the most used color hexadecimal codes from image.png
$palette = $image->extract();

#-----------------------------------------------------

$image = imagecreatefromjpeg('image.jpg');
$thumb = imagecreatetruecolor(1, 1);
imagecopyresampled($thumb, $image, 0, 0, 0, 0, 1, 1, imagesx($image), imagesy($image));
$mainColor = strtoupper(dechex(imagecolorat($thumb, 0, 0)));
echo $mainColor;

/*
######################
svg to png*/

$usmap = '/path/to/blank/us-map.svg';
$im = new Imagick();
//$im->setBackgroundColor(new ImagickPixel('transparent'));

$svg = file_get_contents($usmap);
/*loop to color each state as needed, something like*/
$idColorArray = array(
    "AL" => "339966"
    , "AK" => "0099FF"
    #...
    , "WI" => "FF4B00"
    , "WY" => "A3609B",
);
foreach ($idColorArray as $state => $color) {
//Where $color is a RRGGBB hex value
    $svg = preg_replace(
        '/id="' . $state . '" style="fill:#([0-9a-f]{6})/'
        , 'id="' . $state . '" style="fill:#' . $color
        , $svg
    );
}

$im->readImageBlob($svg);
/*png settings*/
$im->setImageFormat("png24");
$im->resizeImage(720, 445, imagick::FILTER_LANCZOS, 1); /*Optional, if you need to resize*/
/*jpeg*/
$im->setImageFormat("jpeg");
$im->adaptiveResizeImage(720, 445); /*Optional, if you need to resize*/
$im->writeImage('/path/to/colored/us-map.png'); /*(or .jpg)*/
$im->clear();
$im->destroy();

/*
----------------------------
 */

//declare the points for your rectangles
//'UL' means upper left points, and 'LR' means the lower right points
$rectangle_array = array(
    $R1 = array("UL" => array("x" => 10, "y" => 20), "LR" => array("x" => 22, "y" => 5)),
    $R2 = array("UL" => array("x" => 32, "y" => 44), "LR" => array("x" => 65, "y" => 20)),
    $R3 = array("UL" => array("x" => 20, "y" => 16), "LR" => array("x" => 25, "y" => 10)),
);

if (rectIntersect($rectangle_array)) {
    echo "THEY INTERSECT";
} else {
    echo "NO INTERSECTION";
}

function rectIntersect($rectangles)
{
    $num_rectangles = count($rectangles);
    for ($i = 0; $i < $num_rectangles; $i++) {
        //for each rectangle, compare points to every following rectangle
        $R1 = $rectangles[$i];
        for ($k = $i; $k < ($num_rectangles - $i); $k++) {
            $R2 = $rectangles[$k + 1];
            if ($R1['LR']['x'] > $R2['UL']['x'] && $R1['UL']['x'] < $R2['LR']['x']) {
                //rectangles cross on x-axis
                if (($R1['LR']['y'] < $R2['UL']['y'] && $R1['UR']['y'] < $R2['LR']['y']) ||
                    ($R1['UL']['y'] > $R2['LR']['y'] && $R1['LR']['y'] < $R2['UL']['y'])) {
                    //rectangles intersect
                    return true;
                }
            }
        }
    }
    return false;
}

#########################################################

/*Use of the Haversine formula:

a = sin²(Δlat/2) + cos(lat1)*cos(lat2)*sin²(Δlong/2)
c = 2*atan2(√a, √(1−a))
d = R*c
JavaScript:

var R = 6371; // km
var dLat = (lat2-lat1)*Math.PI / 180;
var dLon = (lon2-lon1)*Math.PI / 180;
var lat1 = lat1*Math.PI / 180;
var lat2 = lat2*Math.PI / 180;

var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2);
var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
var d = R * c;
 */

#-------------------------------

####
#http://stackoverflow.com/questions/39661410/svg-to-png-image-conversion-in-php

/*
$image = new imagick();
//set transparent background
$image->setBackgroundColor(new ImagickPixel('transparent'));
$image->setFormat('svg');
$image->readImageBlob(file_get_contents("image.svg"));
$image->setImageFormat("png32");
$image->resizeImage(265,195, Imagick::FILTER_LANCZOS, 1);
$image->writeImage('result.png');

#http://stackoverflow.com/questions/10289686/rendering-an-svg-file-to-a-png-or-jpeg-in-php

$image = new Imagick();
$image->readImageBlob(file_get_contents('image.svg'));
$image->setImageFormat("png24");
$image->resizeImage(1024, 768, imagick::FILTER_LANCZOS, 1);
$image->writeImage('image.png')
 */

#-----------------------------------------------------
# https://developer-blog.net/svg-zu-png-konvertieren-in-php/

//generate png from svg and save to forum
/*
$im = new Imagick();
$svg = file_get_contents($filename);
$im->readImageBlob('<?xml version="1.0" encoding="UTF-8" standalone="no"?>'.$svg);
$im->setImageBackgroundColor(new ImagickPixel('transparent'));
$im->setImageFormat("png24");
$im->resizeImage(90, 90, imagick::FILTER_LANCZOS, 1);
$im->writeImage($phpbb_root_path."images/avatars/upload/".$avatar_salt."_".$forum_user_id.".png");
$im->clear();
$im->destroy();*/

#-----------------------------------------------------
#https://www.imagemagick.org/discourse-server/viewtopic.php?t=22631

//Works OK
/*
$im = new Imagick();
$im->setBackgroundColor(new ImagickPixel('transparent'));
$im->readimage('from.svg');
$im->setImageFormat("png32");
$im->writeimage('to.png'); //Image with transparent background
 */

#-----------------------------------------------------

/*
$mw = New MagickWand();
$transparentColor = NewPixelWand();
PixelSetColor($transparentColor, 'transparent');
MagickSetBackgroundColor($mw, $transparentColor);
MagickReadImage($mw, 'from.svg');
MagickResizeImage($mw, 300, 300, MW_LanczosFilter, 0); //Key point
MagickSetImageFormat($mw, 'png32');
MagickWriteImage($mw, 'to.png'); //Black image if we use resize. Transparent else.
 */

/*
-----------------------------------------------------
https://www.drweb.de/magazin/html-5-und-svg-per-php-und-imagemagick-generiertes-png-fallback-fuer-aeltere-browser-45449/
https://www.noupe.com/development/html-5-and-svg-providing-a-png-fallback-with-php-and-imagemagick-80508.html
 */
/*
if ($browser["browser"] == "IE" && $browser["majorver"] < 9) {
$png = new Imagick();
$png->setBackgroundColor(new ImagickPixel("transparent"));
$png->readImageBlob($svg);
$png->setImageFormat("png32");
header("Content-Type: image/png");
echo $png;
} else {
header("Content-Type: image/svg+xml");
echo $svg;
}

if ($browser["browser"] == "IE" && $browser["majorver"] < 9) {
$png = new Imagick();
$png->setBackgroundColor(new ImagickPixel("transparent"));
$png->readImageBlob($svg);
$png->setImageFormat("png32");
header("Content-Type: image/png");
echo $png;
} else {
header("Content-Type: image/svg+xml");
echo $svg;
}*/

/*
https://github.com/dirkgroenen/SVGMagic
---------------------------------------------------------*/
#Loop Break;
/*
$a = 0;
while ($a < 10) :
$a++;
if($a == 2){
break;
}
endwhile;*/

#-----------------------------------------------------

/*
function scaleImage($imagePath) {
$imagick = new \Imagick(realpath($imagePath));
$imagick->scaleImage(150, 150, true);
header("Content-Type: image/jpg");
echo $imagick->getImageBlob();
}*/

#-----------------------------------------------------

/*
$im = new Imagick($filename);
$im->setImageBackgroundColor('#ffffff');
$im = $im->flattenImages();
// Setting same size for all images
$base->resizeImage(274, 275, Imagick::FILTER_LANCZOS, 1);
// Copy opacity mask
$base->compositeImage($mask, Imagick::COMPOSITE_DSTIN, 0, 0, Imagick::CHANNEL_ALPHA);
$im->setImageFormat("jpeg");
$im->setImageCompressionQuality(95);
$im->writeImage($filename);
header("Content-Type: image/png");
echo $base;
 */
#-----------------------------------------------------

/*
# http://php.net/manual/de/imagick.setbackgroundcolor.php
$im = new Imagick();
$im->setBackgroundColor(new ImagickPixel('transparent'));
$im->readImage('carte_Alain2.svg');
$im->setImageFormat("png32");
header('Content-type: image/png');
echo $im;*/

#-----------------------------------------------------
# convert -background magenta -density 100 test.svg test.png # ok
# -----------------------------------------------------

// generate PNG
// magenta    #FF00FF    rgb(255,0,255)
//$fh = fopen($fileSVG, "rb");
//$data = fread($fh, 16096);
//$svg = file_get_contents($fileSVG);

/*
$image = new Imagick();
$image->setBackgroundColor(new ImagickPixel('#FF00FF'));
$image->readImageBlob($svg);
$image->scaleImage(450, 450, true);
$image->setImageFormat("png");
$image->writeImage( $filename );
//header("Content-Type: image/png");
//$im->setImageBackgroundColor('#FF00FF');
$im->setBackgroundColor(new ImagickPixel('#FF00FF'));
$im->readImageBlob(file_get_contents($fileSVG));
#$im->readimage($fileSVG);
#$im->cropThumbnailImage( 80, 80 );
#$im->thumbnailImage(300, 300);
#$im->resizeImage(320,240,Imagick::FILTER_LANCZOS,1);
$im->resizeImage(800,800, imagick::FILTER_LANCZOS, 0.9, true);
#$im->cropImage (680,680,0,0);
#$im->setImageFormat("png32");
#$im->writeimage($filename); //Image with transparent background 'to.png'
$im->setImageFormat("png");
header("Content-type: image/png");
echo $im->getImageBlob();
#$im->writeImage( $filename );
#echo '<img src="local/temp/'.basename($filename).'">';
//header('Content-type: image/png');
//echo $im;
 */

#-----------------------------------------------------

$handle = fopen("inputfile.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
    }

    fclose($handle);
} else {
    // error opening the file.
}

#-----------------------------------------------------

if ($file = fopen("file.txt", "r")) {
    while (!feof($file)) {
        $line = fgets($file);
        # do same stuff with the $line
    }
    fclose($file);
}

#-----------------------------------------------------

$file = new SplFileObject("file.txt");
while (!$file->eof()) {
    echo $file->fgets();
}

#-----------------------------------------------------

# Pixel / MM / CM conversion:
function toMM($v)
{
    return round(($v * 26.2) / 25.4);
}

function px2cmFromImage($image, $dpi)
{

    #Create a new image from file or URL
    $img = ImageCreateFromJpeg($image);

    #Get image width / height
    $x = ImageSX($img);
    $y = ImageSY($img);

    #Convert to centimeter
    $h = $x * 2.54 / $dpi;
    $l = $y * 2.54 / $dpi;

    #Format a number with grouped thousands
    $h = number_format($h, 2, ',', ' ');
    $l = number_format($l, 2, ',', ' ');

    #add size unit
    $px2cm[] = $h . "cm";
    $px2cm[] = $l . "cm";

    #return array w values
    #$px2cm[0] = X
    #$px2cm[1] = Y
    return $px2cm;
}

function px2cmFromSVG($width, $height, $dpi)
{

    #Assign width / height
    $x = $width;
    $y = $height;

    #Convert to centimeter
    $h = $x * 2.54 / $dpi;
    $l = $y * 2.54 / $dpi;

    #Format a number with grouped thousands
    $h = number_format($h, 2, ',', ' ');
    $l = number_format($l, 2, ',', ' ');

    #add size unit
    //$px2cm[] = $h."cm";
    //$px2cm[] = $l."cm";

    $px2cm[] = $h;
    $px2cm[] = $l;

    #return array w values
    #$px2cm[0] = X
    #$px2cm[1] = Y
    return $px2cm;
}

// mm = (pixels * 25.4) / dpi
// pixels = (mm * dpi) / 25.4

// mm = (pixels * 25.4) / dpi
// pixels = (mm * dpi) / 25.4

// 26.2) / 25.4;
function cm2pixel($valcm, $dpi)
{
    $valmm = $valcm * 10;
    $pixels = ($valmm * $dpi) / 25.4;
    return round($pixels);
}

function pixel2cm($pixels, $dpi)
{
    $cm = round((($pixels * 25.4) / $dpi), 2) / 10;
    return $cm;
}

$dpi = 72;

// http://php.net/manual/de/function.imagesx.php

/*
// Create a200 x200 canvas image
$canvas = imagecreatetruecolor(250,200);
// Allocate color for rectangle
$pink = imagecolorallocate($canvas,255,105,180);
// Draw rectangle with its color
imagerectangle($canvas,50,50,200,150, $pink);
// Output and free from memory
header('Content-Type: image/jpeg');
imagejpeg($canvas);
imagedestroy($canvas);
 */
