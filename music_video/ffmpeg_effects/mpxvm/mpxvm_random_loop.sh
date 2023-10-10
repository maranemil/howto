
########################################################
random loop
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


