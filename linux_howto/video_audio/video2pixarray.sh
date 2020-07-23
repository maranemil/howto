#!/bin/bash

################################################################################
# Create a 'Frame-Averaged Pixel Array' of a given video. Works by reducing
# each frame to a single pixel, and appending all frames into single image.
# - Takes: $1=Filename [$2=width]
# - Requires: ffmpeg + ffprobe
#   ver. 1.1 - 10th November, 2015
# source: https://oioiiooixiii.blogspot.com
# http://oioiiooixiii.blogspot.com/2018/09/ffmpeg-fapa-frame-averaged-pixel-array.html
# download: video2pixarray.sh
###############################################################################

width="${2:-640}" # If no width given, set as 640
duration="$(ffprobe "$1" 2>&1 \
            | grep Duration \
            | awk  '{ print $2 }')"
seconds="$(echo $duration \
           | awk -F: '{ print ($1 * 3600) + ($2 * 60) + $3 }' \
           | cut -d '.' -f 1)"
fps="$(ffprobe "$1" 2>&1 \
       | sed -n 's/.*, \(.*\) fps,.*/\1/p' \
       | awk '{printf("%d\n",$1 + 0.5)}')"
frames="$(( seconds*fps ))"
height="$(( frames/width ))"
filters="tile=${width}x${height}"

clear
printf "$(pwd)/$1
___Duration: ${duration::-1}
____Seconds: $seconds
________FPS: $fps
_____Frames: $frames
_____Height: $height
____Filters: $filters\n"

# First instance of FFmpeg traverses the frames, the second concatenates them.
ffmpeg \
   -y \
   -i "$1" \
   -vf "scale=1:1" \
   -c:v png \
   -f image2pipe pipe:1 \
   -loglevel quiet \
   -stats \
| ffmpeg \
    -y \
    -i pipe:0 \
    -vf "$filters" \
    -loglevel quiet \
    "${1%.*}_$width".png

################################ NOTES #######################################

# Single line solution, but doesn't show progress
# ffmpeg -i "$1" -frames 1 -vf "$filters" "${1%.*}".png -y
# filters="scale=1:1,tile=${width}x${height}" # Used with single line version
# View ingest progress using: pv "$1" | piped to ffmpeg
# download: video2pixarray.sh