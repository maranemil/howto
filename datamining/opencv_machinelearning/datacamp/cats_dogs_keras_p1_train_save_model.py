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
