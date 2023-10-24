
################################################################################
# fx loops gen
################################################################################

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.mp3*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-133' -autoexit -ac 1 && sleep 1; done

# 132,66,36
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-66,rubberband=432/220' -autoexit -ac 1 && sleep 1; done

# 132,66,36
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.98:0.2:0.99,afreqshift=shift=-133,rubberband=432/220' -autoexit -ac 1 && sleep 1; done

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-126,rubberband=432/420,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=1dB:precision=fixed' -autoexit -ac 2 && sleep 1; done

# 132,66,36
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=+53,rubberband=432/220,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 1 && sleep 1; done

# fast speed
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=+53,rubberband=432/430,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# low speed
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=+53,rubberband=432/830,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# suprfast
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-253,rubberband=432/1530,rubberband=822/122,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# suprfast
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-253,rubberband=432/1530,rubberband=322/122,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# detune 1
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-53,rubberband=432/830,rubberband=522/832,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# detune 2
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-253,rubberband=432/930,rubberband=422/382,crystalizer=i=2:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# detune 3
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-253,rubberband=432/1530,rubberband=922/522,crystalizer=i=3:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 4 && sleep 1; done

# detune 4
RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in *.wav*; do ffplay -hide_banner -loglevel error -i $i -ss $RANDX  -t 3.58 -loop 2 -af 'aecho=0.1:0.88:0.2:0.94,afreqshift=shift=-123,rubberband=800/432,rubberband=332/582,crystalizer=i=2:c=0,pan=stereo| c0=FL | c1=FR,volume=volume=5dB:precision=fixed' -autoexit -ac 2 && sleep 1; done

touch plist.txt
ls  *.wav >> plist.txt

################################################################################
# split audio by silence all in one
################################################################################

# move each wav to folder
for i in *.*;do echo ${i::-4} && mkdir ${i::-4} && mv $i ${i::-4}; done

# detect segments
ffmpeg -i mpxvm_loops.wav -af silencedetect=d=0.5 -f null - |& awk '/silence_end/ {print $4,$5}'|&awk '/:/ {print $2}' >> segments.txt

# split
varseg=$(tr '\n' ',' < segments.txt) &&  ffmpeg -i mpxvm_loops.wav -f segment -segment_times ${varseg::-1} -reset_timestamps 1 -map 0:a -c:a copy output_%03d.wav

################################################################################
# test pitch single file
################################################################################

for i in {1..130..10}; do ffplay -i in.xm -af afreqshift=shift=-$i,afreqshift=shift=+66 -autoexit -t 3.58 -loop 2  -hide_banner -loglevel error && echo $i; done

for i in {1..130..10}; do ffplay -i in.xm -af afreqshift=shift=+$i,afreqshift=shift=-66 -autoexit -t 3.58 -loop 2  -hide_banner -loglevel error && echo $i; done

for i in {1..2500..200}; do ffplay -i in.xm -af afreqshift=shift=+$i,afreqshift=shift=-2400 -autoexit -t 1.88 -loop 2  -hide_banner -loglevel error && echo $i; done

for i in {2350..2450..10}; do ffplay -i in.xm -af afreqshift=shift=+$i,afreqshift=shift=-2400,rubberband=440/432,rubberband=430/432,volume=volume=5dB -autoexit -t 1.88 -loop 2  -hide_banner -loglevel error && echo $i; done

for i in {16..40..5}; do ffplay -i in.xm -af afreqshift=shift=+$i,afreqshift=shift=-30,rubberband=420/432,rubberband=460/432,volume=volume=7dB,crystalizer=i=3:c=0 -autoexit -t 17 -loop 2  -hide_banner -loglevel error && echo $i; done

for i in {1..2..1}; do ffplay -i in.xm -af afreqshift=shift=-10,rubberband=420/432,rubberband=450/432,volume=volume=7dB,crystalizer=i=3:c=0 -autoexit -t 17 -loop 2  -hide_banner -loglevel error && echo $i; done



################################################################################
# p 2
################################################################################

# detune loop
for i in *.xm; do ffplay -i $i -af afreqshift=shift=+7,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -autoexit -hide_banner -loglevel error && echo $i; done

# detune loop
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-7,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -autoexit -hide_banner -loglevel error && echo $i; done

# detune loop
for i in *.wav; do ffplay -i $i -af afreqshift=shift=-49,afreqshift=shift=+42,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -ss 00:00:00 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

# fx loop wawa
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-577,rubberband=120/432,rubberband=1560/432,volume=volume=7dB,crystalizer=i=7:c=0 -autoexit -t 1.87 -loop 2  -hide_banner -loglevel error && echo $i; done

# fx loop wawa
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-577,rubberband=120/432,rubberband=1560/432,volume=volume=3dB,crystalizer=i=7:c=0,highpass=f=300 -autoexit -t 1.87 -loop 2  -hide_banner -loglevel error && echo $i; done

# detune loop bass short
for i in *.wav; do ffplay -i $i -af afreqshift=shift=-20,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -ss 00:00:14 -t 1.89 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# detune loop bass
for i in *.wav; do ffplay -i $i -af afreqshift=shift=-20,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -ss 00:00:14 -t 3.56 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# pre master mix
for i in *.wav; do ffplay -i $i -af afreqshift=shift=-7,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -ss 00:00:14 -t 3.56 -loop 2 -autoexit -hide_banner -loglevel error -ac 1 && echo $i; done

# detune loop
for i in *.wav; do ffplay -i $i -af afreqshift=shift=-246,volume=volume=3dB,crystalizer=i=5:c=0,highpass=f=30,lowpass=f=6500,rubberband=420/432,rubberband=450/432 -ss 00:00:14 -t 3.56 -loop 2 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

################################################################################
# p 3
################################################################################

# fx loop pitch mix metalic
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-66,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=230/938:tempo=0.99:pitch=13:transients=smooth -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# fx metalic pingpong
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-66,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=230/938:tempo=0.99:pitch=36:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# sf fx low noise movie sound track
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-66,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=230/218:tempo=0.99:pitch=0.1:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# sf fx low noise movie sound track
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-66,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=440/432:tempo=0.99:pitch=0.1:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# dubstep
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=440/1432:tempo=0.29:pitch=52.02:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# dubstep
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=440/2432:tempo=0.39:pitch=52.02:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# dubstep
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=20,lowpass=f=8500,rubberband=440/432:tempo=0.29:pitch=42.02:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error && echo $i; done

# sf fx noise movie sound track
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=10,lowpass=f=8500,rubberband=240/2232:tempo=0.29:pitch=30.22:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

# fx techno
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=10,lowpass=f=8500,rubberband=240/2232:tempo=5.29:pitch=30.22:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

# fx phone
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=10,lowpass=f=8500,rubberband=240/2232:tempo=10.29:pitch=30.22:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

# fx metalic
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-69,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=10,lowpass=f=8500,rubberband=240/2232:tempo=2.29:pitch=30.22:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

# pre master *****
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-9,volume=volume=3dB,crystalizer=i=6:c=0,highpass=f=10,lowpass=f=8500,rubberband=440/432:tempo=0.99:pitch=0.99:transients=crisp -t 3.55 -loop 2 -autoexit -hide_banner -loglevel error -ac 2 && echo $i; done

# pre master sp
for i in *.xm; do ffplay -i $i -af afreqshift=shift=-7,rubberband=420/432,rubberband=460/432,volume=volume=3dB,crystalizer=i=6:c=0 -autoexit -t 17  -hide_banner -loglevel error && echo $i; done




################################################################################
# test pitch
################################################################################

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in {1..95..5}; do ffplay -hide_banner -loglevel error -i in.wav -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-'$i',volume=volume=3dB' -autoexit -ac 1 && echo $i && sleep 1; done



################################################################################
# Audacity mix channels
################################################################################

# open original + set volume +10db / or +7db
# clone original + make mono + invert + set +3db / or -3db