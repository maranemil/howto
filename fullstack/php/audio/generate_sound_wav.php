<?php

// https://stackoverflow.com/questions/28053226/generate-wav-tone-in-php

$freqOfTone = 440;
$sampleRate = 44100;
$samplesCount = 80000;

$amplitude = 0.25 * 32768;
$w = 2 * pi() * $freqOfTone / $sampleRate;

$samples = array();
for ($n = 0; $n < $samplesCount; $n++) {
    $samples[] = (int)($amplitude * sin($n * $w));
}

$srate = 44100; //sample rate
$bps = 16; //bits per sample
$Bps = $bps / 8; //bytes per sample /// I EDITED

$str = call_user_func_array("pack",
    array_merge(array("VVVVVvvVVvvVVv*"),
        array( //header
            0x46464952, //RIFF
            160038, //File size
            0x45564157, //WAVE
            0x20746d66, //"fmt " (chunk)
            16, //chunk size
            1, //compression
            1, //nchannels
            $srate, //sample rate
            $Bps * $srate, //bytes/second
            $Bps, //block align
            $bps, //bits/sample
            0x61746164, //"data"
            160000, //chunk size
        ),
        $samples //data
    )
);
$myfile = fopen("sine.wav", "wb") or die("Unable to open file!");
fwrite($myfile, $str);
fclose($myfile);

# ------------------------------------------------------------------------------------
# https://github.com/dvictor/php-wave
# apt-get install lame
# Usage:

$song = array(1000, 1500, 1200);
$duration = .3;

$wav = new Wave(44100);
for ($i = 0; $i < count($song); $i++) {
    $wav->addTone($song[$i], $duration);
}

header('X-Debug-info: ' . join(',', $song));
$wav->outMp3();

# ------------------------------------------------------------------------------------
# Fixed bit rate 128kbps encoding:
# lame sample.wav sample.mp3
#
# Fixed bit rate jstereo 128kbps encoding, high quality (recommended):
# lame -h sample.wav sample.mp3
#
# Average bit rate 112kbps encoding:
# lame --abr 112 sample.wav sample.mp3
#
# Fast encode, low quality (no psycho-acoustics):
# lame -f sample.wav sample.mp3
#
# Variable bitrate (use -V n to adjust quality/filesize):
# lame -h -V 6 sample.wav sample.mp3

# ------------------------------------------------------------------------------------
# Create image for WAV file: Draw a graph of the sound of a WAV file
# https://www.phpclasses.org/package/5365-PHP-Draw-a-graph-of-the-sound-of-a-WAV-file.html
#
# WavEdit: Manipulate audio files in the WAV format
# https://www.phpclasses.org/package/2608-PHP-Manipulate-audio-files-in-the-WAV-format.html
#
# http://mydons.com/drawing-easy-wave-graph-for-wave-audio-file-with-php/
# https://github.com/afreiday/php-waveform-png

# ------------------------------------------------------------------------------------

/**
 * Generate a sine waveform.
 *
 * @param float $frequency
 * @param float $volume Percentage in volume (.5 for 50%)
 * @param float $seconds
 * @throws OutOfRangeException Volume out of range
 */
//function synthesizeSine($frequency, $volume, $seconds)
//{
//    $b = pow(2, $this->bits_per_sample) / 2;
//    for ($i = 0; $i < $seconds * $this->sample_rate; $i++) {
//        // Add a sample for each channel
//        $this->output .= str_repeat(
//            $this->encodeSample(
//                $volume * $b * // <- amplitude
//                sin(2 * M_PI * $i * $frequency / $this->sample_rate)
//            ),
//            $this->channels);
//        $this->sample_count++;
//    }
//}

# https://github.com/sk89q/wavforge/blob/f50953d0accf11cc26207086d50136f93634a830/src/WavForge.php#L266
# https://github.com/sk89q/wavforge/blob/f50953d0accf11cc26207086d50136f93634a830/src/WavForge.php#L266
# https://github.com/sk89q/WavForge
# http://www.techrepublic.com/article/create-an-audio-stitching-tool-in-php/
# http://www.phillipweb.com/Jan05/wavstitch.zip

###################################################################
#
#   Generate wav tone in PHP - Stack Overflow
#   https://stackoverflow.com/questions/28053226/generate-wav-tone-in-php
#
###################################################################

$freqOfTone = 240; // tone
$sampleRate = 44100; // rate
$samplesCount = 40000; // length

$amplitude = 0.25 * 32768;
$w = 2 * pi() * $freqOfTone / $sampleRate;

$samples = array();
for ($n = 0; $n < $samplesCount; $n++) {
    $samples[] = (int)($amplitude * sin($n * $w));
}

$srate = 44100; //sample rate
$bps = 16; //bits per sample
$Bps = $bps / 8; //bytes per sample /// I EDITED

$str = call_user_func_array("pack",
    array_merge(array("VVVVVvvVVvvVVv*"),
        array( //header
            0x46464952, //RIFF
            160038, //File size
            0x45564157, //WAVE
            0x20746d66, //"fmt " (chunk)
            16, //chunk size
            1, //compression
            1, //nchannels
            $srate, //sample rate
            $Bps * $srate, //bytes/second
            $Bps, //block align
            $bps, //bits/sample
            0x61746164, //"data"
            160000, //chunk size
        ),
        $samples //data
    )
);
$myfile = fopen("sine.wav", "wb") or die("Unable to open file!");
fwrite($myfile, $str);
fclose($myfile);

/*

http://www.python-exemplary.com/drucken.php?inhalt_mitte=raspi/en/sound.inc.php
https://pythonbasics.org/python-play-sound/
https://guzalexander.com/2012/08/17/playing-a-sound-with-python.html
https://docs.scipy.org/doc/numpy/reference/generated/numpy.array.html
https://stackoverflow.com/questions/10357992/how-to-generate-audio-from-a-numpy-array
https://www.tutorialspoint.com/execute_python_online.php
http://www.python-exemplary.com/index_en.php?inhalt_links=navigation_en.inc.php&inhalt_mitte=raspi/en/sound.inc.php

sudo apt-get install sox
sudo apt-get install libsox-fmt-mp3

#!/usr/bin/env python

# Sound2a.py
from soundplayer import SoundPlayer
import time
# Sine tone during 0.1 s, blocking, device 0
dev = 0
SoundPlayer.playTone(900, 0.1, True, dev) # 900 Hz
SoundPlayer.playTone(800, 0.1, True, dev) # 600 Hz
SoundPlayer.playTone(600, 0.1, True, dev) # 600 Hz
time.sleep(1)
SoundPlayer.playTone([900, 800, 600], 5, True, dev) # 3 tones together
print "done"

# pip install playsound
from playsound import playsound
playsound('audio.mp3')

from pydub import AudioSegment
from pydub.playback import play
song = AudioSegment.from_wav("sound.wav")
play(song)

from Tkinter import *
import tkSnack
root = Tk()
tkSnack.initializeSnack(root)
snd = tkSnack.Sound()
snd.read('sound.wav')
snd.play(blocking=1)

# apt install mpg123
import os
file = "file.mp3"
os.system("mpg123 " + file)

pygame.mixer.init()
pygame.mixer.music.load("file.mp3")
pygame.mixer.music.play()

# pip install simpleaudio
import simpleaudio as sa
wave_obj = sa.WaveObject.from_wave_file("path/to/file.wav")
play_obj = wave_obj.play()
play_obj.wait_done()

pip install sounddevice --user
import sounddevice as sd
import numpy as np
myarray = np.array([1, 2, 3])
sd.default.samplerate = 44100
sd.default.device = 'digital output'
sd.play(myarray)

# playNote.py
# Demonstrates how to play a single note.
from music import *   # import music library
note = Note(C4, HN)   # create a middle C half note
Play.midi(note)       # and play it!

import numpy as np
from scipy.io.wavfile import write
data = np.random.uniform(-1,1,44100) # 44100 random samples between -1 and 1
scaled = np.int16(data/np.max(np.abs(data)) * 32767)
write('test.wav', 44100, scaled)

import numpy as np
import sounddevice as sd
fs = 44100
data = np.random.uniform(-1, 1, fs)
sd.play(data, fs)

import numpy as np
import scikits.audiolab
data = np.random.uniform(-1,1,44100)
# write array to file:
scikits.audiolab.wavwrite(data, 'test.wav', fs=44100, enc='pcm16')
# play the array:
scikits.audiolab.play(data, fs=44100)

import numpy as np
import sounddevice as sd
sd.default.samplerate = 44100
time = 2.0
frequency = 440
# Generate time of samples between 0 and two seconds
samples = np.arange(44100 * time) / 44100.0
# Recall that a sinusoidal wave of frequency f has formula w(t) = A*sin(2*pi*f*t)
wave = 10000 * np.sin(2 * np.pi * frequency * samples)
# Convert it to wav format (16 bits)
wav_wave = np.array(wave, dtype=np.int16)
sd.play(wav_wave, blocking=True)

 */
