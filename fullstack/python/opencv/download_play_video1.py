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
#from pprint import pprint


"""
https://docs.opencv.org/3.1.0/dd/d43/tutorial_py_video_display.html
http://answers.opencv.org/question/27902/how-to-record-video-using-opencv-and-python/
https://docs.opencv.org/3.1.0/d8/dfe/classcv_1_1VideoCapture.html
https://docs.opencv.org/3.0-beta/doc/py_tutorials/py_gui/py_video_display/py_video_display.html
https://www.codingforentrepreneurs.com/blog/how-to-record-video-in-opencv-python/
https://raspberrypi.stackexchange.com/questions/66976/capture-video-for-a-certain-time-then-quit-and-save-to-a-folder-using-opencv3-on
https://www.programcreek.com/python/example/85663/cv2.VideoCapture
https://www.pyimagesearch.com/2017/02/06/faster-video-file-fps-with-cv2-videocapture-and-opencv/
"""

# DW
"""
# https://www.youtube.com/watch?v=j3a-ZaVtyRc
# https://www.youtube.com/watch?v=u9DzwcptbrM
# https://www.youtube.com/watch?v=ZvHXpd9uzN4
"""

#url = "https://www.youtube.com/watch?v=u9DzwcptbrM"
#videoPafy = pafy.new(url)
#best = videoPafy.getbest(preftype="mp4")
#video = cv2.VideoCapture(best.url)
#pprint(best)

"""
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
"""

"""
CV_FOURCC('P','I','M','1')    = MPEG-1 codec
CV_FOURCC('M','J','P','G')    = motion-jpeg codec (does not work well)
CV_FOURCC('M', 'P', '4', '2') = MPEG-4.2 codec
CV_FOURCC('D', 'I', 'V', '3') = MPEG-4.3 codec
CV_FOURCC('D', 'I', 'V', 'X') = MPEG-4 codec
CV_FOURCC('U', '2', '6', '3') = H263 codec
CV_FOURCC('I', '2', '6', '3') = H263I codec
CV_FOURCC('F', 'L', 'V', '1') = FLV1 codec


cv2.VideoWriter_fourcc(*'MP4V')
cv2.VideoWriter_fourcc(*'H264')
cv2.VideoWriter_fourcc(*'XVID')
cv2.VideoWriter_fourcc(*'MPEG-1')
cv2.VideoWriter_fourcc(*'MPEG-4')
cv2.VideoWriter_fourcc(*'H263')
cv2.VideoWriter_fourcc(*'H263I')
cv2.VideoWriter_fourcc(*'FLV1')
"""

"""
# Banchmark Test 1
from skvideo.io import VideoWriter
import numpy
writer = VideoWriter(filename, frameSize=(w, h))
writer.open()
image = numpy.zeros((h, w, 3))
writer.write(image)
writer.release()


# Banchmark Test 2
writer = cv2.VideoWriter("output.avi", cv2.VideoWriter_fourcc(*"MJPG"), 30,(640,480))
for frame in range(1000):
    writer.write(np.random.randint(0, 255, (480,640,3)).astype('uint8'))
writer.release()
"""

#!/usr/bin/env python2
# -*- coding: utf-8 -*-
'''
converts sequence of images to video
uses glob pattern and allows skipping images
'''

import numpy as np
import cv2
import sys

print(cv2.__file__)
print(cv2.__version__)
# pprint(vars(cv2))

#pip3 uninstall opencv_python
#pip3 install opencv_python --user


# Create test window
#cv2.namedWindow("cam_out", cv2.CV_WINDOW_AUTOSIZE)
# Create vid cap object
#cap = cv2.VideoCapture(1)

"""
# construct the argument parse and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-v", "--video", required=True,
	help="path to input video file")
args = vars(ap.parse_args())
"""


video = "DrivingDowntown2.mp4";
cap = cv2.VideoCapture(video)
width  = int(cap.get(3))
height = int(cap.get(4))
fps = int(cap.get(5))

# Define the codec and create VideoWriter object
#fourcc = cv2.VideoWriter_fourcc(*'H264') # H264 MP4V XVID
out = cv2.VideoWriter('output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 30, (width,height),True)

while(cap.isOpened()):
    ret, frame = cap.read()
    if ret==True:
        frame = cv2.flip(frame,1)

        # write the flipped frame
        output = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        out.write(output)

        #cv2.imshow('frame',frame)
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break
    else:
        break

# Release everything if job is finished
cap.release()
out.release()
cv2.destroyAllWindows()


"""
# Banchmark Test 2 OK
writer = cv2.VideoWriter("output.avi", cv2.VideoWriter_fourcc(*"MJPG"), 30,(640,480))
for frame in range(1000):
    writer.write(np.random.randint(0, 255, (480,640,3)).astype('uint8'))
writer.release()
"""

"""
# Banchmark Test 1 NOT OK
# pip install sk-video
# pip3 install sk-video
#sudo apt-get install libav-tools
#pip install scikit-video
# pip3 install opencv-python

import skvideo.io
import skvideo.datasets
import skvideo.utils
from skvideo.io import VideoWriter
import numpy

#cap = skvideo.io.VideoCapture(sys.argv[1])
#ret, frame = cap.read()

writer = VideoWriter("output1.avi", frameSize=(w, h))
writer.open()
image = numpy.zeros((h, w, 3))
writer.write(image)
writer.release()
"""


"""
# Example get limited duration
import numpy as np
import cv2
import time

# Define the duration (in seconds) of the video capture here
capture_duration = 10

cap = cv2.VideoCapture(0)

# Define the codec and create VideoWriter object
fourcc = cv2.VideoWriter_fourcc(*'XVID')
out = cv2.VideoWriter('output.avi',fourcc, 20.0, (640,480))

start_time = time.time()
while( int(time.time() - start_time) < capture_duration ):
    ret, frame = cap.read()
    if ret==True:
        frame = cv2.flip(frame,0)

        # write the flipped frame
        out.write(frame)

        cv2.imshow('frame',frame)
        #if cv2.waitKey(1) & 0xFF == ord('q'):
        #    break
    else:
        break

# Release everything if job is finished
cap.release()
out.release()
cv2.destroyAllWindows()
"""