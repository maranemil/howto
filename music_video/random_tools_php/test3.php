<?php

// https://www.php.net/manual/en/function.imagejpeg.php

// Create a blank image and add some text
$im = imagecreatetruecolor(120, 120);

foreach (range(1, 155) as $i) {
    $text_color = imagecolorallocate($im, random_int(1, 255), random_int(1, 255), random_int(1, 255));
    imagestring($im, -100 + $i, 5 + $i, 5 + $i, 'A Simple Text String', $text_color);
}


// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');

// Output the image
imagejpeg($im);

// Free up memory
imagedestroy($im);