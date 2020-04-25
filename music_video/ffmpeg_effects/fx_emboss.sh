#!/bin/sh

# emboss fx
ffmpeg -i in1.mp4 -vf "format=gray,geq=lum_expr='(p(X,Y)+(256-p(X-4,Y-4)))/2'" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4