# overlay mix
ffmpeg -i video1.mp4 -i video2.mp4  -i video3.mp4  -i video4.mp4  -filter_complex "[0]scale=1200:1200,format=rgba[v1];  [1]scale=-1:900,crop=600:600[v2]; [2]scale=-1:800, crop=600:600[v3]; [3]scale=-1:800,crop=600:600[v4];    [v1][v2]overlay=0:H/2[out1]; [out1][v3]overlay=0:0 [out2]; [out2][v4]overlay=600:0[out3];[out3][v]overlay=600:600[out]" -shortest -map [out]  -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf "eq=contrast=1.5:brightness=0.2:saturation=2.3,setpts=2.0*PTS" -y output2.mp4

#add logo
ffmpeg -i output2.mp4 -i bg.png -filter_complex  "[0:v]format=rgba[scaled];  [scaled][1:v]overlay=5:5[out]" -map "[out]"  -c:v libx264 -c:a copy output3.mp4

