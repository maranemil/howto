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

# import pafy
# from pprint import pprint

# DW
"""
# https://www.youtube.com/watch?v=j3a-ZaVtyRc
# https://www.youtube.com/watch?v=u9DzwcptbrM
# https://www.youtube.com/watch?v=ZvHXpd9uzN4

https://www.youtube.com/watch?v=_YqoKe4rnbw
https://www.youtube.com/watch?v=PGMu_Z89Ao8
https://www.youtube.com/watch?v=R_XfeQZDWqI
https://www.youtube.com/watch?v=ZkOsJfT40lY
https://www.youtube.com/watch?v=qqx8jQ7Z5FA
https://www.youtube.com/watch?v=t0S0FFdLzTo
https://www.youtube.com/watch?v=Pp2GksUDomw
https://www.youtube.com/watch?v=SO4tjI43Ob4
https://www.youtube.com/watch?v=Ho3yyyqinTU
https://www.youtube.com/watch?v=X8B8X5WKqTk


# youtube-dl -F  https://www.youtube.com/watch?v=ZvHXpd9uzN4

249          webm       audio only DASH audio   49k , opus @ 50k, 6.23MiB
250          webm       audio only DASH audio   59k , opus @ 70k, 7.02MiB
171          webm       audio only DASH audio   86k , vorbis@128k, 10.59MiB
251          webm       audio only DASH audio  102k , opus @160k, 12.79MiB
140          m4a        audio only DASH audio  128k , m4a_dash container, mp4a.40.2@128k, 17.38MiB
278          webm       256x144    144p  107k , webm container, vp9, 30fps, video only, 13.31MiB
160          mp4        256x144    144p  115k , avc1.4d400c, 30fps, video only, 15.05MiB
242          webm       426x240    240p  245k , vp9, 30fps, video only, 30.49MiB
133          mp4        426x240    240p  251k , avc1.4d4015, 30fps, video only, 33.57MiB
243          webm       640x360    360p  586k , vp9, 30fps, video only, 57.03MiB
134          mp4        640x360    360p  646k , avc1.4d401e, 30fps, video only, 80.36MiB
244          webm       854x480    480p  969k , vp9, 30fps, video only, 104.67MiB
135          mp4        854x480    480p 1171k , avc1.4d401f, 30fps, video only, 152.82MiB
247          webm       1280x720   720p 2221k , vp9, 30fps, video only, 210.58MiB
136          mp4        1280x720   720p 2349k , avc1.4d401f, 30fps, video only, 308.00MiB
248          webm       1920x1080  1080p 4023k , vp9, 30fps, video only, 372.24MiB
137          mp4        1920x1080  1080p 4414k , avc1.640028, 30fps, video only, 577.03MiB
264          mp4        2560x1440  1440p 10644k , avc1.640032, 30fps, video only, 1.34GiB
271          webm       2560x1440  1440p 11464k , vp9, 30fps, video only, 1.19GiB
313          webm       3840x2160  2160p 21990k , vp9, 30fps, video only, 2.38GiB
17           3gp        176x144    small , mp4v.20.3, mp4a.40.2@ 24k
36           3gp        320x180    small , mp4v.20.3, mp4a.40.2
43           webm       640x360    medium , vp8.0, vorbis@128k
18           mp4        640x360    medium , avc1.42001E, mp4a.40.2@ 96k
22           mp4        1280x720   hd720 , avc1.64001F, mp4a.40.2@19

 youtube-dl     --format 247  https://www.youtube.com/watch?v=ZvHXpd9uzN4

https://stackoverflow.com/questions/21983062/in-python-opencv-is-there-a-way-to-quickly-scroll-through-frames-of-a-video-all
http://answers.opencv.org/question/94012/is-opencvs-videocaptureread-function-skipping-frames/
"""

"""
url = "https://www.youtube.com/watch?v=ZvHXpd9uzN4"
videoPafy = pafy.new(url)
best = videoPafy.getbest(preftype="mp4")
video = cv2.VideoCapture(best.url)
pprint(best)
exit()
"""

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
spf = 10 / fps
print "Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps)
print "Seconds per frame using 1/fps :", spf




# (*'MJPG') (*'mp42') (*'XVID') (*'X264') (*'H264')
out = cv2.VideoWriter(os.path.expanduser('~/Git/') + str(time.time()).split('.')[0] + 'output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 30, (frame_width, frame_height), True)

# Sorting
# https://www.geeksforgeeks.org/find-average-list-python/
# https://jakevdp.github.io/PythonDataScienceHandbook/02.08-sorting.html
# https://docs.python.org/3/howto/sorting.html
# https://opencvpython.blogspot.de/search/label/CHAIN_APPROX_NONE
# https://www.programcreek.com/python/example/89466/cv2.CHAIN_APPROX_NONE
# https://docs.python.org/2/library/functools.html

while (cap.isOpened()):
    ret, frame = cap.read()
    frame_count = frame_count + 1
    frame = cv2.resize(frame, (640, 360))

    # ------------------------------------------

    # if frame_count % 2:
    #    continue

    if ret == False:
        break

    frame = cv2.flip(frame, 1)
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    # blurred = cv2.GaussianBlur(gray, (5, 5), 0)
    blurred = cv2.medianBlur(gray, 5)
    edged = cv2.Canny(blurred, 0, 5)

    # ret, thresh = cv2.threshold(blurred, 127, 255, 1)  # 127,255,1
    ret, thresh = cv2.threshold(blurred, 127, 255, cv2.THRESH_BINARY | cv2.THRESH_OTSU)  # 127,255,1

    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_BINARY)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_BINARY_INV)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_TRUNC)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_TOZERO)
    # ret,thresh = cv.threshold(img,127,255,cv2.THRESH_TOZERO_INV)

    # _, contours, h = cv2.findContours(edged, cv2.RETR_LIST, cv2.CHAIN_APPROX_NONE)
    _, contours, h = cv2.findContours(edged, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    # Options
    # cv2.RETR_LIST , cv2.RETR_EXTERNAL, cv2.RETR_CCOMP cv2.RETR_TREE
    # cv2.CHAIN_APPROX_NONE and cv2.CHAIN_APPROX_SIMPLE.

    # Get Average or Sort Value
    contours = sorted(contours, key=cv2.contourArea, reverse=True)


    # for each contour search polygon rectangle
    for cnt in contours:

        if cv2.contourArea(cnt) > 110 and cv2.contourArea(cnt) < 2690:
            #    approx = cv2.approxPolyDP(cnt,0.01*cv2.arcLength(cnt,True),True)
            approx = cv2.approxPolyDP(cnt, 0.1 * cv2.arcLength(cnt, True), True) #0.05
            # print len(approx)
            if len(approx) == 4:
                target = approx
                break

        cv2.drawContours(gray, [cnt], -1, (255, 0, 0), -1)  # classic overlay without transparency

        #x, y, w, h = cv2.boundingRect(contours[0])
        #cv2.rectangle(gray, (x, y), (x + w / 4, y + h / 4), (255, 255, 255), 3)

        cv2.imshow('frame', gray)
        frame = cv2.cvtColor(gray, cv2.COLOR_GRAY2BGR)
        # out.write(frame)

    gray = cv2.resize(gray, (1280, 720))
    #gray = cv2.resize(gray, (640,360))
    cv2.imshow('frame', gray)
    # cv2.merge(frame,gray)
    cv2.resize(frame, (640, 360))
    frame = cv2.cvtColor(gray, cv2.COLOR_GRAY2BGR)
    out.write(frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
out.release()
cv2.destroyAllWindows()
