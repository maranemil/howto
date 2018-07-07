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
"""

import sys
import numpy as np
import cv2
print(cv2.__version__)
import json
import os
#import rect
# importing reduce()
from functools import reduce
import time



# import error: sk video is not found
# fix by by uninstalling scikit video then install using conda install -c conda-forge sk-video in anaconda prompt.
#from skvideo.io import VideoWriter
# sudo pip3 install scikit-video
# sudo pip3 install sk-video



# import pafy
# from pprint import pprint
# OpenCV Python Video FX03 Edge Cartoonizer
# opencv2_python_video_fx03_edge_cartoonizer.py

frame_count = 0
video = "2018_0705_173811_015A1.mp4";
cap = cv2.VideoCapture(video)
frame_width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
frame_height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
width = int(cap.get(3))
height = int(cap.get(4))
fps = int(cap.get(5))

# find fps of video file
fps = cap.get(cv2.CAP_PROP_FPS)
spf = 10 / fps
print "Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps)
print "Seconds per frame using 1/fps :", spf

# (*'MJPG') (*'MP42') (*'XVID') (*'X264') (*'H264') mp4v
#out = cv2.VideoWriter(  str(time.time()).split('.')[0] + 'output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 30, (frame_width, frame_height), True)
out = cv2.VideoWriter(  str(time.time()).split('.')[0] + 'output999.avi', cv2.VideoWriter_fourcc(*"mp42"), 20, (640, 360), True)

while (cap.isOpened()):
    ret, frame = cap.read()
    frame_count = frame_count + 1
    frame = cv2.resize(frame, (640, 360))
    #frame = cv2.resize(frame, (320, 180))

    # ------------------------------------------

    if frame_count % 2:
        continue

    if ret == False:
        break

    #frame = cv2.flip(cv2.flip(frame, 1),1)
    #gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    blurred = cv2.GaussianBlur(gray, (5,5), 0)
    #sobel = cv2.Sobel(gray, -1, 1, 0)



    #blurred = cv2.GaussianBlur(gray, (5, 5), 0)
    #blurred = cv2.medianBlur(gray, 5)
    edged = cv2.Canny(blurred, 0, 5)

    #ret, thresh = cv2.threshold(gray, 17, 25, 1)  # 127,255,1
    ret, thresh = cv2.threshold(edged, 127, 225, cv2.THRESH_BINARY | cv2.THRESH_OTSU)  # 127,255,1

    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_BINARY)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_BINARY_INV)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_TRUNC)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_TOZERO)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_TOZERO_INV)

    #se = cv2.getStructuringElement(cv2.MORPH_RECT, (4,2))
    #gray = cv2.morphologyEx(sobel, cv2.MORPH_CLOSE, se)
    #ed_img = np.copy(gray)


    #_, contours, h = cv2.findContours(gray, cv2.RETR_LIST, cv2.CHAIN_APPROX_NONE)
    _, contours, h = cv2.findContours(edged, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    # Options
    # cv2.RETR_LIST , cv2.RETR_EXTERNAL, cv2.RETR_CCOMP cv2.RETR_TREE
    # cv2.CHAIN_APPROX_NONE and cv2.CHAIN_APPROX_SIMPLE.

    # Get Average or Sort Value
    #contours = sorted(contours, key=cv2.contourArea, reverse=True)


    # for each contour search polygon rectangle
    for cnt in contours:

        if cv2.contourArea(cnt) > 150 and cv2.contourArea(cnt) < 180:
            #    approx = cv2.approxPolyDP(cnt,0.01*cv2.arcLength(cnt,True),True)
            approx = cv2.approxPolyDP(cnt, 0.05 * cv2.arcLength(cnt, True), True) #0.05
            # print len(approx)
            if len(approx) == 4:
                target = approx
                break

        cv2.drawContours(gray, [cnt], -1, (255, 210, 210), -1)  # classic overlay without transparency

        #x, y, w, h = cv2.boundingRect(contours[0])
        #cv2.rectangle(gray, (x, y), (x + w / 4, y + h / 4), (255, 255, 255), 3)

        cv2.imshow('frame', gray)
	#gray = cv2.resize(gray, (frame_width, frame_height))
	gray = cv2.resize(gray, (640, 360)) # (640, 360)
        frame = cv2.cvtColor(gray, cv2.COLOR_GRAY2BGR)
        ##out.write(frame)

    #gray = cv2.resize(gray, (1280, 720))
    #gray = cv2.resize(gray, (frame_width, frame_height))
    #gray = cv2.resize(gray, (640,360))
    #cv2.imshow('frame', gray)
    #cv2.merge(frame, gray)
    #cv2.imshow('frame', gray)
    #cv2.resize(frame, (cv2.CV_CAP_PROP_FRAME_WIDTH, cv2.CV_CAP_PROP_FRAME_HEIGHT))
    #frame = cv2.cvtColor(gray, cv2.COLOR_GRAY2BGR)
    out.write(frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
out.release()
cv2.destroyAllWindows()