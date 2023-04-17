##############################################
#  codecs and formats supported by FFmpeg GoPro
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

# https://x265.readthedocs.io/en/stable/presets.html
# ultrafast
# superfast
# veryfast
# faster
# fast
# medium (default)
# slow
# slower
# veryslow
# placebo

# fast compression libx265
mkdir exp && for f in *.MP4; do  ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2:preset=faster -y exp/$f; done

# fast compression libx264
# https://stackoverflow.com/questions/29276904/how-to-increase-compression-speed-for-ffmpeg

ffmpeg -y -i INPUT -r 5 -c:v libx264 -b:v 600k -b:a 44100 -ac 2 -ar 22050 -tune fastdecode -preset ultrafast OUT.mp4
mkdir exp && for f in *.MP4; do ffmpeg -y -i $f -r 25 -c:v libx264 -b:v 1800k -b:a 44100 -ac 2 -ar 22050 -tune fastdecode -preset ultrafast exp/$f; done

mkdir exp && for file in *.*; do ffmpeg -i $file -vf 'scale=-1:480' -threads 1 -y exp/$f; done
mkdir exp && for file in *.*; do ffmpeg -i $file -crf 28 -threads 1 -y exp/$f; done
ffmpeg -i in.mkv -vf 'scale=-1:480' -crf 28 -threads 1 -y out.mp4

mkdir exp && for f in *.*; do ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2,2 -y exp/$f; done
mkdir exp && for f in *.*; do ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2,2:preset=veryfast -y exp/$f; done
mkdir exp && for f in *.*; do ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2,2:preset=superfast -y exp/$f; done #

# https://stackoverflow.com/questions/29276904/how-to-increase-compression-speed-for-ffmpeg

ffmpeg -y -i INPUT -r 5 -c:v libx264 -b:v 600k -b:a 44100 -ac 2 -ar 22050 -tune fastdecode -preset ultrafast OUT.mp4
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -b:v 4000k -b:a 22050 -ac 2 -ar 11025 -tune fastdecode -preset superfast -threads 1 exp/$f.mp4; done #
mkdir exp && for f in *.*; do ffmpeg -y -i $f -r 25 -c:v libx264 -b:v 1800k -b:a 44100 -ac 2 -ar 22050 -tune fastdecode -preset ultrafast exp/$f; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -b:v 1800k -b:a 44100 -ac 2 -ar 22050 -tune fastdecode -preset superfast -threads 1 exp/$f; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -b:a 22050 -ac 2 -ar 11025 -tune fastdecode -preset superfast -threads 1 exp/$f; done



mkdir exp && for f in *.MOV; do ffmpeg -y -i $f -q:v 0 -threads 1 exp/$f.out.mp4; done