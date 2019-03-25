
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




"""
https://www.pyimagesearch.com/2014/08/18/skin-detection-step-step-example-using-python-opencv/
https://www.learnopencv.com/color-spaces-in-opencv-cpp-python/
https://www.pyimagesearch.com/2014/12/01/complete-guide-building-image-search-engine-python-opencv/
https://lmcaraig.com/image-histograms-histograms-equalization-and-histograms-comparison/
https://www.whatmatrix.com/portal/intro-to-python-image-processing-in-computational-photography/
https://www.learnopencv.com/applycolormap-for-pseudocoloring-in-opencv-c-python/
https://techtutorialsx.com/2018/06/02/python-opencv-converting-an-image-to-gray-scale/
https://www.codementor.io/isaib.cicourel/image-manipulation-in-python-du1089j1u
https://www.pyimagesearch.com/2017/06/19/image-difference-with-opencv-and-python/


https://www.pyimagesearch.com/2014/06/30/super-fast-color-transfer-images/
http://www.askaswiss.com/2016/02/how-to-manipulate-color-temperature-opencv-python.html
"""

img_gray = cv2.imread("img_example.jpg",  cv2.IMREAD_GRAYSCALE)
x = [0, 128, 255]
y = [0, 192, 255]
myLUT = create_LUT_8UC1(x, y)
img_curved = cv2.LUT(img_gray, myLUT).astype(np.uint8)
incr_ch_lut = create_LUT_8UC1([0, 64, 128, 192, 256], [0, 70, 140, 210, 256])
decr_ch_lut = create_LUT_8UC1([0, 64, 128, 192, 256], [0, 30, 80, 120, 192])
c_b, c_g, c_r = cv2.split(img_bgr_in)
c_r = cv2.LUT(c_r, incr_ch_lut).astype(np.uint8)
c_b = cv2.LUT(c_b, decr_ch_lut).astype(np.uint8)
img_bgr_warm = cv2.merge((c_b, c_g, c_r))
c_b = cv2.LUT(c_b, decr_ch_lut).astype(np.uint8)


# increase color saturation
c_h, c_s, c_v = cv2.split(cv2.cvtColor(img_rgb_warm,
    cv2.COLOR_BGR2HSV))
c_s = cv2.LUT(c_s, self.incr_ch_lut).astype(np.uint8)
img_bgr_warm = cv2.cvtColor(cv2.merge(
    (c_h, c_s, c_v)),
    cv2.COLOR_HSV2BGR)


c_b, c_g, c_r = cv2.split(img_bgr_in)
c_r = cv2.LUT(c_r, self.decr_ch_lut).astype(np.uint8)
c_b = cv2.LUT(c_b, self.incr_ch_lut).astype(np.uint8)
img_bgr_cold = cv2.merge((c_b, c_g, c_r))
 # decrease color saturation
c_h, c_s, c_v = cv2.split(cv2.cvtColor(img_bgr_cold,
    cv2.COLOR_BGR2HSV))
c_s = cv2.LUT(c_s, self.decr_ch_lut).astype(np.uint8)
img_bgr_cold = cv2.cvtColor(cv2.merge(
    (c_h, c_s, c_v)),
    cv2.COLOR_HSV2BGR)


#--------------------------------------------


im_gray = cv2.imread("pluto.jpg", cv2.IMREAD_GRAYSCALE)
im_color = cv2.applyColorMap(im_gray, cv2.COLORMAP_JET)

"""
COLORMAP_AUTUMN	colorscale_autumn
COLORMAP_BONE	colorscale_bone
COLORMAP_JET	colorscale_jet
COLORMAP_WINTER	colorscale_winter
COLORMAP_RAINBOW	colorscale_rainbow
COLORMAP_OCEAN	colorscale_ocean
COLORMAP_SUMMER	colorscale_summer
COLORMAP_SPRING	colorscale_spring
COLORMAP_COOL	colorscale_cool
COLORMAP_HSV	colorscale_hsv
COLORMAP_PINK	colorscale_pink
COLORMAP_HOT
"""

#--------------------------------------------

def show_grayscale_histogram(image):
    grayscale_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    draw_image_histogram(grayscale_image, [0])
    plt.show()

def show_rgb_equalized(image):
    channels = cv2.split(image)
    eq_channels = []
    for ch, color in zip(channels, ['B', 'G', 'R']):
        eq_channels.append(cv2.equalizeHist(ch))

    eq_image = cv2.merge(eq_channels)
    eq_image = cv2.cvtColor(eq_image, cv2.COLOR_BGR2RGB)
    plt.imshow(eq_image)
    plt.show()

def show_hsv_equalized(image):
    H, S, V = cv2.split(cv2.cvtColor(image, cv2.COLOR_BGR2HSV))
    eq_V = cv2.equalizeHist(V)
    eq_image = cv2.cvtColor(cv2.merge([H, S, eq_V]), cv2.COLOR_HSV2RGB)
    plt.imshow(eq_image)
    plt.show()

def show_grayscale_equalized(image):
    grayscale_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    eq_grayscale_image = cv2.equalizeHist(grayscale_image)
    plt.imshow(eq_grayscale_image, cmap='gray')
    plt.show()