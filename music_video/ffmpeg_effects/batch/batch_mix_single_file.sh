#!/bin/sh

FILE="mpxvm_fumix174_ft2.xm.wav"

ffmpeg  -i $FILE -i cover.png -vf "drawtext=text='$(basename $FILE)':fontcolor=black:fontsize=72:box=1:boxcolor=black@0.15:boxborderw=5:x=(w-text_w)/2:y=(h-text_h)/1.5" -y output.mp4

ffmpeg -i output.mp4 -filter_complex "[0:a]showcqt=timeclamp=0.9,format=yuv420p[v]" -map "[v]" -map 0:a -acodec copy -y  -threads 4 showcqt.mp4

ffmpeg  -i  showcqt.mp4 -vf negate,eq=contrast=0.9:brightness=0.14:saturation=1.3,hue=h=910:s=9 -acodec copy -y -threads 4 showcqt2.mp4

ffmpeg  -i showcqt2.mp4 -i output.mp4 -filter_complex "[0:v][1:v]blend=all_mode=average:all_opacity=0.99" -max_muxing_queue_size 1024 -y -acodec copy -threads 4 outlayer1.mp4

ffmpeg  -i  outlayer1.mp4 -vf eq=contrast=1.8:brightness=-0.5:saturation=2.3 -max_muxing_queue_size 1024 -y -acodec copy -threads 4 xfinalmix.mp4

ffmpeg -i xfinalmix.mp4 -i $FILE -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 xfinalmixyoutube.mp4