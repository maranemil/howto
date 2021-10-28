#!/bin/sh

#-----------------------------------------------------------
# mix multiple files - batch
#-----------------------------------------------------------

# add vu showfreqs
for i in {001..066}; do ffmpeg -i fumix$i.wav -filter_complex "[0:a]showfreqs=s=960x540:mode=bar:ascale=sqrt:fscale=log:win_size=512:colors=FFFFFF[v]" -map "[v]" -map 0:a  -r:a 44100 -crf 14  -y fumix$i.mp4; done

# add text
for i in {001..066}; do ffmpeg -i fumix$i.mp4 -vf drawtext="text='FUMIX $i': fontcolor=white: fontsize=32: box=1: boxcolor=black@0.5: boxborderw=5: x=(w-text_w)/6: y=(h-text_h)/6" -y numix$i.mp4; done

# concat multiple files
for f in numix*; do echo "file '$f'" >> mylist.txt; done
touch mylist.txt
ffmpeg -f concat -i mylist.txt -c copy output.mp4

# merge overlay with audio down sample rate
ffmpeg -i output.mp4 -i input2.png -filter_complex "[0]colorkey=color=black,crop=960:540,scale=960:540,pad=iw*20:ih:0:0[keyed];[1][keyed]overlay=y=0[x];[x]scale=-1:540" -crf 28  -pix_fmt rgb24 -r:a 32000 -t 24  -y rout.mp4

# merge overlay
ffmpeg -i output.mp4 -i input2.png -filter_complex "[0]colorkey=color=black,crop=960:540,scale=960:540,pad=iw*20:ih:0:0[keyed];[1][keyed]overlay=y=0[x];[x]scale=-1:540" -crf 14 -t 24  -y rout.mp4

# compress audio to mp3
ffmpeg -i rout.mp4 -codec:v copy -codec:a libmp3lame -q:a 2 rout2.mp3