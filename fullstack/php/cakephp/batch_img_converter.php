<?php

#print_r($argv);

/*
# check
find . -type f -print -quit -name "*jpg" | xargs identify | cut  -c  1-25,31-40 | xargs echo
# convert
find . -type f  -name "*jpg" | xargs identify | xargs -l  php ./myscript.php
find . -type f -size +100k -name "*jpg" | xargs identify | xargs -l  php ./myscript.php
# search
grep --colour -r -ainH -m 1 "<html" . | cut -c 1-120 > html.txt
 */

$sGeometry = explode("x", $argv[3]);
$sOrgImg = $argv[1];
$sOrgImgRs = $sOrgImg . "2.jpg";
$picSize = $argv[3];

if ($sGeometry[0] > $sGeometry[1]) {
    $picType = "L"; // lanscape
} elseif ($sGeometry[0] == 200) {
    //do nothing
    print "skip" . PHP_EOL;
} else {
    print "--------$argv[1]------$argv[3]-----------" . PHP_EOL;
    $picType = "P"; // portrait
    $cmd = "convert {$sOrgImg} -resize 200x -quality 95  {$sOrgImgRs}";
    print $cmd . PHP_EOL;
    exec($cmd);
    $cmd = "mv {$sOrgImgRs} {$sOrgImg}";
    exec($cmd);
}
usleep(rand(130000, 180000));

/*

find . -name "*.jpg" | xargs convert -resize 50%
find . -name "*.jpg" | xargs mogrify -resize 50%
find . -type f -size +6200k | xargs mogrify -resize 1600x

find . -maxdepth 1 -type f -name '*.png' -exec sh -c \
'identify -format "%[fx:(h>400 && w>400)]\n" "$0" | grep -q 1' {} \; -print0 \
| xargs -0 mogrify -resize '400x400'

 */
