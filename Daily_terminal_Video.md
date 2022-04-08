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
```

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
* ffmpeg -i file.mp4 -crf 18 -acodec copy file_compressed.mp4 
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

### Mix showwaves Video with Overlay 

### generate wave
```
* ffmpeg -i in.wav -filter_complex "[0:a]showwaves=mode=line:s=hd1080:colors=yellow[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100  out_$(date +%s).mp4
```

### mix wave + bg
```
* ffmpeg -i in.mp4 -i input.png   -filter_complex "[0]colorkey=color=black,crop=1920:400,scale=1920:100,pad=iw*200:ih:0:0[keyed];[1][keyed]overlay=y=770" -t 10  out_$(date +%s).mp4
```


### ubuntu webcam settings
```
* sudo apt install v4l-utils
* v4l2-ctl -d /dev/video0 --set-ctrl=brightness=60,gamma=30,sharpness=2,hue=2,saturation=30
* v4l2-ctl -d /dev/video0 --set-ctrl=brightness=90,gamma=30,sharpness=2,hue=2,saturation=30
```

### HDMI brightness
```
* xrandr -q | grep " connected"
* xrandr --output HDMI-1 --brightness 0.5

* xrandr --listactivemonitors
* xrandr --output HDMI-1-1 --brightness 0.7
* xrandr --verbose |egrep '(Bright|Gamma)'
* xrandr --output HDMI-1-1 --gamma 0.8:0.8:0.8
* xrandr --output HDMI-1-1 --gamma 1.0:1.0:1.0
* xrandr --output eDP-1-1 --gamma 1.0:1.0:1.0
```

