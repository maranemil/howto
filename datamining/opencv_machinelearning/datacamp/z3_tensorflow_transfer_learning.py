import matplotlib.image as mpimg
import matplotlib.pyplot as plt
import numpy as np
from __future__ import absolute_import, division, print_function, unicode_literals
import os
import sys
import tensorflow as tf
from tensorflow import keras
print("TensorFlow version is ", tf.__version__)

# https://www.tensorflow.org/tutorials/images/transfer_learning
# pip3 install tensorflow --user
# pip3 install --ignore-installed --upgrade tensorflow
# pip3 install matplotlib --user
# pip3 install --ignore-installed --upgrade matplotlib
# pip3 install numpy --user
# sudo apt-get install python3-tk


"""
https://www.tensorflow.org/tutorials/
https://www.tensorflow.org/overview
https://www.tensorflow.org/tutorials/images/deep_cnn
https://www.tensorflow.org/tutorials/images/hub_with_keras
https://www.tensorflow.org/tutorials/images/transfer_learning
https://www.tensorflow.org/tutorials/eager/custom_training
https://github.com/tensorflow/models/tree/master/official
https://www.tensorflow.org/resources/models-datasets
https://github.com/tensorflow/tensorflow/blob/r1.13/tensorflow/contrib/eager/python/examples/pix2pix/pix2pix_eager.ipynb
https://github.com/tensorflow/models/blob/master/research/nst_blogpost/4_Neural_Style_Transfer_with_Eager_Execution.ipynb
https://github.com/tensorflow/models/blob/master/samples/outreach/blogs/segmentation_blogpost/image_segmentation.ipynb

https://pytorch.org/tutorials/
https://pytorch.org/tutorials/beginner/data_loading_tutorial.html
https://pytorch.org/tutorials/beginner/transfer_learning_tutorial.html
https://pytorch.org/tutorials/beginner/deep_learning_60min_blitz.html
https://pytorch.org/tutorials/beginner/saving_loading_models.html
https://pytorch.org/tutorials/beginner/pytorch_with_examples.html


https://www.tensorflow.org/api_docs/python/tf/keras/optimizers/SGD
https://keras.io/optimizers/
https://machinelearningmastery.com/how-to-reduce-overfitting-with-dropout-regularization-in-keras/
https://keras.io/layers/core/
https://www.programcreek.com/python/example/104284/keras.optimizers.SGD
https://www.programcreek.com/python/example/89706/keras.layers.Dropout
https://www.tensorflow.org/api_docs/python/tf/keras/layers/Dropout
https://keras.io/layers/pooling/
https://github.com/keras-team/keras-applications/blob/master/keras_applications/mobilenet_v2.py
"""


zip_file = tf.keras.utils.get_file(origin="https://storage.googleapis.com/mledu-datasets/cats_and_dogs_filtered.zip",
                                   fname="cats_and_dogs_filtered.zip", extract=True)
base_dir, _ = os.path.splitext(zip_file)
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


image_size = 32  # All images will be resized to 160x160
batch_size = 16  # 32

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

IMG_SHAPE = (image_size, image_size, 3)

# Create the base model from the pre-trained model MobileNet V2
base_model = tf.keras.applications.MobileNetV2(input_shape=IMG_SHAPE,
                                               include_top=False,
                                               # alpha=0.5,
                                               input_tensor=None,
                                               pooling=None,
                                               # classes=10000,
                                               weights='imagenet')

base_model.trainable = False
# Let's take a look at the base model architecture
base_model.summary()

# sys.exit()

model = tf.keras.Sequential([
    base_model,
    # keras.layers.GlobalAveragePooling2D(),
    keras.layers.GlobalMaxPooling2D(),  # maxpool_layer
    keras.layers.Dropout(0.5),
    keras.layers.Dense(1, activation='sigmoid')  # prediction_layer
])
"""
model.compile(optimizer=tf.keras.optimizers.RMSprop(lr=0.0001),
              loss='binary_crossentropy',
              metrics=['accuracy'])
"""
learning_rate = 0.0001
"""
model.compile(optimizer=tf.keras.optimizers.Adam(lr=learning_rate), 
              loss='binary_crossentropy',
              metrics=['accuracy'])
"""
model.compile(optimizer=tf.keras.optimizers.SGD(lr=0.01, decay=1e-6, momentum=0.9, nesterov=True),
              loss='mean_squared_error', metrics=['accuracy'])


model.summary()
len(model.trainable_variables)


epochs = 2  # 10
steps_per_epoch = train_generator.n // batch_size
validation_steps = validation_generator.n // batch_size

history = model.fit_generator(train_generator,
                              steps_per_epoch=steps_per_epoch,
                              epochs=epochs,
                              workers=2,  # 4
                              validation_data=validation_generator,
                              validation_steps=validation_steps)


acc = history.history['acc']
val_acc = history.history['val_acc']

loss = history.history['loss']
val_loss = history.history['val_loss']
"""
plt.figure(figsize=(8, 8))
plt.subplot(2, 1, 1)
plt.plot(acc, label='Training Accuracy')
plt.plot(val_acc, label='Validation Accuracy')
plt.legend(loc='lower right')
plt.ylabel('Accuracy')
plt.ylim([min(plt.ylim()),1])
plt.title('Training and Validation Accuracy')

plt.subplot(2, 1, 2)
plt.plot(loss, label='Training Loss')
plt.plot(val_loss, label='Validation Loss')
plt.legend(loc='upper right')
plt.ylabel('Cross Entropy')
plt.ylim([0,max(plt.ylim())])
plt.title('Training and Validation Loss')
plt.show()
"""

base_model.trainable = True
# Let's take a look to see how many layers are in the base model
print("Number of layers in the base model: ", len(base_model.layers))

# Fine tune from this layer onwards
fine_tune_at = 100

# Freeze all the layers before the `fine_tune_at` layer
for layer in base_model.layers[:fine_tune_at]:
    layer.trainable = False

model.compile(optimizer=tf.keras.optimizers.RMSprop(lr=2e-5),
              loss='binary_crossentropy',
              metrics=['accuracy'])
model.summary()
len(model.trainable_variables)

history_fine = model.fit_generator(train_generator,
                                   steps_per_epoch=steps_per_epoch,
                                   epochs=epochs,
                                   workers=4,
                                   validation_data=validation_generator,
                                   validation_steps=validation_steps)

acc += history_fine.history['acc']
val_acc += history_fine.history['val_acc']

loss += history_fine.history['loss']
val_loss += history_fine.history['val_loss']
"""
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
