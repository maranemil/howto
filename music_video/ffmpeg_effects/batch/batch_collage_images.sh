
##############################################
#   batch collage photos
##############################################

ffmpeg -framerate 1 -pattern_type glob -i '*.png' -c:v libx264 -r 30 -pix_fmt yuv420p -y output.mp4
#ffmpeg -i output.mp4 -frames 2 -vf "select=not(mod(n\,1000)),scale=320:240,tile=1x2" -y out.png
ffmpeg -i output.mp4 -frames 1 -vf "select=not(mod(n\,50)),scale=1280:960,tile=3x2" -y out.png
ffmpeg -i output.mp4 -frames 1 -vf "select=not(mod(n\,30)),scale=960:1280,tile=3x2" -y out.png


# tile with hstack or vstack
ffmpeg -i 1.png -i 2.jpg -i 3.png -filter_complex hstack=inputs=3 -y z.png

####################################
# examples refs
####################################
#https://stackoverflow.com/questions/11552565/vertically-or-horizontally-stack-mosaic-several-videos-using-ffmpeg
#https://superuser.com/questions/625189/combine-multiple-images-to-form-a-strip-of-images-ffmpeg
#https://stackoverflow.com/questions/24604689/how-to-join-two-images-into-one-with-ffmpeg
#https://www.bannerbear.com/blog/how-to-create-a-slideshow-from-images-with-ffmpeg/
#https://shotstack.io/learn/use-ffmpeg-to-convert-images-to-video/
#
#
#ffmpeg -framerate 1 -i happy%d.jpg -c:v libx264 -r 30 -pix_fmt yuv420p output.mp4
#ffmpeg -framerate 1 -pattern_type glob -i '*.jpg' -c:v libx264 -r 30 -pix_fmt yuv420p output.mp4
#
#ffmpeg -i input.jpg -i input.jpg -i input.jpg -filter_complex "[0][1][2]hstack=inputs=3" -vframes 1 output.jpg
#ffmpeg -i %03d.png -filter_complex "scale=120:-1,tile=5x1:margin=10:padding=4:color=white" output.png
#
#
#ffmpeg -i a.jpg -i b.jpg -filter_complex hstack output.jpg
#ffmpeg -i a.jpg -i b.jpg -i c.jpg -filter_complex "[0][1][2]hstack=inputs=3" output.jpg
#
#ffmpeg \
#-loop 1 -t 3 -i img001.jpg \
#-loop 1 -t 3 -i img002.jpg \
#-loop 1 -t 3 -i img003.jpg \
#-loop 1 -t 3 -i img004.jpg \
#-loop 1 -t 3 -i img005.jpg \
#-filter_complex \
#"[1]fade=d=1:t=in:alpha=1,setpts=PTS-STARTPTS+2/TB[f0]; \
# [2]fade=d=1:t=in:alpha=1,setpts=PTS-STARTPTS+4/TB[f1]; \
# [3]fade=d=1:t=in:alpha=1,setpts=PTS-STARTPTS+6/TB[f2]; \
# [4]fade=d=1:t=in:alpha=1,setpts=PTS-STARTPTS+8/TB[f3]; \
# [0][f0]overlay[bg1];[bg1][f1]overlay[bg2];[bg2][f2]overlay[bg3]; \
# [bg3][f3]overlay,format=yuv420p[v]" -map "[v]" -r 25 output-crossfade.mp4
#
#
#ffmpeg \
#-loop 1 -t 3 -i img001.jpg \
#-loop 1 -t 3 -i img002.jpg \
#-loop 1 -t 3 -i img003.jpg \
#-loop 1 -t 3 -i img004.jpg \
#-loop 1 -t 3 -i img005.jpg \
#-filter_complex \
#"[0][1]xfade=transition=slideleft:duration=0.5:offset=2.5[f0]; \
#[f0][2]xfade=transition=slideleft:duration=0.5:offset=5[f1]; \
#[f1][3]xfade=transition=slideleft:duration=0.5:offset=7.5[f2]; \
#[f2][4]xfade=transition=slideleft:duration=0.5:offset=10[f3]" \
#-map "[f3]" -r 25 -pix_fmt yuv420p -vcodec libx264 output-swipe.mp4
#
#ffmpeg \
#-loop 1 -t 3 -i img001.jpg \
#-loop 1 -t 3 -i img002.jpg \
#-loop 1 -t 3 -i img003.jpg \
#-loop 1 -t 3 -i img004.jpg \
#-loop 1 -t 3 -i img005.jpg \
#-filter_complex \
#"[0][1]xfade=transition=circlecrop:duration=0.5:offset=2.5[f0]; \
#[f0][2]xfade=transition=smoothleft:duration=0.5:offset=5[f1]; \
#[f1][3]xfade=transition=pixelize:duration=0.5:offset=7.5[f2]; \
#[f2][4]xfade=transition=hblur:duration=0.5:offset=10[f3]" \
#-map "[f3]" -r 25 -pix_fmt yuv420p -vcodec libx264 output-swipe-custom.mp4
#
#
#fade
#wipeleft
#wiperight
#wipeup
#wipedown
#slideleft
#slideright
#slideup
#slidedown
#circlecrop
#rectcrop
#distance
#fadeblack
#fadewhite
#radial
#smoothleft
#smoothright
#smoothup
#smoothdown
#circleopen
#circleclose
#vertopen
#vertclose
#horzopen
#horzclose
#dissolve
#pixelize
#diagtl
#diagtr
#diagbl
#diagbr
#hlslice
#hrslice
#vuslice
#vdslice
#hblur
#fadegrays
#wipetl
#wipetr
#wipebl
#wipebr
#squeezeh
#squeezev
#zoomin
#
#
#https://trac.ffmpeg.org/wiki/How%20to%20take%20multiple%20screenshots%20to%20an%20image%20(tile%2C%20mosaic)
#https://www.bogotobogo.com/FFMpeg/ffmpeg_select_scene_change_keyframes_tile_Creating_a_mosaic_of_screenshots_from_a_movie.php
#
#ffmpeg -ss 00:00:10 -i movie.avi -frames 1 -vf "select=not(mod(n\,1000)),scale=320:240,tile=2x3" out.png
#ffmpeg -i YosemiteHDII.webm -vf select='gt(scene\,0.4)',scale=160:120,tile -frames:v 1 Yosemite_preview.png
#ffmpeg -ss 00:00:05 -i YosemiteHDII.webm -frames 1 -vf "select=not(mod(n\,400)),scale=160:120,tile=4x3" tile.png

