########################################
# Loop video X times
########################################

# https://video.stackexchange.com/questions/12905/repeat-loop-input-video-with-ffmpeg
# https://superuser.com/questions/1602115/ffmpeg-create-a-looping-video-with-specific-time

ffmpeg -stream_loop 3 -i input.mp4 -c copy output.mp4

