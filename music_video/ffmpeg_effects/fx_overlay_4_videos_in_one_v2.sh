#!/bin/sh

# add saturation
ffmpeg -i office1.mp4 -vf "scale=-1:540" -crf 20 -threads 6 -y video1A.mp4
ffmpeg -i office2.mp4 -vf "scale=-1:540" -crf 20 -threads 6 -y video1B.mp4
ffmpeg -i office3.mp4 -vf "scale=-1:540" -crf 20 -threads 6 -y video1C.mp4
ffmpeg -i office4.mp4 -vf "scale=-1:540" -crf 20 -threads 6 -y video1D.mp4
sleep 1

# mix horizontally x2
ffmpeg -i video1A.mp4  -i video1B.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 20 -y outA.mp4
ffmpeg -i video1C.mp4  -i video1D.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 20 -y outB.mp4
sleep 1

# scale down
ffmpeg -i outA.mp4 -vf scale=-1:540 -y -threads 6 outA1.mp4
ffmpeg -i outB.mp4 -vf scale=-1:540 -y -threads 6 outB1.mp4
sleep 1

# mix vertically
ffmpeg -i outA1.mp4  -i outB1.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=0:540"  -t 20 -y outC.mp4

# add slow motion
ffmpeg -i outC.mp4 -filter:v "setpts=2.0*PTS" -threads 6 outD.mp4

# add saturation again ?
ffmpeg -i outD.mp4 -vf eq=saturation=1.5 -y outE.mp4
