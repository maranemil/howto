#! /bin/sh

ffplay -i load/in.wav -af "

aphaser=in_gain=0.8:out_gain=0.6:delay=0.05:decay=0.715:speed=0.25,
chorus=in_gain=0.8:out_gain=0.6:delays=1.26:decays=0.5:speeds=0.25:depths=15,

aecho=in_gain=0.8:out_gain=0.7:delays=228.5:decays=0.379,
stereowiden=delay=1.052:drymix=0.5:crossfeed=0.65:feedback=0.23,
adelay='1.75|0',
extrastereo=m=0.95,
rubberband=pitch=0.72:tempo=0.97

"

# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/vibrato.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/extrastereo.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/flanger.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/aphaser.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/chorus.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/aecho.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/adelay.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/stereotools.html
# https://hhsprings.bitbucket.io/docs/programming/examples/ffmpeg/manipulating_audio/stereowiden.html






