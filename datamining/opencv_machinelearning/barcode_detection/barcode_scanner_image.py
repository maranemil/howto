# import the necessary packages
from pyzbar import pyzbar
import argparse
import cv2

# pip install scipy
# pip install scikit-learn
# pip install pandas
# pip install opencv-python 
# pip install pyzbar
# pip install numpy
# pip install imutils
# https://www.pyimagesearch.com/2018/05/21/an-opencv-barcode-and-qr-code-scanner-with-zbar/
# https://www.pyimagesearch.com/2018/05/21/an-opencv-barcode-and-qr-code-scanner-with-zbar/
# https://www.pyimagesearch.com/2018/03/19/reading-barcodes-with-python-and-openmv/
# https://www.pyimagesearch.com/2014/12/15/real-time-barcode-detection-video-python-opencv/
# https://www.pyimagesearch.com/2014/11/24/detecting-barcodes-images-python-opencv/

 
# construct the argument parser and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True,
	help="path to input image")
args = vars(ap.parse_args())


# load the input image
image = cv2.imread(args["image"])
 
# find the barcodes in the image and decode each of the barcodes
barcodes = pyzbar.decode(image)

# loop over the detected barcodes
for barcode in barcodes:
	# extract the bounding box location of the barcode and draw the
	# bounding box surrounding the barcode on the image
	(x, y, w, h) = barcode.rect
	cv2.rectangle(image, (x, y), (x + w, y + h), (0, 0, 255), 2)
 
	# the barcode data is a bytes object so if we want to draw it on
	# our output image we need to convert it to a string first
	barcodeData = barcode.data.decode("utf-8")
	barcodeType = barcode.type
 
	# draw the barcode data and barcode type on the image
	text = "{} ({})".format(barcodeData, barcodeType)
	cv2.putText(image, text, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX,
		0.5, (0, 255, 0), 2)
 
	# print the barcode type and data to the terminal
	print("[INFO] Found {} barcode: {}".format(barcodeType, barcodeData))
 
# show the output image
cv2.imshow("Image", image)
cv2.waitKey(0)
