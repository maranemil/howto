#!/bin/sh

ffmpeg -i in.mp4 -i in.mp4 -i in.mp4 -i in.mp4 -i in.mp4 -i in.mp4 -i in.mp4 -i in.mp4 -filter_complex "[0]scale=1920:1080,format=rgba[v1]; [1]scale=-1:1080,crop=240:1080[v2]; [2]scale=-1:1080,crop=240:1080[v3]; [3]scale=-1:1080,crop=240:1080[v4]; [4]scale=-1:1080,crop=240:1080[v5]; [5]scale=-1:1080,crop=240:1080[v6]; [6]scale=-1:1080,crop=240:1080[v7]; [7]scale=-1:1080,crop=240:1080[v8]; [v1][v2]overlay=0:0[out1]; [out1][v3]overlay=240:0[out2]; [out2][v4]overlay=480:0[out3]; [out3][v5]overlay=720:0[out4]; [out4][v6]overlay=960:0[out5]; [out5][v7]overlay=1200:0[out6]; [out6][v8]overlay=1440:0[out7]" -map [out7] -y  -t 20 output.mp4


###########################################
# Interpolate Between
###########################################
#ffmpeg -i output.mp4 -vf "hflip, perspective=60:90:889:147:50:615:882:618:enable='not(between(n,1,40)+between(n,70,130))'" output2.mp4
ffmpeg -i output.mp4 -vf "hflip" -y output2.mp4

###########################################
# FFMPEG Perspective + Overlay
###########################################
ffmpeg -i output2.mp4 -i output2.mp4 -filter_complex  "[1] fade=in:10:1:alpha=1, fade=out:5000:1:alpha=1, scale=480:480, rotate=-0.45:c=none [ov1];[1] fade=in:10:1:alpha=1, fade=out:5000:1:alpha=1, scale=480:480, rotate=0.45:c=none [ov2]; [0][ov1] overlay=100:100 [v1]; [v1][ov2] overlay=W-680:100 [v] " -map "[v]" -y output3.mp4


###########################################
# vidstabdetect
###########################################

#ffmpeg -i output3.mp4 -vf vidstabdetect=show=1 -y output4.mp4

###########################################
# add saturation
###########################################
#ffmpeg -i output4.mp4 -vf eq=saturation=1.5 -y output5.mp4


###########################################
# FFMPEG Kaleidoskop
###########################################

# Mirror Effect Horizontal
ffmpeg -i output3.mp4 -vf "crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack" -threads 2 -y outputH.mp4

# Mirror Effect Vertical
ffmpeg -i output3.mp4 -vf "split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2" -y -threads 2 outputV.mp4

# flip vertical
ffmpeg -i outputH.mp4 -vf "vflip" -y -threads 2 outputHFV.mp4

# flip horizontal
ffmpeg -i outputV.mp4 -vf "hflip" -y -threads 2 outputVFH.mp4

# blend overlay 4 vids
ffmpeg -i outputV.mp4 -i outputVFH.mp4 -filter_complex "[0:0][1:0]blend=all_mode='overlay':all_opacity=1[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264 -crf 18 -y -threads 2 outputB1.mp4

ffmpeg -i outputH.mp4 -i outputHFV.mp4 -filter_complex "[0:0][1:0]blend=all_mode='overlay':all_opacity=1[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264 -crf 18 -y -threads 2 outputB2.mp4

ffmpeg -i outputB1.mp4 -i outputB2.mp4 -filter_complex "[0:0][1:0]blend=all_mode='overlay':all_opacity=1[out]" -shortest -map [out]  -pix_fmt yuv420p -c:a copy -c:v libx264 -crf 18 -y -threads 2 outputBF.mp4

# add saturation
#ffmpeg -i outputBF.mp4 -vf eq=saturation=1.5 -y -threads 2 outputBFS.mp4






###########################################
# FFMPEG Lens Correction FX
###########################################
#ffplay -i in.mp4 -vf lenscorrection=k1=-0.86:k2=0.5



###########################################
# FFMPEG Kaleidoskop 2 Effect# ,scale=1320:460 NO
###########################################
#ffmpeg -i output5.mp4 -vf rotate=PI/4,rotate=PI/270,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/1.2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack" -y  output6.mp4


###########################################
# perspective
###########################################
#ffplay -f lavfi -i testsrc -vf perspective=x0=-800:y0=-800:x2=+500:y2=H+100:sense=destination


###########################################
#  Perspective SKEW
###########################################
#ffplay -f lavfi -i testsrc -vf pad="iw+4:ih+4:2:2:0x00000000",perspective=x0=W/4:y0=H/4:x1=3*W/4:y1=H/4:sense=destination

###########################################
#  Perspective fusheye
###########################################
#ffmpeg -i in.mp4 -vf "lenscorrection=cx=0.5:cy=0.5:k1=-0.727:k2=-0.822" out.mp4

######################################################################################
# postcard perspective
###########################################
#ffmpeg -y -i in.mp4 -i in.mp4 -filter_complex "[0]format=bgra[v0]; [1]colorkey=color=black,perspective=x0=0:y0=0:x1=W:y1=180, scale=-1:420, rotate=-0.1745:c=none:ow=rotw(-0.1745):oh=roth(-0.1745)[v1];  [v0][v1] overlay=100:100:eof_action=pass [v]" -map "[v]" out.mp4


###########################################
#Perspective Twist FX
###########################################
# ffplay -f lavfi -i testsrc -vf perspective=x0=200:y0=100:x1=200:y1=200:sense=destination