#!/bin/bash

convert example4.png +flop ref.png

cp ref.png flip1.png
convert flip1.png +flop flip3.png
convert flip3.png +flip flip2.png
convert flip2.png +flop flip4.png

convert flip3.png flip1.png -rotate 90 -append out1.png
convert flip2.png flip4.png -rotate 90 -append out2.png
convert out2.png out1.png -rotate 90 -append out3.png

convert example4.png +flip ref.png

cp ref.png flip1.png
convert flip1.png +flop flip3.png
convert flip3.png +flip flip2.png
convert flip2.png +flop flip4.png

convert flip3.png flip1.png -rotate 90 -append out1.png
convert flip2.png flip4.png -rotate 90 -append out2.png
convert out2.png out1.png -rotate 90 -append out4.png

composite -blend 100x100 -alpha on  -gravity center -compose Lighten  out3.png  out4.png final.png
#composite -blend 100x100 -alpha on  -gravity center -compose difference  out3.png  out4.png final.png