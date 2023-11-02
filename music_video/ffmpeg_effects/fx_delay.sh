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





##########################################
# delay
##########################################

#https://superuser.com/questions/982342/in-ffmpeg-how-to-delay-only-the-audio-of-a-mp4-video-without-converting-the-au
#https://stackoverflow.com/questions/52446539/how-to-add-offset-or-delay-to-audio-file-with-ffmpeg
#https://superuser.com/questions/1719361/combining-two-audio-files-and-introducing-an-offset-with-ffmpeg
#https://superuser.com/questions/1713053/mixing-audio-into-video-and-adjusting-volume

#delay video by 3.84 seconds, use a command like this:
ffmpeg -i "movie.mp4" -itsoffset 3.84 -i "movie.mp4" -map 1:v -map 0:a -c copy "movie-video-delayed.mp4"

#delay audio by 3.84 seconds, use a command like this:
ffmpeg -i "movie.mp4" -itsoffset 3.84 -i "movie.mp4" -map 0:v -map 1:a -c copy "movie-audio-delayed.mp4"

#ffmpeg -i 3.mp3 -af adelay=100000|100000 delayed.mp3

#2 tracks
ffmpeg -i p0.wav -i p1.wav \
  -filter_complex   "aevalsrc=0:d=2[s1];[s1][1:a]concat=n=2:v=0:a=1[ac2];[0:a]apad[ac1];[ac1][ac2]amerge=2[a]" -map "[a]"  \
  output.m4a

# adjust volume
#!/bin/sh
ffmpeg -i vid.mp4 \
    -i aud.mp3 \
    -filter_complex \
    "[0:a]volume=0.18[a0]; [1:a]volume=1.98[a1]; [a0][a1]amerge=inputs=2[a]" \
    -map 0:v -map "[a]" -c:v copy -c:a mp3 -shortest \
    vid--voice-over--mix--volume.mp4

