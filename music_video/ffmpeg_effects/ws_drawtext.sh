#!/bin/sh

ffmpeg -i WS.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=Yellow@0.5|Blue@0.5:scale=sqrt[v]; [v]drawtext=text='Hello World':fontcolor=White@0.5: fontsize=30:font=Arvo:x=(w-text_w)/5:y=(h-text_h)/5[out]"  -map "[out]" -map 0:a -pix_fmt yuv420p  -b:a 360k -r:a 44100  out_$(date +%s).mp4