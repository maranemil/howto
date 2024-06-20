<?php

// sudo apt-get install php composer
// sudo apt-get install php-gd
// php -S localhost:8008
// https://www.php.net/manual/en/function.imagejpeg.php
// https://stackoverflow.com/questions/48649273/how-to-create-png-from-array-of-pixel-color-data-in-php
// https://www.hgb-leipzig.de/~uklaus/PHP/function.imagefilter.html
// https://stackoverflow.com/questions/13929468/php-for-loop-vs-foreach-with-range
// https://www.phpied.com/image-fun-with-php-part-2/
// https://stackoverflow.com/questions/10593638/how-to-loop-through-all-the-pixels-of-an-image

$w = 120;
$widthx = 120;
$h = 120;
$heightx = 120;

// Create truecolour image so we can have infinitely many colours rather than a limited palette
$img = imagecreatetruecolor($w, $h);
imagesavealpha($img, true);
imagealphablending($img, false);

// Iterate over all pixels
/* for($y=0;$y<$h;$y++){
   for($x=0;$x<$w;$x++){
      $r     = round(255*$y/$h);
      $g     = round(255*$x/$w);
      $b     = 0;
      $alpha = rand(0,127);
      $color = imagecolorallocatealpha($img,$r,$g,$b,$alpha);
      imagesetpixel($img,$x,$y,$color);
   }
} */

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $r = round(random_int(1, 255) * $y / $h);
        $g = round(random_int(1, 255) * $x / $w);
        $b = random_int(1, 225);
        $alpha = rand(1, 1);
        $color = imagecolorallocatealpha($img, $r, $g, $b, $alpha);
        imagesetpixel($img, $x, $y, $color);
    }
}

# apply fx 
$width = imagesx($img);
$height = imagesy($img);
$im2 = imagecreatetruecolor($width, $height);
imagecopy($im2, $img, 0, 0, 0, 0, $width, $height);
imagefilter($im2, IMG_FILTER_GRAYSCALE);
imagefilter($im2, IMG_FILTER_PIXELATE, 24, true);
imagefilter($im2, IMG_FILTER_BRIGHTNESS, 10);
imagefilter($im2, IMG_FILTER_CONTRAST, -25);
imagefilter($im2, IMG_FILTER_MEAN_REMOVAL);
#imagefilter($im2, IMG_FILTER_NEGATE);
#imagefilter($im2, IMG_FILTER_COLORIZE, 80,50,255,0);
imagecopymerge($img, $im2, 0, 0, 0, 0, $width, $height, 100);
imagedestroy($im2);


imagepng($img, "result.png");

#header('Content-Type: image/jpeg');
#imagejpeg($img);
#imagedestroy($img);
?>
<img src="result.png"/><br/>

<?php

$src = 'result.png';
$im = imagecreatefrompng($src);
$size = getimagesize($src);
$width = $size[0];
$height = $size[1];

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $rgb = imagecolorat($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        #var_dump($r, $g, $b);
        $arr[] = $r;
    }
}

foreach (range(1, 13) as $i) {
    $k = array_rand($arr);
    $v = $arr[$k];
    $arrRand[] = [$v + 60, 500];
}
print_r($arrRand);

$unixtime = time();

file_put_contents('test_' . $unixtime . '.json', json_encode($arrRand));
?>
<?php

// https://stackoverflow.com/questions/56085344/is-it-possible-to-generate-wav-files-using-php

/*
 * Set some input - format is [Hz, milliseconds], so [440, 1000] is 440Hz (A4) for 1 second
 */
/* $input = [
    [175, 500],
    [350, 1000],
    [500, 500],
    [750, 1000],
    [1000, 500]
];
 */
$input = $arrRand;

//Path to output file
$filePath = 'test_' . $unixtime . '.wav';

//Open a handle to our file in write mode, truncate the file if it exists
$fileHandle = fopen($filePath, 'w');

// Calculate variable dependent fields
$channels = 1; //Mono
$bitDepth = 8; //8bit
$sampleRate = 8000; //CD quality 44100
$blockAlign = ($channels * ($bitDepth / 8));
$averageBytesPerSecond = $sampleRate * $blockAlign;

/*
 * Header chunk
 * dwFileLength will be calculated at the end, based upon the length of the audio data
 */
$header = [
    'sGroupID' => 'RIFF',
    'dwFileLength' => 0,
    'sRiffType' => 'WAVE'
];

/*
 * Format chunk
 */
$fmtChunk = [
    'sGroupID' => 'fmt',
    'dwChunkSize' => 16, // 16
    'wFormatTag' => 1,
    'wChannels' => $channels,
    'dwSamplesPerSec' => $sampleRate,
    'dwAvgBytesPerSec' => $averageBytesPerSecond,
    'wBlockAlign' => $blockAlign,
    'dwBitsPerSample' => $bitDepth
];

/*
 * Map all fields to pack flags
 * WAV format uses little-endian byte order
 */
$fieldFormatMap = [
    'sGroupID' => 'A4',
    'dwFileLength' => 'V',
    'sRiffType' => 'A4',
    'dwChunkSize' => 'V',
    'wFormatTag' => 'v',
    'wChannels' => 'v',
    'dwSamplesPerSec' => 'V',
    'dwAvgBytesPerSec' => 'V',
    'wBlockAlign' => 'v',
    'dwBitsPerSample' => 'v' //Some resources say this is a uint but it's not - stay frosty.
];


/*
 * Pack and write our values
 * Keep track of how many bytes we write so we can update the dwFileLength in the header
 */
$dwFileLength = 0;
foreach ($header as $currKey => $currValue) {
    if (!array_key_exists($currKey, $fieldFormatMap)) {
        die('Unrecognized field ' . $currKey);
    }

    $currPackFlag = $fieldFormatMap[$currKey];
    $currOutput = pack($currPackFlag, $currValue);
    $dwFileLength += fwrite($fileHandle, $currOutput);
}

foreach ($fmtChunk as $currKey => $currValue) {
    if (!array_key_exists($currKey, $fieldFormatMap)) {
        die('Unrecognized field ' . $currKey);
    }

    $currPackFlag = $fieldFormatMap[$currKey];
    $currOutput = pack($currPackFlag, $currValue);
    $dwFileLength += fwrite($fileHandle, $currOutput);
}

/*
 * Set up our data chunk
 * As we write data, the dwChunkSize in this struct will be updated, be sure to pack and overwrite
 * after audio data has been written
 */
$dataChunk = [
    'sGroupID' => 'data',
    'dwChunkSize' => 0
];

//Write sGroupID
$dwFileLength += fwrite($fileHandle, pack($fieldFormatMap['sGroupID'], $dataChunk['sGroupID']));

//Save a reference to the position in the file of the dwChunkSize field so we can overwrite later
$dataChunkSizePosition = $dwFileLength;

//Write our empty dwChunkSize field
$dwFileLength += fwrite($fileHandle, pack($fieldFormatMap['dwChunkSize'], $dataChunk['dwChunkSize']));

/*
    8-bit audio: -128 to 127 (because of 2’s complement)
 */
$maxAmplitude = 127;

//Loop through input
foreach ($input as $currNote) {
    $currHz = $currNote[0];
    $currMillis = $currNote[1];

    /*
     * Each "tick" should be 1 second divided by our sample rate. Since we're counting in milliseconds, use
     * 1000/$sampleRate
     */
    $timeIncrement = 1000 / $sampleRate;

    /*
     * Define how much each tick should advance the sine function. 360deg/(sample rate/frequency)
     */
    $waveIncrement = 360 / ($sampleRate / $currHz);

    /*
     * Run the sine function until we have written all the samples to fill the current note time
     */
    $elapsed = 0;
    $x = 0;
    while ($elapsed < $currMillis) {
        /*
         * The sine wave math
         * $maxAmplitude*.95 lowers the output a bit so we're not right up at 0db
         */
        $currAmplitude = ($maxAmplitude) - number_format(sin(deg2rad($x)) * ($maxAmplitude * .95));

        //Increment our position in the wave
        $x += $waveIncrement;

        //Write the sample and increment our byte counts
        $currBytesWritten = fwrite($fileHandle, pack('c', $currAmplitude));
        $dataChunk['dwChunkSize'] += $currBytesWritten;
        $dwFileLength += $currBytesWritten;

        //Update the time counter
        $elapsed += $timeIncrement;
    }
}

/*
 * Seek to our dwFileLength and overwrite it with our final value. Make sure to subtract 8 for the
 * sGroupID and sRiffType fields in the header.
 */
fseek($fileHandle, 4);
fwrite($fileHandle, pack($fieldFormatMap['dwFileLength'], ($dwFileLength - 8)));

//Seek to our dwChunkSize and overwrite it with our final value
fseek($fileHandle, $dataChunkSizePosition);
fwrite($fileHandle, pack($fieldFormatMap['dwChunkSize'], $dataChunk['dwChunkSize']));
fclose($fileHandle);

?>
<hr/>
<audio src="<?php echo $filePath ?>" controls>
    Your browser does not support the audio element.
</audio>