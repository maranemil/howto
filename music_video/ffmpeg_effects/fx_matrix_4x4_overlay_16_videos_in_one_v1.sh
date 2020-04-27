#!/bin/sh

# resize
ffmpeg -loglevel quiet -stats -i video01.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1A.mp4
ffmpeg -loglevel quiet -stats -i video02.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1B.mp4
ffmpeg -loglevel quiet -stats -i video03.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1C.mp4
ffmpeg -loglevel quiet -stats -i video04.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1D.mp4
ffmpeg -loglevel quiet -stats -i video05.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1E.mp4
ffmpeg -loglevel quiet -stats -i video06.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1F.mp4
ffmpeg -loglevel quiet -stats -i video07.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1G.mp4
ffmpeg -loglevel quiet -stats -i video08.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1H.mp4
ffmpeg -loglevel quiet -stats -i video09.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1I.mp4
ffmpeg -loglevel quiet -stats -i video10.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1J.mp4
ffmpeg -loglevel quiet -stats -i video11.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1K.mp4
ffmpeg -loglevel quiet -stats -i video12.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1L.mp4
ffmpeg -loglevel quiet -stats -i video13.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1M.mp4
ffmpeg -loglevel quiet -stats -i video14.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1N.mp4
ffmpeg -loglevel quiet -stats -i video15.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1O.mp4
ffmpeg -loglevel quiet -stats -i video16.mp4 -vf "scale=960:540" -crf 20 -threads 6 -t 15 -y video1P.mp4

# exit
sleep 1

# mix horizontally x2
ffmpeg -i video1A.mp4  -i video1B.mp4  -i video1C.mp4 -i video1D.mp4    -filter_complex "[0]pad=iw*4:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960[bg3];[bg3][3]overlay=w+1920" -y outA.mp4
ffmpeg -i video1E.mp4  -i video1F.mp4  -i video1G.mp4 -i video1H.mp4    -filter_complex "[0]pad=iw*4:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960[bg3];[bg3][3]overlay=w+1920" -y outB.mp4
ffmpeg -i video1I.mp4  -i video1J.mp4  -i video1K.mp4 -i video1L.mp4    -filter_complex "[0]pad=iw*4:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960[bg3];[bg3][3]overlay=w+1920" -y outC.mp4
ffmpeg -i video1M.mp4  -i video1N.mp4  -i video1O.mp4 -i video1P.mp4    -filter_complex "[0]pad=iw*4:540[bg1];[bg1][1]overlay=w[bg2];[bg2][2]overlay=w+960[bg3];[bg3][3]overlay=w+1920" -y outD.mp4
sleep 1

# scale down
ffmpeg -loglevel quiet -stats -i outA.mp4 -vf scale=-1:540 -y -threads 6 outA1.mp4
ffmpeg -loglevel quiet -stats -i outB.mp4 -vf scale=-1:540 -y -threads 6 outB1.mp4
ffmpeg -loglevel quiet -stats -i outC.mp4 -vf scale=-1:540 -y -threads 6 outC1.mp4
ffmpeg -loglevel quiet -stats -i outD.mp4 -vf scale=-1:540 -y -threads 6 outD1.mp4
sleep 1

# mix vertically
ffmpeg -i outA1.mp4  -i outB1.mp4 -i outC1.mp4 -i outD1.mp4 -filter_complex "[0]pad=iw:ih*4[bg];[bg][1]overlay=0:540[bg2];[bg2][2]overlay=0:1080[bg3];[bg3][3]overlay=0:1620"  -y outK.mp4

# add slow motion
ffmpeg -loglevel quiet -stats -i outK.mp4 -filter:v "setpts=2.0*PTS" -threads 6 -y outM.mp4

# add saturation
ffmpeg -loglevel quiet -stats -i outD.mp4 -vf eq=saturation=1.5 -y outN.mp4