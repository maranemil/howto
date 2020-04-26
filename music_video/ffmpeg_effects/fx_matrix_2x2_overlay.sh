#!/bin/sh

ffmpeg -i video1.mp4 -vf "curves=preset=lighter,eq=1:0:2.1:1:1:1.1:1:1" -crf 20  -y video1A.mp4
ffmpeg -i video2.mp4 -vf "curves=preset=lighter,eq=1:0:2.1:1:1:1.1:1:1" -crf 20  -y video2A.mp4
ffmpeg -i video3.mp4 -vf "curves=preset=lighter,eq=1:0:2.1:1:1:1.1:1:1" -crf 20  -y video3A.mp4
ffmpeg -i video4.mp4 -vf "curves=preset=lighter,eq=1:0:2.1:1:1:1.1:1:1" -crf 20  -y video4A.mp4

# mix horizontally x2
ffmpeg -i video1A.mp4  -i video1B.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 53 -y outA.mp4
ffmpeg -i video1C.mp4  -i video1D.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 53 -y outB.mp4

# scale down optional
ffmpeg -i outA.mp4 -vf scale=-1:540 -y outA1.mp4
ffmpeg -i outB.mp4 -vf scale=-1:540 -y outB1.mp4

# mix vertically
ffmpeg -i outA1.mp4  -i outB1.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=0:540"  -t 20 -y outC.mp4