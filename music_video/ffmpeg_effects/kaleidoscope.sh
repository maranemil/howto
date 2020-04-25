#!/bin/sh

# Mirror Effect Horizontal
ffmpeg -hwaccel opencl -i in4.mp4 -vf "crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack" -crf 14 -threads 6 -t 15 -y outputH.mp4

# Mirror Effect Vertical
ffmpeg -hwaccel opencl  -i in4.mp4 -vf "split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2" -crf 14 -threads 6 -t 15 -y  outputV.mp4

# flip vertical
ffmpeg -hwaccel opencl  -i outputH.mp4 -vf "vflip" -y -threads 6 outputHFV.mp4

# flip horizontal
ffmpeg -hwaccel opencl  -i outputV.mp4 -vf "hflip" -y -threads 6 outputVFH.mp4

sleep 2
# blend overlay 4 vids
ffmpeg -hwaccel opencl  -i outputV.mp4 -i outputVFH.mp4 -filter_complex "[0:0][1:0]blend=all_mode='overlay':all_opacity=1[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264  -y -threads 6 outputB1.mp4

ffmpeg -hwaccel opencl  -i outputH.mp4 -i outputHFV.mp4 -filter_complex "[0:0][1:0]blend=all_mode='overlay':all_opacity=1[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264  -y -threads 6 outputB2.mp4

sleep 2
ffmpeg -hwaccel opencl  -i outputB1.mp4 -i outputB2.mp4 -filter_complex "[0:0][1:0]blend=all_mode='overlay':all_opacity=1[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264  -y -threads 6 outputBF.mp4

sleep 2
# add saturation
ffmpeg -hwaccel opencl  -i outputBF.mp4 -vf eq=saturation=1.5 -y -threads 6 outputBFS.mp4