#!/bin/sh

#  invert
ffplay -i GOPR0186cr.mp4 -vf "split [main][tmp]; [tmp] lutrgb="r=negval:g=negval:b=negval" [tmp2]; [main][tmp2] overlay"

#  saturation
ffplay -i input.jpg -vf "eq=contrast=1.5:brightness=-0.05:saturation=0.75"

#  speed up 4x
ffmpeg -i output.mp4 -r 16 -filter:v "setpts=0.25*PTS" -strict -2 -preset ultrafast output2.mp4

# paulstretch audio

# ffmpeg mirror
ffplay -i GOPR0186cr.mp4 -vf "split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2"