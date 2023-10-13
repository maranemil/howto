
########################################################
random loop batch
########################################################
https://linux.die.net/man/1/ffplay
https://ffmpeg.org/ffplay.html

mkdir -p conv && for i in *.*; do ffmpeg -i $i conv/$i.wav; done
for i in *.*; do ffplay -i $i -ss 00:00:20 -t 1 -loop 1 -autoexit; done
for i in *.*; do ffplay -i $i -ss 00:00:20 -t 1 -loop 4 -autoexit -ac 1; done #
for i in *.*; do ffplay -i $i -ss 00:00:53 -t 1 -loop 4 -autoexit -ac 1; done #
for i in *.*; do ffplay -i $i -ss 00:00:40 -t 1 -loop 4 -autoexit -ac 1; done #

echo $(( ( RANDOM % 59 )
shuf -i1-10 -n1
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -autoexit -ac 1; done
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -autoexit -ac 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=+54' -autoexit -ac 1; done
00:00:49
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=+154' -autoexit -ac 1; done
00:00:52
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=-254' -autoexit -ac 1; done
00:00:23
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=-154' -autoexit -ac 1; done
00:01:28
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=-154' -autoexit -ac 1; done
00:01:31
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=+154' -autoexit -ac 1; done
00:01:31
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.88:6:0.9,afreqshift=shift=-54' -autoexit -ac 1; done
00:01:14
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.8:0.98:6:0.99,afreqshift=shift=-5' -autoexit -ac 1; done
00:01:40
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1 -loop 4 -af 'aecho=0.2:0.98:6:0.99,afreqshift=shift=-95' -autoexit -ac 1; done
00:01:56 #
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.9 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-145' -autoexit -ac 1; done
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.9 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-145' -autoexit -ac 1; done
00:01:58
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+145' -autoexit -ac 1; done
00:01:53
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+145' -autoexit -ac 1; done
00:01:33
RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+145' -autoexit -ac 1; done
00:01:46

RANDX=00:01:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+145' -autoexit -ac 1; done
00:01:21
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+145' -autoexit -ac 1; done
00:00:55
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+215' -autoexit -ac 1; done
00:00:22
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+215' -autoexit -ac 1; done
00:00:20
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+215' -autoexit -ac 1; done
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-35' -autoexit -ac 1; done
00:00:36
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-53' -autoexit -ac 1; done
00:00:30
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-33' -autoexit -ac 1; done
00:00:20

#################################################

mkdir -p conv && for i in *.*; do ffmpeg -i $i conv/$i.wav; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-133' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.45 -loop 8 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-933' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-133' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=+133' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-133' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.2:0.98:0.2:0.99,afreqshift=shift=+133' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-133,rubberband=432/220' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=+133,rubberband=432/220' -autoexit -ac 1 && sleep 2; done

#################################################

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-133,rubberband=432/220' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 0.89 -loop 4 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-133,rubberband=432/220' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-133,rubberband=432/220' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-83,rubberband=432/220' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=+193,rubberband=432/220,crystalizer=i=5:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=6dB:precision=fixed' -autoexit -ac 1 && sleep 2; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=+53,rubberband=432/220,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 1 && sleep 2; done





#################################################
apply highpass lowpass
#################################################

ffmpeg -filters | grep -i norma

 TSC adenorm           A->A       Remedy denormals by adding extremely low-level noise.
 TSC anlmf             AA->A      Apply Normalized Least-Mean-Fourth algorithm to first audio stream.
 TSC anlms             AA->A      Apply Normalized Least-Mean-Squares algorithm to first audio stream.
 T.C dynaudnorm        A->A       Dynamic Audio Normalizer.
 ... loudnorm          A->A       EBU R128 loudness normalization
 T.C speechnorm        A->A       Speech Normalizer.


for i in {adenorm,dynaudnorm,speechnorm}; do ffmpeg -i output_001_.wav -af $i -y output_001_$i.wav; done

TSC adynamicequalizer A->A       Apply Dynamic Equalization of input audio.
 T.C aexciter          A->A       Enhance high frequency part of audio.
 TS. afftfilt          A->A       Apply arbitrary expressions to samples in frequency domain.
 TSC afreqshift        A->A       Apply frequency shifting to input audio.
 TSC anequalizer       A->N       Apply high-order audio parametric multi band equalizer.
 TSC asubboost         A->A       Boost subwoofer frequencies.
 TSC asubcut           A->A       Cut subwoofer frequencies.
 TSC asupercut         A->A       Cut super frequencies.
 TSC bass              A->A       Boost or cut lower frequencies.
 TSC equalizer         A->A       Apply two-pole peaking equalization (EQ) filter.
 ..C firequalizer      A->A       Finite Impulse Response Equalizer.
 TSC highpass          A->A       Apply a high-pass filter with 3dB point frequency.
 TSC lowpass           A->A       Apply a low-pass filter with 3dB point frequency.
 ... superequalizer    A->A       Apply 18 band equalization filter.
 TSC treble            A->A       Boost or cut upper frequencies.

for i in {highpass,lowpass}; do ffmpeg -i output_001_.wav -af $i,speechnorm -y output_001_$i.wav; done
for i in *.*; do ffmpeg -i $i -af lowpass -y $i.lowpass.wav; done
for i in *.*; do ffmpeg -i $i -af highpass -y $i.highpass.wav; done

# https://superuser.com/questions/323119/how-can-i-normalize-audio-using-ffmpeg
# https://trac.ffmpeg.org/wiki/AudioVolume
# https://stackoverflow.com/questions/64753053/normalizing-audio-in-ffmpeg-how

ffmpeg -i input.wav -filter:a volumedetect -f null /dev/null
ffmpeg -i input.wav -af "volumedetect" -vn -sn -dn -f null /dev/null
ffplay -i a.wav -af "dynaudnorm=p=0.9:s=9,volume=8dB"
ffmpeg -i input.wav -filter:a loudnorm output.wav
ffmpeg-normalize -h