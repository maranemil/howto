#!/bin/sh

ffmpeg -f rawvideo -vcodec rawvideo -s 1920x1080 -r 25 -pix_fmt yuv420p -i GOPR0187cut2.mp4 -c:v libx264 -preset ultrafast -qp 0 output.mp4

ffplay -f rawvideo -vcodec rawvideo -video_size 1920x1080  -pixel_format yuv420p -i GOPR0187cut2.mp4  -preset ultrafast -qp 0