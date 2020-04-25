#!/bin/sh

fmpeg -i WS.wav  -filter_complex "[0:a]showspectrum=s=854x480:mode=combined:slide=scroll:saturation=0.2:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a  -b:v 700k -b:a 360k out_$(date +%s).mp4

ffmpeg -i WS.wav  -filter_complex "[0:a]showspectrum=s=854x480:mode=combined:slide=scroll:saturation=0.2:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a  -b:v 700k -b:a 360k out_$(date +%s).mp4

ffmpeg -y -f lavfi -i "amovie=input.wav, asplit [a][out1]; [a] showspectrum="mode=separate:s=1920x1080:color=rainbow:legend=1" [out0]" -vf "drawtext=text='input (15 sec)': start_number=1: x=(w/3): y=(h/2): fontcolor=yellow: fontsize=72" -b:v 8M -c:a ac3 -b:a 320k out_$(date +%s).mp4