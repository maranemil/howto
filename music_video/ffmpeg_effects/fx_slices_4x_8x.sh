######################################
# FFMPEG Slice FX - Random Videos from pexels.com
######################################

######################################
# Slicebox 4x
######################################
ffmpeg -i video1.mp4 -i video2.mp4  -i video3.mp4  -i video4.mp4  -filter_complex "[0]scale=1920:1080,format=rgba[v1];  [1]scale=-1:1080,crop=480:1080[v2]; [2]scale=-1:1080, crop=480:1080[v3]; [3]scale=-1:1080,crop=480:1080[v4];   [v1][v2]overlay=0:0[out1]; [out1][v3]overlay=480:0 [out2]; [out2][v4]overlay=960:0[out3];[out3][v]overlay=1440:0[out]" -shortest -map [out] -t 5 -y output.mp4


# add saturation and slow motion
ffmpeg -i output.mp4 -vf "eq=saturation=1.6,setpts=2.0*PTS" -y output2.mp4

exit

######################################
# Slicebox 8x
######################################
ffmpeg -i video1.mp4 -i video2.mp4 -i video3.mp4 -i video4.mp4 -i video5.mp4 -i video6.mp4 -i video7.mp4 -i video8.mp4 -filter_complex "[0]scale=1920:1080,format=rgba[v1]; [1]scale=-1:1080,crop=240:1080[v2]; [2]scale=-1:1080,crop=240:1080[v3]; [3]scale=-1:1080,crop=240:1080[v4]; [4]scale=-1:1080,crop=240:1080[v5]; [5]scale=-1:1080,crop=240:1080[v6]; [6]scale=-1:1080,crop=240:1080[v7]; [7]scale=-1:1080,crop=240:1080[v8]; [v1][v2]overlay=0:0[out1]; [out1][v3]overlay=240:0[out2]; [out2][v4]overlay=480:0[out3]; [out3][v5]overlay=720:0[out4]; [out4][v6]overlay=960:0[out5]; [out5][v7]overlay=1200:0[out6]; [out6][v8]overlay=1440:0[out]" -map [out] -y output.mp4

# add saturation and slow motion
ffmpeg -i output.mp4 -vf "eq=saturation=1.6,setpts=2.0*PTS" -y output2.mp4

# cut
ffmpeg -i output2.mp4 -t 20 -y output3.mp4