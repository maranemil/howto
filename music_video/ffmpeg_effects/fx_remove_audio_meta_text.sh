#############################################################################
# ffmpeg remove comments
#############################################################################

# https://superuser.com/questions/441361/strip-metadata-from-all-formats-with-ffmpeg

ffmpeg -i in.wav -map_metadata -1 -c:v copy -c:a copy out.wav

# ffmpeg -y -i "test.mkv" -c copy -map_metadata -1 -metadata title="My Title" \
# -metadata creation_time=2016-09-20T21:30:00 -map_chapters -1 "test.mkv"


