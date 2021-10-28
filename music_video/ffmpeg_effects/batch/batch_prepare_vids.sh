#!/bin/sh

#-----------------------------------------------------------
#prepare multiple videos for mix
#-----------------------------------------------------------

# rename
num=0; for i in *.mp4; do mv "$i" "$(printf '%04d' $num).mp4"; ((num++)); done

# scale
for i in *.mp4; do ffmpeg -i $i -vf scale=-1:1080 -an -t 10 out/"$i"_out.mp4; done

# sharp
ffmpeg -i in.mp4 -vf unsharp=3:3:1.5 -y -acodec copy out.mp4

# saturate
ffmpeg -i in.mp4 -vf eq=saturation=1.3 -y -acodec copy  out.mp4
ffmpeg -i in.mp4 -vf eq=saturation=1.3 -y -codec:a copy  out.mp4


