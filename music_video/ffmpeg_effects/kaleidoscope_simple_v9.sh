#!/bin/sh

# Kaleidoskop
# https://trac.ffmpeg.org/wiki/Stereoscopic
# https://ffmpeg.org/ffmpeg-filters.html#Examples-109


ffmpeg  -i in.mp4 -i in.mp4 -filter_complex  "[1] fade=in:1:1:alpha=1,fade=out:5000:1:alpha=1, scale=980:980, rotate=-0.95:c=none [ov1];[1] fade=in:1:1:alpha=1, fade=out:5000:1:alpha=1, scale=980:980, rotate=0.95:c=none [ov2]; [0][ov1] overlay=900:100 [v1]; [v1][ov2] overlay=W-600:600 [v] " -map "[v]" -y  -t 10 -an  outlayer1.mp4

#exit

ffmpeg -i outlayer1.mp4 -vf rotate=PI/4,rotate=PI/270,lutrgb="r=negval:g=negval:b=negval","split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/1.2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=1560:360 -y  -t 10 output1.mp4

# add saturation
ffmpeg -i output1.mp4 -vf eq=saturation=1.5 -y output1a.mp4

# add on top
ffmpeg -i output1a.mp4  -i output1a.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=0:360"  -t 10 -y output1b.mp4


#ffmpeg -i in.mp4  -i in2.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 10 -y outV2.mp4
#ffmpeg -i outV2.mp4 -vf lenscorrection=k1=-0.86:k2=0.5 outV3.mp4

ffmpeg -i output1b.mp4 -i output1b.mp4 -filter_complex  "hflip,[1] fade=in:1:1:alpha=1, fade=out:5000:1:alpha=1, scale=880:880, rotate=-1.45:c=none [ov1];[1] fade=in:1:1:alpha=1, fade=out:5000:1:alpha=1, scale=1280:1280, rotate=1.45:c=none [ov2]; [0][ov1] overlay=300:300 [v1]; [v1][ov2] overlay=W-680:100 [v] " -map "[v]"  -y  -t 10  outlayer2.mp4


ffmpeg -i outlayer2.mp4 -vf rotate=PI/8,rotate=PI/270,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/1.2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=1560:360 -y  -t 10 output2.mp4

# add saturation
ffmpeg -i output2.mp4 -vf eq=saturation=1.5 -y output2a.mp4

# add on top
ffmpeg -i output2a.mp4  -i output2a.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=0:360"  -t 10 -y output2b.mp4

ffmpeg -i output2b.mp4 -i output2b.mp4 -filter_complex  "[1] fade=in:1:1:alpha=1, fade=out:5000:1:alpha=1, scale=880:880, rotate=-0.45:c=none [ov1];[1] fade=in:1:1:alpha=1, fade=out:5000:1:alpha=1, scale=880:880, rotate=0.45:c=none [ov2]; [0][ov1] overlay=100:100 [v1]; [v1][ov2] overlay=W-680:100 [v] " -map "[v]"  -y  -t 10  outlayer3.mp4


ffmpeg -i outlayer3.mp4 -vf rotate=PI/4,rotate=PI/270,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/1.2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=1560:360 -y  -t 10 output3.mp4

# add saturation
ffmpeg -i output3.mp4 -vf eq=saturation=1.5 -y output3a.mp4

# add on top
ffmpeg -i output3a.mp4  -i output3a.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=0:360"  -t 10 -y output4Final.mp4

#ffmpeg -i in.mp4 -vf "crop=iw/4:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack" out.mp4
