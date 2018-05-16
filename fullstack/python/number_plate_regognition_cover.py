
# -*- coding: utf-8 -*-

import cv2
import time
import numpy as np

"""

import sys
import cv2
import numpy
import random
from scipy.ndimage import label

sudo apt-get install python-opencv
sudo apt-get install python-matplotlib

pip install scipy
pip install numpy
pip install opencv-python
pip install pytesseract
pip install opencv-python
pip install opencv-contrib-python

http://answers.opencv.org/question/40252/getting-outermost-contour-using-findcontours/
https://docs.opencv.org/3.1.0/d4/d13/tutorial_py_filtering.html
https://mehmethanoglu.com.tr/blog/6-opencv-ile-dikdortgen-algilama-python.html
https://github.com/opencv/opencv/blob/master/samples/python/squares.py
https://stackoverflow.com/questions/14997733/advanced-square-detection-with-connected-region
https://docs.opencv.org/3.0-beta/doc/py_tutorials/py_imgproc/py_contours/py_contour_features/py_contour_features.html
https://www.pyimagesearch.com/2016/02/08/opencv-shape-detection/
https://www.programcreek.com/python/example/89416/cv2.BORDER_DEFAULT
https://docs.python.org/2/library/copy.html
https://pypi.org/project/opencv-python/#description
https://github.com/anuj-badhwar/Indian-Number-Plate-Recognition-System/blob/master/main.py
https://github.com/anuj-badhwar/Indian-Number-Plate-Recognition-System
https://docs.opencv.org/2.4/modules/core/doc/drawing_functions.html
https://docs.opencv.org/3.1.0/dc/da5/tutorial_py_drawing_functions.html
https://docs.opencv.org/2.4.2/modules/core/doc/drawing_functions.html
https://docs.opencv.org/3.1.0/dd/d49/tutorial_py_contour_features.html
https://docs.opencv.org/2.4/modules/imgproc/doc/structural_analysis_and_shape_descriptors.html
http://opencvexamples.blogspot.com/2013/10/applying-bilateral-filter.html
http://eric-yuan.me/bilateral-filtering/
https://kyamagu.github.io/mexopencv/matlab/bilateralFilter.html
https://docs.opencv.org/2.4/modules/imgproc/doc/filtering.html
https://docs.opencv.org/3.4/d4/d86/group__imgproc__filter.html
https://www.programcreek.com/python/example/89455/cv2.moments
https://docs.opencv.org/3.4/dd/d49/tutorial_py_contour_features.html
http://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_filtering/py_filtering.html
https://pythonprogramming.net/blurring-smoothing-python-opencv-tutorial/
https://docs.opencv.org/3.3.0/d4/d13/tutorial_py_filtering.html
https://stackoverflow.com/questions/34389384/improve-contour-detection-with-opencv-python
https://docs.opencv.org/3.0-beta/modules/imgproc/doc/filtering.html
https://docs.opencv.org/2.4/doc/tutorials/imgproc/gausian_median_blur_bilateral_filter/gausian_median_blur_bilateral_filter.html


blur( src, dst, Size( i, i ), Point(-1,-1) );
GaussianBlur( src, dst, Size( i, i ), 0, 0 );
medianBlur ( src, dst, i );
bilateralFilter ( src, dst, i, i*2, i/2 );


"""

####################################
IS_FOUND = 0
MORPH = 3
CANNY = 1125
####################################
_width  = 640.0
_height = 360.0
_margin = 0.0
####################################

corners = np.array(
    [
        [[_margin, _margin]],
        [[_margin, _height + _margin]],
        [[_width + _margin, _height + _margin]],
        [[_width + _margin, _margin]],
    ]
)

pts_dst = np.array(corners, np.float32)
#rgb = cv2.imread("testData/test.JPG")
rgb = cv2.imread("testData/test1.jpg",1)
gray = cv2.cvtColor( rgb, cv2.COLOR_BGR2GRAY )
gray = cv2.bilateralFilter( gray, 1, 5, 10, 10 )
edges  = cv2.Canny( gray, 120, CANNY )
kernel = cv2.getStructuringElement( cv2.MORPH_RECT, ( MORPH, MORPH ) )
closed = cv2.morphologyEx( edges, cv2.MORPH_CLOSE, kernel )
_, contours, h  = cv2.findContours(closed, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

"""
cnt = contours[0]
M = cv2.moments(cnt)
print M
cx = int(M['m10']/M['m00'])
cy = int(M['m01']/M['m00'])
print cx
print cy
"""

for cont in contours:

    if cv2.contourArea(cont) > 290: # contour Area

        arc_len = cv2.arcLength(cont, True)
        approx = cv2.approxPolyDP(cont, 0.1 * arc_len, True)

        if (len(approx) == 4):
            IS_FOUND = 1

            #M = cv2.moments(cont)
            #print M
            #area = cv2.contourArea(cont)
            #print area
            #perimeter = cv2.arcLength(cont, True)
            #print perimeter

            # get center xy
            M = cv2.moments( cont )
            cX = int(M["m10"] / M["m00"]) - 25
            cY = int(M["m01"] / M["m00"])
            #cv2.putText(rgb, "Center", (cX, cY), cv2.FONT_HERSHEY_SIMPLEX, 1.0, (0, 0, 255), 3)
            x, y, w, h = cv2.boundingRect(cont)
            #cv2.circle(rgb, (cX, cY), 20, (0, 0, 255), -1)
            cv2.rectangle(rgb, (cX-8, cY-8), (cX + w, cY + h/2), (0, 0, 255), 25, 0)

            pts_src = np.array(approx, np.float32)
            h, status = cv2.findHomography(pts_src, pts_dst)
            out = cv2.warpPerspective(rgb, h, (int(_width + _margin * 1), int(_height + _margin *1)))
            #cv2.drawContours(rgb, [approx], -1, (255, 255, 255), 16)
            #cv2.drawContours(rgb, cont, -1, (0, 255, 0), 3)
            #blur = cv2.blur(rgb, (5, 5))
        else:
            pass

if IS_FOUND:
    cv2.imshow('out', rgb)
    cv2.waitKey(0)

"""
def segment_on_dt(img):
    dt = cv2.distanceTransform(img, 2, 3) # L2 norm, 3x3 mask
    dt = ((dt - dt.min()) / (dt.max() - dt.min()) * 255).astype(numpy.uint8)
    dt = cv2.threshold(dt, 100, 255, cv2.THRESH_BINARY)[1]
    lbl, ncc = label(dt)

    lbl[img == 0] = lbl.max() + 1
    lbl = lbl.astype(numpy.int32)
    cv2.watershed(cv2.cvtColor(img, cv2.COLOR_GRAY2BGR), lbl)
    lbl[lbl == -1] = 0
    return lbl


img = cv2.cvtColor(cv2.imread(sys.argv[1]), cv2.COLOR_BGR2GRAY)
img = cv2.threshold(img, 0, 255, cv2.THRESH_OTSU)[1]
img = 255 - img # White: objects; Black: background

ws_result = segment_on_dt(img)
# Colorize
height, width = ws_result.shape
ws_color = numpy.zeros((height, width, 3), dtype=numpy.uint8)
lbl, ncc = label(ws_result)
for l in xrange(1, ncc + 1):
    a, b = numpy.nonzero(lbl == l)
    if img[a[0], b[0]] == 0: # Do not color background.
        continue
    rgb = [random.randint(0, 255) for _ in xrange(3)]
    ws_color[lbl == l] = tuple(rgb)

#cv2.imwrite(sys.argv[2], ws_color)
cv2.imshow('im',ws_color)
cv2.waitKey(0)

"""

"""
def segment_on_dt(img):
    dt = cv2.distanceTransform(img, 2, 3) # L2 norm, 3x3 mask
    dt = ((dt - dt.min()) / (dt.max() - dt.min()) * 255).astype(numpy.uint8)
    dt = cv2.threshold(dt, 100, 255, cv2.THRESH_BINARY)[1]
    lbl, ncc = label(dt)

    lbl[img == 0] = lbl.max() + 1
    lbl = lbl.astype(numpy.int32)
    cv2.watershed(cv2.cvtColor(img, cv2.COLOR_GRAY2BGR), lbl)
    lbl[lbl == -1] = 0
    return lbl

img = cv2.cvtColor(cv2.imread(sys.argv[1]), cv2.COLOR_BGR2GRAY)
img = cv2.threshold(img, 0, 255, cv2.THRESH_OTSU)[1]
img = 255 - img # White: objects; Black: background

ws_result = segment_on_dt(img)
# Colorize
height, width = ws_result.shape
ws_color = numpy.zeros((height, width, 3), dtype=numpy.uint8)
lbl, ncc = label(ws_result)
for l in xrange(1, ncc + 1):
    a, b = numpy.nonzero(lbl == l)
    if img[a[0], b[0]] == 0: # Do not color background.
        continue
    rgb = [random.randint(0, 255) for _ in xrange(3)]
    ws_color[lbl == l] = tuple(rgb)

cv2.imshow('im',ws_color)
cv2.waitKey(0)
#cv2.imwrite(sys.argv[2], ws_color)
"""



"""


import numpy as np
import cv2
from matplotlib import pyplot as plt
from mpl_toolkits.axes_grid1 import ImageGrid
import math

img = cv2.imread('image.png')
img = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
plt.imshow(img)


#  cards are detected
# Prepocess
gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
blur = cv2.GaussianBlur(gray,(1,1),1000)
flag, thresh = cv2.threshold(blur, 120, 255, cv2.THRESH_BINARY)
# Find contours
contours, hierarchy = cv2.findContours(thresh,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)
contours = sorted(contours, key=cv2.contourArea,reverse=True) 
# Select long perimeters only
perimeters = [cv2.arcLength(contours[i],True) for i in range(len(contours))]
listindex=[i for i in range(15) if perimeters[i]>perimeters[0]/2]
numcards=len(listindex)
# Show image
imgcont = img.copy()
[cv2.drawContours(imgcont, [contours[i]], 0, (0,255,0), 5) for i in listindex]
plt.imshow(imgcont)


# perspective is corrected:
#plt.rcParams['figure.figsize'] = (3.0, 3.0)
warp = range(numcards)
for i in range(numcards):
    card = contours[i]
    peri = cv2.arcLength(card,True)
    approx = cv2.approxPolyDP(card,0.02*peri,True)
    rect = cv2.minAreaRect(contours[i])
    r = cv2.cv.BoxPoints(rect)

    h = np.array([ [0,0],[399,0],[399,399],[0,399] ],np.float32)
    approx = np.array([item for sublist in approx for item in sublist],np.float32)
    transform = cv2.getPerspectiveTransform(approx,h)
    warp[i] = cv2.warpPerspective(img,transform,(400,400))

# Show perspective correction
fig = plt.figure(1, (10,10))
grid = ImageGrid(fig, 111, # similar to subplot(111)
                nrows_ncols = (4, 4), # creates 2x2 grid of axes
                axes_pad=0.1, # pad between axes in inch.
                aspect=True, # do not force aspect='equal'
                )

for i in range(numcards):
    grid[i].imshow(warp[i]) # The AxesGrid object work as a list of axes.




fig = plt.figure(1, (10,10))
grid = ImageGrid(fig, 111, # similar to subplot(111)
                nrows_ncols = (4, 4), # creates 2x2 grid of axes
                axes_pad=0.1, # pad between axes in inch.
                aspect=True, # do not force aspect='equal'
                )
for i in range(numcards):
    image2 = cv2.bilateralFilter(warp[i].copy(),10,100,100)
    grey = cv2.cvtColor(image2,cv2.COLOR_BGR2GRAY)
    grey2 = cv2.cv.AdaptiveThreshold(cv2.cv.fromarray(grey), cv2.cv.fromarray(grey), 255, cv2.cv.CV_ADAPTIVE_THRESH_MEAN_C, cv2.cv.CV_THRESH_BINARY, blockSize=31, param1=6)
    grid[i].imshow(grey,cmap=plt.cm.binary) 



"""






"""

# https://stackoverflow.com/questions/34389384/improve-contour-detection-with-opencv-python

import numpy as np
import cv2
import math



img = cv2.imread('image.bmp')

# Prepocess
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
flag, thresh = cv2.threshold(gray, 120, 255, cv2.THRESH_BINARY)

# Find contours
img2, contours, hierarchy = cv2.findContours(thresh, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)
contours = sorted(contours, key=cv2.contourArea, reverse=True) 

# Select long perimeters only
perimeters = [cv2.arcLength(contours[i],True) for i in range(len(contours))]
listindex=[i for i in range(15) if perimeters[i]>perimeters[0]/2]
numcards=len(listindex)

card_number = -1 #just so happened that this is the worst case
stencil = np.zeros(img.shape).astype(img.dtype)
cv2.drawContours(stencil, [contours[listindex[card_number]]], 0, (255, 255, 255), cv2.FILLED)
res = cv2.bitwise_and(img, stencil)
cv2.imwrite("out.bmp", res)
canny = cv2.Canny(res, 100, 200)
cv2.imwrite("canny.bmp", canny)

"""