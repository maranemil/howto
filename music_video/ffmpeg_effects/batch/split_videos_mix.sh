#---------------------------------------------
#batch
#---------------------------------------------

ffmpeg -i pexels-ron-lach-7087631.mp4 -c copy -map 0 -segment_time 00:00:02 -f segment -reset_timestamps 1 split/out%03d.mp4
ffmpeg -f concat -safe 0 -i <(for f in split/*[02468].mp4; do echo "file '$PWD/$f'"; done) -c copy -y xoutput1.mp4
ffmpeg -f concat -safe 0 -i <(for f in split/*[13579].mp4; do echo "file '$PWD/$f'"; done) -c copy -y xoutput2.mp4
ffmpeg -f concat -safe 0 -i <(for f in xoutput*.mp4; do echo "file '$PWD/$f'"; done) -c copy -y zoutput.mp4
ffmpeg -stream_loop 5 -i zoutput.mp4 -c copy zoutput2.mp4

# ffmpeg -i "concat:xoutput1.mp4|xoutput2.mp4" -codec copy zoutput.mkv
# ffmpeg -i zoutput.mp4 -i zoutput.mp4 -filter_complex "concat=n=2:v=0:a=1" -vn -y zoutput.mp4



