<?php

# https://www.phpied.com/ffmpeg-to-mix-audio-files/
# ffmpeg -i audio.mp3 -i video.avi video_audio_mix.mpg

# https://trac.ffmpeg.org/wiki/Concatenate
# https://ffmpeg.org/ffmpeg-filters.html
# ffmpeg -f concat -safe 0 -i <(for f in ./*.wav; do echo "file '$PWD/$f'"; done) -c copy output.wav

$cmdMix = "ffmpeg ";

// get files array
// http://php.net/manual/en/function.shuffle.php

$arrFiles = glob("gen4/*.wav");
shuffle($arrFiles);
foreach ($arrFiles as $filename) {
    #echo "$filename size " . filesize($filename) . "\n";
    if (rand(1, 10) == 2) {
        $cmdMix .= " -i '{$filename}' ";
    }
}

#$cmdMix .= "  -filter_complex \"[0:0][1:0] amix=inputs=3:duration=longest:dropout_transition=3\"" ;
#$cmdMix .= "  -filter_complex \"[0:0][1:0] amix=inputs=3:duration=longest\" ";
#$cmdMix .= "  -filter_complex amix=inputs=3:duration=first:dropout_transition=3 ";
#$cmdMix .= "  -filter_complex amix=inputs=5:duration=longest:dropout_transition=2 ";
#$cmdMix .= " -filter_complex amix=inputs=3:duration=first:dropout_transition=2100,adelay=0,dynaudnorm=s=3:r=0.6:p=0.5,volume=2 ";
#$cmdMix .= " -filter_complex [aud11][aud12]amix=inputs=3:duration=first:dropout_transition=0,loudnorm ";

$cmdMix .= " -filter_complex amix=inputs=3:duration=first:dropout_transition=0,";
$cmdMix .= "dynaudnorm=f=10:g=131:p=0.82:m=50.0:r=0.9:s=0.0,";
#$cmdMix .= "equalizer=f=1000:t=h:width=200:g=-10,crystalizer=5.0,";
#$cmdMix .= "acrossfade=d=10:c1=exp:c2=exp,";
$cmdMix .= "atrim=end=3,aphaser=speed=0.85:decay=0.1,volume=4  ";

/*
f -frame length in milliseconds from 10 to 8000
g - Gaussian filter  from 3 to 301
p - target peak value default value is 0.95
m - maximum gain factor. 1.0 to 100.0.
r - RMS. In range from 0.0 to 1.0. Default is 0.0 - disabled.
n - Enable channels coupling By default is enabled
c - Enable DC bias correction. -1.0 to 1.0 range
b - Enable alternative boundary mode
s - Set the compress factor. In range from 0.0 to 30.0.

Attenuate 10 dB at 1000 Hz, with a bandwidth of 200 Hz:
equalizer=f=1000:t=h:width=200:g=-10
Apply 2 dB gain at 1000 Hz with Q 1 and attenuate 5 dB at 100 Hz with Q 2:
equalizer=f=1000:t=q:w=1:g=2,equalizer=f=100:t=q:w=2:g=-5

Take the first 5 seconds of a clip, and reverse it.
atrim=end=5,areverse

Cross fade from one input to another:
ffmpeg -i first.flac -i second.flac -filter_complex acrossfade=d=10:c1=exp:c2=exp output.flac
Cross fade from one input to another but without overlapping:
ffmpeg -i first.flac -i second.flac -filter_complex acrossfade=d=10:o=0:c1=exp:c2=exp output.flac

chorus=0.7:0.9:55:0.4:0.25:2

setpts=0.5*PTS double the speed
setpts=0.25*PTS speed up (4x) video
setpts=2.0*PTS slow down
-filter:v setpts=4.0*PTS
 */

$cmdMix .= " -filter:v setpts=4.0*PTS -vcodec copy -y  output_" . date("YmdHis") . ".wav";
echo $cmdMix;

#shell_exec($cmdMix);
exec($cmdMix, $out);
print_r($out);

# https://music.tutsplus.com/articles/12-places-you-can-download-quality-edm-samples-for-free--audio-20765

# http://www.mediafire.com/file/7y6ytqj9uaqkc7y/HTMEM-Sound-FX-Pack-Vol1.zip
# https://howtomakeelectronicmusic.com/32-free-sound-fx-samples/

# https://www.musicradar.com/news/tech/sampleradar-429-free-upfront-house-percussion-samples-360922
# https://www.musicradar.com/news/tech/sampleradar-161-free-stadium-house-samples-571813
# https://www.musicradar.com/news/tech/sampleradar-330-free-retro-house-samples-637779
# https://www.musicradar.com/news/tech/sampleradar-326-free-jackin-house-samples-560360
# https://www.musicradar.com/news/tech/sampleradar-235-free-80s-heat-samples-628852
# https://www.musicradar.com/news/tech/sampleradar-189-free-french-house-samples-627128

/*
https://www.wavealchemy.co.uk/evolve/pid184/

https://freesound.org/people/jobro/sounds/39148/
https://freesound.org/people/HerbertBoland/sounds/29699/
https://freesound.org/people/casualsamples/sounds/63391/
https://freesound.org/people/staticpony1/sounds/253597/
https://freesound.org/people/Stereo%20Surgeon/sounds/265675/
https://freesound.org/people/ChrisButler99/sounds/367972/
https://freesound.org/people/casualsamples/sounds/63392/
https://freesound.org/people/nabz871/sounds/260250/
https://freesound.org/people/Jagadamba/sounds/254404/
https://freesound.org/people/Mattc90/sounds/264285/
https://freesound.org/people/Bitbeast/sounds/274512/
https://freesound.org/people/ChrisButler99/sounds/367976/
https://freesound.org/people/casualsamples/sounds/63393/
https://freesound.org/people/PanxoZerok/sounds/441577/
https://freesound.org/people/Harha/sounds/208083/
https://freesound.org/people/SouthernUK/sounds/219164/
https://freesound.org/people/Jedo/sounds/397005/
https://freesound.org/people/YellowTree/sounds/431632/
https://freesound.org/people/ScreamStudio/sounds/410149/
https://freesound.org/people/IanStarGem/sounds/275224/
https://freesound.org/people/ChrisAbaz/sounds/430827/
https://freesound.org/people/SSS_Samples/sounds/434128/
https://freesound.org/people/Chameon/sounds/413423/
https://freesound.org/people/Santiaro99/sounds/429907/
https://freesound.org/people/gunnbladez/sounds/106815/
https://freesound.org/people/LovelyFriendAli/sounds/411614/
https://freesound.org/people/owowowwo/sounds/198100/
https://freesound.org/people/rossgalloway/sounds/176001/
https://freesound.org/people/IanStarGem/sounds/271078/
https://freesound.org/people/waveplay_old/sounds/245257/
https://freesound.org/people/medetix/sounds/177912/
https://freesound.org/people/InSintesi/sounds/348053/
https://freesound.org/people/SSS_Samples/sounds/430919/
https://freesound.org/people/InSintesi/sounds/383927/
https://freesound.org/people/Tom8Music/sounds/392630/
https://freesound.org/people/IanStarGem/sounds/271077/
https://freesound.org/people/SSS_Samples/sounds/431594/
 */