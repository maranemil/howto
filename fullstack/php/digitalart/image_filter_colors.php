<?php
$image = imagecreatefromjpeg('pexels-photo-1910014.jpg');
for ($ias = 0; $ias < 12; $ias++) {
    imagefilter($image, IMG_FILTER_BRIGHTNESS, -$ias); # -100/+100
    imagefilter($image, IMG_FILTER_CONTRAST, -$ias); # -50/+50
    #imagefilter($image, IMG_FILTER_GRAYSCALE);
    imagejpeg($image, "output/img_filter_$ias.jpg");
}
imagedestroy($image);





$strHTMLIMG = '';
for ($ias = 0; $ias < 12; $ias++) {
    $strHTMLIMG .= '<div style="float: left; margin: 5px">';
    $strHTMLIMG .= '<img src="output/img_filter_' . $ias . '.jpg" class="plotimg" />';
    $strHTMLIMG .= '</div>';
}
$strHTML = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <style>
        body {
        background: #20262E;
        padding: 20px;
        }
        .plotimg {
        width: 255px;
        }
    </style>

</head>
<body>

<div class="container">
    <div class="col-md-12">
    ' . $strHTMLIMG . '
    </div>
</div>

</body>
</html>
';

file_put_contents(__FILE__ . ".html", $strHTML);

/*
imagefilter($image, IMG_FILTER_COLORIZE, 100, 0, 0); # -100,-100,-100 - 100,100,100
imagejpeg($image, 'img_filter_colorize_100_0_0.jpg');
imagefilter($image, IMG_FILTER_EDGEDETECT);
imagefilter($image, IMG_FILTER_GRAYSCALE);
imagefilter($image, IMG_FILTER_EMBOSS);
imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
imagefilter($image, IMG_FILTER_SELECTIVE_BLUR);
imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
imagefilter($image, IMG_FILTER_SMOOTH, 5);
imagefilter($image, IMG_FILTER_NEGATE);
 */

/*

https://davidwalsh.name/php-image-filter
https://www.phpied.com/image-fun-with-php-part-2/
https://www.php.net/manual/de/function.imagefilter.php
https://pixabay.com/de/users/free-photos-242387/
https://pixabay.com/de/photos/artischocken-gem%C3%BCse-gourmet-1246858/
https://de.freeimages.com/
https://de.freeimages.com/photo/lake-at-the-cottage-1372381
https://www.freepik.com/popular-photos
https://www.freepik.com/free-photo/wooden-board-empty-table-top-blurred-background_1387629.htm
https://unsplash.com/
https://unsplash.com/photos/Q9YdEzqwfDE
https://unsplash.com/photos/qkWmW-70M9Y
https://stocksnap.io/
https://stocksnap.io/photo/XQESGTCJEV
https://www.pexels.com/photo/woman-standing-against-wall-wearing-yellow-turtleneck-sweater-1910014/
https://www.pexels.com/
 */
