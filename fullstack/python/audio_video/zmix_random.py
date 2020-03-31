"""
import wave
BUFFER_SIZE = 248
fp = wave.open('x0em.wav')
output = wave.open('output.wav', 'wb')
output.setparams(fp.getparams())
frames_to_read = fp.getnframes()/1000 #BUFFER_SIZE / (fp.getsampwidth() + fp.getnchannels())
while True:
    frames = fp.readframes(frames_to_read)
    if not frames:
        break
    output.writeframes(frames)
exit


http://blog.acipo.com/wave-generation-in-python/
https://www.tutorialspoint.com/read-and-write-wav-files-using-python-wave
http://www.scikit-video.org/stable/io.html
http://zulko.github.io/blog/2013/09/27/read-and-write-video-frames-in-python-using-ffmpeg/
https://programtalk.com/python-examples/wave.open/?ipage=3
https://programtalk.com/python-examples/wave.open/?ipage=3
https://stackoverflow.com/questions/33311153/python-extracting-and-saving-video-frames
https://github.com/ZoeB/wave-tools/blob/master/wavesplit.py
https://www.programcreek.com/python/example/82393/wave.open
https://stackoverflow.com/questions/34959797/read-wav-files-in-buffers
https://docs.python.org/2/library/wave.html
https://docs.python.org/3/library/wave.html
http://doc.sagemath.org/html/en/reference/misc/sage/media/wav.html


https://stackoverflow.com/questions/37999150/how-to-split-a-wav-file-into-multiple-wav-files
https://stackoverflow.com/questions/7833807/get-wav-file-length-or-duration
"""

#pip3 install pydub
from pydub import AudioSegment
t1 =  0 #Works in milliseconds
t2 =  1000
newAudio = AudioSegment.from_wav("x0em.wav")
newAudio = newAudio[t1:t2]
newAudio.export('newSong.wav', format="wav") #Exports to a wav


"""
import wave, struct
data= []
w = wave.open('x0em.wav', 'rb')
#data.append( [w.getparams(), w.readframes(w.getnframes())] )
frames = w.getnframes()
data.append( [w.getparams(), w.readframes(25000)] )
w.close()
outfile = "sounds1.wav"
output = wave.open(outfile, 'wb')
output.setparams(data[0][0])
output.writeframes(data[0][1])
output.close()
"""
