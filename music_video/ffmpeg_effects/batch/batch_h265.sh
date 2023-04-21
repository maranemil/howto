# batch h265
mkdir conv && for f in *.mkv; do ffmpeg -i $f -c:v libx265 -c:a copy -vtag hvc1 -threads 1 conv/$f.mp4; done
# h264
mkdir conv && for f in *.mkv; do ffmpeg -i $f -c:a copy -threads 1 conv/$f.mp4; done

# ffmpeg -i in.mkv -vf scale=-1:480 -preset ultrafast -threads 1 out.mp4
# ffmpeg -i in.mkv -vf scale=-1:480 -c:a copy -threads 1 out2.mp4

# https://superuser.com/questions/564402/explanation-of-x264-tune
# https://trac.ffmpeg.org/wiki/Encode/H.264

mkdir exp && for f in *.*; do ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2,2:tune=fastdecode:preset=superfast -y exp/$f.mp4; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -c:a copy -tune fastdecode -preset superfast -threads 2 exp/$f.mp4; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -c:a copy -tune film -preset superfast -threads 2 exp/$f.mp4; done


#sudo apt-get install ubuntu-restricted-extras # h264 divx video codec
#sudo apt-get install ubuntu-restricted-addons ubuntu-restricted-extras
#sudo apt-get install libxvidcore4 gstreamer1.0-plugins-base gstreamer1.0-plugins-good gstreamer1.0-plugins-ugly gstreamer1.0-plugins-bad gstreamer1.0-alsa gstreamer1.0-fluendo-mp3 gstreamer1.0-libav

sudo apt-get install libquicktime2
sudo apt-get install vlc
sudo apt-get install ubuntu-restricted-extras # h264 video codec
sudo apt install rename
rename 's/ /_/g' *

mkdir exp && for f in *.*; do ffmpeg -i $f -c:v libx265 -c:a copy -x265-params pools=2,2:tune=fastdecode:preset=superfast -y exp/$f.mp4; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -c:a copy -tune fastdecode -preset superfast -threads 2 exp/$f.mp4; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -c:a copy -tune film -preset superfast -threads 2 exp/$f.mp4; done
mkdir exp && for f in *.*; do ffmpeg -y -i $f -c:v libx264 -c:a copy -tune fastdecode -preset veryfast -threads 1 exp/$f.mp4; done
