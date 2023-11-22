# record video mix screen + webcam
ffmpeg -video_size 1920x1080 \
    -f x11grab -i :1.0  -f pulse -ac 2 -ar 44100 -i alsa_output.pci-0000_00_1f.3.analog-stereo.monitor -framerate 30 \
    -f v4l2 -i /dev/video0 -framerate 30 \
    -filter_complex "[2]scale=160:90[inner];[0][inner]overlay=0:0:shortest=1[out]" \
     -map "[out]" \
        -y output.mp4

# record audio
ffmpeg -f alsa -i default  -ar 44100 -ac 2 -acodec pcm_s16le -y out.wav
