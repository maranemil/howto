#!/bin/sh

#-----------------------------------------------------------
# add showwaves + cover v2
#-----------------------------------------------------------

# freq spectrum
ffmpeg -i in.wav -filter_complex "[0:a]showfreqs=s=1920x1080:mode=bar:ascale=sqrt:fscale=log:win_size=512:colors=FFFFFF[v]" -map "[v]" -map 0:a  -r:a 44100 -crf 14 -y out.mp4

# hflip
ffmpeg -i out.mp4 -vf hflip -crf 24 -an out1.mp4

# mirror
ffmpeg -i out1.mp4 -vf "crop=iw/2:ih:0:0,split[right][tmp];[tmp]hflip[left];[left][right] hstack" out2.mp4

# add cover
ffmpeg -i out2.mp4 -i input.png -filter_complex "[0]colorkey=color=black,crop=1920:1080,scale=1920:1080,pad=iw*20:ih:0:0[keyed];[1][keyed]overlay=y=8" -crf 24 -preset ultrafast out3.mp4

# fisheye
ffmpeg -i out3.mp4 -vf "lenscorrection=cx=0.5:cy=0.5:k1=-0.198:k2=-0.5" -an out4.mp4

# mix
ffmpeg -i out4.mp4 -i in.wav -c:v copy -c:a aac out5.mp4

# mix replace audio
ffmpeg -i video.mp4 -i audio.wav -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 output.mp4