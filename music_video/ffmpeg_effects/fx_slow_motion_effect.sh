#!/bin/sh

# slow motion 4x or 8x
ffmpeg -i in1.mp4 -filter:v "setpts=4.0*PTS" output.mp4
ffmpeg -i in1.mp4 -filter:v "setpts=2.0*PTS" output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4