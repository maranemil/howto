#!/bin/sh

# flip horizontaly
ffmpeg -i in1.mp4 -vf "hflip" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4