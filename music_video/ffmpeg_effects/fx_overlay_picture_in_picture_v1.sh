#!/bin/sh


ffmpeg -i in1.mp4  -i in2.mp4 -filter_complex "[0:0][1:0]overlay[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264 -crf 18  output.mp4

ffmpeg -i out360.mp4 -i out180.mp4 -filter_complex "[1:v]setpts=PTS+0.1/TB[a]; [0:v][a]overlay=enable=gte(t\,0.1):shortest=1[out]" -map [out]  -c:v libx264 -crf 18 -pix_fmt yuv420p -t 20 -c:a copy -y output3.mp4