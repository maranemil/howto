"""
pip3 install opencv-python  numpy pandas scipy matplotlib tensorflow scikit-learn
sudo apt-get install python3-tk

Installing collected packages: numpy, opencv-python, six, python-dateutil, pytz, pandas, scipy, setuptools, kiwisolver, cycler, pyparsing, matplotlib, wheel, keras-preprocessing, absl-py, gast, protobuf, werkzeug, grpcio, markdown, tensorboard, astor, termcolor, h5py, keras-applications, pbr, mock, tensorflow-estimator, tensorflow, scikit-learn
Successfully installed absl-py-0.7.1 astor-0.7.1 cycler-0.10.0 gast-0.2.2 grpcio-1.19.0 h5py-2.9.0 keras-applications-1.0.7 keras-preprocessing-1.0.9 kiwisolver-1.0.1 markdown-3.1 matplotlib-3.0.3 mock-2.0.0 numpy-1.16.2 opencv-python-4.1.0.25 pandas-0.24.2 pbr-5.1.3 protobuf-3.7.1 pyparsing-2.4.0 python-dateutil-2.8.0 pytz-2019.1 scikit-learn-0.20.3 scipy-1.2.1 setuptools-41.0.0 six-1.12.0 tensorboard-1.13.1 tensorflow-1.13.1 tensorflow-estimator-1.13.0 termcolor-1.1.0 werkzeug-0.15.2 wheel-0.33.1

https://docs.opencv.org/3.2.0/d5/d26/tutorial_py_knn_understanding.html
https://docs.opencv.org/3.0-beta/doc/py_tutorials/py_ml/py_knn/py_knn_understanding/py_knn_understanding.html
"""

import cv2
import numpy as np
import matplotlib.pyplot as plt
import tkinter as Tk

Tk._test()
# Feature set containing (x,y) values of 25 known/training data
trainData = np.random.randint(0,100,(25,2)).astype(np.float32)
# Labels each one either Red or Blue with numbers 0 and 1
responses = np.random.randint(0,2,(25,1)).astype(np.float32)
# Take Red families and plot them
red = trainData[responses.ravel()==0]
plt.scatter(red[:,0],red[:,1],80,'r','^')
# Take Blue families and plot them
blue = trainData[responses.ravel()==1]
plt.scatter(blue[:,0],blue[:,1],80,'b','s')
#plt.imshow("test.png")
plt.show()

# KNearest CV"
newcomer = np.random.randint(0,100,(1,2)).astype(np.float32)
plt.scatter(newcomer[:,0],newcomer[:,1],80,'g','o')
knn = cv2.ml.KNearest_create()
knn.train(trainData, cv2.ml.ROW_SAMPLE, responses)
ret, results, neighbours ,dist = knn.findNearest(newcomer, 3)
print ("result: ", results,"\n")
print ("neighbours: ", neighbours,"\n")
print ("distance: ", dist)
#plt.imshow("test.png")
plt.show()