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
import rect

# importing reduce()
from functools import reduce

# def Average(lst):
#    return reduce(lambda a, b: a + b, lst) / len(lst)


# def Average(lst):
# total_score = 0
# count = len(lst)
# index = 0
# for item in lst:
#    if count > 0:
#        total_score += lst[index]
#        index += 1
# return float(total_score / count)

# Works.      ## avg = float(sum(lst)) / float(len(lst))
# Works.      ## avg = float(sum(lst)) / len(lst)
# Works.      ## avg = sum(lst) / float(len(lst))
# avg = float(sum(lst)) / len(lst)
# return float(avg)


# import pafy
# from pprint import pprint

# DW
"""
# https://www.youtube.com/watch?v=j3a-ZaVtyRc
# https://www.youtube.com/watch?v=u9DzwcptbrM
# https://www.youtube.com/watch?v=ZvHXpd9uzN4


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
video = "DrivingDowntown2a.mp4";
cap = cv2.VideoCapture(video)
frame_width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
frame_height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
width = int(cap.get(3))
height = int(cap.get(4))
fps = int(cap.get(5))

# find fps of video file
fps = cap.get(cv2.CAP_PROP_FPS)
spf = 1 / fps
print "Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps)
print "Seconds per frame using 1/fps :", spf

# https://www.programcreek.com/python/example/72134/cv2.VideoWriter
# https://docs.opencv.org/2.4/modules/highgui/doc/reading_and_writing_images_and_video.html
# https://scottontechnology.com/flip-image-opencv-python/
# https://docs.opencv.org/3.1.0/dd/d43/tutorial_py_video_display.html
# https://www.tutorialspoint.com/python/python_loop_control.htm
# http://anh.cs.luc.edu/python/hands-on/3.1/handsonHtml/ifstatements.html
# http://www.fourcc.org/codecs.php
# https://github.com/opencv/opencv/tree/master/3rdparty/ffmpeg
# https://pypi.org/project/opencv-contrib-python/
# https://www.tutorialspoint.com/python/python_decision_making.htm
# https://www.tutorialspoint.com/python/python_if_else.htm
# https://www.pyimagesearch.com/2016/02/22/writing-to-video-with-opencv/


"""
from skvideo.io import VideoWriter
import numpy
writer = VideoWriter(filename, frameSize=(w, h))
writer.open()
image = numpy.zeros((h, w, 3))
writer.write(image)
writer.release()
"""

"""
# construct the argument parse and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-o", "--output", required=True,
	help="path to output video file")
ap.add_argument("-p", "--picamera", type=int, default=-1,
	help="whether or not the Raspberry Pi camera should be used")
ap.add_argument("-f", "--fps", type=int, default=20,
	help="FPS of output video")
ap.add_argument("-c", "--codec", type=str, default="MJPG",
	help="codec of output video")
args = vars(ap.parse_args())
"""

# (*'MJPG') (*'mp42') (*'XVID') (*'X264') (*'H264')
out = cv2.VideoWriter('output999.avi', cv2.VideoWriter_fourcc(*"MJPG"), 60, (frame_width, frame_height), True)

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

    # https://docs.opencv.org/3.4.0/d7/d4d/tutorial_py_thresholding.html
    # https://pythonprogramming.net/thresholding-image-analysis-python-opencv-tutorial/
    # https://kyamagu.github.io/mexopencv/matlab/approxPolyDP.html
    # http://www.swarthmore.edu/NatSci/mzucker1/opencv-2.4.10-docs/modules/imgproc/doc/structural_analysis_and_shape_descriptors.html
    # https://github.com/eyantrainternship/eYSIP_2015_Marker_based_Robot_Localisation/wiki/Contour-Features-and-Shape-Detection

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

    # ret,thresh = cv.threshold(img,127,255,cv.THRESH_BINARY)
    # ret,thresh = cv.threshold(img,127,255,cv.THRESH_BINARY_INV)
    # ret,thresh = cv.threshold(img,127,255,cv.THRESH_TRUNC)
    # ret,thresh = cv.threshold(img,127,255,cv.THRESH_TOZERO)
    # ret,thresh = cv.threshold(img,127,255,cv.THRESH_TOZERO_INV)

    # _, contours, h = cv2.findContours(edged, cv2.RETR_LIST, cv2.CHAIN_APPROX_NONE)
    _, contours, h = cv2.findContours(edged, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    # Options
    # cv2.RETR_LIST , cv2.RETR_EXTERNAL, cv2.RETR_CCOMP cv2.RETR_TREE
    # cv2.CHAIN_APPROX_NONE and cv2.CHAIN_APPROX_SIMPLE.

    # Get Average or Sort Value
    contours = sorted(contours, key=cv2.contourArea, reverse=True)
    # contours = Average(contours)

    # for each contour search polygon rectangle
    for cnt in contours:

        if cv2.contourArea(cnt) > 10 and cv2.contourArea(cnt) < 690:
            #    approx = cv2.approxPolyDP(cnt,0.01*cv2.arcLength(cnt,True),True)
            approx = cv2.approxPolyDP(cnt, 0.1 * cv2.arcLength(cnt, True), True)
            # print len(approx)
            if len(approx) == 4:
                target = approx
                break

        # cv2.drawContours(gray, [cnt], -1, (255, 0, 0), -1)  # classic overlay without transparency

        x, y, w, h = cv2.boundingRect(contours[0])
        cv2.rectangle(gray, (x, y), (x + w / 4, y + h / 4), (255, 255, 255), 3)

        # approx = rect.rectify(target)
        # pts2 = np.float32([[0,0],[800,0],[800,800],[0,800]])
        # M = cv2.getPerspectiveTransform(cnt,pts2)
        # dst = cv2.warpPerspective(gray,M,(800,800))
        # cv2.drawContours(gray, [cnt], -1, (0, 255, 0), 2)
        # gray = cv2.cvtColor(gray, cv2.COLOR_BGR2GRAY)

        cv2.imshow('frame', gray)
        frame = cv2.cvtColor(gray, cv2.COLOR_GRAY2BGR)
        # out.write(frame)

    gray = cv2.resize(gray, (1280, 720))
    # gray = cv2.resize(gray, (640,360))
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
