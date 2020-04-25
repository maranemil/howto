#!/bin/sh

# scale h/2 = 540 from 1080
ffmpeg -i in1.mp4 -vf scale=-1:540 -y in1A.mp4

# mix with overlay 1920x1080 with 960x540
ffmpeg -i in2.mp4  -i in1A.mp4 -filter_complex "[0:0][1:0]overlay[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264 -crf 18 -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5  output2.mp4