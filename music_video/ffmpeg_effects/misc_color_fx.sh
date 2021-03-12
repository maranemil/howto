

# saturation
ffplay -i input.mp4 -vf "scale=-1:1080,,eq=saturation=1.9" -an

# magenta
ffplay -i input.mp4  -vf "unsharp=3:5:2,edgedetect=mode=colormix:high=0.5:low=0.5,eq=saturation=0.2:gamma=0.8:brightness=0.3:contrast=1.4,lutrgb=r=negval:g=negval:b=negval,hue='H=2*PI*t: s=sin(2*PI*t)+1',lutrgb=g=0,setpts=2*PTS"

# disco
ffplay -i input.mp4  -vf "unsharp=3:5:2,eq=saturation=0.2:gamma=0.8:brightness=0.3:contrast=1.4,lutrgb=r=negval:g=negval:b=negval,hue='H=2*PI*t: s=sin(2*PI*t)+1',lutrgb=g=0:b=55,lutrgb=r=negval:g=negval:b=negval,hue='H=2*PI*t: s=sin(2*PI*t)+1'"

# red
ffplay -i input.mp4  -vf "unsharp=3:5:2,eq=saturation=0.2:gamma=0.8:brightness=0.3:contrast=1.4,lutrgb=g=0:b=85"


# red2
ffplay -i input.mp4  -vf "unsharp=3:5:2,eq=saturation=1.2:gamma=0.9:brightness=0.8:contrast=2.4,lutrgb=g=0:b=35"

 # saturation contrast
ffplay -i input.mp4 -vf "unsharp=3:5:2,eq=brightness=0.06:saturation=2:contrast=1.8"
ffplay -i input.mp4 -vf "unsharp=3:5:2,eq=brightness=0.06:saturation=2:contrast=1.8:gamma=1.5"

# cartonize
# https://www.youtube.com/watch?v=-fgOmOI07RY
# http://dragonquest64.blogspot.com/2020/09/cartoonize-video-with-ffmpeg-take-2.html
ffplay -i input.mp4 -vf "format=gray,geq=lum_expr='if(lte(lum(X,Y),50),0,if(lte(lum(X,Y),100),50,if(lte(lum(X,Y),150),100,if(lte(lum(X,Y),200),150,if(lte(lum(X,Y),255),200,0)))))'"

# invert
ffplay -i input.mp4 -vf "split [main][tmp]; [tmp] lutrgb="r=negval:g=negval:b=negval" [tmp2]; [main][tmp2] overlay"

# compress
ffmpeg -i input.mp4 -vf "split [main][tmp]; [tmp] lutrgb="r=negval:g=negval:b=negval" [tmp2]; [main][tmp2] overlay" -c:a copy -crf 30 -y output.mp4

# skip frames
ffmpeg -i input.mp4 -vf fps=fps=1.5 -an -y output.mp4
ffmpeg -i input.mp4 -vf fps=fps=3.5 -an -y output.mp4











# rename
num=0; for i in *.mp4; do mv "$i" "$(printf '%04d' $num).mp4"; ((num++)); done


#black video mask
#ffplay -t 7200 -s 1920x1080 -f rawvideo -pix_fmt rgb24  -i /dev/zero

#black video mask
#ffmpeg -t 7200 -s 1920x1080 -f rawvideo -pix_fmt rgb24  -i /dev/zero -i 0001.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)'" -pix_fmt yuv420p  -y -t 4 output.mp4

#black video mask
#ffmpeg -t 7200 -s 1280x720 -f rawvideo -pix_fmt rgb24  -i /dev/zero -i 0001.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p  -y -t 4 output.mp4

#white video mask
#ffmpeg -f lavfi -i color=white:1920x1080:d=3 -i 0067.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p  -y -t 4 output.mp4


#ffmpeg -f lavfi -i color=white:1920x1080 -i 0067.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p  -y -t 4 output.mp4

#batch h 1080
#for i in *.mp4; do ffmpeg -i "$i" -vf scale=-1:1080,unsharp=3:5:2 batch/"$i"; done

#batch w 1920
for i in *.mp4; do ffmpeg -i "$i" -vf scale=1920:-1,unsharp=3:5:2 batch/"$i"; done


#white video mask center
ffmpeg -f lavfi -i color=white:1920x1080 -i in.mp4 -filter_complex "[0:v][1:v] overlay=(W-w)/2:(H-h)/2:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p -y -t 4 output.mp4

#black video mask center
ffmpeg -f lavfi -i color=black:1920x1080 -i in.mp4 -filter_complex "[0:v][1:v] overlay=(W-w)/2:(H-h)/2:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p -y -t 4 output.mp4




#https://www.rapidtables.com/web/color/magenta-color.html
#https://ffmpeg.org/ffmpeg-filters.html#Examples-70
# magenta edges gamma brightness contrast invert colors hue
#Filters:
ffplay -i a.mp4 -vf "unsharp=3:5:2,edgedetect=mode=colormix:high=0.5:low=0.5,eq=saturation=0.2:gamma=0.8:brightness=0.3:contrast=1.4,lutrgb=r=negval:g=negval:b=negval,hue='H=2*PI*t: s=sin(2*PI*t)+1',lutrgb=g=0,setpts=2*PTS" -fast -threads 2 -strict 2
ffplay -i a.mp4 -vf "unsharp=3:3:1,edgedetect=low=0.1:high=0.1,curves=preset=lighter,setpts=2*PTS"  -fast -threads 2 -strict 2

ffmpeg -i a.mp4 -i b.mp4 -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -strict -2 -t 20 -y c.mp4
ffmpeg -i c.mp4 -vf scale=-1:1080 -c:v libx264  -preset veryslow d.mp4



# disco
ffplay -i a.mp4 -vf "unsharp=3:5:2,eq=saturation=0.2:gamma=0.8:brightness=0.3:contrast=1.4,lutrgb=r=negval:g=negval:b=negval,hue='H=2*PI*t: s=sin(2*PI*t)+1',lutrgb=g=0:b=55,lutrgb=r=negval:g=negval:b=negval,hue='H=2*PI*t: s=sin(2*PI*t)+1'" -fast -threads 2 -strict 2

# red
ffplay -i a.mp4 -vf "unsharp=3:5:2,eq=saturation=0.2:gamma=0.8:brightness=0.3:contrast=1.4,lutrgb=g=0:b=85" -fast -threads 2 -strict 2

#https://de.wikipedia.org/wiki/Datei:FFmpeg-Logo.svg
#https://de.wikipedia.org/wiki/Datei:The_GIMP_icon_-_gnome.svg
