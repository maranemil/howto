#######################################################################
#
#   Data preparation for deep learning: images to a .npy file
#   https://qiita.com/li-li-qiita/items/1e7827ced044c3277c70
#
#######################################################################

# Preparation

import os
import time  # only if you want to track the processing time
import numpy as np  # for matrix manipulation
from PIL import Image  # for loading image files
from multiprocessing import Pool  # if you want to leverage multi-core cpu(s)
import glob # this is for listing all the files in a folder

# File location

base_path = os.path.dirname(os.path.dirname(__file__))
base_path = 'G:\Image data' + base_path[13:]
files = os.scandir(base_path) # scan files in the directory

# Defining new functions

def imload(filename):
    im = Image.open(filename)  # load an image file
    imarray = np.array(im)  # convert it to a matrix
    # image augmentation / preprocessing from here
    # Following example shows how to make all the image into the same size.
    W = min(imarray.shape)  # find the smallest dimension of the image
    if W<190:  # I want to make them 190 x 190
        edgeL = imarray[:,0:190-W]
        edgeR = imarray[:,2*W-190-1:-1]
        if np.std(edgeL) < np.std(edgeR):
            imarray = np.concatenate((np.flip(edgeL,axis=1),imarray),axis=1)
        else:
            imarray = np.concatenate((imarray, np.flip(edgeR,axis=1)),axis=1)
    # If the image is larger than 190 x 190, it will be trimmed here.
    imarray = imarray[0:190, 0:190]
    return imarray

def multi_process(sampleList):
    # number of processors
    p = Pool(24)  # indicate how many threads you are going to use
    # use starmap if you need more than 2 input variables for imload like:
    # output = p.starmap(imload, sampleList, var)
    output = p.map(imload, sampleList)
    p.close()
    return output

# Convert image to npy

start = time.time()  # start measuring time
if __name__ == '__main__':
    __spec__ = None
    # list up file names end with ".tif"
    fnamelist = glob.glob(os.path.join(folder_path, '*.tif'))

    # input file name list to multiprocessing function
    blob = multi_process(fnamelist)
    # You will get a matrix with 190 x 190 x number_of_images dimensions

    # determine a new name for an npy file
    img_conv_name = 'imgarray_' + cellname + '_' + concnames + '.npy'
    img_conv_name = os.path.join(newloc[fldrlayer],img_conv_name)

    # stretching each image into a 1D array, and adding index and label at the end of the array
    ind = np.reshape(np.arange(1, len(blob)+1), (-1, 1))
    blob_nparray = np.reshape(np.asarray(blob), (len(blob), blob[1].size))
    blob_nparray = np.hstack((blob_nparray, ind, conc * np.ones((len(blob), 1))))

    # change data type from float64 to float32
    blob_nparray = np.asarray(blob_nparray, dtype=np.float32)

    # save this as .npy file
    np.save(img_conv_name, blob_nparray)

    elapsed = time.time() - start  # stop the stopwatch
    print('Time elapsed: {:10.1f} \nFile saved: '.format(elapsed) + img_conv_name)

