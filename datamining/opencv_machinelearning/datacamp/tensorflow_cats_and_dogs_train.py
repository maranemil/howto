from __future__ import absolute_import, division, print_function, unicode_literals

import matplotlib.image as mpimg
import matplotlib.pyplot as plt
import numpy as np
import os

import tensorflow as tf
from tensorflow import keras
print("TensorFlow version is ", tf.__version__)


#---------------------------------------------------
# Transfer Learning Using Pretrained ConvNets
#---------------------------------------------------
# https://www.tensorflow.org/tutorials/images/transfer_learning

#---------------------------------------------------
# Data preprocessing
#---------------------------------------------------

zip_file = tf.keras.utils.get_file(origin="https://storage.googleapis.com/mledu-datasets/cats_and_dogs_filtered.zip",
                                   fname="cats_and_dogs_filtered.zip", extract=True)
base_dir, _ = os.path.splitext(zip_file)

#---------------------------------------------------
# Prepare training and validation cats and dogs datasets
#---------------------------------------------------

train_dir = os.path.join(base_dir, 'train')
validation_dir = os.path.join(base_dir, 'validation')
# Directory with our training cat pictures
train_cats_dir = os.path.join(train_dir, 'cats')
print('Total training cat images:', len(os.listdir(train_cats_dir)))
# Directory with our training dog pictures
train_dogs_dir = os.path.join(train_dir, 'dogs')
print('Total training dog images:', len(os.listdir(train_dogs_dir)))
# Directory with our validation cat pictures
validation_cats_dir = os.path.join(validation_dir, 'cats')
print('Total validation cat images:', len(os.listdir(validation_cats_dir)))
# Directory with our validation dog pictures
validation_dogs_dir = os.path.join(validation_dir, 'dogs')
print('Total validation dog images:', len(os.listdir(validation_dogs_dir)))

#---------------------------------------------------
# Create Image Data Generator with Image Augmentation
#---------------------------------------------------

image_size = 160  # All images will be resized to 160x160
batch_size = 32
# Rescale all images by 1./255 and apply image augmentation
train_datagen = keras.preprocessing.image.ImageDataGenerator(
                rescale=1./255)
validation_datagen = keras.preprocessing.image.ImageDataGenerator(
    rescale=1./255)
# Flow training images in batches of 20 using train_datagen generator
train_generator = train_datagen.flow_from_directory(
                train_dir,  # Source directory for the training images
                target_size=(image_size, image_size),
                batch_size=batch_size,
                # Since we use binary_crossentropy loss, we need binary labels
                class_mode='binary')
# Flow validation images in batches of 20 using test_datagen generator
validation_generator = validation_datagen.flow_from_directory(
                validation_dir,  # Source directory for the validation images
                target_size=(image_size, image_size),
                batch_size=batch_size,
                class_mode='binary')

#---------------------------------------------------
# Create the base model from the pre-trained convnets
#---------------------------------------------------


IMG_SHAPE = (image_size, image_size, 3)
# Create the base model from the pre-trained model MobileNet V2
base_model = tf.keras.applications.MobileNetV2(input_shape=IMG_SHAPE,
                                               include_top=False,
                                               weights='imagenet')

#---------------------------------------------------
# Feature extraction
#---------------------------------------------------

base_model.trainable = False
# Let's take a look at the base model architecture
base_model.summary()
model = tf.keras.Sequential([
  base_model,
  keras.layers.GlobalAveragePooling2D(),
  keras.layers.Dense(1, activation='sigmoid')
])
# Compile the model
model.compile(optimizer=tf.keras.optimizers.RMSprop(lr=0.0001),
              loss='binary_crossentropy',
              metrics=['accuracy'])
model.summary()
len(model.trainable_variables)

#---------------------------------------------------
# Train the model
#---------------------------------------------------

epochs = 2 # 10
steps_per_epoch = train_generator.n // batch_size
validation_steps = validation_generator.n // batch_size

history = model.fit_generator(train_generator,
                              steps_per_epoch = steps_per_epoch,
                              epochs=epochs,
                              workers=2,
                              validation_data=validation_generator,
                              validation_steps=validation_steps)


# Learning curves
acc=history.history['acc']
val_acc=history.history['val_acc']

loss=history.history['loss']
val_loss=history.history['val_loss']

plt.figure(figsize=(8, 8))
plt.subplot(2, 1, 1)
plt.plot(acc, label='Training Accuracy')
plt.plot(val_acc, label='Validation Accuracy')
plt.legend(loc='lower right')
plt.ylabel('Accuracy')
plt.ylim([min(plt.ylim()), 1])
plt.title('Training and Validation Accuracy')

plt.subplot(2, 1, 2)
plt.plot(loss, label='Training Loss')
plt.plot(val_loss, label='Validation Loss')
plt.legend(loc='upper right')
plt.ylabel('Cross Entropy')
plt.ylim([0, max(plt.ylim())])
plt.title('Training and Validation Loss')
plt.show()

# Un-freeze the top layers of the model


"""

#-------------------------------------------------------------
# Fine tuning
#-------------------------------------------------------------
base_model.trainable = True

# Let's take a look to see how many layers are in the base model
print("Number of layers in the base model: ", len(base_model.layers))

# Fine tune from this layer onwards
fine_tune_at = 100

#-------------------------------------------------------------
# Freeze all the layers before the `fine_tune_at` layer
#-------------------------------------------------------------
for layer in base_model.layers[:fine_tune_at]:
  layer.trainable =  False

model.compile(optimizer = tf.keras.optimizers.RMSprop(lr=2e-5),
              loss='binary_crossentropy',
              metrics=['accuracy'])
model.summary()
len(model.trainable_variables)
history_fine = model.fit_generator(train_generator,
                                   steps_per_epoch = steps_per_epoch,
                                   epochs=epochs,
                                   workers=2,
                                   validation_data=validation_generator,
                                   validation_steps=validation_steps)

acc += history_fine.history['acc']
val_acc += history_fine.history['val_acc']

loss += history_fine.history['loss']
val_loss += history_fine.history['val_loss']

plt.figure(figsize=(8, 8))
plt.subplot(2, 1, 1)
plt.plot(acc, label='Training Accuracy')
plt.plot(val_acc, label='Validation Accuracy')
plt.ylim([0.9, 1])
plt.plot([epochs-1,epochs-1], plt.ylim(), label='Start Fine Tuning')
plt.legend(loc='lower right')
plt.title('Training and Validation Accuracy')

plt.subplot(2, 1, 2)
plt.plot(loss, label='Training Loss')
plt.plot(val_loss, label='Validation Loss')
plt.ylim([0, 0.2])
plt.plot([epochs-1,epochs-1], plt.ylim(), label='Start Fine Tuning')
plt.legend(loc='upper right')
plt.title('Training and Validation Loss')
plt.show()

"""






# /usr/bin/python3 -m pip install -U autopep8 --user


"""
https://www.tensorflow.org/guide/keras
https://www.tensorflow.org/guide
https://www.tensorflow.org/guide/datasets
https://www.tensorflow.org/guide/datasets_for_estimators
https://www.tensorflow.org/guide/graphs
https://www.tensorflow.org/guide/tensors
https://www.tensorflow.org/install
https://www.tensorflow.org/guide/variables
https://www.tensorflow.org/guide/saved_model
https://www.tensorflow.org/guide/low_level_intro
https://www.tensorflow.org/guide/debugger
https://www.tensorflow.org/tutorials
https://www.tensorflow.org/tutorials/images/hub_with_keras
https://www.tensorflow.org/hub/common_issues
https://www.tensorflow.org/hub/basics
https://pytorch.org/tutorials/beginner/blitz/cifar10_tutorial.html#sphx-glr-beginner-blitz-cifar10-tutorial-py
https://pytorch.org/tutorials/beginner/deep_learning_60min_blitz.html
https://pytorch.org/tutorials/
https://cran.rstudio.com/web/packages/keras/vignettes/sequential_model.html
https://machinelearningmastery.com/dropout-regularization-deep-learning-models-keras/
https://keras.io/layers/core/
https://keras.io/getting-started/sequential-model-guide/
https://keras.io/
https://www.tensorflow.org/tutorials/load_data/tf_records
https://keras.io/getting-started/faq/
https://www.tensorflow.org/tutorials/load_data/images
https://www.tensorflow.org/tutorials/sequences/audio_recognition
https://www.tensorflow.org/tutorials/sequences/recurrent_quickdraw
https://github.com/tensorflow/models/blob/master/tutorials/rnn/quickdraw/train_model.py
https://www.tensorflow.org/tutorials/images/transfer_learning
https://www.tensorflow.org/tutorials/images/deep_cnn
https://www.tensorflow.org/tutorials/sequences/text_generation
https://www.tensorflow.org/tutorials/sequences/recurrent
https://github.com/tensorflow/docs/blob/master/site/en/tutorials/images/hub_with_keras.ipynb
"""