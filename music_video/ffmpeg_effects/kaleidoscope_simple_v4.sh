#!/bin/sh

# Kaleidoskop
ffmpeg -i in.mp4 -vf rotate=PI/4,rotate=PI/270,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/1.2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=1560:460 -y  output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4

# add on top
ffmpeg -i output.mp4  -i output.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=0:460"  -t 23 -y outV1.mp4


#ffmpeg -i in.mp4  -i in2.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 53 -y outV2.mp4

