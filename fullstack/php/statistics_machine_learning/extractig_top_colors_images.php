<?php

// File and new size
$filename = 'test.jpg';
$percent = 0.05;

// Content type
header('Content-Type: image/jpeg');

// Get new sizes
list($width, $height) = getimagesize($filename);
$newwidth = $width * $percent;
$newheight = $height * $percent;
echo "Img Size: ".PHP_EOL;
print_r(array($width,$height));
echo "---------------------------------".PHP_EOL;
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);
// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
// get max w/h pixels
$imgw = imagesx($thumb);
$imgh = imagesy($thumb);
echo "Img Resize: ".PHP_EOL;
print_r(array($imgw,$imgh));
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
//$keys = array_keys($countHex);
//print_r($keys);
//print PHP_EOL;
//print_r( key($top5)); // hex color nr 1
echo "---------------------------------".PHP_EOL;
// print_r( hexdec( key($top5))); //
echo "Top color: ".PHP_EOL;
list($r, $g, $b) = sscanf(key($top5), "#%02x%02x%02x");
echo key($top5)."-> $r $g $b"; // rgb color nr 1
print PHP_EOL;

/*
$three = array_chunk($n, 3, true)[0];
$three = array_slice($n, 0, 3, true);
*/

/*

https://www.php.net/manual/de/function.krsort.php
https://www.php.net/manual/de/function.arsort.php
https://www.php.net/manual/de/function.array-count-values.php
https://www.php.net/manual/de/function.array-values.php
https://unsplash.com/search/photos/blue-sky
https://www.php.net/manual/en/function.imagescale.php
https://www.php.net/manual/en/function.imagecopyresized.php
https://www.php.net/manual/en/function.imagecopyresized.php
https://www.php.net/manual/en/function.imagecopyresampled.php

https://canvasjs.com/php-charts/scatter-point-chart/
https://jpgraph.net/download/manuals/chunkhtml/ch15s05.html
https://jpgraph.net/
https://www.codediesel.com/php/6-excellent-charting-libraries-for-php/
https://www.edrawsoft.com/createscatterchart.php
https://demo.koolphp.net/Examples/KoolChart/ChartTypes/Scatter_Chart/index.php
https://www.fusioncharts.com/dev/chart-guide/standard-charts/select-scatter-chart
https://www.zingchart.com/docs/chart-types/scatter-plots/
http://pchart.sourceforge.net/documentation.php?topic=exemple25
https://www.highcharts.com/demo/scatter
http://www.jzy3d.org/tutorial.php


https://www.python-kurs.eu/matplotlib.php

https://matplotlib.org/users/colors.html
https://github.com/matplotlib/matplotlib/issues/5377
https://stackoverflow.com/questions/33287156/specify-color-of-each-point-in-scatter-plot-matplotlib
https://jakevdp.github.io/PythonDataScienceHandbook/04.02-simple-scatter-plots.html
https://stackoverflow.com/questions/12236566/setting-different-color-for-each-series-in-scatter-plot-on-matplotlib
https://community.plot.ly/t/specifying-a-color-for-each-point-in-a-3d-scatter-plot/12652
https://franciscouzo.github.io/image_colors/
https://en.wikipedia.org/wiki/CIELAB_color_space
https://pandas.pydata.org/pandas-docs/stable/reference/api/pandas.DataFrame.plot.scatter.html
https://www.r-graph-gallery.com/121-manage-colors-with-plotly/
https://gist.github.com/Uberi/4885a318e7ef2afa7f22
https://kite.com/python/docs/matplotlib.pyplot.scatter
https://stackoverflow.com/questions/12182891/plot-image-color-histogram-using-matplotlib
https://matplotlib.org/api/_as_gen/matplotlib.pyplot.show.html
https://www.quora.com/How-do-I-generate-n-visually-distinct-RGB-colours-in-Python

https://pythonspot.com/image-histogram/
https://www.pyimagesearch.com/2014/01/22/clever-girl-a-guide-to-utilizing-color-histograms-for-computer-vision-and-image-search-engines/
https://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_image_histogram_calcHist.php
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_histograms/py_2d_histogram/py_2d_histogram.html
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_histograms/py_histogram_begins/py_histogram_begins.html
https://matplotlib.org/users/image_tutorial.html


*/


// find the maximum in the histogram in order to display a normated graph
/*$max = 0;
for ($i=0; $i<255; $i++)
{
        if ($histo[$i] > $max)
        {
                $max = $histo[$i];
        }
}
echo $max;*/
?>