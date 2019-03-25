
"""
https://realpython.com/python-opencv-color-spaces/
https://docs.opencv.org/3.1.0/d4/d13/tutorial_py_filtering.html
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_filtering/py_filtering.html
https://docs.opencv.org/3.1.0/d7/d1b/group__imgproc__misc.html
https://www.programcreek.com/python/example/71304/cv2.COLOR_BGR2RGB
https://www.programcreek.com/python/example/89441/cv2.COLOR_RGB2HSV
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_colorspaces/py_colorspaces.html
https://docs.opencv.org/3.1.0/de/d25/imgproc_color_conversions.html
https://vovkos.github.io/doxyrest-showcase/opencv/sphinxdoc/enum_cv_ColorConversionCodes.html
https://www.ccoderun.ca/programming/doxygen/opencv/group__imgproc__color__conversions.html
http://bytedeco.org/javacpp-presets/opencv/apidocs/org/bytedeco/javacpp/opencv_imgproc.html
https://csharp.hotexamples.com/examples/-/ColorConversionCodes/-/php-colorconversioncodes-class-examples.html
https://docs.opencv.org/3.4.0/d4/d86/group__imgproc__filter.html
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_table_of_contents_imgproc/py_table_of_contents_imgproc.html
https://hub.packtpub.com/image-filtering-techniques-opencv/
https://docs.opencv.org/3.1.0/d7/d1b/group__imgproc__misc.html
https://pythonprogramming.net/blurring-smoothing-python-opencv-tutorial/
https://medium.com/@almutawakel.ali/opencv-filters-arithmetic-operations-2f4ff236d6aa
https://github.com/realpython/materials/blob/master/opencv-color-spaces/finding-nemo.py
https://www.programcreek.com/python/example/89374/cv2.medianBlur
https://www.bogotobogo.com/OpenCV/opencv_3_tutorial_imgproc_gausian_median_blur_bilateral_filter_image_smoothing_B.php
https://docs.opencv.org/3.3.1/dc/dd3/tutorial_gausian_median_blur_bilateral_filter.html
https://code.tutsplus.com/tutorials/image-filtering-in-python--cms-29202
"""

import cv2
import numpy as np
import matplotlib.pyplot as plt
from matplotlib import colors
from mpl_toolkits.mplot3d import Axes3D  # noqa
from matplotlib.colors import hsv_to_rgb

nemo = cv2.imread('./testpy.jpg')
#nemo = cv2.resize(nemo, (224, 224))
plt.imshow(nemo)
plt.show()

rgbnemo = cv2.cvtColor(nemo, cv2.COLOR_BGR2RGB)
plt.imshow(rgbnemo)
plt.show()

hsv_nemo = cv2.cvtColor(nemo, cv2.COLOR_RGB2HSV)
plt.imshow(hsv_nemo)
plt.show()

gray_nemo = cv2.cvtColor(nemo, cv2.COLOR_RGB2GRAY)
plt.imshow(gray_nemo)
plt.show()


light_orange = (1, 190, 200)
dark_orange = (18, 255, 255)
mask = cv2.inRange(hsv_nemo, light_orange, dark_orange)
result = cv2.bitwise_and(nemo, nemo, mask=mask)
plt.subplot(1, 2, 1)
plt.imshow(mask, cmap="gray")
plt.subplot(1, 2, 2)
plt.imshow(result)
plt.show()

light_white = (0, 0, 200)
dark_white = (145, 60, 255)
mask_white = cv2.inRange(hsv_nemo, light_white, dark_white)
result_white = cv2.bitwise_and(nemo, nemo, mask=mask_white)
plt.subplot(1, 2, 1)
plt.imshow(mask_white, cmap="gray")
plt.subplot(1, 2, 2)
plt.imshow(result_white)
plt.show()

final_mask = mask + mask_white
final_result = cv2.bitwise_and(nemo, nemo, mask=final_mask)
plt.subplot(1, 2, 1)
plt.imshow(final_mask, cmap="gray")
plt.subplot(1, 2, 2)
plt.imshow(final_result)
plt.show()

blur = cv2.GaussianBlur(final_result, (7, 7), 0)
plt.imshow(blur)
plt.show()

# sobel
x_sobel = cv2.Sobel(nemo,cv2.CV_64F,1,0,ksize=5)
y_sobel = cv2.Sobel(nemo,cv2.CV_64F,0,1,ksize=5)
# laplacian
lapl = cv2.Laplacian(nemo,cv2.CV_64F, ksize=5)
# gaussian blur
blur = cv2.GaussianBlur(nemo,(5,5),0)
# laplacian of gaussian
log = cv2.Laplacian(blur,cv2.CV_64F, ksize=5)
plt.imshow(log)
plt.show()



# Creating our 3 x 3 kernel that would look like this:
# [[ 0.11111111  0.11111111  0.11111111]
#  [ 0.11111111  0.11111111  0.11111111]
#  [ 0.11111111  0.11111111  0.11111111]]
kernel_3x3 = np.ones((3, 3), np.float32) / 9
# We apply the filter and display the image
blurred = cv2.filter2D(image, -1, kernel_3x3)
cv2.imshow('3x3 Kernel Blurring', blurred)
cv2.waitKey(0)
# Let's try with 7 x 7 kernel to get a more blurred image
kernel_7x7 = np.ones((7, 7), np.float32) / 49
blurred2 = cv2.filter2D(image, -1, kernel_7x7)
cv2.imshow('7x7 Kernel Blurring', blurred2)
cv2.waitKey(0)
#cv2.destroyAllWindows()



# Create our shapening kernel, it must equal to one eventually
kernel_sharpening = np.array([[-1,-1,-1],
                              [-1, 9,-1],
                              [-1,-1,-1]])
# applying the sharpening kernel to the input image & displaying it.
sharpened = cv2.filter2D(image, -1, kernel_sharpening)
cv2.imshow('Image Sharpening', sharpened)
cv2.waitKey(0)
#cv2.destroyAllWindows()



processed_image = cv2.medianBlur(nemo, 3)
# display image
cv2.imshow('Median Filter Processing', processed_image)
# save image to disk
#cv2.imwrite('processed_image.png', processed_image)
cv2.waitKey(0)
#cv2.destroyAllWindows()



kernel = np.ones((3,3),np.float32)/9
processed_image = cv2.filter2D(nemo,-1,kernel)
cv2.imshow('Mean Filter Processing', processed_image)
#cv2.imwrite('processed_image.png', processed_image)
# pause the execution of the script until a key on the keyboard is pressed
cv2.waitKey(0)


cv2.destroyAllWindows()