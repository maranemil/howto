from datetime import datetime

from midiutil import MIDIFile
import random

# pip install -r requirements.txt
# pip install midiutil

# Settings
tempo = 140  # BPM
beats_per_bar = 4
bars = 4  # 4 bars = 8 seconds at 120 BPM
channel = 0
volume = 100
track = 0

# Create MIDI file
mf = MIDIFile(1)
mf.addTempo(track, 0, tempo)

# C minor scale (C, D, Eb, F, G, Ab, Bb)
# scale = [60, 62, 63, 65, 67, 68, 70]
scale = [67, 68, 70]
total_beats = beats_per_bar * bars

# Melody
for beat in range(total_beats):
    if random.random() < 0.75:
        note = random.choice(scale)
        duration = random.choice([0.25, 0.5, 1.0])
        velocity = random.randint(60, 100)
        mf.addNote(track, channel, note, beat, duration, velocity)

# Kick drum on channel 9
kick_note = 36  # Standard kick
for beat in range(total_beats):
    mf.addNote(track, 9, kick_note, beat, 0.5, 100)

unixfrom = round(datetime.now().astimezone().timestamp())
# Save file
with open("random_8_second_song_" + str(unixfrom) + ".mid", "wb") as f:
    mf.writeFile(f)
