#!/bin/bash

ffmpeg -v warning -video_size 2560x1600 -framerate 30 -f x11grab -i :0.0 -f alsa -ac 2 -ar 44100 -i default -probesize 42M -preset ultrafast -pix_fmt yuv420p -vcodec libx264  myvid_$(date +%s).mp4
