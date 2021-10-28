#!/bin/sh

#-----------------------------------------------------------
#   Loop same file
#-----------------------------------------------------------

ffplay -i out.mp4 -vf "loop=5:size=25:start=1" -t 10
ffplay -i out.mp4 -af 'atrim=5:duration=1,aloop=2:size=8*48000' -t 7
ffplay -i out.wav -af 'atrim=5:duration=1,aloop=2:size=8*48000' -t 7

ffmpeg -i out.wav -t 2 -ss 00:00:06 -f wav - | ffplay -

# mix x2 audios
ffmpeg -i out.wav -i out.wav  -filter_complex "[0:a]atrim=5:duration=1,aloop=1:size=8*48000[out1];[1:a]atrim=9:duration=1,aloop=1:size=8*48000[out2];[out1][out2]amerge=inputs=2[a]" -map "[a]" -f wav -  | ffplay -

# concat random x3
ffmpeg -i out.wav -i out.wav -i out.wav -filter_complex "[0:0]atrim=5:duration=1,aloop=1:size=44*48000[out1];[1:0]atrim=1:duration=1,aloop=0:size=8*48000[out2];[2:0]atrim=22:duration=1,aloop=1:size=8*48000[out3];[out1][out2][out3]concat=n=3:v=0:a=1[a]" -map "[a]" -f wav -  | ffplay -

# mix x2 audios
ffmpeg -i out.mp4 -i out.mp4 -filter_complex "[0:a]volume=0.15[oo];[oo][1:a]amerge=inputs=2[a]" -map "[a]" -f wav - | ffplay -
ffmpeg -i out.mp4 -i out.mp4 -filter_complex "[0:a]volume=0.95[oo];[oo][1:a]amerge=inputs=2[a]" -map "[a]" -f wav - | ffplay -

# mix x2 audios panning
ffmpeg -i out.mp4 -i out.mp4 -filter_complex "[0:a]volume=0.95[oo];[oo][1:a]amerge=inputs=2,pan=stereo|c0=FL|c1=FR[a]" -map "[a]" -f wav - | ffplay -
ffmpeg -i out.mp4 -i out.mp4 -filter_complex "[0:a]volume=0.95[oo];[oo][1:a]amerge=inputs=2,pan=stereo|c0=c0|c1=c2[a]" -map "[a]" -f wav - | ffplay -
ffmpeg -i out.mp4 -i out.mp4 -filter_complex "[0:a]volume=2.95[oo];[oo][1:a]amerge=inputs=2,pan=stereo|c0=c2|c1=c0[a]" -map "[a]" -f wav - | ffplay -


#https://trac.ffmpeg.org/wiki/AudioChannelManipulation
