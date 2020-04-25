#!/bin/sh

ffmpeg -i WS.wav -filter_complex "[0:a]avectorscope=s=480x480:zoom=1.5:rc=0:gc=200:bc=0:rf=0:gf=40:bf=0,format=yuv420p[v];  [v]pad=854:480:187:0[out]"  -map "[out]" -map 0:a -b:v 700k -b:a 360k out_$(date +%s).mp4