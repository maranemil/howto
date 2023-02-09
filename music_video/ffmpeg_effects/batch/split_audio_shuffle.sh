#################################################
# wav shuffle with pitch
#################################################

# https://trac.ffmpeg.org/wiki/audio%20types
# https://gist.github.com/whizkydee/804d7e290f46c73f55a84db8a8936d74
# https://stackoverflow.com/questions/7333232/how-to-concatenate-two-mp4-files-using-ffmpeg
# https://code.luasoftware.com/tutorials/linux/select-random-files-from-directory-bash
# https://www.howtoforge.de/anleitung/linux-shuf-befehl/
# https://www.geeksforgeeks.org/shuf-command-in-linux-with-examples/


ffmpeg -i in.wav -acodec pcm_s16le -ac 1 -ar 8000  out.wav
# ffmpeg -i in.wav -acodec pcm_s16le -ac 1 -ar 4000  out.wav
# ffmpeg -i in.wav -map_channel 0.0.0 -c:v copy mono.mp4


# sudo apt install rubberband-cli -y
# rubberband -c $(shuf -i0-3 -n1)  -t $(shuf -i0-2 -n1)  -T $(shuf -i0-2 -n1)   -p $(shuf -i0-8 -n1) mono.wav monor.wav

for i in {1..9}; do rubberband -c $(shuf -i0-3 -n1)  -t $(shuf -i0-2 -n1)  -T $(shuf -i0-2 -n1)   -p $(shuf -i0-8 -n1) out.wav mono_$i.wav ;done

# for i in mono_*.wav; do echo $i; done

for i in mono_*.wav; do ffmpeg -i "$i" -t 1 -y stereo_"$i"; done

rm list.txt && (for i in stereo*.wav; do echo file $i >> list.txt; done) && ffmpeg -safe 0 -f concat -i list.txt -c copy output_$(date +%s).wav