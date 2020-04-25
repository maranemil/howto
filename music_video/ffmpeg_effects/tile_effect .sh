#!/bin/sh

ffmpeg -i in6.mp4 -i in6.mp4  -i in6.mp4 -filter_complex "[0]scale=-1:720,format=rgba[v1];  [1]scale=-1:360,crop=360:360[v2]; [2] crop=360:440[v3];    [v1][v2]overlay=0:H/1.7[out1];[out1][v3]overlay=0:0 [out]" -shortest -map [out]  -y -preset ultrafast output.mp4

ffmpeg -i output.mp4 -vf "eq=contrast=1.5:brightness=-0.05:saturation=1.5" -y output2.mp4