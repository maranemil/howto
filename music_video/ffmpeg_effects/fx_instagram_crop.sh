# crop 1920 into instagram format 608x1080  
ffmpeg -i in.mp4 -vf "crop=608:1080:650:150,eq=saturation=1.9"  -y out1.mp4

#exit

# resize video from 608x1080 to 1080x1920 
ffmpeg -i out1.mp4 -vf scale=1080:1920 -y out2.mp4
  
#replace video sound
ffmpeg -i out2.mp4 -i in.wav -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 -y out3.mp4
