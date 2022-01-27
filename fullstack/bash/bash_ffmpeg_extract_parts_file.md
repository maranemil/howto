# ffmpeg bash 


## extracting frames from video
```
ffmpeg -ss 00:00:26.000 -i vid.mp4 -t 00:00:03.000 -r 6 jpg2/vid_%04d.jpg
```

## make thumb img
```
ffmpeg  -itsoffset (time) -i video.avi -vcodec mjpeg -vframes 1 -an -f rawvideo -s (WIDTHxHEIGHT) thumb.jpg
for f in *.flv; do ffmpeg -y -i "$f" -f image2 -ss 10 -vframes 1 -an "${f%.flv}.jpg"; done
thumbnail() { ffmpeg -itsoffset -20 -i $i -vcodec mjpeg -vframes 1 -an -f rawvideo -s 640x272 ${i%.*}.jpg }
```
------------------------------------------------------------------------------------------------------------------------
```
for f in *.mp4; do ffmpeg -i "$f" -vcodec mjpeg -vframes 1 -an -f rawvideo -s 1280x760 "${f%.mp4}.jpg"; done
for f in *.mp4; do ffmpeg -y -i "$f" -f image2 -ss 10 -vframes 1 -an "${f%.mp4}.jpg"; done

ffmpeg  -itsoffset -20 -i vid.mp4 -vcodec mjpeg -vframes 1 -an -f rawvideo -s 640x272 thumb.jpg
```
------------------------------------------------------------------------------------------------------------------------

## Generate Thumbs 1x
```
for f in *.mp4; do ffmpeg -y -itsoffset -20 -i "$f" -vcodec mjpeg -vframes 1 -an -f rawvideo -loglevel warning -s 800x600 "${f%.mp4}.jpg"; done
```

## Timeline gen 9 thumbs
```
for f in *.mp4; do ffmpeg -y -ss 3 -i "$f" -vf "select=gt(scene\,0.4)" -frames:v 9 -vsync vfr -vf fps=fps=1/30 "${f%}out%02d.jpg"; done
```

## merge 9 thumbs
```
for f in *.mp4; do ffmpeg -y -pattern_type glob -i "$f*.jpg"  -filter_complex scale=360:-1,tile=3x3 "${f%}output.png" ; done
for f in *.png; do rm "$f"; done
```

------------------------------------------------------------------------------------------------------------------------


## Wiki:Create a thumbnail image every X seconds of the video
```
-vframes option
Output a single frame from the video into an image file:

ffmpeg -i input.flv -ss 00:00:14.435 -vframes 1 out.png
This example will seek to the position of 0h:0m:14sec:435msec and output one frame (-vframes 1) from that position into a PNG file.

fps video filter
Output one image every second, named out1.png, out2.png, out3.png, etc.

ffmpeg -i input.flv -vf fps=1 out%d.png
Output one image every minute, named img001.jpg, img002.jpg, img003.jpg, etc. The %03d dictates that the ordinal number of each output image will be formatted using 3 digits.

ffmpeg -i myvideo.avi -vf fps=1/60 img%03d.jpg
Output one image every ten minutes:

ffmpeg -i test.flv -vf fps=1/600 thumb%04d.bmp
select video filter
Output one image for every I-frame:

ffmpeg -i input.flv -vf "select='eq(pict_type,PICT_TYPE_I)'" -vsync vfr thumb%04d.png
```

---------------------------------------------------------------------------

## How to extract time-accurate video segments with ffmpeg
```
ffmpeg -i a.mp4 -force_key_frames 00:00:09,00:00:12 out.mp4
ffmpeg -ss 00:00:09 -i out.mp4 -t 00:00:03 -vcodec copy -acodec copy -y final.mp4

ffmpeg -ss 3 -i input.mp4 -vf "select=gt(scene\,0.4)" -frames:v 5 -vsync vfr -vf fps=fps=1/600 out%02d.jpg
ffmpeg -ss 120.2 -t 0.75 -i slow.mkv -c:a libopus -shortest -aspect 16:9 -preset veryslow -x264-params nr=250:ref=6 -crf 22  -movflags +faststart clip2.mkv
```

## Extract  sound
```
ffmpeg -i input-video.avi -vn -acodec copy output-audio.aac
ffmpeg -i sample.avi -q:a 0 -map a sample.mp3
ffmpeg -i sample.avi -ss 00:03:05 -t 00:00:45.0 -q:a 0 -map a sample.mp3
ffmpeg -i input.wav -codec:a libmp3lame -qscale:a 2 output.mp3
```

---------------------------------------------------------------------------
```
#!/usr/bin/env bash

## this is slow but gives better thumbnails (takes about 1+ minutes for 20 files)
#-vf thumbnail,scale=640:360 -frames:v 1 poster.png

## this is faster but thumbnails are random (takes about 8 seconds for 20 files)
#-vf scale=640:360 -frames:v 1 poster.png
cd ~/path/to/streams

find . -type f \
  -name "*.m3u8" \
  -execdir sh -c 'ffmpeg -y -i "$0" -vf scale=640:360 -frames:v 1 "poster.png"' \
  {} \;
```

---------------------------------------------------------------------------
```
timeline
ffmpeg -ss 3 -i input.mp4 -vf "select=gt(scene\,0.4)" -frames:v 5 -vsync vfr -vf fps=fps=1/60 out%02d.jpg

merge
ffmpeg -y -pattern_type glob -i "*.jpg"  -filter_complex scale=360:-1,tile=3x2 output.png
#ffmpeg -i %03d.jpg -filter_complex scale=240:-1,tile=5x1:margin=10:padding=4 output.png


https://trac.ffmpeg.org/wiki/Creating%20multiple%20outputs
http://www.cplusplus.com/reference/cstdio/printf/
```

---------------------------------------------------------------------------

```
#!/bin/sh

echo $@

#timeline gen 9 thumbs
for f in *.mp4; do ffmpeg -y -ss 3 -i "$f" -vf "select=gt(scene\,0.4)" -frames:v 9 -vsync vfr -vf fps=fps=1/30 "${f%}out%02d.jpg"; done

# merge 9 thumbs
for f in *.mp4; do ffmpeg -y -pattern_type glob -i "$f*.jpg"  -filter_complex scale=360:-1,tile=3x3 "${f%}output.png" ; done

for f in *.jpg; do rm "$f"; done
```

---------------------------------------------------------------------------

### Some useful strings:

```
$$ = The PID number of the process executing the shell.
$? = Exit status variable.
$0 = The name of the command you used to call a program.
$1 = The first argument on the command line.
$2 = The second argument on the command line.
$n = The nth argument on the command line.
$* = All the arguments on the command line.
$# The number of command line arguments.
```

https://linuxconfig.org/how-do-i-print-all-arguments-submitted-on-a-command-line-from-a-bash-script

```
#/bin/bash
 for i in $*; do
   echo $i
 done

 #!/bin/bash

while (( "$#" )); do
  echo $1
  shift
done
```


---------------------------------------------------------------------------

```
https://www.lifewire.com/pass-arguments-to-bash-script-2200571

while getopts u:d:p:f: option
do
 case "${option}"
 in
 u) USER=${OPTARG};;
 d) DATE=${OPTARG};;
 p) PRODUCT=${OPTARG};;
 f) FORMAT=$OPTARG;;
 esac
done
```

---------------------------------------------------------------------------

```
https://ryanstutorials.net/bash-scripting-tutorial/bash-if-statements.php
https://wiki.ubuntuusers.de/Shell/Bash-Skripting-Guide_für_Anfänger/
https://ss64.com/bash/echo.html
http://www.tldp.org/LDP/abs/html/comparison-ops.html

Operator	Description
! EXPRESSION	The EXPRESSION is false.
-n STRING	The length of STRING is greater than zero.
-z STRING	The lengh of STRING is zero (ie it is empty).
STRING1 = STRING2	STRING1 is equal to STRING2
STRING1 != STRING2	STRING1 is not equal to STRING2
INTEGER1 -eq INTEGER2	INTEGER1 is numerically equal to INTEGER2
INTEGER1 -gt INTEGER2	INTEGER1 is numerically greater than INTEGER2
INTEGER1 -lt INTEGER2	INTEGER1 is numerically less than INTEGER2
-d FILE	FILE exists and is a directory.
-e FILE	FILE exists.
-r FILE	FILE exists and the read permission is granted.
-s FILE	FILE exists and it's size is greater than zero (ie. it is not empty).
-w FILE	FILE exists and the write permission is granted.
-x FILE	FILE exists and the execute permission is granted.
```

---------------------------------------------------------------------------

```
# Reset
Color_Off='\033[0m'       # Text Reset

# Regular Colors
Black='\033[0;30m'        # Black
Red='\033[0;31m'          # Red
Green='\033[0;32m'        # Green
Yellow='\033[0;33m'       # Yellow
Blue='\033[0;34m'         # Blue
Purple='\033[0;35m'       # Purple
Cyan='\033[0;36m'         # Cyan
White='\033[0;37m'        # White

# Bold
BBlack='\033[1;30m'       # Black
BRed='\033[1;31m'         # Red
BGreen='\033[1;32m'       # Green
BYellow='\033[1;33m'      # Yellow
BBlue='\033[1;34m'        # Blue
BPurple='\033[1;35m'      # Purple
BCyan='\033[1;36m'        # Cyan
BWhite='\033[1;37m'       # White

# Underline
UBlack='\033[4;30m'       # Black
URed='\033[4;31m'         # Red
UGreen='\033[4;32m'       # Green
UYellow='\033[4;33m'      # Yellow
UBlue='\033[4;34m'        # Blue
UPurple='\033[4;35m'      # Purple
UCyan='\033[4;36m'        # Cyan
UWhite='\033[4;37m'       # White

# Background
On_Black='\033[40m'       # Black
On_Red='\033[41m'         # Red
On_Green='\033[42m'       # Green
On_Yellow='\033[43m'      # Yellow
On_Blue='\033[44m'        # Blue
On_Purple='\033[45m'      # Purple
On_Cyan='\033[46m'        # Cyan
On_White='\033[47m'       # White

# High Intensity
IBlack='\033[0;90m'       # Black
IRed='\033[0;91m'         # Red
IGreen='\033[0;92m'       # Green
IYellow='\033[0;93m'      # Yellow
IBlue='\033[0;94m'        # Blue
IPurple='\033[0;95m'      # Purple
ICyan='\033[0;96m'        # Cyan
IWhite='\033[0;97m'       # White

# Bold High Intensity
BIBlack='\033[1;90m'      # Black
BIRed='\033[1;91m'        # Red
BIGreen='\033[1;92m'      # Green
BIYellow='\033[1;93m'     # Yellow
BIBlue='\033[1;94m'       # Blue
BIPurple='\033[1;95m'     # Purple
BICyan='\033[1;96m'       # Cyan
BIWhite='\033[1;97m'      # White

# High Intensity backgrounds
On_IBlack='\033[0;100m'   # Black
On_IRed='\033[0;101m'     # Red
On_IGreen='\033[0;102m'   # Green
On_IYellow='\033[0;103m'  # Yellow
On_IBlue='\033[0;104m'    # Blue
On_IPurple='\033[0;105m'  # Purple
On_ICyan='\033[0;106m'    # Cyan
On_IWhite='\033[0;107m'   # White
```





### ultra compression ffmpeg

```

ffmpeg -i u.mkv -s hd480 -crf 24 -strict -2 -b 100000 -preset ultrafast -y u_480.mp4

https://trac.ffmpeg.org/wiki/AudioVolume

ffmpeg -i 1.mkv -crf 18 -strict -2 -preset ultrafast test.mp4
ffmpeg -i 1.mkv -vf scale=-1:720 -c:v libx264 -crf 18 -strict -2 -preset ultrafast test2.mp4
ffmpeg -i 1.mkv -crf 18 -strict -2 -preset ultrafast test.mp4
ffmpeg -i 1.mkv -vf scale=-1:720 -crf 18 -strict -2 -b 1000000 -preset ultrafast test2.mp4
https://de.wikipedia.org/wiki/Videoauflösung

ffmpeg -i 1.mkv -crf 18 -strict -2 -preset ultrafast test.mp4
ffmpeg -i 1.mkv -vf scale=-1:720 -crf 18 -strict -2 -b 1000000 -preset ultrafast test2.mp4

ffmpeg -i input.mp4 -s hd480 -c:v libx264 -crf 23 -c:a aac -strict -2 output.mp4
ffmpeg -i 01.mkv -s hd360 -c:v libx264 -crf 23 -c:a aac -strict -2 01.mkv
ffmpeg -i input.avi -filter:v scale=720:-1 -c:a copy output.mkv
http://www.bugcodemaster.com/article/changing-resolution-video-using-ffmpeg
ffmpeg -i video_1920.mp4 -vf scale=640:480,setdar=4:3 video_640x480.mp4 -hide_banner


ffmpeg -i input -vf scale=-1:480 -vcodec mpeg4 -qscale 3 output.mp4
ffmpeg -i input -vf scale=-1:360 -vcodec mpeg4 -qscale 3 output.mp4
ffmpeg -i input -vf scale=-1:260 -vcodec mpeg4 -qscale 3 output.mp4
avconv -i input.vob -s hd480 output.vob
ffmpeg -i in.mp4 -vf scale=720:480 out.mp4
ffmpeg -i in.mp4 -vf scale=720:-2 out.mp4
ffmpeg -i in.mp4 -filter:v "crop=in_w:480" out.mp4
ffmpeg -i <input_file> -vcodec libx264 -vf scale=852:480 -aspect 16:9  -r 60000/1001 -preset slow -crf 18 <output_file>
ffmpeg -i input.mp4 -vf "scale=640:480,transpose=1" output.mp4

ffmpeg -i SomeInput.mp4 -vf "crop=in_h*9/16:in_h,scale=-2:400" -t 4 SomeOutput.mp4
ffmpeg -i input.file -vf "scale=(iw*sar)*max(720/(iw*sar)\,480/ih):ih*max(720/(iw*sar)\,480/ih), crop=720:480" -c:v mpeg4 -vtag XVID -q:v 4 -c:a libmp3lame -q:a 4 output.avi

for i in *.mp4;
do
    ffmpeg -y -i "$i" << TODO >> "${i%.mp4}_shrink.mp4";
done

```