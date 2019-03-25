
# sudo apt install python3-pip
# pip3 install opencv-python
# pip3 install matplotlib
# pip3 install numpy
# sudo apt-get install python3-tk
# pip3 install scipy
# pip3 install scikit-image

#sudo apt-get install python-opencv
#sudo apt-get install python-matplotlib


"""
https://matplotlib.org/gallery/subplots_axes_and_figures/axes_margins.html
https://www.learnopencv.com/image-classification-using-convolutional-neural-networks-in-keras/
https://matplotlib.org/users/pyplot_tutorial.html
https://matplotlib.org/api/_as_gen/matplotlib.pyplot.subplot.html


"""


import cv2
import numpy as np
import scipy
import matplotlib.pyplot as plt
from matplotlib import colors
#from mpl_toolkits.mplot3d import Axes3D  # noqa
from matplotlib.colors import hsv_to_rgb

# subplot(nrows, ncols, index, **kwargs)

nemo = cv2.imread('./nature00.jpg',cv2.IMREAD_COLOR ) #   COLOR_BGR2RGB
height, width = nemo.shape[:2]
#nemo = cv2.resize(nemo, None,fx=2, fy=2, interpolation = cv2.INTER_CUBIC)
#nemo = cv2.resize(nemo,(2*width, 2*height), interpolation = cv2.INTER_CUBIC)
nemo = cv2.resize(nemo, (0,0), fx=1.3, fy=1.3)
#nemo = cv2.bitwise_not(nemo) # invert

subplotrows = 5
subplotcols = 6

# define main plot
plt.plot([221])

plt.subplot(subplotrows,subplotcols,1)
plt.title('CV2 Read Image')
plt.axis('off')
plt.grid(False)
plt.imshow(nemo)

#--------------------------------------------

nemo = cv2.cvtColor(nemo, cv2.COLOR_BGR2RGB) # COLOR_BGR2RGB
plt.subplot(subplotrows,subplotcols,2)
plt.title('COLOR_BGR2RGB')
plt.axis('off')
plt.grid(False)
plt.imshow(nemo)
#plt.show()

#--------------------------------------------

"""
hsv_nemo = cv2.cvtColor(nemo, cv2.COLOR_RGB2HSV)
plt.subplot(subplotrows,subplotcols,3)
plt.title('COLOR_RGB2HSV')
plt.axis('off')
plt.grid(False)
plt.imshow(hsv_nemo)
#plt.show()
"""

#--------------------------------------------

gray_nemo = cv2.cvtColor(nemo, cv2.COLOR_RGB2GRAY)
plt.subplot(subplotrows,subplotcols,3)
plt.title('COLOR_RGB2GRAY')
plt.axis('off')
plt.grid(False)
plt.imshow(gray_nemo)
#plt.show()

#--------------------------------------------

#im_gray = cv2.imread(nemo, cv2.IMREAD_GRAYSCALE)
im_color = cv2.applyColorMap(nemo, cv2.COLORMAP_AUTUMN)
plt.subplot(subplotrows,subplotcols,4)
#plt.ylabel('COLORMAP_AUTUMN')
#plt.xlabel('COLORMAP_AUTUMN')
#plt.axis([40, 160, 0, 0.03])
plt.title('COLORMAP_AUTUMN')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color)

#--------------------------------------------

im_color2 = cv2.applyColorMap(nemo, cv2.COLORMAP_BONE)
plt.subplot(subplotrows,subplotcols,5)
plt.title('COLORMAP_BONE')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color2)

#--------------------------------------------

im_color3 = cv2.applyColorMap(nemo, cv2.COLORMAP_JET)
plt.subplot(subplotrows,subplotcols,6)
plt.title('COLORMAP_JET')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color3)

#--------------------------------------------

im_color4 = cv2.applyColorMap(nemo, cv2.COLORMAP_WINTER)
plt.subplot(subplotrows,subplotcols,7)
plt.title('COLORMAP_WINTER')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color4)

#--------------------------------------------

im_color = cv2.applyColorMap(nemo, cv2.COLORMAP_RAINBOW)
plt.subplot(subplotrows,subplotcols,8)
plt.title('COLORMAP_RAINBOW')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color)

#--------------------------------------------

im_color5 = cv2.applyColorMap(nemo, cv2.COLORMAP_OCEAN)
plt.subplot(subplotrows,subplotcols,9)
plt.title('COLORMAP_OCEAN')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color5)

#--------------------------------------------

im_color6 = cv2.applyColorMap(nemo, cv2.COLORMAP_SUMMER)
plt.subplot(subplotrows,subplotcols,10)
plt.title('COLORMAP_SUMMER')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color6)

#--------------------------------------------

im_color7 = cv2.applyColorMap(nemo, cv2.COLORMAP_SPRING)
plt.subplot(subplotrows,subplotcols,11)
plt.title('COLORMAP_SPRING')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color7)

#--------------------------------------------

im_color8 = cv2.applyColorMap(nemo, cv2.COLORMAP_COOL)
plt.subplot(subplotrows,subplotcols,12)
plt.title('COLORMAP_COOL')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color8)

#--------------------------------------------

im_color9 = cv2.applyColorMap(nemo, cv2.COLORMAP_HSV)
plt.subplot(subplotrows,subplotcols,13)
plt.title('COLORMAP_HSV')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color9)

#--------------------------------------------

im_color = cv2.applyColorMap(nemo, cv2.COLORMAP_PINK)
plt.subplot(subplotrows,subplotcols,14)
plt.title('COLORMAP_PINK')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color)

#--------------------------------------------

im_color = cv2.applyColorMap(nemo, cv2.COLORMAP_HOT)
plt.subplot(subplotrows,subplotcols,15)
plt.title('COLORMAP_HOT')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color)

#--------------------------------------------

"""
blur = cv2.GaussianBlur(nemo, (7, 7), 0)
plt.subplot(subplotrows,subplotcols,16)
plt.title('GaussianBlur')
plt.axis('off')
plt.grid(False)
plt.imshow(blur)
"""

"""
# sobel
x_sobel = cv2.Sobel(nemo,cv2.CV_64F,1,0,ksize=5)
y_sobel = cv2.Sobel(nemo,cv2.CV_64F,0,1,ksize=5)
# laplacian
lapl = cv2.Laplacian(nemo,cv2.CV_64F, ksize=5)
# gaussian blur
blur = cv2.GaussianBlur(nemo,(5,5),0)
# laplacian of gaussian
log = cv2.Laplacian(blur,cv2.CV_64F, ksize=5)
plt.subplot(subplotrows,subplotcols,18)
plt.title('sobel + laplacian')
plt.axis('off')
plt.grid(False)
plt.imshow(log)
"""


"""
# Creating our 3 x 3 kernel that would look like this:
# [[ 0.11111111  0.11111111  0.11111111]
#  [ 0.11111111  0.11111111  0.11111111]
#  [ 0.11111111  0.11111111  0.11111111]]
kernel_3x3 = np.ones((3, 3), np.float32) / 9
# We apply the filter and display the image
blurred = cv2.filter2D(nemo, -1, kernel_3x3)
# Let's try with 7 x 7 kernel to get a more blurred image
kernel_7x7 = np.ones((7, 7), np.float32) / 49
blurred2 = cv2.filter2D(nemo, -1, kernel_7x7)
plt.subplot(subplotrows,subplotcols,17)
plt.title('3 x 3 kernel ')
plt.axis('off')
plt.grid(False)
plt.imshow(blurred2)
"""

"""
# Create our shapening kernel, it must equal to one eventually
kernel_sharpening = np.array([[-1,-1,-1],
                              [-1, 9,-1],
                              [-1,-1,-1]])
# applying the sharpening kernel to the input image & displaying it.
sharpened = cv2.filter2D(nemo, -1, kernel_sharpening)
plt.subplot(subplotrows,subplotcols,20)
plt.title('shapening kernel ')
plt.axis('off')
plt.grid(False)
plt.imshow(sharpened)
"""

#--------------------------------------------

processed_image = cv2.medianBlur(nemo, 3)
plt.subplot(subplotrows,subplotcols,16)
plt.title('Median Filter Processing ')
plt.axis('off')
plt.grid(False)
plt.imshow(processed_image)

#--------------------------------------------

kernel = np.ones((3,3),np.float32)/9
processed_image = cv2.filter2D(nemo,-1,kernel)
#cv2.imshow('Mean Filter Processing', processed_image)
plt.subplot(subplotrows,subplotcols,17)
plt.title('Mean Filter Processing ')
plt.axis('off')
plt.grid(False)
plt.imshow(processed_image)

#--------------------------------------------

"""
im_color = cv2.cvtColor(nemo, cv2.COLOR_BGR2HSV)
plt.subplot(subplotrows,subplotcols,23)
plt.title('COLOR_BGR2HSV')
plt.axis('off')
plt.grid(False)
plt.imshow(im_color)
"""

#--------------------------------------------

img_rgb_warm = cv2.cvtColor(nemo, cv2.COLOR_BGR2RGB)
# increase color saturation
img_bgr_warm = cv2.cvtColor(img_rgb_warm, cv2.COLOR_HSV2BGR)
plt.subplot(subplotrows,subplotcols,18)
plt.title('BGR2RGB + HSV2BGR')
plt.axis('off')
plt.grid(False)
plt.imshow(img_bgr_warm)

#--------------------------------------------

img_bgr_cold = cv2.cvtColor( img_bgr_warm, cv2.COLOR_RGB2GRAY)
plt.subplot(subplotrows,subplotcols,19)
plt.title('COLOR_RGB2GRAY')
plt.axis('off')
plt.grid(False)
plt.imshow(img_bgr_cold)

#--------------------------------------------

gray_img = cv2.cvtColor(nemo, cv2.COLOR_RGB2GRAY)
gray_img = cv2.cvtColor(gray_img, cv2.COLOR_GRAY2RGB)
plt.subplot(subplotrows,subplotcols,20)
plt.title('COLOR_GRAY2RGB')
plt.axis('off')
plt.grid(False)
plt.imshow(gray_img)

#--------------------------------------------

"""
piet_hsv = cv2.cvtColor(nemo, cv2.COLOR_BGR2HSV)
piet_hsv = cv2.cvtColor(piet_hsv, cv2.COLOR_BGR2RGB)
plt.subplot(subplotrows,subplotcols,27)
plt.title('piet_hsv')
plt.axis('off')
plt.grid(False)
plt.imshow(piet_hsv)
"""

#--------------------------------------------

gray_img = cv2.cvtColor(nemo, cv2.COLOR_RGB2GRAY)
adaptive_thresh = cv2.adaptiveThreshold(gray_img,255,\
                                         cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
                                         cv2.THRESH_BINARY,11,2)
adaptive_thresh2 = cv2.cvtColor(adaptive_thresh, cv2.COLOR_GRAY2RGB)
plt.subplot(subplotrows,subplotcols,21)
plt.title('adaptive_thresh2')
plt.axis('off')
plt.grid(False)
plt.imshow(adaptive_thresh2)

"""
cups = cv2.cvtColor(nemo, cv2.COLOR_BGR2RGB)
cups_preprocessed  = cv2.cvtColor(cv2.GaussianBlur(cups, (7,7), 0), cv2.COLOR_BGR2GRAY)
cups_edges = cv2.Canny(cups_preprocessed, threshold1=90, threshold2=110)
cups_edges2 = cv2.cvtColor(cups_edges, cv2.COLOR_GRAY2RGB)
plt.subplot(subplotrows,subplotcols,29)
plt.title('adaptive_thresh2')
plt.axis('off')
plt.grid(False)
plt.imshow(cups_edges2)
"""
#--------------------------------------------





#import numpy as np
import skimage
from skimage import io, filters

def channel_adjust(channel, values):
    orig_size = channel.shape
    flat_channel = channel.flatten()
    adjusted = np.interp(flat_channel, np.linspace(0, 1, len(values)), values)
    return adjusted.reshape(orig_size)

def split_image_into_channels(image):
    red_channel = image[:, :, 0]
    green_channel = image[:, :, 1]
    blue_channel = image[:, :, 2]
    return red_channel, green_channel, blue_channel

def merge_channels(red_channel, green_channel, blue_channel):
    return np.stack([red_channel, green_channel, blue_channel], axis=2)

def sharpen(image, a, b, sigma=10):
    blurred = filters.gaussian(image, sigma=sigma, multichannel=True)
    sharper = np.clip(image * a - blurred * b, 0, 1.0)
    return sharper

r, g, b = split_image_into_channels(nemo)
rgbskimage = merge_channels(r, g, b)
plt.subplot(subplotrows,subplotcols,22)
plt.title('rgb skimage')
plt.axis('off')
plt.grid(False)
plt.imshow(rgbskimage)

#--------------------------------------------

r, g, b = split_image_into_channels(nemo)
r_boost_lower = channel_adjust(r, [  0, 0.05, 0.1, 0.2, 0.3, 0.5, 0.7, 0.8, 0.9, 0.95, 1.0 ])
bluer_blacks = merge_channels(r_boost_lower, g, np.clip(b + 0.3, 0.3, 1.0))
sharperskimage = sharpen(bluer_blacks, 0.25, 0.2, sigma=15)
r, g, b = split_image_into_channels(sharperskimage)
b_adjusted = channel_adjust(b, [
    0, 0.047, 0.118, 0.251, 0.318, 0.392, 0.42, 0.439, 0.475, 0.561, 0.58, 0.627, 0.671,
    0.733, 0.847, 0.925, 1.0     ])

plt.subplot(subplotrows,subplotcols,23)
plt.title('adjust+skimage')
plt.axis('off')
plt.grid(False)
plt.imshow(sharperskimage)

# ----------------------------------------------

rgba = cv2.cvtColor(nemo, cv2.COLOR_BGR2RGBA)
plt.subplot(subplotrows,subplotcols,24)
plt.title('COLOR_BGR2RGBA')
plt.axis('off')
plt.grid(False)
plt.imshow(rgba)

# ----------------------------------------------
"""
rgbay = cv2.cvtColor(nemo, cv2.COLOR_YCrCb2BGR)
plt.subplot(subplotrows,subplotcols,27)
plt.title('COLOR_YCrCb2BGR')
plt.axis('off')
plt.grid(False)
plt.imshow(rgbay)

# ----------------------------------------------

rgbay = cv2.cvtColor(nemo, cv2.COLOR_BGR2YCrCb)
plt.subplot(subplotrows,subplotcols,28)
plt.title('COLOR_BGR2YCrCb')
plt.axis('off')
plt.grid(False)
plt.imshow(rgbay)
"""

# ----------------------------------------------

rgbay = cv2.cvtColor(nemo, cv2.COLOR_YUV2RGB) #
plt.subplot(subplotrows,subplotcols,25)
plt.title('COLOR_YUV2RGB')
plt.axis('off')
plt.grid(False)
plt.imshow(rgbay)

# ----------------------------------------------

rgbay = cv2.cvtColor(nemo, cv2.COLOR_BGR2RGBA)
rgbay[np.all(rgbay == [0, 0, 0, 255], axis=2)] = [0, 0, 0, 0]
plt.subplot(subplotrows,subplotcols,26)
plt.title('COLOR_BGR2RGBA')
plt.axis('off')
plt.grid(False)
plt.imshow(rgbay)

#--------------------------------------------

hsv = cv2.cvtColor(nemo, cv2.COLOR_BGR2HSV)
# define range of blue color in HSV
lower_blue = np.array([110,50,50])
upper_blue = np.array([210,155,255])
# Threshold the HSV image to get only blue colors
mask = cv2.inRange(hsv, lower_blue, upper_blue)
# Bitwise-AND mask and original image
res = cv2.bitwise_and(nemo,nemo, mask= mask)
plt.subplot(subplotrows,subplotcols,27)
plt.title('COLOR_BGR2Lab')
plt.axis('off')
plt.grid(False)
plt.imshow(mask)

#--------------------------------------------

def f(t):
    return np.exp(-t) * np.cos(2*np.pi*t)

valueA=5
valueB=2
hsvbright = cv2.cvtColor(nemo, cv2.COLOR_BGR2HSV) #convert it to hsv
for x in range(0, len(hsvbright)-100):
    for y in range(0, len(hsvbright[0])):
        hsvbright[x, y][2] += valueA
        hsvbright[x, y][1] += valueB
        hsvbright[x, y][0] += valueB
        #hsvbright[:,:,2] += value
hsvbright2 = cv2.cvtColor(hsvbright, cv2.COLOR_HSV2BGR)
plt.subplot(subplotrows,subplotcols,28).margins(2,2)
plt.title('BGR2HSV+HSV2BGR')
plt.axis('off')
plt.grid(False)
plt.imshow(hsvbright2)

#--------------------------------------------


plt.legend(loc='best')
plt.show()
cv2.waitKey(0)
cv2.destroyAllWindows()








"""
https://github.com/despoisj/VariationalAutoEncoder/blob/master/visuals.py
https://www.pyimagesearch.com/2015/03/09/capturing-mouse-click-events-with-python-and-opencv/
https://www.kaggle.com/gaborvecsei/plants-t-sne
https://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Changing_ColorSpaces_RGB_HSV_HLS.php
https://lmcaraig.com/image-histograms-histograms-equalization-and-histograms-comparison/
https://www.programcreek.com/python/example/70393/cv2.IMREAD_COLOR
https://www.learnopencv.com/color-spaces-in-opencv-cpp-python/
http://benjamintan.io/blog/2018/05/24/making-transparent-backgrounds-with-numpy-and-opencv-in-python/
https://docs.opencv.org/3.4/d4/dbd/tutorial_filter_2d.html
https://www.practicepython.org/blog/2016/12/20/instagram-filters-python.html
https://piratefsh.github.io/image-processing-101/
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_imgproc/py_canny/py_canny.html
https://opencv-python-tutroals.readthedocs.io/en/latest/py_tutorials/py_core/py_basic_ops/py_basic_ops.html
https://matplotlib.org/users/pyplot_tutorial.html
https://matplotlib.org/api/_as_gen/matplotlib.pyplot.subplot.html
https://matplotlib.org/api/_as_gen/matplotlib.figure.Figure.html#matplotlib.figure.Figure.add_subplot
https://docs.opencv.org/3.4.2/da/d6e/tutorial_py_geometric_transformations.html
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
https://docs.opencv.org/3.4/d4/dbd/tutorial_filter_2d.html
https://www.programcreek.com/python/example/89295/cv2.bitwise_not
"""



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



"""
COLORMAP_AUTUMN colorscale_autumn
COLORMAP_BONE   colorscale_bone
COLORMAP_JET    colorscale_jet
COLORMAP_WINTER colorscale_winter
COLORMAP_RAINBOW    colorscale_rainbow
COLORMAP_OCEAN  colorscale_ocean
COLORMAP_SUMMER colorscale_summer
COLORMAP_SPRING colorscale_spring
COLORMAP_COOL   colorscale_cool
COLORMAP_HSV    colorscale_hsv
COLORMAP_PINK   colorscale_pink
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






