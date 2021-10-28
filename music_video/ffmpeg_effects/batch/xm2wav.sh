#!/bin/sh

#-----------------------------------------------------------
# Batch converter Files XM to WAV in Ubuntu
#-----------------------------------------------------------

# test if play works else install ffmpeg
# ffplay -i your_track.xm

# convert files from xm to wav
for i in *.xm ; do ffmpeg  -i "$i" "$i".wav; done