#!/bin/sh

# instagram vintage color fx
ffmpeg -i in1.mp4 -vf "curves=vintage" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4




# touch inputs.txt
# file a.mp4
# file b.mp4

## ffmpeg -i in.mp4 -vf scale=-1:1080 -an out.mp4
## ffmpeg -i out.mp4 -vf "crop=608:1080:270:150,eq=saturation=1.9" out2.mp4

# ffmpeg -f concat -i inputs.txt -c copy output.mp4
# ffmpeg -i output.mp4 -i vst2.wav -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 output2.mp4
# ffmpeg -i output2.mp4 -t 45 output3.mp4