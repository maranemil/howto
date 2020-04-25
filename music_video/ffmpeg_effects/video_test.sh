#!/bin/sh

ffmpeg -y -f lavfi -i testsrc=duration=5:size=1920x1080:rate=30 testsrc.mp4