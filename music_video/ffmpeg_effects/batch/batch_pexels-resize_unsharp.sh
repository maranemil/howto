##############################################
# batch scale unsharp
##############################################

#ffmpeg -i input.mp4 -filter:v "scale=1280:-1:flags=lanczos,unsharp=5:5:1.0:5:5:0.0" output.mp4
#ffmpeg -i input.mp4 -filter:v "scale=1280:-1:flags=lanczos,unsharp=luma_msize_x=7:luma_msize_y=7:luma_amount=2.5" output.mp4 # ok

#mkdir -p conv && for i in *.*; do ffmpeg -i $i -filter:v "scale=1280:-1:flags=lanczos,unsharp=luma_msize_x=7:luma_msize_y=7:luma_amount=2.5" -threads 2 conv/$i.output.mp4; done

mkdir -p conv && for i in *.*; do ffmpeg -i $i -filter:v "scale=1920:-1:flags=lanczos,unsharp=luma_msize_x=7:luma_msize_y=7:luma_amount=2.5" -threads 2 conv/$i.output.mp4; done



