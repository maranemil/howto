"""
sudo apt install python-pip
pip install --upgrade pip

pip install scipy
pip install numpy
pip install opencv-python
pip install opencv-contrib-python

pip install pytesseract
pip install pafy
pip install matplotlib
pip install scikit-learn
pip install youtube_dl
pip install jupyter
pip install graphviz
pip install sklearn
pip install imutils
"""

from __future__ import division

import sys
import numpy as np
import cv2

print(cv2.__version__)
import json
import os
# import rect
# importing reduce()
from functools import reduce
import time
import imutils

frame_count = 0
video = os.path.expanduser('~/Git/') + "jQU_wiBW6M0Final.mp4";
cap = cv2.VideoCapture(video)
frame_width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
frame_height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
width = int(cap.get(3))
height = int(cap.get(4))
fps = int(cap.get(5))

# find fps of video file
fps = cap.get(cv2.CAP_PROP_FPS)
spf =  5 / fps
print "Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps)
print "Seconds per frame using 1/fps :", spf

# (*'MJPG') (*'mp42') (*'XVID') (*'X264') (*'H264')
out = cv2.VideoWriter(os.path.expanduser('~/Git/') + str(time.time()).split('.')[0] + 'output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 30,
                      (frame_width, frame_height), True)

while (cap.isOpened()):
    ret, frame = cap.read()
    frame_count = frame_count + 1
    #frame = cv2.resize(frame, (640, 360))

    # ------------------------------------------

    if frame_count % 2:
        continue

    if ret == False:
        break

    frame = cv2.flip(frame, 1)
    blurred = cv2.GaussianBlur(frame, (5, 5), 5)
    # hsv = cv2.threshold(blurred, 60, 255, cv2.THRESH_BINARY)[1]
    hsv = cv2.cvtColor(blurred, cv2.COLOR_BGR2HSV)

    greenLower = (29, 86, 6)
    greenUpper = (64, 255, 255)

    mask = cv2.inRange(hsv, greenLower, greenUpper)
    mask = cv2.erode(mask, None, iterations=1)
    mask = cv2.dilate(mask, None, iterations=1)

    cnts = cv2.findContours(mask.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    cnts = imutils.grab_contours(cnts)

    # for each contour search polygon rectangle
    for cnt in cnts:
        peri = cv2.arcLength(cnt, True)
        approx = cv2.approxPolyDP(cnt, 0.04 * peri, True)  # 0.05
        # print len(approx)

        if len(approx) == 4:
            target = approx
            (x), (y), (w), (h) = cv2.boundingRect(approx)
            #cv2.rectangle(hsv, (x, y),  int( x + int(w / 4)), int(y + int(h / 4)), (255, 255, 255), 13)
            cv2.imshow('frame', hsv)
            # frame = cv2.cvtColor(hsv, cv2.COLOR_BGR2HSV)
            #out.write(hsv)
        # break

    # gray = cv2.resize(gray, (1280, 720))
    #hsv = cv2.resize(hsv, (640, 360))
    #cv2.imshow('frame', hsv)
    # cv2.merge(frame,gray)
    # cv2.resize(frame, (640, 360))
    # frame = cv2.cvtColor(hsv, cv2.COLOR_GRAY2BGR)
    out.write(hsv)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
out.release()
cv2.destroyAllWindows()
