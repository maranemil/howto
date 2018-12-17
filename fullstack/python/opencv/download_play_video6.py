from __future__ import print_function
from imutils.object_detection import non_max_suppression
import numpy as np
import argparse
import time
import cv2
import os
import pytesseract
from pytesseract import image_to_string
from cs50 import get_string

from PIL import Image
import PIL.Image
import imutils

import sys
reload(sys)
sys.setdefaultencoding('utf-8')

# pip install imutils
# pip install opencv-contrib-python
# pip install pytesseract
# sudo apt install tesseract-ocr
# pip install cs50

# https://github.com/cs50/python-cs50
# https://docs.cs50.net/2017/fall/notes/8/lecture8.html
# https://www.learnopencv.com/deep-learning-based-text-recognition-ocr-using-tesseract-and-opencv/

# sudo apt install aptitude
# aptitude install python-imaging

frame_count = 0
video = os.path.expanduser('~/Git/') + "jQU_wiBW6M0Final2.mp4";
cap = cv2.VideoCapture(video)
frame_width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
frame_height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
width = int(cap.get(3))
height = int(cap.get(4))
fps = int(cap.get(5))

# find fps of video file
fps = cap.get(cv2.CAP_PROP_FPS)
spf =  25 / fps
print ("Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps))
print ("Seconds per frame using 1/fps :", spf)

# (*'MJPG') (*'mp42') (*'XVID') (*'X264') (*'H264')
out = cv2.VideoWriter(os.path.expanduser('~/Git/') + 'output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 30, (width,height),True)

while (cap.isOpened()):

    ret, frame = cap.read()
    #frame_count = frame_count + 1
    #frame = cv2.resize(frame, (640, 360))
    frame = cv2.flip(frame, 1)

    # -------------------------------------------

    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    blurred = cv2.GaussianBlur(gray, (15, 15), 0)
    thresh = cv2.threshold(blurred, 60, 255, cv2.THRESH_BINARY)[1]
    chan = cv2.medianBlur(blurred, 5)
    edged = cv2.Canny(chan, 10, 100)

    # find contours in the thresholded image
    cnts = cv2.findContours(thresh.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    cnts = imutils.grab_contours(cnts)

    if(len(cnts)):
        # loop over the contours
        for c in cnts:
            # compute the center of the contour
            M = cv2.moments(c)

            if(M["m10"]==0):
                continue

            cX = int(M["m10"] / M["m00"])
            cY = int(M["m01"] / M["m00"])

            # draw the contour and center of the shape on the image
            cv2.drawContours(edged, [c], -1, (0, 255, 0), 2)
            cv2.circle(edged, (cX, cY), 7, (255, 255, 255), -1)
            cv2.putText(edged, "*", (cX - 20, cY - 20), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 2)

            # show the image
            #cv2.imshow("Image", blurred)
            #cv2.waitKey(0)

    # -------------------------------------------

    """
    config = ('-l eng --oem 1 --psm 3')
    # ll /usr/share/tesseract-ocr/4.00/tessdata

    # Run tesseract OCR on image
    #textx = pytesseract.image_to_string(frame, config=config)
    textx = pytesseract.image_to_string(frame, lang='eng')

    # converts image to numpy
    #textx = get_string(frame)
    font = cv2.FONT_HERSHEY_SIMPLEX
    cv2.putText(thresh, textx, (20,100), font, 2,(255,255,255),2,cv2.LINE_AA)
    """

    # -------------------------------------------

    # gray = cv2.resize(gray, (1280, 720))
    #hsv = cv2.resize(hsv, (640, 360))
    cv2.imshow('frame', edged)
    cv2.merge(frame,edged)
    # cv2.resize(frame, (640, 360))
    # frame = cv2.cvtColor(hsv, cv2.COLOR_GRAY2BGR)
    output = cv2.resize(edged, (1280, 720))
    out.write(output)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

#cv2.imshow('frame', frame)
cap.release()
out.release()
cv2.destroyAllWindows()