#!/bin/sh

# Kaleidoskop
ffmpeg -i in3.mp4 -vf rotate=PI/4,rotate=PI/270,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/1.2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=1320:460 -y  output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4