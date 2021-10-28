#!/bin/sh

#-----------------------------------------------------------
#   add showwaves + cover
#-----------------------------------------------------------

ffmpeg -i in.wav -filter_complex "[0:a]showwaves=mode=line:s=hd1080:colors=yellow[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100 in.mp4

ffmpeg -i in.mp4 -i input.png -filter_complex "[0]colorkey=color=black,crop=1920:400,scale=1920:100,pad=iw*200:ih:0:0[keyed];[1][keyed]overlay=y=770" -acodec copy out_$(date +%s).mp4
