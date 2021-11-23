#!/bin/sh

# bw filter
ffmpeg -i in1.mp4 -vf lutyuv="u=128:v=128" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4

# FFmpeg & Black and White Conversion
# https://stackoverflow.com/questions/32384057/ffmpeg-black-and-white-conversion

ffmpeg -i input.mp4 -vf format=gray output.mp4
ffmpeg -i input.mp4 -vf hue=s=0 output.mp4
ffmpeg -i input.mp4 -vf lutyuv=u=128:v=128 output.mp4