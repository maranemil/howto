#!/bin/sh

# test video pattern output
ffplay -y -f lavfi -i testsrc=duration=5:size=1920x1080:rate=30

# test video pattern output cropped with pixels
ffplay -f lavfi testsrc2 -vf perspective=0:W:0:0:H:W:H:0:0:0,scale=1440:1080,crop=1200:720