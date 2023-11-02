
# https://superuser.com/questions/1660111/set-ffmpeg-volume-mixer-with-delay-functionality

# 3 mix with adelay
ffmpeg -i test.wav -i test.wav -i test.wav -filter_complex "[1]volume=0.5,adelay=0.1ms:all=1[a1];[2]volume=0.5,adelay=2ms:all=1[a2];[0:a]volume=2[a0];[a0][a1][a2]amix=inputs=3[a]" -map "[a]" -y zoutput.wav


# https://stackoverflow.com/questions/64729433/ffmpeg-how-to-add-volume-to-filter-complex

# 2 mix with highpass lowpass ok
ffmpeg -i test.wav -i test.wav -filter_complex "[0:a]highpass=f=20,lowpass=f=9000,volume=0.4[mic];[1:a]volume=1.9[a1];[mic][a1]amix=duration=shortest[a]" -map "[a]"  -y zoutput2.wav