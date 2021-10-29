#!/bin/sh

DIR2XM="xm"
DIR2WAV="towav"
DIR2MP4="tomp4"

if [ ! -d "$DIR2XM" ]; then
    mkdir -p "$DIR2XM"
fi

if [ ! -d "$DIR2WAV" ]; then
    mkdir -p "$DIR2WAV"
fi

if [ ! -d "$DIR2MP4" ]; then
    mkdir -p "$DIR2MP4"
fi


# https://stackoverflow.com/questions/13971113/how-to-replace-on-path-string-with-using-sed
# https://stackoverflow.com/questions/91368/checking-from-shell-script-if-a-directory-contains-files

if [ -n "$(ls -A $DIR2MP4)" ]; then
    rm $DIR2MP4/*.mp4
fi

if [ -n "$(ls -A $DIR2WAV)" ]; then
    rm $DIR2WAV/*.wav
fi

# convert files from xm to wav
for i in $DIR2XM/*.xm ; do ffmpeg  -i "$i" -ss 00:00:45 -t 25 -y $DIR2WAV/$(basename $i).wav; done


# if [ -f $FILE ]; then
#   echo "File does not exist! Bye!"
#   exit
# fi

# -codec:a copy

#exit

# https://wallpapercave.com/retro-1920x1080-wallpapers
for f in $DIR2WAV/*.wav ; do ffmpeg  -i "$f" -i cover.png  -af 'afade=in:st=0:d=5,afade=out:st=20:d=5'  -vf "drawtext=text='$(basename $f)':fontcolor=black:fontsize=72:box=1:boxcolor=black@0.15:boxborderw=5:x=(w-text_w)/2:y=(h-text_h)/1.5" -y $DIR2MP4/$(basename $f).mp4; done

#exit

###################################
# concat multiple files
###################################

rm mylist.txt
touch mylist.txt
for f in $DIR2MP4/*.mp4; do echo "file $f" >> mylist.txt; done
ffmpeg -f concat -i mylist.txt -c copy -y output.mp4

# ls * | perl -ne 'print "file $_"' | ffmpeg -f concat -i - -c copy merged.mp4 ?

###################################
#   spectrogram
###################################
# https://gist.github.com/liangfu/97f877e311210fa0ae18a31fdd92982e
# https://gist.github.com/seyoum/4455e9bed74241bfbd640a8083fd38b3
# https://scribbleghost.net/2018/10/26/convert-audio-to-visualization-video/

# ffmpeg -i output.mp4 -filter_complex "[0:a]avectorscope=s=1920x1080,format=yuv420p[v]" -map "[v]" -map 0:a -y -t 10 output2.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]showcqt=s=1920x1080,format=yuv420p[v]" -map "[v]" -map 0:a  -y -t 10 output3.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]ahistogram=s=1920x1080,format=yuv420p[v]" -map "[v]" -map 0:a -y -t 10 output4.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]aphasemeter=s=1920x1080:mpc=cyan,format=yuv420p[v]" -map "[v]" -map 0:a -y -t 10 output5.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]showfreqs=s=1920x1080:mode=line:fscale=log,format=yuv420p[v]" -map "[v]" -map 0:a  -y -t 10 output6.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]showspectrum=s=1920x1080,format=yuv420p[v]" -map "[v]" -map 0:a   -y -t 10 output7.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]showwaves=s=1920x1080:mode=line:rate=25,format=yuv420p[v]" -map "[v]" -map 0:a  -y -t 10 output8.mp4
# ffmpeg -i output.mp4 -filter_complex "[0:a]showvolume=f=0.5:c=VOLUME:b=4:w=1920:h=900,format=yuv420p[v]" -map "[v]" -map 0:a   -y -t 10 output9.mp4

#ffmpeg -i output.mp4 -filter_complex "[0:a]showcqt=s=1920x1080,format=yuv420p[v]" -map "[v]" -map 0:a  -y -t 10 showcqt.mp4
ffmpeg -i output.mp4 -filter_complex "[0:a]showcqt=timeclamp=0.9,format=yuv420p[v]" -map "[v]" -map 0:a -acodec copy -y  -threads 4 showcqt.mp4
ffmpeg  -i  showcqt.mp4 -vf negate,eq=contrast=0.6:brightness=0.24:saturation=0.3 -acodec copy -y -threads 4 showcqt2.mp4

###################################
# overlay
###################################
# https://video.stackexchange.com/questions/12105/add-an-image-overlay-in-front-of-video-using-ffmpeg
# https://stackoverflow.com/questions/49686244/ffmpeg-too-many-packets-buffered-for-output-stream-01
# https://stackoverflow.com/questions/33279760/ffmpeg-overlay-video-with-semi-transparent-video
# overlay -max_muxing_queue_size 1024

#ffmpeg  -i showcqt.mp4 -i output.mp4 -filter_complex "[0:v][1:v] overlay=25:25:enable='between(t,0,20)'" -max_muxing_queue_size 1024  -y  -t 10  outlayer1.mp4
#ffmpeg  -i output.mp4 -i showcqt.mp4 -filter_complex "[0:v][1:v]blend=all_mode='overlay':all_opacity=0.58'" -max_muxing_queue_size 1024  -y  -t 10  outlayer1.mp4


ffmpeg  -i showcqt2.mp4 -i output.mp4 -filter_complex "[0:v][1:v]blend=all_mode=average:all_opacity=0.99" -max_muxing_queue_size 1024 -y -acodec copy -threads 4 outlayer1.mp4


# https://superuser.com/questions/1336315/invert-colors-of-a-video-using-ffmpeg/1336361
# https://superuser.com/questions/928151/ffmpeg-eq-filter-complex-contrast

#ffmpeg  -i  outlayer1.mp4 -vf negate,eq=contrast=1.4:brightness=0:saturation=1.7 -max_muxing_queue_size 1024  -y outlayer2.mp4
#ffmpeg  -i  outlayer1.mp4 -vf eq=contrast=1.8:brightness=-0.4:saturation=1.1 -max_muxing_queue_size 1024  -y outlayer2.mp4
ffmpeg  -i  outlayer1.mp4 -vf eq=contrast=1.8:brightness=-0.5:saturation=2.3 -max_muxing_queue_size 1024 -y -acodec copy -threads 4 xfinalmix.mp4

# replace audio in mp4
# ffmpeg -i xfinalmix.mp4 -i xfinalmixwav.wav -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 xfinalmixyoutube.mp4