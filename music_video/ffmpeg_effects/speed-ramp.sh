#speed-ramp Progressively Accelerate Video with ffmpeg

#https://superuser.com/questions/382483/progressively-accelerate-video-with-ffmpeg
#https://trac.ffmpeg.org/wiki/How%20to%20speed%20up%20/%20slow%20down%20a%20video
#https://stackoverflow.com/questions/61397353/conversion-of-images-to-video-with-variable-fps-using-ffmpeg

ffmpeg -y -i 15.mp4 -filter:v "setpts=(1.5-0.002*N)*PTS" new.mp4
ffmpeg -y -i 15.mp4 -filter:v "setpts=(0.003*N+0.5)*PTS" new.mp4

ffmpeg -start_number 1 -i %03d.tif -vf "settb=1/1000,setpts='if(eq(N,0),0,PREV_OUTPTS+200-189*(min(N,809)/809))'" -vsync vfr -enc_time_base 1/1000 -c:v libx264 -pix_fmt yuv420p output.mp4
