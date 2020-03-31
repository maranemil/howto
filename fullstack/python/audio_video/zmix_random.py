##############################################
#
#  Read 1 sec from WAV
#
##############################################

# pip3 install pydub
from pydub import AudioSegment

t1 = 0  # Works in milliseconds
t2 = 1000
newAudio = AudioSegment.from_wav("x0em.wav")
newAudio = newAudio[t1:t2]
newAudio.export('sounds1.wav', format="wav")  # Exports to a wav

##############################################
#
#  Read ~1 sec  / 25000 frames from WAV
#
##############################################

import wave, struct

data = []
w = wave.open('x0em.wav', 'rb')
# data.append( [w.getparams(), w.readframes(w.getnframes())] )
data.append([w.getparams(), w.readframes(25000)])
w.close()
# save in other file
outfile = "sounds2.wav"
output = wave.open(outfile, 'wb')
output.setparams(data[0][0])
output.writeframes(data[0][1])
output.close()
