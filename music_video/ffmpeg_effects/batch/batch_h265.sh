# batch h265
mkdir conv && for f in *.mkv; do ffmpeg -i $f -c:v libx265 -c:a copy -vtag hvc1 -threads 1 conv/$f.mp4; done

# h264
mkdir conv && for f in *.mkv; do ffmpeg -i $f -c:a copy -threads 1 conv/$f.mp4; done



# ffmpeg -i in.mkv -vf scale=-1:480 -preset ultrafast -threads 1 out.mp4
# ffmpeg -i in.mkv -vf scale=-1:480 -c:a copy -threads 1 out2.mp4
