#!/bin/bash

#http://underpop.online.fr/f/ffmpeg/help/showcqt.htm.gz
#https://eandata.com/linux/?chap=1&cmd=ffmpeg-filters
#http://manpages.ubuntu.com/manpages/cosmic/man1/ffplay-all.1.html
#https://johnwarburton.net/blog/?p=77
#https://ffmpeg.org/ffmpeg-filters.html


#ffplay -f lavfi "amovie='http\://listen64.radionomy.com/TheDepartureLounge',asplit[a][b];[a]showcqt=fullhd=0:timeclamp=0.3:fps=30[out0]; [b]anull[out1]"

ffmpeg -f lavfi "amovie='in.wav',asplit[a][b];[a]showcqt=fullhd=0:timeclamp=0.3:fps=30[out0]; [b]anull[out1]" 1out_$(date +%s).mp4

ffmpeg -f lavfi 'amovie=in.wav, asplit [a][out1]; [a] showcqt=s=1280x720:count=4 [out0]' 2out_$(date +%s).mp4

ffmpeg -f lavfi 'aevalsrc=0.1*sin(2*PI*55*t)+0.1*sin(4*PI*55*t)+0.1*sin(6*PI*55*t)+0.1*sin(8*PI*55*t),
                 asplit[a][out1]; [a] showcqt [out0]' 3out_$(date +%s).mp4

ffmpeg -f lavfi 'aevalsrc=0.1*sin(2*PI*55*t)+0.1*sin(4*PI*55*t)+0.1*sin(6*PI*55*t)+0.1*sin(8*PI*55*t),
                 asplit[a][out1]; [a] showcqt=timeclamp=0.5 [out0]' 4out_$(date +%s).mp4

ffmpeg -f lavfi 'bar_v=10:sono_v=bar_v*a_weighting(f)' 5out_$(date +%s).mp4

ffmpeg -f lavfi 'bar_g=2:sono_g=2' 6out_$(date +%s).mp4

ffmpeg -f lavfi 'fontcolor="if(mod(floor(midi(f)+0.5),12), 0x0000FF, g(1))":font="Monospace,mono|bold"' 7out_$(date +%s).mp4

ffmpeg -f lavfi 'axisfile=myaxis.png:basefreq=40:endfreq=10000' 8out_$(date +%s).mp4

ffmpeg -i in.wav -filter_complex "[0:a]avectorscope=s=480x480:zoom=1.5:rc=0:gc=200:bc=0:rf=0:gf=40:bf=0,format=yuv420p[v];  [v]pad=854:480:187:0[out]"  -map "[out]" -map 0:a -b:v 700k -b:a 360k 9out_$(date +%s).mp4

ffmpeg -i in.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=Yellow@0.5|Blue@0.5:scale=sqrt[v]; [v]drawtext=text='Hello World':fontcolor=White@0.5: fontsize=30:font=Arvo:x=(w-text_w)/5:y=(h-text_h)/5[out]"  -map "[out]" -map 0:a -pix_fmt yuv420p  -b:a 360k -r:a 44100  10out_$(date +%s).mp4

ffmpeg -i in.wav -filter_complex "[0:a]ahistogram=s=hd480:slide=scroll:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a -b:a 360k 11out_$(date +%s).mp4

ffmpeg -i in.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=White[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100  12out_$(date +%s).mp4

fmpeg -i in.wav  -filter_complex "[0:a]showspectrum=s=854x480:mode=combined:slide=scroll:saturation=0.2:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a  -b:v 700k -b:a 360k 13out_$(date +%s).mp4

ffmpeg -i in.wav  -filter_complex "[0:a]showspectrum=s=854x480:mode=combined:slide=scroll:saturation=0.2:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a  -b:v 700k -b:a 360k 14out_$(date +%s).mp4

ffmpeg -y -f lavfi -i "amovie=in.wav, asplit [a][out1]; [a] showspectrum="mode=separate:s=1920x1080:color=rainbow:legend=1" [out0]" -vf "drawtext=text='input (15 sec)': start_number=1: x=(w/3): y=(h/2): fontcolor=yellow: fontsize=72" -b:v 8M -c:a ac3 -b:a 320k out_$(date +%s).mp4



