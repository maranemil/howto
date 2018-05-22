# pip install IPython
# pip install pytube
# pip install pafy
# pip install --upgrade youtube_dl
# https://github.com/nficano/pytube

# From IPython
#from IPython import display, YouTubeVideo
#from pytube import YouTube

import numpy as np
import cv2, pafy
from pprint import pprint

# DW
"""
# https://www.youtube.com/watch?v=j3a-ZaVtyRc
# https://www.youtube.com/watch?v=u9DzwcptbrM
# https://www.youtube.com/watch?v=ZvHXpd9uzN4
"""

url = "https://www.youtube.com/watch?v=ZvHXpd9uzN4"
videoPafy = pafy.new(url)
best = videoPafy.getbest(preftype="webm")
video = cv2.VideoCapture(best.url)
pprint(best)
exit()

video = "MontyPythons.webm";
cap = cv2.VideoCapture(video)
while(cap.isOpened()):
    ret, frame = cap.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    cv2.imshow('frame',gray)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
cap.release()
cv2.destroyAllWindows()



