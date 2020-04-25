#!/bin/sh

# invert colors
ffmpeg -i in1.mp4 -vf "split [main][tmp]; [tmp] lutrgb="r=negval:g=negval:b=negval" [tmp2]; [main][tmp2] overlay" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4
