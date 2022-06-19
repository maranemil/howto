# https://stackoverflow.com/questions/48366665/ffplay-two-videos-mp4-one-display-screen-and-just-a-few-seconds-to-display
# https://codereview.stackexchange.com/questions/117610/ffmpeg-command-line-for-showing-two-videos-side-by-side
# https://ffmpeg.org/pipermail/ffmpeg-user/2018-May/039829.html

ffplay -f lavfi -i "movie=in6.mp4,crop=1280:360:0:0[v0]; movie=in8.mp4,scale=1280:-1,crop=1280:360:0:0[v1]; [v0][v1]vstack"

ffplay -f lavfi -i "movie=in2.mp4,scale=560:-1,crop=480:360:0:0[v0];movie=in4.mp4,scale=560:-1,crop=480:360:0:0[v1];[v0][v1]vstack"

ffplay -v warning -f rawvideo -s 800x400 -i /dev/zero
 -vf 'movie=video1.mkv,scale=400x400 [mv2] ; movie=video2.mkv,scale=400x400 [mv1]; [in][mv1] overlay=0:0 [tmp]; [tmp][mv2] overlay=400:0'

ffmpeg -v warning -i video1.mkv -i video2.mkv -filter_complex '[0:v]scale=400:400,pad=800:400 [0:q]; [1:v]scale=400:400[1:q]; [0:q][1:q]overlay=400:0'
  -f nut -c:v rawvideo -c:a copy - | mplayer -noconsolecontrols -cache-min 1 -cache 1024000 -

ffplay -f lavfi -i "movie='LEFT.mp4',scale=iw/2:ih[v0];movie='RIGHT.mp4',scale=iw/2:ih[v1];[v0][v1]hstack"