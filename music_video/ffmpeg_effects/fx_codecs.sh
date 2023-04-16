##############################################
#  codecs and formats supported by FFmpeg
##############################################

# https://stackoverflow.com/questions/3377300/what-are-all-codecs-and-formats-supported-by-ffmpeg
# https://stackoverflow.com/questions/5678695/ffmpeg-usage-to-encode-a-video-to-h264-codec-format
# https://superuser.com/questions/785528/how-to-generate-an-mp4-with-h-265-codec-using-ffmpeg

ffmpeg -codecs
ffmpeg -formats
ffmpeg -codecs | grep h264

ffmpeg -i input.flv -vcodec libx264 -acodec aac -threads 1 output.mp4
ffmpeg -i INPUT -c:v libx265 -c:a copy -x265-params crf=25 -threads 1 OUT.mov
ffmpeg -i INPUT -c:v libx265 -c:a copy -threads 1 OUT.mov