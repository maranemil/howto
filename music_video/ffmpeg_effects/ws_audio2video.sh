#!/bin/bash

#http://underpop.online.fr/f/ffmpeg/help/showcqt.htm.gz
#https://eandata.com/linux/?chap=1&cmd=ffmpeg-filters
#http://manpages.ubuntu.com/manpages/cosmic/man1/ffplay-all.1.html
#https://johnwarburton.net/blog/?p=77
#https://ffmpeg.org/ffmpeg-filters.html
#https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/index.html

#ffplay -f lavfi "amovie='http\://listen64.radionomy.com/TheDepartureLounge',asplit[a][b];[a]showcqt=fullhd=0:timeclamp=0.3:fps=30[out0]; [b]anull[out1]"

#1
ffmpeg -i in.mp4 -filter_complex "[0:a]showcqt=s=1920x1080=timeclamp=0.3,format=yuv420p,negate[v]" -map "[v]" -map 0:a -acodec copy -y  -threads 2 -y -preset fast 1out_$(date +%s).mp4

#2
ffmpeg  -i in.mp4 -filter_complex '[a]showcqt=s=1920x1080:count=4'  -threads 2 -y -preset fast 2out_$(date +%s).mp4

#3
ffmpeg  -i in.mp4 -filter_complex 'showcqt=s=1920x1080:bar_v=5:sono_v=bar_v*a_weighting(f),hue=h=910:s=9'  -threads 2 -y -preset fast 3out_$(date +%s).mp4

#4
ffmpeg  -i in.mp4 -filter_complex 'showcqt=s=1920x1080:bar_g=1:sono_g=1'  -threads 2 -y -preset fast 4out_$(date +%s).mp4

#5
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/audio_visualization/_avectorscope_draw_line_.html
ffmpeg -i in.mp4 -filter_complex "[0:a]avectorscope=s1920x10800:zoom=1.5:rc=0:gc=200:bc=0:rf=0:gf=40:bf=0,format=yuv420p[v];  [v]pad=854:480:187:0[out]"  -map "[out]" -map 0:a -b:v 700k -b:a 360k 5out_$(date +%s).mp4

#6
ffmpeg -i in.mp4 -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=Yellow@0.5|Blue@0.5:scale=sqrt[v]; [v]drawtext=text='showwaves':fontcolor=White@0.5: fontsize=30:font=Arvo:x=(w-text_w)/5:y=(h-text_h)/5[out]"  -map "[out]" -map 0:a -pix_fmt yuv420p  -b:a 360k -r:a 44100  6out_$(date +%s).mp4

#7
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/audio_visualization/_ahistogram_.html
ffmpeg -i in.wav -filter_complex "[0:a]ahistogram=s=hd1080:slide=scroll:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a -b:a 360k 7out_$(date +%s).mp4

# 8
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/audio_visualization/_showwaves_split_channels_1_mode_cline_.html
ffmpeg -i in.wav -filter_complex "[0:a]showwaves=split_channels=1:mode=cline:s=1920x1080[v]" -map '[v]' -map '0:a' -pix_fmt yuv420p  -y 8out_$(date +%s).mp4

#9
ffmpeg -i in.wav  -filter_complex "[0:a]showspectrum=s=1920x1080:mode=combined:slide=scroll:saturation=1.2:scale=log,format=yuv420p[v]"  -map "[v]" -map 0:a  -b:v 700k -b:a 360k 9out_$(date +%s).mp4

#10
ffmpeg -y -f lavfi -i "amovie=in.wav, asplit [a][out1]; [a] showspectrum="mode=separate:s=1920x1080:color=rainbow:legend=1" [out0]" -vf "drawtext=text='showspectrum': start_number=1: x=(w/3): y=(h/2): fontcolor=yellow: fontsize=72" -b:v 8M -c:a ac3 -b:a 320k 10out_$(date +%s).mp4

#11
# https://stackoverflow.com/questions/51792396/ffmpeg-fill-change-part-of-audio-waveform-color-as-per-actual-progress-with
ffmpeg -y -loop 1 -threads 0 -i cover.png -i in.wav -filter_complex "[0:v]drawbox=0:755:1920:200:gray@1:t=fill[baserect];[1:a]aformat=channel_layouts=mono,asplit[red][white];[red]showwaves=s=1920x200:rate=7:mode=cline:scale=sqrt:colors=0xff0000[red];[white]showwaves=s=1920x200:rate=7:mode=cline:scale=sqrt:colors=0xffff99[white];[red][white]blend=all_expr='if(lte(X/W,T/64),A,B)'[waveform];[baserect][waveform]overlay=0:755:format=yuv444[v]" -map "[v]" -map 1:a -preset fast -shortest -pix_fmt yuv420p -threads 2 11out_$(date +%s).mp4

#12
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/audio_visualization/_abitscope_.html
ffmpeg -y -i in.wav -filter_complex "[0:a]abitscope=s=1920x1080[v]" -map '[v]' -map '0:a'  12out_$(date +%s).mp4

#13
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/audio_visualization/acrossover_and_its_vis.html
ffmpeg -y -i in.wav -filter_complex "[0:a]asplit=2[a][as1];[as1]acrossover=split='125 500 2000 8000'[a01][a02][a03][a04][a05];[a01]showvolume,scale=1920:216[v01];[a02]showvolume,scale=1920:216[v02];[a03]showvolume,scale=1920:216[v03];[a04]showvolume,scale=1920:216[v04];[a05]showvolume,scale=1920:216[v05];[v01][v02][v03][v04][v05]vstack=5[v]" -map '[v]' -map '[a]'  13out_$(date +%s).mp4

#14
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/video_data_visualization/vidstabdetect.html
ffmpeg -y -i in.wav -filter_complex 'showcqt=s=1920x1080:bar_g=1:sono_g=1,vidstabdetect=show=2'  14out_$(date +%s).mp4


#15
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/video_data_visualization/datascope.html
ffmpeg -y -i in.wav -filter_complex "showcqt=s=1920x1080:bar_g=1:sono_g=1,datascope=s=1920x1080:mode=color2"  15out_$(date +%s).mp4



