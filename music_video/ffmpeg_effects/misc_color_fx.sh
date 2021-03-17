
# edgedetect
ffplay -i BeeFarm.mp4 -vf edgedetect=low=20/255:high=10/225:mode=wires
ffplay -i BeeFarm.mp4 -vf edgedetect=20/255:50/255:wires
ffplay -i BeeFarm.mp4 -vf edgedetect=low=0.8:high=0.1

# crop square
ffplay -i BeeFarm.mp4 -vf crop=w=600:h=600:x=300:y=300

# draw box
ffplay -i BeeFarm.mp4 -vf drawbox=x=20:y=20:w=in_w/3:h=ih/2:color=pink


# drawgrid
ffplay -i BeeFarm.mp4 -vf drawgrid=width=100:height=100:thickness=2:color=white@0.9

# geq
ffplay -i BeeFarm.mp4 -vf "geq=r='X/W*r(X,Y)':g='(1-X/W)*g(X,Y)':b='(H-Y)/H*b(X,Y)'"
ffplay -i BeeFarm.mp4 -vf "geq=lum_expr='(p(X,Y)+(256-p(X-4,Y-4)))/2"


# gen rgb
ffplay -i BeeFarm.mp4 -vf lutrgb=163:u=5-10:v=5

# add noise
ffplay -i BeeFarm.mp4 -vf noise=alls=80:allf=t+u

# add pad box
ffplay -i BeeFarm.mp4 -vf pad=width=in_w+50:height=in_h+50:x=24:y=24:color=yellow

# shuffleplanes
ffplay -i BeeFarm.mp4 -vf shuffleplanes=0:2:1:3

# unsharp
ffplay -i BeeFarm.mp4 -vf unsharp=5:5:1.0:5:5:5.0
ffplay -i BeeFarm.mp4 -vf unsharp=7:7:-2:7:7:-2

# tile
ffmpeg -ss 00:00:10 -i movie.avi -frames 1 -vf "select=not(mod(n\,1000)),scale=320:240,tile=2x3" out.png

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

#black video mask
#ffplay -t 7200 -s 1920x1080 -f rawvideo -pix_fmt rgb24  -i /dev/zero

#black video mask
#ffmpeg -t 7200 -s 1920x1080 -f rawvideo -pix_fmt rgb24  -i /dev/zero -i 0001.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)'" -pix_fmt yuv420p  -y -t 4 output.mp4

#black video mask
#ffmpeg -t 7200 -s 1280x720 -f rawvideo -pix_fmt rgb24  -i /dev/zero -i 0001.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p  -y -t 4 output.mp4

#white video mask
#ffmpeg -f lavfi -i color=white:1920x1080:d=3 -i 0067.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p  -y -t 4 output.mp4


#ffmpeg -f lavfi -i color=white:1920x1080 -i 0067.mp4  -filter_complex "[0:v][1:v] overlay=125:125:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p  -y -t 4 output.mp4


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


#####################################################
#
#   file batches
#
#####################################################

# rename
num=0; for i in *.mp4; do mv "$i" "$(printf '%04d' $num).mp4"; ((num++)); done

# batch h 1080
#for i in *.mp4; do ffmpeg -i "$i" -vf scale=-1:1080,unsharp=3:5:2 batch/"$i"; done

# batch w 1920
#for i in *.mp4; do ffmpeg -i "$i" -vf scale=1920:-1,unsharp=3:5:2 batch/"$i"; done

# batch w 1920
mkdir batch;for i in *.mp4; do ffmpeg -i "$i" -vf scale=1920:-2,unsharp=3:5:2 batch/"$i"; done

# batch black bg
mkdir batch; for i in *.mp4; do ffmpeg -f lavfi -i color=black:1920x1080 -i "$i" -filter_complex "[0:v][1:v] overlay=(W-w)/2:(H-h)/2:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p -t 10 -y batch/"$i"; done

# batch white bg
mkdir batch; for i in *.mp4; do ffmpeg -f lavfi -i color=white:1920x1080 -i "$i" -filter_complex "[0:v][1:v] overlay=(W-w)/2:(H-h)/2:enable='between(t,0,20)',unsharp=3:3:1.5" -pix_fmt yuv420p -t 10 -y batch/"$i"; done

# thumb 16 tiles
f=in.mp4; ffmpeg -y -ss 3 -i "$f" -vf "select=gt(scene\,0.4)" -frames:v 16 -vsync vfr -vf fps=fps=1/7 "${f%}out%02d.jpg"; ffmpeg -y -pattern_type glob -i "$f*.jpg"  -filter_complex scale=360:-1,tile=4x4 "${f%}output.png"

# thumb 9 tiles
f=in.mp4; ffmpeg -y -ss 3 -i "$f" -vf "select=gt(scene\,0.4)" -frames:v 9 -vsync vfr -vf fps=fps=1/5 "${f%}out%02d.jpg"; ffmpeg -y -pattern_type glob -i "$f*.jpg"  -filter_complex scale=480:-2,tile=3x3 "${f%}output.png"