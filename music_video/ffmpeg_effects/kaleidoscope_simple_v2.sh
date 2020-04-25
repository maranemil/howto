#!/bin/sh

# stereo - mix left and right + flip - kaleidoscope
ffmpeg -i in1.mp4 -vf rotate=PI/2,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/1.1:0:0, vflip [flip]; [main][flip] overlay=0:H/1.1","crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=1720:1460 output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4