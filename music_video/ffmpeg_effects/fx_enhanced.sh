##########################
ffmpeg enhanced
##########################

# https://video.stackexchange.com/questions/29337/how-do-the-super-resolution-filters-in-ffmpeg-work
# https://www.mux.com/articles/convert-video-to-different-resolutions-with-ffmpeg

ffmpeg -i input_video.mp4 -vf "scale=1920:-1:flags=lanczos" -c:v libx264 -crf 18 -c:a copy output_4k_enhanced.mp4
