##############################################
#  codecs and formats supported by FFmpeg
##############################################

# https://stackoverflow.com/questions/3377300/what-are-all-codecs-and-formats-supported-by-ffmpeg
# https://stackoverflow.com/questions/5678695/ffmpeg-usage-to-encode-a-video-to-h264-codec-format
# https://superuser.com/questions/785528/how-to-generate-an-mp4-with-h-265-codec-using-ffmpeg
# https://trac.ffmpeg.org/wiki/Encode/H.265
# https://x265.readthedocs.io/en/latest/presets.html
# https://stackoverflow.com/questions/47389381/ffmpeg-multiple-x265-params-are-not-recognized
# https://x265.readthedocs.io/en/2.5/cli.html
# https://x265.readthedocs.io/en/latest/cli.html#cmdoption-pools
# https://x265.readthedocs.io/en/stable/threading.html

ffmpeg -codecs
ffmpeg -formats
ffmpeg -codecs | grep h264
ffmpeg -h encoder=libx265

ffmpeg -i input.flv -vcodec libx264 -acodec aac -threads 1 output.mp4
ffmpeg -i INPUT -c:v libx265 -c:a copy -x265-params crf=25 -threads 1 OUT
ffmpeg -i INPUT -c:v libx265 -c:a copy -threads 1 OUT

# cpu limiting
ffmpeg -i GOPR0378.MP4 -c:v libx265 -c:a copy -x265-params pools=2 GOPR0378c.mp4

# batch
mkdir exp && for f in *.MP4; do  ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2 -y exp/$f; done

# GOPR0377.MP4  2GB
# libx264       500MB
# libx265       225MB

# ffmpeg -i INPUT -c:v libx265 -preset medium -tune psnr -x265-params "qp=16:rc-lookahead=18" OUT