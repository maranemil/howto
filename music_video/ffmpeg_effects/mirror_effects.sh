#!/bin/sh

ffmpeg -i input.mp4 -vf "crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack" output.mp4