#!/bin/sh

# get 20 sec of video and glitch it!
ffmpeg  -i in.mp4  -lavfi "fps=15,scale=320:-1:flags=lanczos" -crf 24 -t 20  -y out.gif

# break quality
convert out.gif -coalesce +repage -fuzz 60% -delay 4 -loop 0 frames -layers Optimize -quality 40%  out2.gif

# convert back
ffmpeg -i out2.gif out2.mp4

# invert colors
ffmpeg -i out2.mp4 -vf "split [main][tmp]; [tmp] lutrgb="r=negval:g=negval:b=negval" [tmp2]; [main][tmp2] overlay" -s 1280x720 out2.mp4