#####################################################
# Video Stabilization With `ffmpeg` and `VidStab`
#####################################################



# check
mkdir -p conv && for i in *.*; do ffmpeg -i $i -vf vidstabdetect=shakiness=7  -f null - \
  && ffmpeg -i $i -vf vidstabtransform=smoothing=15:input="transforms.trf" -an conv/$i.stabilized.mp4; done

# apply saturation
mkdir -p conv && for i in *.*; do ffmpeg -i $i -vf eq=brightness=0.06:saturation=1.9:gamma=0.915 conv/$i; done

# add slow motion
mkdir -p conv && for i in *.*; do ffmpeg -i $i -filter:v "setpts=2.0*PTS" conv/$i; done

####################################
# examples refs
####################################

#https://www.paulirish.com/2021/video-stabilization-with-ffmpeg-and-vidstab/
#https://gist.github.com/hlorand/e5012fa315dcfe358008cf1b4611c7e0
#https://gist.github.com/maxogden/43219d6dcb9006042849
#https://rainnic.altervista.org/en/how-stabilize-video-using-ffmpeg-and-vidstab
#
#sudo apt install ffmpeg
#sudo apt install libvidstab-dev
#
#ffmpeg -i clip.mov -vf vidstabdetect -f null -
#ffmpeg -i clip.mov -vf vidstabtransform=smoothing=5:input="transforms.trf" clip-stabilized.mov
#
#ffmpeg -i clip.mkv -i clip-stabilized.mkv  -filter_complex vstack clips-stacked.mkv
#ffmpeg -i clip.mkv -i clip-stabilized.mkv  -filter_complex hstack clips-sxs.mkv
#
#
#-----------------------
#
## The first pass ('detect') generates stabilization data and saves to `transforms.trf`
## The `-f null -` tells ffmpeg there's no output video file
#ffmpeg -i clip.mkv -vf vidstabdetect -f null -
#
## The second pass ('transform') uses the .trf and creates the new stabilized video.
#ffmpeg -i clip.mkv -vf vidstabtransform clip-stabilized.mkv
#
#
## create a comparison video
#
## vertically stacked
#ffmpeg -i clip.mkv -i clip-stabilized.mkv  -filter_complex vstack clips-stacked.mkv
#
## side-by-side
#ffmpeg -i clip.mkv -i clip-stabilized.mkv  -filter_complex hstack clips-sxs.mkv
#
## all in one
#export vid="sourcevid.mkv"
#ffmpeg -i "$vid" -vf vidstabdetect -f null -; ffmpeg -i "$vid" -vf vidstabtransform "$vid.stab.mkv"; ffmpeg -i "$vid" -i "$vid.stab.mkv"  -filter_complex vstack "$vid.stacked.mkv"
#
#--------------
#
#apt install ffmpeg
#
#ffmpeg -i input.mp4 -vf vidstabdetect=shakiness=7 -f null -
#ffmpeg -i input.mp4 -vf vidstabtransform=smoothing=30:zoom=5:input="transforms.trf" stabilized.mp4
#ffmpeg -i original.mp4 -i stabilized.mp4 -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" sidebyside.mp4
#
#----------------------
#
#ffmpeg -i input.mp4 -vf vidstabtransform,unsharp=5:5:0.8:3:3:0.4 output.mp4
#
#ffmpeg -i input.mp4 -vf vidstabdetect=stepsize=32:shakiness=10:accuracy=10:result=transforms.trf -f null -
#ffmpeg -y -i input.mp4 -vf vidstabtransform=input=transforms.trf:zoom=0:smoothing=10,unsharp=5:5:0.8:3:3:0.4 -vcodec libx264 -tune film -acodec copy -preset slow output.mp4
