#!/bin/sh

# saturation
ffmpeg -i input.mp4  -vf eq=1:0:1.9:1:1:0.9:1:1 -c:v libx264 -strict -2 -threads 2 -preset ultrafast -filter:v "setpts=0.25*PTS" output.mp4 -y

# saturation
ffmpeg -i in.mp4 -vf "eq=contrast=1.5:brightness=.15:saturation=1.5" out.mp4

# overlay mix saturation
# ffmpeg -i in.mp4 -i in.mp4 -filter_complex "[0:v]setsar=sar=1[v];[v][1]blend=all_mode='overlay':all_opacity=0.7" -movflags +faststart out.mp4