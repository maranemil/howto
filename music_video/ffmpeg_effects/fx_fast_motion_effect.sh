#!/bin/sh

# fast motion 4x or 8x
ffmpeg -i in1.mp4 -filter:v "setpts=0.25*PTS" -y output.mp4
ffmpeg -i in1.mp4 -filter:v "setpts=0.5*PTS" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4