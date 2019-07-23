################################################################
#
# pip3 install keras --user
# pip3 install pandas --user
# pip3 install numpy --user
# pip3 install tensorflow --user
# pip3 install h5py
# pip3 install matplotlib
#
################################################################

from keras.layers import Conv2D, MaxPooling2D, ZeroPadding2D, Dense, Activation, Dropout, Flatten
from keras import optimizers, applications
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img
from keras.models import Sequential, load_model
from keras.preprocessing.image import img_to_array, load_img

import numpy as np
import cv2
import pandas as pd
import matplotlib.pyplot as plt
from PIL import Image

import tensorflow as tf
from tensorflow import keras
from tensorflow.keras import layers

import os
import sys


img_width = 120
img_height = 120
train_data_dir = 'data/train'
valid_data_dir = 'data/validation'

train_datagen = ImageDataGenerator(rescale=1. / 255,
                                   shear_range=0.2,
                                   zoom_range=0.2,
                                   horizontal_flip=True,
                                   validation_split=0.2)  # set validation split

train_generator = train_datagen.flow_from_directory(directory=train_data_dir,
                                                    target_size=(img_width, img_height),
                                                    classes=['dogs', 'cats'],
                                                    class_mode='binary',
                                                    batch_size=16)

validation_generator = train_datagen.flow_from_directory(directory=valid_data_dir,
                                                         target_size=(img_width, img_height),
                                                         classes=['dogs', 'cats'],
                                                         class_mode='binary',
                                                         batch_size=32)


model = load_model('models/simple_CNN2.h5')
model.load_weights('models/simple_CNN.h5')
model.summary()

print("Loaded model from disk")
# evaluate loaded model on test data
# Define X_test & Y_test data first
model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])
# model.compile(loss='binary_crossentropy', optimizer='rmsprop', metrics=['accuracy'])
model.evaluate_generator(generator=validation_generator, steps=8)

prediction = model.predict_generator(validation_generator, steps=16, verbose=1)
predicted_class_indices = np.argmax(prediction, axis=1)

labels = validation_generator.class_indices
labels = dict((v, k) for k, v in labels.items())
predictions = [labels[k] for k in predicted_class_indices]
print(predictions)




# image = 'data/validation/dogs/dog.1009.jpg'
image = 'data/validation/cats/cat.6.jpg'
imager = Image.open(image).convert('RGB')
size = 240, 240
imager.thumbnail(size, Image.ANTIALIAS)
image_data = np.array(imager)[:, :, 0:4]  # Select RGB channels only.

"""
im = cv2.imread('data/train/cats/cat.6.jpg')
im = cv2.resize(im,  (img_rows, img_cols)) 
#im.reshape(( img_rows, img_cols))
print(im.shape) # (28,28)
"""

#batch = np.expand_dims(im,axis=0)
#print(batch.shape) # (1, 28, 28)
#batch = np.expand_dimes(batch,axis=3)
#print(batch.shape) # (1, 28, 28,1)
... # build the model
model.predict(image_data)


"""
img = np.random.random((4, 4, 3))
#fname = 'data/train/cats/cat.6.jpg'
#img = Image.open(fname).convert("L")
classes = model.predict_classes(img)
print (classes)
"""

#arr = np.asarray(image)
#plt.imshow(arr, cmap='gray', vmin=0, vmax=255)
#plt.show()


"""
img =  plt.imread('data/train/cats/cat.6.jpg');
plt.gray()
classes = model.predict_classes(img)
print (classes)
"""

"""
img = cv2.imread('data/train/cats/cat.6.jpg')
img = cv2.resize(img,(28,28))
img = np.reshape(img,[28,28,3])
classes = model.predict_classes(img)
print (classes)
"""






"""
filenames=validation_generator.filenames
results=pd.DataFrame({"Filename":filenames,
                      "Predictions":predictions})
results.to_csv("results.csv",index=False)
"""

"""
https://www.tensorflow.org/beta/guide/keras/saving_and_serializing
https://keras.io/preprocessing/image/
http://faroit.com/keras-docs/2.0.6/preprocessing/image/

https://machinelearningmastery.com/save-load-keras-deep-learning-models/
https://stackoverflow.com/questions/28170623/how-to-read-hdf5-files-in-python?noredirect=1&lq=1
https://medium.com/@vijayabhaskar96/tutorial-image-classification-with-keras-flow-from-directory-and-generators-95f75ebe5720
https://medium.com/@vijayabhaskar96/tutorial-on-keras-flow-from-dataframe-1fd4493d237c
https://kylewbanks.com/blog/train-validation-split-with-imagedatagenerator-keras
https://stackoverflow.com/questions/42443936/keras-split-train-test-set-when-using-imagedatagenerator
https://gitlab.lrz.de/ga97vof/VisuSpeech/blob/a6cca3457d76183e3a5b26458eafbda01c212989/train.py
https://www.kaggle.com/fanconic/densenet169-approach-test-accuracy-0-897
http://faroit.com/keras-docs/1.2.0/preprocessing/image/
http://faroit.com/keras-docs/1.0.5/preprocessing/image/
https://github.com/jessicayung/self-driving-car-nd/blob/master/p3-behavioural-cloning/p3-behavioural-cloning.ipynb

https://www.degeneratestate.org/posts/2016/Oct/23/image-processing-with-numpy/
https://scikit-image.org/docs/dev/user_guide/numpy_images.html
https://keras.io/layers/convolutional/
http://scipy-lectures.org/advanced/image_processing/

https://stackoverflow.com/questions/41563720/error-when-checking-model-input-expected-convolution2d-input-1-to-have-4-dimens
https://www.kaggle.com/crawford/resize-and-save-images-as-numpy-arrays-128x128

https://towardsdatascience.com/transform-grayscale-images-to-rgb-using-pythons-matplotlib-6a0625d992dd
https://stackoverflow.com/questions/43469281/how-to-predict-input-image-using-trained-model-in-keras
https://stackoverflow.com/questions/49057149/expected-conv2d-1-input-to-have-shape-28-28-1-but-got-array-with-shape-1-2

https://stackoverflow.com/questions/38774977/reshape-array-to-rgb-matrix

"""
