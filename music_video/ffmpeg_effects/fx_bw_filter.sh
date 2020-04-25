#!/bin/sh

# bw filter
ffmpeg -i in1.mp4 -vf lutyuv="u=128:v=128" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4