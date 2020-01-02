<?php

// Kaleidoscope 4 parts

$x = 220; // 140
$y = 220; // 140
$width = 300;
$height = 300;
$filename_bl = 'example-bl.png';
$filename_br = 'example-br.png';
$filename_tl = 'example-tl.png';
$filename_tr = 'example-tr.png';

// ----------------------------------------------------------------------------
// bottom left
$im = imagecreatefrompng('example3.png');
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
imagepng($rotate,$filename_tr);
imagedestroy($source);
imagedestroy($rotate);

// top left
$im = imagecreatefrompng($filename_bl);
imageflip($im, IMG_FLIP_VERTICAL);
imagepng($im,$filename_tl);
imagedestroy($im);

// bottom right
$im = imagecreatefrompng($filename_tr);
imageflip($im, IMG_FLIP_VERTICAL);
imagepng($im,$filename_br);
imagedestroy($im);

//
$im = @imagecreatetruecolor(600, 600)
      or die('Cannot Initialize new GD image stream');
#$text_color = imagecolorallocate($im, 233, 14, 91);
#imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);
imagepng($im,'example_wrap.png');
imagedestroy($im);


// -----------------------------------------------------------
// Load 4 parts into wrap box
$stamp = imagecreatefrompng($filename_bl);
$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 300, imagesy($im) - $sy - 0, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_tl);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 300, imagesy($im) - $sy - 300, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_tr);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 0, imagesy($im) - $sy - 300, 0, 0, imagesx($stamp), imagesy($stamp));

$stamp = imagecreatefrompng($filename_br);
#$im = imagecreatefrompng('example_wrap.png');
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - 0, imagesy($im) - $sy - 0, 0, 0, imagesx($stamp), imagesy($stamp));

#header('Content-type: image/png');
imagepng($im,'example_wrap_out.png');
imagedestroy($im);, 