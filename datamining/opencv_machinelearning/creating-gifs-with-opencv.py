"""
Creating GIFs with OpenCV
    https: // www.pyimagesearch.com / 2018 / 11 / 05 / creating - gifs -
    with-opencv /

sudo apt-get install imagemagick
pip install imutils

"""

# import the necessary packages
from imutils import face_utils
from imutils import paths
import numpy as np
import argparse
import imutils
import shutil
import json
import dlib
import cv2
import sys
import os


def overlay_image(bg, fg, fgMask, coords):
    # grab the foreground spatial dimensions (width and height),
    # then unpack the coordinates tuple (i.e., where in the image
    # the foreground will be placed)
    (sH, sW) = fg.shape[:2]
    (x, y) = coords

    # the overlay should be the same width and height as the input
    # image and be totally blank *except* for the foreground which
    # we add to the overlay via array slicing
    overlay = np.zeros(bg.shape, dtype="uint8")
    overlay[y:y + sH, x:x + sW] = fg

    # the alpha channel, which controls *where* and *how much*
    # transparency a given region has, should also be the same
    # width and height as our input image, but will contain only
    # our foreground mask
    alpha = np.zeros(bg.shape[:2], dtype="uint8")
    alpha[y:y + sH, x:x + sW] = fgMask
    alpha = np.dstack([alpha] * 3)

    # perform alpha blending to merge the foreground, background,
    # and alpha channel together
    output = alpha_blend(overlay, bg, alpha)

    # return the output image
    return output


def alpha_blend(fg, bg, alpha):
    # convert the foreground, background, and alpha layers from
    # unsigned 8-bit integers to floats, making sure to scale the
    # alpha layer to the range [0, 1]
    fg = fg.astype("float")
    bg = bg.astype("float")
    alpha = alpha.astype("float") / 255

    # perform alpha blending
    fg = cv2.multiply(alpha, fg)
    bg = cv2.multiply(1 - alpha, bg)

    # add the foreground and background to obtain the final output
    # image
    output = cv2.add(fg, bg)

    # return the output image
    return output.astype("uint8")


def create_gif(inputPath, outputPath, delay, finalDelay, loop):
    # grab all image paths in the input directory
    imagePaths = sorted(list(paths.list_images(inputPath)))

    # remove the last image path in the list
    lastPath = imagePaths[-1]
    imagePaths = imagePaths[:-1]

    # construct the image magick 'convert' command that will be used
    # generate our output GIF, giving a larger delay to the final
    # frame (if so desired)
    cmd = "convert -delay {} {} -delay {} {} -loop {} {}".format(
        delay, " ".join(imagePaths), finalDelay, lastPath, loop,
        outputPath)
    os.system(cmd)


# construct the argument parser and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-c", "--config", required=True,
                help="path to configuration file")
ap.add_argument("-i", "--image", required=True,
                help="path to input image")
ap.add_argument("-o", "--output", required=True,
                help="path to output GIF")
args = vars(ap.parse_args())

# load the JSON configuration file and the "Deal With It" sunglasses
# and associated mask
config = json.loads(open(args["config"]).read())
sg = cv2.imread(config["sunglasses"])
sgMask = cv2.imread(config["sunglasses_mask"])

# delete any existing temporary directory (if it exists) and then
# create a new, empty directory where we'll store each individual
# frame in the GIF
shutil.rmtree(config["temp_dir"], ignore_errors=True)
os.makedirs(config["temp_dir"])

# load our OpenCV face detector and dlib facial landmark predictor
print("[INFO] loading models...")
detector = cv2.dnn.readNetFromCaffe(config["face_detector_prototxt"],
                                    config["face_detector_weights"])
predictor = dlib.shape_predictor(config["landmark_predictor"])

# load the input image and construct an input blob from the image
image = cv2.imread(args["image"])
(H, W) = image.shape[:2]
blob = cv2.dnn.blobFromImage(cv2.resize(image, (300, 300)), 1.0,
                             (300, 300), (104.0, 177.0, 123.0))

# pass the blob through the network and obtain the detections
print("[INFO] computing object detections...")
detector.setInput(blob)
detections = detector.forward()

# we'll assume there is only one face we'll be applying the "Deal
# With It" sunglasses to so let's find the detection with the largest
# probability
i = np.argmax(detections[0, 0, :, 2])
confidence = detections[0, 0, i, 2]

# filter out weak detections
if confidence < config["min_confidence"]:
    print("[INFO] no reliable faces found")
    sys.exit(0)

# compute the (x, y)-coordinates of the bounding box for the face
box = detections[0, 0, i, 3:7] * np.array([W, H, W, H])
(startX, startY, endX, endY) = box.astype("int")

# construct a dlib rectangle object from our bounding box coordinates
# and then determine the facial landmarks for the face region
rect = dlib.rectangle(int(startX), int(startY), int(endX), int(endY))
shape = predictor(image, rect)
shape = face_utils.shape_to_np(shape)

# grab the indexes of the facial landmarks for the left and right
# eye, respectively, then extract (x, y)-coordinates for each eye
(lStart, lEnd) = face_utils.FACIAL_LANDMARKS_IDXS["left_eye"]
(rStart, rEnd) = face_utils.FACIAL_LANDMARKS_IDXS["right_eye"]
leftEyePts = shape[lStart:lEnd]
rightEyePts = shape[rStart:rEnd]

# compute the center of mass for each eye
leftEyeCenter = leftEyePts.mean(axis=0).astype("int")
rightEyeCenter = rightEyePts.mean(axis=0).astype("int")

# compute the angle between the eye centroids
dY = rightEyeCenter[1] - leftEyeCenter[1]
dX = rightEyeCenter[0] - leftEyeCenter[0]
angle = np.degrees(np.arctan2(dY, dX)) - 180

# rotate the sunglasses image by our computed angle, ensuring the
# sunglasses will align with how the head is tilted
sg = imutils.rotate_bound(sg, angle)

# the sunglasses shouldn't be the *entire* width of the face and
# ideally should just cover the eyes -- here we'll do a quick
# approximation and use 90% of the face width for the sunglasses
# width
sgW = int((endX - startX) * 0.9)
sg = imutils.resize(sg, width=sgW)

# our sunglasses contain transparency (the bottom parts, underneath
# the lenses and nose) so in order to achieve that transparency in
# the output image we need a mask which we'll use in conjunction with
# alpha blending to obtain the desired result -- here we're binarizing
# our mask and performing the same image processing operations as
# above
sgMask = cv2.cvtColor(sgMask, cv2.COLOR_BGR2GRAY)
sgMask = cv2.threshold(sgMask, 0, 255, cv2.THRESH_BINARY)[1]
sgMask = imutils.rotate_bound(sgMask, angle)
sgMask = imutils.resize(sgMask, width=sgW, inter=cv2.INTER_NEAREST)

# our sunglasses will drop down from the top of the frame so let's
# define N equally spaced steps between the top of the frame and the
# desired end location
steps = np.linspace(0, rightEyeCenter[1], config["steps"],
                    dtype="int")

# start looping over the steps
for (i, y) in enumerate(steps):
    # compute our translation values to move the sunglasses both
    # slighty to the left and slightly up -- the reason why we are
    # doing this is so the sunglasses don't *start* directly at
    # the center of our eye, translation helps us shift the
    # sunglasses to adequately cover our entire eyes (otherwise
    # what good are sunglasses!)
    shiftX = int(sg.shape[1] * 0.25)
    shiftY = int(sg.shape[0] * 0.35)
    y = max(0, y - shiftY)

    # add the sunglasses to the image
    output = overlay_image(image, sg, sgMask,
                           (rightEyeCenter[0] - shiftX, y))

    # if this is the final step then we need to add the "DEAL WITH
    # IT" text to the bottom of the frame
    if i == len(steps) - 1:
        # load both the "DEAL WITH IT" image and mask from disk,
        # ensuring we threshold the mask as we did for the sunglasses
        dwi = cv2.imread(config["deal_with_it"])
        dwiMask = cv2.imread(config["deal_with_it_mask"])
        dwiMask = cv2.cvtColor(dwiMask, cv2.COLOR_BGR2GRAY)
        dwiMask = cv2.threshold(dwiMask, 0, 255,
                                cv2.THRESH_BINARY)[1]

        # resize both the text image and mask to be 80% the width of
        # the output image
        oW = int(W * 0.8)
        dwi = imutils.resize(dwi, width=oW)
        dwiMask = imutils.resize(dwiMask, width=oW,
                                 inter=cv2.INTER_NEAREST)

        # compute the coordinates of where the text will go on the
        # output image and then add the text to the image
        oX = int(W * 0.1)
        oY = int(H * 0.8)
        output = overlay_image(output, dwi, dwiMask, (oX, oY))

    # write the output image to our temporary directory
    p = os.path.sep.join([config["temp_dir"], "{}.jpg".format(
        str(i).zfill(8))])
    cv2.imwrite(p, output)

# now that all of our frames have been written to disk we can finally
# create our output GIF image
print("[INFO] creating GIF...")
create_gif(config["temp_dir"], args["output"], config["delay"],
           config["final_delay"], config["loop"])

# cleanup by deleting our temporary directory
print("[INFO] cleaning up...")
shutil.rmtree(config["temp_dir"], ignore_errors=True)


"""

$ python create_gif.py - -config config.json - -image images / adrian.jpg \
- -output adrian_out.gif

python create_gif.py - -config config.json - -image images / adrian_jp.jpg \
- -output adrian_jp_out.gif

$ python create_gif.py - -config config.json - -image images / vampire.jpg \
- -output vampire_out.gif

pip install -upgrade imutils

"""
