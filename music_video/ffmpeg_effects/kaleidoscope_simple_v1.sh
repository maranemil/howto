#!/bin/sh

ffmpeg -i in.mp4 -vf rotate=PI/6,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=720:460 out.mp4

ffplay -i GOPR0186cr.mp4 -vf rotate=PI/6,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=720:460

ffplay -i GOPR0186cr.mp4 -vf rotate=PI/6,rotate=PI/180,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=320:460

ffmpeg -i GOPR0186cr.mp4 -vf rotate=PI/6,rotate=PI/180,stereo3d=abl:sbsr,stereo3d=sbsl:aybd,"split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2","crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack",scale=720:460 -strict -2 xperimet.mp4