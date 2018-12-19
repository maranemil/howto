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
spf =   5/fps
print ("Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps))
print ("Seconds per frame using 1/fps :", spf)

# (*'MJPG') (*'mp42') (*'XVID') (*'X264') (*'H264')
out = cv2.VideoWriter(os.path.expanduser('~/Git/') + 'output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 30, (width,height),True)


def detectShape(cnt):
    shape = 'unknown'
    # calculate perimeter using
    peri = cv2.arcLength(c, True)
    # apply contour approximation and store the result in vertices
    vertices = cv2.approxPolyDP(c, 0.04 * peri, True) # 0.04
    if len(vertices) == 3:
        shape = 'triangle'
    elif len(vertices) == 4:
        x, y, width, height = cv2.boundingRect(vertices)
        aspectRatio = float(width) / height
        if aspectRatio >= 0.95 and aspectRatio <= 1.05:
            shape = "square"
        else:
            shape = "rectangle"
    elif len(vertices) == 5:
        shape = "pentagon"
    else:
        shape = "circle"
    return shape

while (cap.isOpened()):
    ret, frame = cap.read()
    frame = cv2.flip(frame, 1)
    frame_count = frame_count + 1
    #if frame_count % 4:
    #    continue
    if frame_count % 2:
        continue
    # -------------------------------------------
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    gray = cv2.bitwise_not(gray)
    blurred = cv2.GaussianBlur(gray, (17, 17), 4)
    thresh = cv2.threshold(blurred, 80, 255, cv2.THRESH_BINARY)[1]
    cnts = cv2.findContours(thresh.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    cnts = imutils.grab_contours(cnts)
    if(len(cnts)):
        # loop over the contours
        for c in cnts:
            shape = detectShape(c)
            if (shape == "rectangle" ): #
                # compute the center of the contour
                M = cv2.moments(c)
                if(M["m10"] == 0):
                    continue
                if cv2.contourArea(c) < 90 and cv2.contourArea(c) > 500:  # contour Area
                    continue
                cX = int(M["m10"] / M["m00"])
                cY = int(M["m01"] / M["m00"])
                alpha = cv2.cvtColor(thresh, cv2.COLOR_GRAY2BGR) #COLOR_GRAY2BGR
                cv2.drawContours(alpha, [c], -1, (25, 0, 225), 24)
                cv2.imshow('frame', alpha)

    # -------------------------------------------
    out.write(alpha)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
cap.release()
out.release()
cv2.destroyAllWindows()