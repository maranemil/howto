#!/bin/sh

# instagram vintage color fx
ffmpeg -i in1.mp4 -vf "curves=vintage" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4