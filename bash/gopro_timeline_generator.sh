#!/usr/bin/bash

##############################################
#
#   Video 2 Timeline thumbs Generator
#   GoPro 2 Timeline thumbs Generator
#
##############################################


while getopts d:s:p:h: option
do
 case "${option}"
 in
 d) DEGUB=${OPTARG};;
 s) SCALE=${OPTARG};;
 p) PATHB=${OPTARG};;
 h) HELP=${OPTARG};;
 esac
done

if ["$SCALE" = ""] # if empty
 then
   SCALE=360;
   echo "\033[1;36m  no scale specified! Set by detault to 360  \033[0m "
  # exit
fi

if [ "$DEBUG" = "true" ] # if null but set
 then
  echo "Debug Arguments: " $@
fi

if [ "$HELP" = "true" ]
 then
  echo "\033[1;36m"
  echo "-d DEBUG "
  echo "-s SCALE Ex: 360 "
  echo "-p PATH absolute "
  echo "-h HELP "
  echo "\033[0m"
  echo '---------------------------- \n';
fi

if  [ -z "$PATHB" ] # if empty
 then
   echo "\033[1;36m  no path! exit now! \033[0m ";
   exit
fi

cd $PATHB; # jump to files order
echo $PWD;

# remove temp png
for f in *.png; do rm "$f"; done

# timeline gen x thumbs : -crf 14 -threads 2 -preset ultrafast -pix_fmt yuv420p -strict -2
for f in *.mp4; do ffmpeg -y -ss 13 -i "$f" -vf "select=gt(scene\,0.4)" -frames:v 9 -vsync vfr -vf fps=fps=1/7 -loglevel verbose  -preset ultrafast "${f%}out%03d.jpg"; done

# merge x thumbs
#for f in *.mp4; do ffmpeg -y -pattern_type glob -i "$f*.jpg" -f image2 -filter_complex scale=$SCALE:-1,tile=3x3 "${f%}output.png" ; done
for f in *.mp4; do ffmpeg -y -pattern_type glob -i "$f*.jpg" -f image2 -filter_complex scale=$SCALE:-1,tile=3x3 -loglevel verbose "${f%}output.png" ; done

# remove temp jpg
for f in *.jpg; do rm "$f"; done

# add saturation
for f in *.png; do ffmpeg -y -i "$f" -vf eq=1:0:1.5:1:0:0.1:1:0  -loglevel panic "${f%}.jpg" ; done
# 1:0:1.3:1:1:0.9:1:1
# 1:0:2.9:1:1:1.1:1:1
# 1:0:2.5:1:0:0.1:1:0

# remove temp png
for f in *.png; do rm "$f"; done

# FFMPEG logleves
# { "quiet"  , AV_LOG_QUIET   },
# { "panic"  , AV_LOG_PANIC   },
# { "fatal"  , AV_LOG_FATAL   },
# { "error"  , AV_LOG_ERROR   },
# { "warning", AV_LOG_WARNING },
# { "info"   , AV_LOG_INFO    },
# { "verbose", AV_LOG_VERBOSE },
# { "debug"  , AV_LOG_DEBUG   },
