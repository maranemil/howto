
# coding: utf-8

# # Image Classifier :
# this tool will be trained using two classes of images, dogs & cats.

# ### Data pre-processing & Data augmentation:
# Due to the fact that a limited amount of data is available at our disposal for training this Convolutional Neural Network, data will be "augmented" through a number of random variations so that the model will never process the same image twice. This technique helps to avoid overfitting & gives better generalization guidelines. 

# In[1]:


from keras.preprocessing.image import ImageDataGenerator, array_to_img, img_to_array, load_img

datagen = ImageDataGenerator(
        rotation_range=40,
        width_shift_range=0.2,
        height_shift_range=0.2,
        rescale=1./255,
        shear_range=0.2,
        zoom_range=0.2,
        horizontal_flip=True,
        fill_mode='nearest')


# - rotation_range is a value in degrees (0-180), a range within which to randomly rotate pictures
# - width_shift and height_shift are ranges (as a fraction of total width or height) within which to randomly translate pictures vertically or horizontally
# - rescale is a value by which we will multiply the data before any other processing. Images consist in RGB coefficients in the 0-255, and such values are too high for our models, so want values between 0 and 1 as not to scale with a 1/255. factor.
# - shear_range randomly applies shearing transformations
# - zoom_range randomly zooms inside pictures
# - horizontal_flip randomly flipps half of the images horizontally (relevant when there are no assumptions of horizontal assymetry, e.g. real-world pictures).
# - fill_mode is the strategy used for filling in newly created pixels

# In[2]:


img = load_img('/Users/filippofrezza/Desktop/GitHub Notebooks/Cat_and_dog_classifier/data/train/cats/cat.0.jpg') 
x = img_to_array(img)  # transforming image into Numpy array with shape (3, 150, 150)
x = x.reshape((1,) + x.shape)  # reshaping into new Numpy array with shape (1, 3, 150, 150)

# the .flow() command below generates batches of randomly transformed images
# and saves the results to the `preview/` directory
i = 0
for batch in datagen.flow(x, batch_size=1,
                          save_to_dir='/Users/filippofrezza/Desktop/GitHub Notebooks/Cat_and_dog_classifier/data/preview', save_prefix='cat', save_format='jpeg'):
    i += 1
    if i > 20:
        break  # otherwise the generator would loop indefinitely


# ### The issue of entropic capacity:
# 
# Since we have a limited amount of data, overfitting is our main issue where the Convolutional Neural Network may end up picking up many irrelevant features and then perform poorly with unseen data (generalization capacity). 
# This is why, other than data augmentation, we focus on the entropic capacity: how much information your model is allowed to store. A model that can store a lot of information has the potential to be more accurate by leveraging more features, but it is also more at risk to start storing irrelevant features. Meanwhile, a model that can only store a few features will have to focus on the most significant features found in the data, and these are more likely to be truly relevant and to generalize better.
# 
# There are a couple of ways to do that:
# - you focus on the number of parameters of your model (layers, neurons, ...etc)
# - Weight regularization - L1/L2 - forcing the model's weights to have smaller values
# 
# Dropout also helps reduce overfitting, by preventing a layer from seeing twice the exact same pattern, therefore acting in a similar way to data augmentation

# #  Setting up directories:
# 
# Before you start dealing with the Convolutional Neural Network, you have to create 2 directories with 2 directories stores inside (so in total 4 directories) as follows:
# 
# - train/cats
# - train/dogs
# 
# 
# 
# - validation/cats
# - validation/dogs

# ### 3-layer Convolutional Neural Net - ReLU activation - Max Pooling layers

# In[3]:


from keras.models import Sequential
from keras.layers import Conv2D, MaxPooling2D
from keras.layers import Activation, Dropout, Flatten, Dense
from keras import backend as K


# dimensions of our images.
img_width, img_height = 150, 150

train_data_dir = '/Users/filippofrezza/Desktop/GitHub Notebooks/Cat_and_dog_classifier/data/train'
validation_data_dir = '/Users/filippofrezza/Desktop/GitHub Notebooks/Cat_and_dog_classifier/data/validation'
nb_train_samples = 2000
nb_validation_samples = 800
epochs = 15
batch_size = 16

if K.image_data_format() == 'channels_first':
    input_shape = (3, img_width, img_height)
else:
    input_shape = (img_width, img_height, 3)

model = Sequential()
model.add(Conv2D(32, (3, 3), input_shape=input_shape))
model.add(Activation('relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))

model.add(Conv2D(32, (3, 3)))
model.add(Activation('relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))

model.add(Conv2D(64, (3, 3)))
model.add(Activation('relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))

model.add(Flatten())
model.add(Dense(64))
model.add(Activation('relu'))
model.add(Dropout(0.5))
model.add(Dense(1))
model.add(Activation('sigmoid'))

model.compile(loss='binary_crossentropy',
              optimizer='rmsprop',
              metrics=['accuracy'])


# In[5]:


train_datagen = ImageDataGenerator(
    rescale=1. / 255,
    shear_range=0.2,
    zoom_range=0.2,
    horizontal_flip=True)

test_datagen = ImageDataGenerator(rescale=1. / 255)


# In[6]:


train_generator = train_datagen.flow_from_directory(
    train_data_dir,
    target_size=(img_width, img_height),
    batch_size=batch_size,
    class_mode='binary')

validation_generator = test_datagen.flow_from_directory(
    validation_data_dir,
    target_size=(img_width, img_height),
    batch_size=batch_size,
    class_mode='binary')


# In[10]:


model.fit_generator(
    train_generator,
    steps_per_epoch=nb_train_samples // batch_size,
    epochs=epochs,
    validation_data=validation_generator,
    validation_steps=nb_validation_samples // batch_size)


# # Bottleneck features of a pre-trained network: 
# 
# By leveraging on a pre-trained network on a large dataset, we can take for granted that the network already has learned the most important features and therefore we can reach better accuracy levels, up to 90% !
# 
# We will use the VGG16 architecture, pre-trained on the ImageNet dataset this database contains in total 1000 classes of images, and therefore the model will already have learned features that are relevant to our classification problem. 

# In[7]:


import numpy as np  
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img  
from keras.models import Sequential  
from keras.layers import Dropout, Flatten, Dense  
from keras import applications  
from keras.utils.np_utils import to_categorical  
import matplotlib.pyplot as plt  
import math  
import cv2 


# ### Defining parameters :

# In[15]:


# dimensions of our images.  
img_width, img_height = 150, 150  

top_model_weights_path = 'bottleneck_fc_model.h5'  
train_data_dir = '/Users/filippofrezza/Desktop/GitHub Notebooks/Cat_and_dog_classifier/bottleneck_data/train'  
validation_data_dir = '/Users/filippofrezza/Desktop/GitHub Notebooks/Cat_and_dog_classifier/data/validation'  

# number of epochs to train top model  
epochs = 5  
# batch size used by flow_from_directory and predict_generator  
batch_size = 16  


# ### Saving Bottleneck features :

# In[9]:


def save_bottlebeck_features():
    datagen = ImageDataGenerator(rescale=1. / 255)

    # build the VGG16 network
    model = applications.VGG16(include_top=False, weights='imagenet')

    generator = datagen.flow_from_directory(
        train_data_dir,
        target_size=(img_width, img_height),
        batch_size=batch_size,
        class_mode=None,
        shuffle=False)
    bottleneck_features_train = model.predict_generator(
        generator, nb_train_samples // batch_size)
    np.save(open('bottleneck_features_train.npy', 'wb'),
            bottleneck_features_train)

    generator = datagen.flow_from_directory(
        validation_data_dir,
        target_size=(img_width, img_height),
        batch_size=batch_size,
        class_mode=None,
        shuffle=False)
    bottleneck_features_validation = model.predict_generator(
        generator, nb_validation_samples // batch_size)
    np.save(open('bottleneck_features_validation.npy', 'wb'),
            bottleneck_features_validation)


# ### Extracting the class labels for each of the training/validation sample in order to properly train the top model :

# In[23]:


# Training features:

datagen_top = ImageDataGenerator(rescale=1./255)  
generator_top = datagen_top.flow_from_directory(  
     train_data_dir,  
     target_size=(img_width, img_height),  
     batch_size=batch_size,  
     class_mode='categorical',  
     shuffle=False)  

train_data = np.load('bottleneck_features_train.npy')  

nb_train_samples = len(generator_top.filenames)  
num_classes = len(generator_top.class_indices)  

# get the class lebels for the training data, in the original order  
train_labels = generator_top.classes  

# convert the training labels to categorical vectors  
train_labels = to_categorical(train_labels, num_classes=num_classes) 


# In[41]:


# Validation features:

generator_top = datagen_top.flow_from_directory(  
     validation_data_dir,  
     target_size=(img_width, img_height),  
     batch_size=batch_size,  
     class_mode=None,  
     shuffle=False) 

validation_data = np.load('bottleneck_features_validation.npy') 

nb_validation_samples = len(generator_top.filenames)  

validation_labels = generator_top.classes  
validation_labels = validation_labels[:len(validation_data)]
validation_labels = to_categorical(validation_labels, num_classes=num_classes)


# ### Train top model function :

# In[42]:


def train_top_model():
    train_data = np.load('bottleneck_features_train.npy')
    train_etiquettes = train_labels
    validation_data = np.load('bottleneck_features_validation.npy')
    validation_etiquettes = validation_labels

    model = Sequential()
    model.add(Flatten(input_shape=train_data.shape[1:]))
    model.add(Dense(256, activation='relu'))
    model.add(Dropout(0.5))
    model.add(Dense(2, activation='sigmoid'))

    model.compile(optimizer='rmsprop',
                  loss='binary_crossentropy', metrics=['accuracy'])

    model.fit(train_data, train_labels,
              epochs=epochs,
              batch_size=batch_size,
              validation_data=(validation_data, validation_etiquettes))
    model.save_weights(top_model_weights_path)


# The training takes about 2 minutes on a GPU. On CPU however, it may take about 30 minutes. 
# 
# With this method, accuracy reaches 90% 

# In[43]:


save_bottlebeck_features()
train_top_model()

