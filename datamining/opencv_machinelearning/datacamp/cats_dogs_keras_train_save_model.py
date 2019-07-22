from keras.layers import Conv2D, MaxPooling2D, ZeroPadding2D
from keras.layers import Dense, Activation, Dropout, Flatten
from keras import optimizers
from keras.models import Sequential
from keras.preprocessing.image import ImageDataGenerator
import numpy as np

# step 1: load data
# https://github.com/vyomshm/Cats-Dogs-with-keras

# data
# - train
# -- cats
# --- cat.0.jpg
# -- dogs
# --- dog.0.jpg
# - validation
# -- cats
# --- cat.1000.jpg

img_width = 150
img_height = 150
train_data_dir = 'data/train'
valid_data_dir = 'data/validation'

datagen = ImageDataGenerator(rescale=1. / 255)
train_generator = datagen.flow_from_directory(directory=train_data_dir,
                                              target_size=(img_width, img_height),
                                              classes=['dogs', 'cats'],
                                              class_mode='binary',
                                              batch_size=16)

validation_generator = datagen.flow_from_directory(directory=valid_data_dir,
                                                   target_size=(img_width, img_height),
                                                   classes=['dogs', 'cats'],
                                                   class_mode='binary',
                                                   batch_size=32)

# step-2 : build model

model = Sequential()
model.add(Conv2D(32, (3, 3), input_shape=(img_width, img_height, 3)))
model.add(Activation('relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))

model.add(Conv2D(32, (3, 3), input_shape=(img_width, img_height, 3)))
model.add(Activation('relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))

model.add(Conv2D(64, (3, 3), input_shape=(img_width, img_height, 3)))
model.add(Activation('relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))

model.add(Flatten())
model.add(Dense(64))
model.add(Activation('relu'))
model.add(Dropout(0.5))
model.add(Dense(1))
model.add(Activation('sigmoid'))

model.compile(loss='binary_crossentropy', optimizer='rmsprop', metrics=['accuracy'])

print('model complied!!')
print('starting training....')
# epochs = 32
training = model.fit_generator(generator=train_generator, steps_per_epoch=2048 // 16, epochs=1,
                               validation_data=validation_generator, validation_steps=832 // 16)

print('training finished!!')
print('saving weights to simple_CNN.h5')
model.save_weights('models/simple_CNN.h5')
print('all weights saved successfully !!')
# models.load_weights('models/simple_CNN.h5')












################################################################

from keras.layers import Conv2D, MaxPooling2D, ZeroPadding2D
from keras.layers import Dense, Activation, Dropout, Flatten
from keras import optimizers
from keras.models import Sequential
import numpy as np
from keras.models import load_model
from keras.preprocessing.image import img_to_array, load_img
import cv2
import pandas as pd
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img
from keras import applications

# pip3 install pandas --user

img_width = 120
img_height = 120
train_data_dir = 'data/train'
valid_data_dir = 'data/validation'

datagen = ImageDataGenerator(rescale=1. / 255)

train_datagen = ImageDataGenerator(rescale=1./255,
    shear_range=0.2,
    zoom_range=0.2,
    horizontal_flip=True,
    validation_split=0.2) # set validation split

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

from keras.models import load_model
model = load_model('models/simple_CNN2.h5')
model.load_weights('models/simple_CNN.h5')
model.summary()

imgdd = 'data/validation/dogs/dog.1009.jpg'

print("Loaded model from disk")
# evaluate loaded model on test data
# Define X_test & Y_test data first
model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])
model.evaluate_generator(generator=validation_generator,
steps=8)


pred=model.predict_generator(validation_generator,steps=16,verbose=1)
predicted_class_indices=np.argmax(pred,axis=1)

labels = (validation_generator.class_indices)
labels = dict((v,k) for k,v in labels.items())
predictions = [labels[k] for k in predicted_class_indices]
print(predictions)

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

"""

