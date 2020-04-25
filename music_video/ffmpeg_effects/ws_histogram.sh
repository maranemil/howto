#!/bin/sh

ffmpeg -i WS.wav -filter_complex "[0:a]ahistogram=s=hd480:slide=scroll:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a -b:a 360k out_$(date +%s).mp4