
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
# test pitch
################################################################################

RANDX=00:00:$(shuf -i10-59 -n1) && echo $RANDX && for i in {1..95..5}; do ffplay -hide_banner -loglevel error -i fumix_255_LMMSPianoEditCutMixFinal.wav -ss $RANDX  -t 1.78 -loop 2 -af 'aecho=0.2:0.98:8:0.99,afreqshift=shift=-'$i',volume=volume=3dB' -autoexit -ac 1 && echo $i && sleep 1; done




# Audacity mix channels
# open original + set volume +10db / or +7db
# clone original + make mono + invert + set +3db / or -3db