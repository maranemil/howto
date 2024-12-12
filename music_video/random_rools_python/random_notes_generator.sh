###########################################################
random notes generator
###########################################################

# C1	32.703 Hz
# C2	65.406 Hz
# C3	130.813 Hz
# C4	261.626 Hz
# C5	523.251 Hz
# C6	1046.502 Hz
# C7	2093.005 Hz
# C8	4186.009 Hz

# Take the Note (C5 / 10 min long) and push it up and down in a random order. OR
# Take the Note (C5 / 5 sec long) and replicate it again and again but in higher / lower notes and put them together.


# https://superuser.com/questions/571463/how-do-i-append-a-bunch-of-wav-files-while-retaining-not-zero-padded-numeric
# https://stackoverflow.com/questions/8880603/loop-through-an-array-of-strings-in-bash
# https://stackoverflow.com/questions/2388488/select-a-random-item-from-an-array-in-bash
# https://stackoverflow.com/questions/13111967/raise-to-the-power-in-shell
# https://stackoverflow.com/questions/12722095/how-do-i-use-floating-point-arithmetic-in-bash
# https://ptolemy.berkeley.edu/eecs20/week8/scale.html
# https://www.shell-tips.com/bash/math-arithmetic-calculation/#gsc.tab=0
# https://chatopenai.de/
# https://samplab.com/audio-to-midi


## declare an array variable
#declare -a arr=("32.703" "65.406" "130.813" "261.626" "523.251" "1046.502" "2093.005")

# arr[0]="65.406"
# arr[1]="130.813"
# arr[2]="261.626"
# arr[3]="523.251"
# arr[4]="1046.502"

m=33

for ((i=1; i<m; i++));
    do
    fr=$(echo "440 * 2 * $i/12"  | bc)
    echo $fr
    arr[$i]=$fr
 done

## now loop through the above array
for i in "${arr[@]}"
do
    # echo "$i"
    rand=$[$RANDOM % ${#arr[@]}]
    random_note=${arr[$rand]}
    echo "$random_note"

   sleep 0.51
   # or do whatever with individual element of the array
   ffmpeg -f lavfi -i "sine=frequency="$random_note":duration=1" -loglevel quiet -stats -y test__$(date +%s).wav
done

# https://wiki.ubuntuusers.de/SoX/
# sudo apt-get install sox
sox $(ls *.wav | sort -n) out_$(date +%s).ogg
rm *.wav