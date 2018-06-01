
"""
#############################################
#
#	https://pypi.org/project/yolo34py/
#
#############################################

https://github.com/madhawav/YOLO3-4-Py/blob/master/download_models.sh
http://www.erogol.com/object-detection-literature/
http://absfreepic.com/free-photos/download/crowded-cars-on-street-4032x2272_48736.html

env | grep '^LD_LIBRARY_PATH'
ls /home/justin/Libs/opencv-3.4.0/build/lib | grep "libopencv*"
ldconfig -v | grep opencv

https://github.com/BriSkyHekun/py-darknet-yolo
https://pjreddie.com/darknet/install/

#---------------------------------
# HOW TO Install
#---------------------------------

# CPU Only Version

pip3 install numpy
pip3 install yolo34py
pip3 install opencv-python

# GPU Version
# pip3 install numpy
# pip3 install yolo34py-gpu

# clone + dw models + create file + run test!

git clone https://pypi.org/project/yolo34py/
cd yolo34py
sh  download_models.sh
wget -C http://absfreepic.com/absolutely_free_photos/small_photos/crowded-cars-on-street-4032x2272_48736.jpg

# create python file with folowing code and run

"""

from pydarknet import Detector, Image
import cv2
cv2.__version__

net = Detector(bytes("cfg/yolov3.cfg", encoding="utf-8"), bytes("weights/yolov3.weights", encoding="utf-8"), 0, bytes("cfg/coco.data" ,encoding="utf-8"))
img = cv2.imread('crowded-cars-on-street-4032x2272_48736.jpg')
img_darknet = Image(img)

results = net.detect(img_darknet)

for cat, score, bounds in results:
    x, y, w, h = bounds
    cv2.rectangle(img, (int(x - w / 2), int(y - h / 2)), (int(x + w / 2), int(y + h / 2)), (255, 0, 0), thickness=2)
    cv2.putText(img ,str(cat.decode("utf-8")) ,(int(x) ,int(y)) ,cv2.FONT_HERSHEY_COMPLEX ,1 ,(255 ,255 ,0))

cv2.imshow("output", img)
cv2.waitKey(0)


"""

INSTALLER MODELS
https://github.com/madhawav/YOLO3-4-Py/blob/master/download_models.sh

#!/usr/bin/env bash

echo "Downloading config files..."

mkdir cfg
wget -O cfg/coco.data https://raw.githubusercontent.com/pjreddie/darknet/master/cfg/coco.data
wget -O cfg/yolov3.cfg https://raw.githubusercontent.com/pjreddie/darknet/master/cfg/yolov3.cfg

mkdir data
wget -O data/coco.names https://raw.githubusercontent.com/pjreddie/darknet/master/data/coco.names

echo "Downloading yolov3 weights"
mkdir weights
wget -O weights/yolov3.weights https://pjreddie.com/media/files/yolov3.weights

"""