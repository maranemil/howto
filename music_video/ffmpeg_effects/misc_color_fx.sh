

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