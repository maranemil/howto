# batch

mkdir conv && for f in *.mkv; do ffmpeg -i $f -c:v libx265 -c:a copy -vtag hvc1 -threads 1 conv/$f.mp4; done
