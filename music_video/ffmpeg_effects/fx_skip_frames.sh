#!/bin/sh

# skip frames
ffmpeg -i in1.mp4 -vf fps=fps=1.5 -an -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4