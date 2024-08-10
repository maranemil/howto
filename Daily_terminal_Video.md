## [ Daily CMDs Video ] 

## [ Audio Video ]

### ALSA diagbose
```
* sudo apt install pavucontrol -y
* sudo apt install pulseeffects -y
* pavucontrol
* alsamixer
* arecord -L
* arecord -l
```

### Push volume up +4dB
```
* ffmpeg -i input.wav -af "volume=4dB" -c:v copy -y  out.wav
* ffmpeg -i input.mp4 -af "volume=4dB" -vf "crop=1080:1080:570:450,eq=saturation=1.9" -y out.mp4
```

### replace audio in mp4
```
* ffmpeg -i input.mp4 -i input.wav -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 out.mp4
```

### Split audio file in 1 sec pieces FFMPEG
```
* ffmpeg -i in.wav -map 0 -f segment -segment_time 1 -af "volume=6dB,equalizer=f=40:width_type=o:width=2:g=-7,areverse" -y dir/out%03d.wav
```

### Cut Video
```
* ffmpeg -i movie.mp4 -ss 00:00:03 -t 00:00:08 -async 1 cut.mp4
```

### Record Screen Ubuntu
```
* ffmpeg -v warning -an -video_size 1366x768 -framerate 5 -f x11grab -i :0.0 myvid_$(date +%s).mp4*
* ffmpeg -v warning -video_size 1920x1080 -framerate 5 -f x11grab -i :0.0  myvid_$(date +%s).mov
* ffmpeg -f x11grab  -follow_mouse centered -show_region 1 -framerate 5 -video_size 4cif -i :0.0 xmvid_$(date +%s).mov
```

### Loop Repeat video 3x
```
ffmpeg -stream_loop 3 -i input.mp4 -c copy output.mp4
```

### Concat Merge Join videos
```
for i in ai_cvid2*.mp4; do echo file $i >> mylist.txt; done  && ffmpeg -f concat -safe 0 -i mylist.txt -c copy output.mp4
```

### Record Screen Ubuntu every X minutes
```
* ffmpeg -v warning -video_size 1920x1080 -framerate 1 -f x11grab -i :1.0 -f segment -segment_time 60 out%03d.mp4
* ffmpeg -v warning -video_size 1920x1080 -framerate 1 -f x11grab -i :1.0 myvid_$(date +%s).mp4
* timeout 10s ffmpeg -f x11grab  -y -r 1  -video_size 1920x1080 -i :1.0 -vf format=gray -pix_fmt yuv420p myfile.mp4
```

### check x11grab source
```
* echo $DISPLAY
* :1
```

### set x11grab source
```
* export DISPLAY=:0.0
* export DISPLAY=localhost:0.0
* firefox &
```

### Record Screen Ubuntu with Sound Lenovo
```
ideapad3
* ffmpeg -v warning -video_size 1920x1080 -framerate 30 -f x11grab -i :1.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4
* ffmpeg -v warning -video_size 1920x1080 -framerate 25 -f x11grab -i :1.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4

ideapad5
* ffmpeg -v warning -video_size 2560x1600 -framerate 25 -f x11grab -i :0.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4
* ffmpeg -v warning -video_size 1920x1080 -framerate 30 -f x11grab -i :1.0 -f alsa -ac 2 -ar 44100 -i default   myvid_$(date +%s).mp4
* ffmpeg -f alsa -ac 2 -i pulse -f x11grab -r 30 -s 1366x768 -i :0.0 -acodec aac -vcodec libx264 -preset ultrafast -strict -2 -crf 0 -threads 0 -y myvid_$(date +%s).mp4

.
.
.

# grab screen without specifying size
ffmpeg -v warning -framerate 25 -f x11grab -i :0.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4

.
.
.

# capture 2th screen monitor
ffmpeg -v warning -video_size 1920x1080 -framerate 30 -f x11grab -i :1.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4

# crop
ffmpeg -i in.mp4 -vf crop=1800:900 -c:a copy out.mp4 
```

### Compress 2x

```
# compress with x265 
ffmpeg -i in.mp4 -c:v libx265 -c:a copy -x265-params pools=2 out2.mp4

# compress with h264 mp3
ffmpeg -i in.mp4 -vcodec h264 -acodec mp3 -b:a 64k  out.mp4

6x speed ultrafast
2x speed veryfast
for i in *.*; do ffmpeg -i $i -vf eq=saturation=0.7 -vcodec h264 -b:v 8000k -acodec mp3 -b:a 96k -threads 2 -preset veryfast -tune zerolatency $i.out.mp4; done


Linux GPU -  H.265 alias HEVC RADEON 6x
ffmpeg -hwaccel vaapi -hwaccel_output_format vaapi -i in.mp4 -vf 'format=vaapi,hwupload' -c:v hevc_vaapi -qp 32 output.mp4

```


### Record Screen Ubuntu with Sound and Mic
~~~
# no echo - OK *** screen + mic + audio
ffmpeg -video_size 1920x1080 -framerate 25 -f x11grab -i :0.0  \
    -f pulse -i alsa_input.pci-0000_00_1f.3.analog-stereo \
    -f pulse -i alsa_output.pci-0000_00_1f.3.analog-stereo.monitor \
     -filter_complex "[0:v:0]scale=-2:620[vout]" -map "[vout]" -map 0:0 -map 1:0 -strict -2 -y screen_$(date +%s).mp4


# sudo apt install pulseaudio-utils
~~~

### Record Screen + Webcam Ubuntu with Mic
~~~
ffmpeg  \
   -video_size 1920x1080 -framerate 25 -f x11grab -i :0.0 -f alsa -ac 1 -i default \
   -f v4l2 -framerate 25 -video_size 480x270 -i /dev/video0 -f alsa -ac 1 -i hw:CARD=Generic_1,DEV=0  -c:v libx264 -b:v 1600k -preset ultrafast  -x264opts keyint=50 -g 25 -pix_fmt yuv420p  -c:a aac -b:a 128k \
    -filter_complex "[2]scale=160:90[inner];[0][inner]overlay=main_w-overlay_w-10:main_h-overlay_h-10[out]" -map "[out]" -map 3:a \
               -y omyvid_$(date +%s).mp4

~~~






### Record Screen Ubuntu with Sound ASUS
```
* ffmpeg -v warning -video_size 1366x768 -framerate 30 -f x11grab -i :0.0 -f alsa -ac 2 -ar 44100 -i default -probesize 42M -preset ultrafast -pix_fmt yuv420p -vcodec libx264 myvid_$(date +%s).mp4
```

### Record Screen Ubuntu Dell capture
```
ffmpeg -v warning -video_size 1920x1080 -framerate 5 -f x11grab -i :1.0  myvid_$(date +%s).mp4
```

### Copy Audio and compress video
```
# https://superuser.com/questions/525928/ffmpeg-keeping-quality-during-conversion

* ffmpeg -i file.mp4 -crf 18 -acodec copy file_compressed.mp4 
* ffmpeg -i test.avi -c:v libx264 -crf 40 -c:a aac -strict -2 test.mp4
```

### Create Test Video
```
* ffmpeg -y -f lavfi -i testsrc=duration=5:size=1920x1080:rate=30 testsrc.mp4
```

### Create showspectrum + text from audio file
```
* ffmpeg -y -f lavfi -i "amovie=input.wav, asplit [a][out1]; [a] showspectrum="mode=separate:s=1920x1080:color=rainbow:legend=1" [out0]" -vf "drawtext=text='input (15 sec)': start_number=1: x=(w/3): y=(h/2): fontcolor=yellow: fontsize=72" -b:v 8M -c:a ac3 -b:a 320k out_$(date +%s).mp4
```

### Create wave + text from audio file
```
* ffmpeg -i INPUT.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=White[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100  OUTPUT.mp4
```

### Create wave + text from audio file
```
* ffmpeg -i INPUT.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=Yellow@0.5|Blue@0.5:scale=sqrt[v];[v]drawtext=text='Rudi Rudi - Still Standing':fontcolor=White@0.5:fontsize=30:font=Arvo:x=(w-text_w)/5:y=(h-text_h)/5[out]"  -map "[out]" -map 0:a -pix_fmt yuv420p  -b:a 360k -r:a 44100  OUTPUT.mp4
```

### invert
```
* ffmpeg -i input.mp4 -vf lutrgb="r=negval:g=negval:b=negval" output3.avi
```


### rotate 90
```
ffmpeg -i in.mp4 -vf "transpose=2" -t 10 out.mp4
```

### crop square
```
* ffplay -i in.mp4 -vf "crop=in_h/1:in_h/1"
* ffplay -i in.mp4 -vf "crop=820:640:570:350" 
* ffplay -i in.mp4 -vf "crop=1080:1080:570:450,eq=saturation=1.9"
```

### speed up
```
ffplay -i in.mp4 -vf "setpts=1/4*PTS"
```

### resize
```
* ffmpeg -i in.mp4 -vf scale=-1:1080 -an out.mp4 
* ffplay -i in -vf scale=-2:540 -c:a copy
```

### Ubuntu crop screen 
```
* ffplay -i in.mp4 -vf "crop=1870:1040:1920:1080" -crf 20
```

### Cut everything after 3 minutes
```
ffmpeg -i in.mp4 -t 180 -c copy output.mp4
```

### thumbnail
```
ffmpeg -i vid.mp4 -vf thumbnail -frames:v 1 out.png
```

### Cut last 3 minutes
```
* echo dur=$(ffprobe -i in.mp4 -show_entries format=duration -v quiet -of csv="p=0")
* echo $((2356 - 180))
* ffmpeg -t 2176 -i input.mp4 output.mp4
```

### merge 4 videos in one - 2 by row with overlay
```
* repeat 2x to merge horizontally 800x600 * 2 = 1600x600
* ffmpeg -i in.mp4  -i in2.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bf]; [bf][1:v:0]overlay=w" -t 53 -y out.mp4
* merge vertically - 1600x1200
* ffmpeg -i in.mp4  -i in2.mp4  -filter_complex "[0]pad=iw:ih*2[bf]; [bf][1] overlay=40:600"  -t 53 -y out.mp4
```

### add logo top left padding 10
```
* ffmpeg -y -i VIDEO.mp4 -i subscribe.png -filter_complex "overlay=10:10" out.mp4
```


### Prepare video for instagram 
```
* // crop 1920 into instagram format 608x1080  
* ffmpeg -i in.mp4 -vf "crop=608:1080:270:150,eq=saturation=1.9" out.mp4

* // resize video from 608x1080 to 1080x1920 
* ffmpeg -i in.mp4 -vf scale=1080:1920 > 1080x1920 out.mp4
  
* // replace video sound
* ffmpeg -i input.mp4 -i input.wav -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 out.mp4
```

### Mix show waves Video with Overlay 

### generate wave
```
* ffmpeg -i in.wav -filter_complex "[0:a]showwaves=mode=line:s=hd1080:colors=yellow[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100  out_$(date +%s).mp4
```

### mix wave + bg
```
* ffmpeg -i in.mp4 -i input.png -filter_complex "[0]colorkey=color=black,crop=1920:400,scale=1920:100,pad=iw*200:ih:0:0[keyed];[1][keyed]overlay=y=770" -t 10  out_$(date +%s).mp4
```

### fast conversion
```
ffmpeg -i input.mkv -preset ultrafast -c:a copy -crf 28 output.mp4
for i in *.*; do ffmpeg -i $i -vcodec h264 -acodec mp3 -threads 2 $i.mp4; done
```

### h264 to h265 conversion
```
ffmpeg -i input.mp4 -c:v libx265 -c:a copy -vtag hvc1 -threads 1 output.mp4
for i in *.*; do ffmpeg -i $i -vcodec libx265 -acodec mp3 -crf 28 $i.mp4; done
```

### audio make mono 
```
ffmpeg -i stereo.flac -ac 1 mono.flac
```


### ubuntu webcam settings
```
* sudo apt install v4l-utils
* v4l2-ctl -d /dev/video0 --set-ctrl=brightness=60,gamma=30,sharpness=2,hue=2,saturation=30
* v4l2-ctl -d /dev/video0 --set-ctrl=brightness=90,gamma=30,sharpness=2,hue=2,saturation=30
```

### HDMI brightness
```
ubuntu-drivers devices
sudo ubuntu-drivers autoinstall

* xrandr -q | grep " connected"
* xrandr --output HDMI-1 --brightness 0.5

* xrandr --listactivemonitors
* xrandr --output HDMI-1-1 --brightness 0.7
* xrandr --verbose |egrep '(Bright|Gamma)'
* xrandr --output HDMI-1-1 --gamma 0.8:0.8:0.8
* xrandr --output HDMI-1-1 --gamma 1.0:1.0:1.0
* xrandr --output eDP-1-1 --gamma 1.0:1.0:1.0

xrandr --output eDP --brightness 0.9
xrandr --output DisplayPort-1 --brightness 0.6


xrandr -s 1920x1200
xrandr -s 2560x1600


xrandr --output eDP-1 --brightness 0.7
xrandr --output DP-2 --brightness 0.7
```

### mp4 cut crop 
~~~
# https://superuser.com/questions/744823/how-i-could-cut-the-last-7-second-of-my-video-with-ffmpeg

# keep only the last N seconds of a video.
ffmpeg -sseof -7 -i input.mp4 -c copy output.mp4

# delete the last N seconds of a video and keep the rest. 
ffmpeg -ss 00:00:00 -to 01:32:00 -i input.mp4 -c copy output.mp4

# delete the last N seconds of a video and keep the rest
ffmpeg -ss 00:00:04 -t 01:00:00 -i input.mp4 -c copy output.mp4;

# keep only the first N seconds of a video.
ffmpeg -i input.avi -t 33 -c copy output.avi
~~~

### fast convert 
~~~
for i in *.avi; do ffmpeg -i $i -y -threads 4 $i.mp4; done
for i in *.mp4; do ffmpeg -i $i -y -threads 4 $i.mkv; done

ffprobe in.mp4 2>&1 | grep Stream

for i in *.mkv; do ffmpeg -i $i -y -threads 4 -codec copy $i.mp4; done
for i in *.mkv; do ffmpeg -i $i -y -threads 4 -crf 24 -c:a copy -tune film -preset superfast  $i.mp4; done
for i in *.mkv; do ffmpeg -i $i -y -threads 4 -crf 24 -tune film -preset superfast  $i.mp4; done

for i in *.*; do ffmpeg -i $i -y -threads 2 -crf 28 -tune film -preset fast  $i.mp4; done
~~~




### join more images in one
~~~
How to join two images into one with FFmpeg
https://stackoverflow.com/questions/24604689/how-to-join-two-images-into-one-with-ffmpeg

ffmpeg -i 1.png -i 2.png  -i 3.png -filter_complex vstack=inputs=3 -y output.jpg
ffmpeg -i 1.png -i 2.png  -i 3.png -filter_complex hstack=inputs=3 -y output.jpg
~~~


### convert to mono
~~~
mkdir -p conv && for i in *.*; do ffmpeg -i $i -ac 1 conv/$i; done 
~~~

### loop an MP4 and a WAV into MP4 container
~~~
# loop 10 times
ffmpeg -stream_loop 10 -i audio.wav -i video.mp4 -c:a aac -b:a 192k -c:v libx264 out.mp4

# loop 0 times
ffmpeg -stream_loop 0 -i audio.wav -i video.mp4  -c:a aac -b:a 256k -c:v libx264 -y out.mp4
~~~


### create video with static album cover
~~~
# [][] add to images side by side  
ffmpeg -i 1.png -i 2.png -filter_complex hstack=inputs=2 -y output.png

# image or video
ffmpeg -loop 1 -i image.png -c:v libx264 -t 15 -pix_fmt yuv420p -y out.mp4

# concat all audio files in single file
sox "*.wav" ../out.wav

# create video with album sound
ffmpeg -stream_loop 0 -i out.wav -i out.mp4  -c:a aac -b:a 256k -c:v libx264 -y zfinal.mp4
~~~


### random usage commands
~~~
# crop
ffmpeg -i in.mp4 -vf crop=1900:1000:10 out.mp4 
ffmpeg -i in.mp4 -vf crop=1910:1080:10:1200 out.mp4 

# secord screen 
ffmpeg -v warning -framerate 30 -f x11grab -i :1.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4

# slow motion
ffmpeg -i pexels-1.mp4 -vf "setpts=1/0.5*PTS" pexels-1b.mp4 

# crop one screen from x11grab
ffmpeg -i in.mp4 -vf "crop=1900:920:10:10,eq=saturation=1.9" out.mp4;

# hue
ffmpeg -i in.mp4 -vf hue=h=5:s=3 -c:a copy out.mp4 
ffmpeg -i in.mp4 -vf hue=s=2:h=270,curves=preset=color_negative out.mp4

# create video with sound
convert image.jpg image.png
convert image.jpeg image.png
sox "*.wav" ../out.wav
convert image.jpeg image.png
ffmpeg -loop 1 -i image.png -c:v libx264 -t 15 -pix_fmt yuv420p -y out.mp4
ffmpeg -stream_loop 0 -i out.wav -i out.mp4  -c:a aac -b:a 256k -c:v libx264 -y out.mp4


# loop video for mp3
ffmpeg -stream_loop -1  -i vid.mp4  -i audio.mp3 -map 0:v -map 1:a -c:v copy -shortest -y out.mp4

# trim
ffmpeg -i in.mp4 -ss 00:00 -to 03:12 out.mp4 

# compress 2Gb into 200Mb
ffmpeg  -i in.mp4 -c:a aac -b:a 256k -c:v libx264 -y out.mp4

# convert
for i in *.wav; do ffmpeg -i "$i" "$i".mp3; done 


ffmpeg -i mpxvm_fumix257_ft2.xm -af "rubberband=pitch=432/400,rubberband=pitch=440/470" -y mpxvm_fumix257_ft2.xm.wav 1:1

echo $DISPLAY
ffmpeg -v warning -framerate 30 -f x11grab -i :0.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4
ffmpeg -v warning -framerate 30 -f x11grab -i :0 -c:v libx264 -qp 0 -preset ultrafast capture.mp4
ffmpeg -video_size 80x24 -f x11grab -i :0.0+61,68 output.mp4

rename 's/ /_/g' *
for i in */; do zip -r "${i%/}.zip" "$i"; done
~~~



Record Screen Mic Audio Web simultaneously 
~~~
#!/bin/bash

# https://stackoverflow.com/questions/3004811/how-do-you-run-multiple-programs-in-parallel-from-a-bash-script

rm *.m4a
rm *.mp4

ffmpeg -v warning -video_size 1920x1080 -framerate 30 -f x11grab -i :0.0 -f alsa -ac 2 -i default myvid_$(date +%s).mp4 &
P1=$!
# audio
ffmpeg -f pulse -i alsa_output.pci-0000_05_00.6.analog-stereo.monitor -ac 2 recording_stereo_$(date +%s).m4a &
P2=$!
# mic
ffmpeg -f alsa -i pulse -ac 1 recording_mic_$(date +%s).m4a &
P3=$!
# web
ffmpeg -f v4l2 -framerate 25 -video_size 480x270 -i /dev/video0  webcam_$(date +%s).mp4
P4=$!
~~~




