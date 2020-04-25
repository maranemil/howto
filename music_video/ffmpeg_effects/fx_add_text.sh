#!/bin/sh

# add text
ffmpeg -i in1.mp4 -vf drawtext="text='Stack Overflow': fontcolor=white: fontsize=84: box=1: boxcolor=black@0.5: boxborderw=5: x=(w-text_w)/2: y=(h-text_h)/2" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4