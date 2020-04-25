#!/bin/sh

# hue
ffmpeg -i in1.mp4 -vf "hue=h=90:s=6" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4