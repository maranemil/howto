<?php /** @noinspection PhpConditionAlreadyCheckedInspection */
/** @noinspection DuplicatedCode */

// Kaleidoscope 4 parts

$x = 30; // 140
$y = 30; // 140
$width = 200;
$height = 200;
$filename_bl = 'example-bl.png';
$filename_br = 'example-br.png';
$filename_tl = 'example-tl.png';
$filename_tr = 'example-tr.png';
$filename_source = 'example4.png';

// ----------------------------------------------------------------------------
// bottom left
$im = imagecreatefrompng($filename_source);
$size = min(imagesx($im), imagesy($im));
$im2 = imagecrop($im, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
if ($im2 !== FALSE) {
    $degrees = 90; // 180
    $rotate = imagerotate($im2, $degrees, 0);
    #imagepng($rotate);

    imageflip($rotate, IMG_FLIP_VERTICAL);
    imagepng($rotate, $filename_bl);
    imagedestroy($im2);
}
imagedestroy($im);

// top right
$degrees = 180; // 180
$source = imagecreatefrompng($filename_bl);
$rotate = imagerotate($source, $degrees, 0);
imagepng($rotate, $filename_tr);
imagedestroy($source);
imagedestroy($rotate);

// top left
$im = imagecreatefrompng($filename_bl);
imageflip($im, IMG_FLIP_VERTICAL);
imagepng($im, $filename_tl);
imagedestroy($im);

// bottom right
$im = imagecreatefrompng($filename_tr);
imageflip($im, IMG_FLIP_VERTICAL);
imagepng($im, $filename_br);
imagedestroy($im);

//
$im = @imagecreatetruecolor($width * 2, $height * 2)
or die('Cannot Initialize new GD image stream');
#$text_color = imagecolorallocate($im, 233, 14, 91);
#imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);
imagepng($im, 'example_wrap.png');
imagedestroy($im);


// -----------------------------------------------------------
// Load 4 parts into wrap box
$stamp = imagecreatefrompng($filename_bl);
$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - $width, imagesy($im) - $sy - 0, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_tl);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - $width, imagesy($im) - $sy - $height, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_tr);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 0, imagesy($im) - $sy - $height, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_br);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 0, imagesy($im) - $sy - 0, 0, 0, imagesx($stamp), imagesy($stamp));

#header('Content-type: image/png');
imagepng($im, 'example_wrap_out.png');
imagedestroy($im);

// Kaleidoscope 4 parts

$x = 130; // 140
$y = 130; // 140
$width = 300;
$height = 300;

// ----------------------------------------------------------------------------
// bottom left
$im = imagecreatefrompng($filename_source);
$size = min(imagesx($im), imagesy($im));
$im2 = imagecrop($im, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
if ($im2 !== FALSE) {
    $degrees = 180; // 180
    $rotate = imagerotate($im2, $degrees, 0);
    #imagepng($rotate);

    imageflip($rotate, IMG_FLIP_VERTICAL);
    imagepng($rotate, $filename_bl);
    imagedestroy($im2);
}
imagedestroy($im);

// top right
$degrees = 180; // 180
$source = imagecreatefrompng($filename_bl);
$rotate = imagerotate($source, $degrees, 0);
imagepng($rotate, $filename_tr);
imagedestroy($source);
imagedestroy($rotate);

// top left
$im = imagecreatefrompng($filename_bl);
imageflip($im, IMG_FLIP_VERTICAL);
imagepng($im, $filename_tl);
imagedestroy($im);

// bottom right
$im = imagecreatefrompng($filename_tr);
imageflip($im, IMG_FLIP_VERTICAL);
imagepng($im, $filename_br);
imagedestroy($im);

//
$im = @imagecreatetruecolor($width * 2, $height * 2)
or die('Cannot Initialize new GD image stream');
#$text_color = imagecolorallocate($im, 233, 14, 91);
#imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);
imagepng($im, 'example_wrap.png');
imagedestroy($im);


// -----------------------------------------------------------
// Load 4 parts into wrap box
$stamp = imagecreatefrompng($filename_bl);
$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - $width, imagesy($im) - $sy - 0, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_tl);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - $width, imagesy($im) - $sy - $height, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_tr);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 0, imagesy($im) - $sy - $height, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_br);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 0, imagesy($im) - $sy - 0, 0, 0, imagesx($stamp), imagesy($stamp));

#header('Content-type: image/png');
imagepng($im, 'example_wrap_out2.png');
imagedestroy($im);


// merge
// http://www.imagemagick.org/Usage/compose/#difference

// convert example_wrap_out2.png  -gravity center  example_wrap_out.png -composite Destination.png
// convert example_wrap_out2.png  -gravity center   example_wrap_out.png  -compose difference -composite  Destination.png
// composite -blend 100x100 -alpha on  -gravity center -compose Lighten  example_wrap_out.png  example_wrap_out2.png    Destination.png

system("composite -blend 100x100 -alpha on  -gravity center -compose Lighten  example_wrap_out.png  example_wrap_out2.png    example_wrap_out3" . time() . ".png");