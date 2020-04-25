#!/bin/sh

ffmpeg -i input.mp4  -vf eq=1:0:1.9:1:1:0.9:1:1 -c:v libx264 -strict -2 -threads 2 -preset ultrafast -filter:v "setpts=0.25*PTS" output.mp4 -y