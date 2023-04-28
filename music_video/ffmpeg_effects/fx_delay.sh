###########################################################
# delay audio in ffmpeg
###########################################################
# https://superuser.com/questions/982342/in-ffmpeg-how-to-delay-only-the-audio-of-a-mp4-video-without-converting-the-au
# https://www.geekyhacker.com/2020/05/17/synchronize-audio-and-video-with-ffmpeg/


# delay video
ffmpeg -i "movie.mp4" -itsoffset 3.84 -i "movie.mp4" -map 1:v -map 0:a -c copy "movie-video-delayed.mp4"

# delay audio
ffmpeg -i "movie.mp4" -itsoffset 3.84 -i "movie.mp4" -map 0:v -map 1:a -c copy "movie-audio-delayed.mp4"

# examples
ffmpeg -i file.mkv -itsoffset 3 -i file.mkv -c:a copy -c:v copy -map 0:v:0 -map 1:a:0 out.mkv
ffmpeg -i file.mkv -itsoffset 3 -i file.mkv -c:a copy -c:v copy -map 0:a:0 -map 1:v:0 out.mkv
ffmpeg -i file.mkv -itsoffset 00:00:00.300 -i file.mkv -c:a copy -c:v copy -map 0:a:0 -map 1:v:0 out.mkv
