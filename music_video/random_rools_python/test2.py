import math        #import needed modules
import pyaudio     #sudo apt-get install python-pyaudio

PyAudio = pyaudio.PyAudio     #initialize pyaudio


# https://stackoverflow.com/questions/9770073/sound-generation-synthesis-with-python

#See https://en.wikipedia.org/wiki/Bit_rate#Audio
BITRATE = 16000     #number of frames per second/frameset.

FREQUENCY = 500     #Hz, waves per second, 261.63=C4-note.
LENGTH = 1     #seconds to play sound

BITRATE = max(BITRATE, FREQUENCY+100)

NUMBEROFFRAMES = int(BITRATE * LENGTH)
RESTFRAMES = NUMBEROFFRAMES % BITRATE
WAVEDATA = ''

#generating wawes
for x in xrange(NUMBEROFFRAMES):
 WAVEDATA = WAVEDATA+chr(int(math.sin(x/((BITRATE/FREQUENCY)/math.pi))*127+128))

for x in xrange(RESTFRAMES):
 WAVEDATA = WAVEDATA+chr(128)

p = PyAudio()
stream = p.open(format = p.get_format_from_width(1),
                channels = 1,
                rate = BITRATE,
                output = True)

stream.write(WAVEDATA)
stream.stop_stream()
stream.close()
p.terminate()