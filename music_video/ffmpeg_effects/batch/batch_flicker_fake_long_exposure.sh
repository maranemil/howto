
####################################
# fake video exposure
####################################

# https://trac.ffmpeg.org/wiki/Blend

# video frame segmentation
ffmpeg -i in.mp4 -r 1/1 -t 10 $filename%03d.png

# mix overlay
ffmpeg -i 002.png -i 003.png -i 004.png \
	-filter_complex "[1:0] format=rgba,unsharp=5:5:1.0:5:5:0.0 [1sared]; [0:0]format=rgba,unsharp=3:3:1.5 [0rgbd]; [0rgbd][1sared]blend=all_mode='overlay':shortest=1:all_opacity=0.5" \
	-y output.jpg

# test results
ffmpeg -i 010.png -i output_hd2.jpg -i output_Nero_AI_Face_x2x.png -filter_complex hstack=inputs=3 -y z.png
