#!/bin/sh

# mirror fx
ffplay -i in.mp4 -vf "crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack"


#  saturation
ffplay -i input.mp4 -vf "eq=contrast=1.5:brightness=-0.05:saturation=0.75"

#  speed up
ffmpeg -i input.mkv -r 16 -filter:v "setpts=0.25*PTS" output.mkv