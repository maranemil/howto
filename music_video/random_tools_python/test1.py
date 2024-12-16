import pyaudio
import numpy as np
import matplotlib.pyplot as plt
from scipy import signal

"""
https://music.stackexchange.com/questions/74555/how-to-generate-the-tone-of-a-specific-waveform
"""

p = pyaudio.PyAudio()

fs = 44100       # sampling rate, Hz, must be integer
duration = 2.0   # in seconds, may be float
f = 440.0        # sine frequency, Hz, may be float

one_cycle = np.linspace(0, 2 * np.pi, int(fs/f), endpoint=False)

waveform = np.concatenate([
    signal.square(one_cycle, duty=1.0) * 0.75 - 0.5, # 3/4 volume and offset
    signal.sawtooth(one_cycle, width=0.5) * 1.0,     # Full volume
    #np.sin(one_cycle)
    ]
)


samples = np.tile(waveform, int(fs * duration / len(waveform)))

print(len(samples))

plt.plot(np.tile(waveform, 2))
plt.show()

# for paFloat32 sample values must be in range [-1.0, 1.0]
stream = p.open(format=pyaudio.paFloat32,
                channels=1,
                rate=fs,
                output=True)

stream.write(samples)

stream.stop_stream()
stream.close()

p.terminate()