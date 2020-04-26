#!/bin/sh

# add saturation
ffmpeg -loglevel quiet -stats -i video1.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1A.mp4
ffmpeg -loglevel quiet -stats -i video2.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1B.mp4
ffmpeg -loglevel quiet -stats -i video3.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1C.mp4
ffmpeg -loglevel quiet -stats -i video4.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1D.mp4
ffmpeg -loglevel quiet -stats -i video5.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1E.mp4
ffmpeg -loglevel quiet -stats -i video6.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1F.mp4
ffmpeg -loglevel quiet -stats -i video7.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1G.mp4
ffmpeg -loglevel quiet -stats -i video8.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1H.mp4
ffmpeg -loglevel quiet -stats -i video9.mp4 -vf "scale=960:540" -crf 18 -threads 6 -y -t 15 video1I.mp4


sleep 1

# mix horizontally x2
ffmpeg -i video1A.mp4  -i video1B.mp4  -i video1C.mp4 -filter_complex "[0]pad=iw*3:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960" -y outA.mp4
ffmpeg -i video1D.mp4  -i video1E.mp4  -i video1F.mp4 -filter_complex "[0]pad=iw*3:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960" -y outB.mp4
ffmpeg -i video1G.mp4  -i video1H.mp4  -i video1I.mp4 -filter_complex "[0]pad=iw*3:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960" -y outC.mp4
sleep 1

# scale down
ffmpeg -loglevel quiet -stats -i outA.mp4 -vf scale=-1:540 -y -threads 6 outA1.mp4
ffmpeg -loglevel quiet -stats -i outB.mp4 -vf scale=-1:540 -y -threads 6 outB1.mp4
ffmpeg -loglevel quiet -stats -i outC.mp4 -vf scale=-1:540 -y -threads 6 outC1.mp4
sleep 1

# mix vertically
ffmpeg -i outA1.mp4  -i outB1.mp4 -i outC1.mp4  -filter_complex "[0]pad=iw:ih*3[bg];[bg][1]overlay=0:540[bg2];[bg2][2]overlay=0:1080"  -y outC.mp4

# add slow motion
ffmpeg -loglevel quiet -stats -i outC.mp4 -filter:v "setpts=2.0*PTS" -threads 6 outD.mp4

# add saturation again ?
ffmpeg -loglevel quiet -stats -i outD.mp4 -vf eq=saturation=1.5 -y outE.mp4

# options for log level
# -loglevel quiet -stats
# -hide_banner -loglevel panic

# ffplobe -i outE.mp4 ->  3072x1620