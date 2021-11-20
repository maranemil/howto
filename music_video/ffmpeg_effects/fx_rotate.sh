# Rotate 90 clockwise:
# https://stackoverflow.com/questions/3937387/rotating-videos-with-ffmpeg

ffmpeg -i in.mov -vf "transpose=1" out.mov

# For the transpose parameter you can pass:
# 0 = 90Counter CLock wise and Vertical Flip (default)
# 1 = 90Clockwise
# 2 = 90CounterClockwise
# 3 = 90Clockwise and Vertical Flip
# Use -vf "transpose=2,transpose=2" for 180 degrees.