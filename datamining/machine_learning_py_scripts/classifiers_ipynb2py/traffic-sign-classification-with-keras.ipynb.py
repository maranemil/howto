
# coding: utf-8

# # Traffic Sign Classification with Keras
# 
# Keras exists to make coding deep neural networks simpler. To demonstrate just how easy it is, you’re going to use Keras to build a convolutional neural network in a few dozen lines of code.
# 
# You’ll be connecting the concepts from the previous lessons to the methods that Keras provides.

# ## Dataset
# 
# The network you'll build with Keras is similar to the example that you can find in Keras’s GitHub repository that builds out a [convolutional neural network for MNIST](https://github.com/fchollet/keras/blob/master/examples/mnist_cnn.py). 
# 
# However, instead of using the [MNIST](http://yann.lecun.com/exdb/mnist/) dataset, you're going to use the [German Traffic Sign Recognition Benchmark](http://benchmark.ini.rub.de/?section=gtsrb&subsection=news) dataset that you've used previously.
# 
# You can download pickle files with sanitized traffic sign data here.

# ## Overview
# 
# Here are the steps you'll take to build the network:
# 
# 1. First load the training data and do a train/validation split.
# 2. Preprocess data.
# 3. Build a feedforward neural network to classify traffic signs.
# 4. Build a convolutional neural network to classify traffic signs.
# 5. Evaluate performance of final neural network on testing data.
# 
# Keep an eye on the network’s accuracy over time. Once the accuracy reaches the 98% range, you can be confident that you’ve built and trained an effective model.

# In[1]:


import pickle
import numpy as np
from sklearn.model_selection import train_test_split
import math


# ## Load the Data
# 
# Start by importing the data from the pickle file.

# In[2]:


# TODO: Implement load the data here.
with open('train.p', 'rb') as f:
    data = pickle.load(f)
    
with open('test.p', 'rb') as f:
    test_data = pickle.load(f)
    
X_train = data["features"]
y_train = data["labels"]
X_test = test_data["features"]
y_test = test_data["labels"]


# ## Validate the Network
# Split the training data into a training and validation set.
# 
# Measure the [validation accuracy](https://keras.io/models/sequential/) of the network after two training epochs.
# 
# Hint: [Use the `train_test_split()` method](http://scikit-learn.org/stable/modules/generated/sklearn.model_selection.train_test_split.html) from scikit-learn.

# In[3]:


# TODO: Use `train_test_split` here.

X_train, X_val, y_train, y_val = train_test_split(
    X_train, y_train, test_size=0.1, stratify=y_train)


# In[4]:


# STOP: Do not change the tests below. Your implementation should pass these tests. 
assert(X_train.shape[0] == y_train.shape[0]), "The number of images is not equal to the number of labels."
assert(X_train.shape[1:] == (32,32,3)), "The dimensions of the images are not 32 x 32 x 3."
assert(X_val.shape[0] == y_val.shape[0]), "The number of images is not equal to the number of labels."
assert(X_val.shape[1:] == (32,32,3)), "The dimensions of the images are not 32 x 32 x 3."


# ## Preprocess the Data
# 
# Now that you've loaded the training data, preprocess the data such that it's in the range between -0.5 and 0.5.

# In[5]:


# TODO: Implement data normalization here.
import cv2

def normalize(image):
    image2 = np.copy(image).astype('float')
    for i, im in enumerate(image):
        im = im.astype('float')
        img2 = np.copy(im)
        img2 = cv2.normalize(im, img2, -0.5, 0.5, cv2.NORM_MINMAX)
        image2[i,:,:,:] = img2
    return image2
    
X_train = normalize(X_train)
X_val = normalize(X_val)
X_test = normalize(X_test)


# In[6]:


# STOP: Do not change the tests below. Your implementation should pass these tests. 
assert(math.isclose(np.min(X_train), -0.5, abs_tol=1e-5) and math.isclose(np.max(X_train), 0.5, abs_tol=1e-5)), "The range of the training data is: %.1f to %.1f" % (np.min(X_train), np.max(X_train))
assert(math.isclose(np.min(X_val), -0.5, abs_tol=1e-5) and math.isclose(np.max(X_val), 0.5, abs_tol=1e-5)), "The range of the validation data is: %.1f to %.1f" % (np.min(X_val), np.max(X_val))


# ## Build a Two-Layer Feedfoward Network
# 
# The code you've written so far is for data processing, not specific to Keras. Here you're going to build Keras-specific code.
# 
# Build a two-layer feedforward neural network, with 128 neurons in the fully-connected hidden layer. 
# 
# To get started, review the Keras documentation about [models](https://keras.io/models/sequential/) and [layers](https://keras.io/layers/core/).
# 
# The Keras example of a [Multi-Layer Perceptron](https://github.com/fchollet/keras/blob/master/examples/mnist_mlp.py) network is similar to what you need to do here. Use that as a guide, but keep in mind that there are a number of differences.

# In[7]:


# TODO: Build a two-layer feedforward neural network with Keras here.
from keras.models import Sequential
from keras.layers.core import Dense, Dropout, Activation, Flatten
from keras.layers.convolutional import Convolution2D
from keras.layers.pooling import MaxPooling2D
from keras.optimizers import SGD, Adam, RMSprop
from keras.utils import np_utils


# In[8]:


model = Sequential()
model.add(Dense(128, input_dim=3072, init='glorot_uniform', activation='relu'))
model.add(Dense(43, init='glorot_uniform', activation='softmax'))
model.summary()
model.compile(optimizer='adam',
              loss='categorical_crossentropy',
              metrics=['accuracy'])


# In[9]:


# STOP: Do not change the tests below. Your implementation should pass these tests.
dense_layers = []
for l in model.layers:
    if type(l) == Dense:
        dense_layers.append(l)
assert(len(dense_layers) == 2), "There should be 2 Dense layers."
d1 = dense_layers[0]
d2 = dense_layers[1]
assert(d1.input_shape == (None, 3072))
assert(d1.output_shape == (None, 128))
assert(d2.input_shape == (None, 128))
assert(d2.output_shape == (None, 43))

last_layer = model.layers[-1]
assert(last_layer.activation.__name__ == 'softmax'), "Last layer should be softmax activation, is {}.".format(last_layer.activation.__name__)


# In[10]:


# Debugging
for l in model.layers:
    print(l.name, l.input_shape, l.output_shape, l.activation)


# ## Train the Network
# Compile and train the network for 2 epochs. [Use the `adam` optimizer, with `categorical_crossentropy` loss.](https://keras.io/models/sequential/)
# 
# Hint 1: In order to use categorical cross entropy, you will need to [one-hot encode the labels](https://github.com/fchollet/keras/blob/master/keras/utils/np_utils.py).
# 
# Hint 2: In order to pass the input images to the fully-connected hidden layer, you will need to [reshape the input](https://github.com/fchollet/keras/blob/master/examples/mnist_mlp.py).
# 
# Hint 3: Keras's `.fit()` method returns a `History.history` object, which the tests below use. Save that to a variable named `history`.

# In[11]:


# TODO: Compile and train the model here.

X_train_flat = X_train.reshape((X_train.shape[0], X_train.shape[1]*X_train.shape[2]*X_train.shape[3]))
X_val_flat = X_val.reshape((X_val.shape[0], X_val.shape[1]*X_val.shape[2]*X_val.shape[3]))
X_test_flat = X_test.reshape((X_test.shape[0], X_test.shape[1]*X_test.shape[2]*X_test.shape[3]))

y_train = np_utils.to_categorical(y_train, 43)
y_val = np_utils.to_categorical(y_val, 43)
y_test = np_utils.to_categorical(y_test, 43)


# In[14]:


history = model.fit(X_train_flat, y_train,
                    batch_size=128, nb_epoch=3,
                    verbose=1, validation_data=(X_val_flat, y_val))
score = model.evaluate(X_test_flat, y_test, verbose=0)
print('Test score:', score[0])
print('Test accuracy:', score[1])


# In[15]:


# STOP: Do not change the tests below. Your implementation should pass these tests.
assert(history.history['acc'][-1] > 0.92), "The training accuracy was: %.3f" % history.history['acc'][-1]
assert(history.history['val_acc'][-1] > 0.9), "The validation accuracy is: %.3f" % history.history['val_acc'][-1]


# **Validation Accuracy**: (fill in here)

# ## Congratulations
# You've built a feedforward neural network in Keras!
# 
# Don't stop here! Next, you'll add a convolutional layer to drive.py.

# ## Convolutions
# Build a new network, similar to your existing network. Before the hidden layer, add a 3x3 [convolutional layer](https://keras.io/layers/convolutional/#convolution2d) with 32 filters and valid padding.
# 
# Then compile and train the network.
# 
# Hint 1: The Keras example of a [convolutional neural network](https://github.com/fchollet/keras/blob/master/examples/mnist_cnn.py) for MNIST would be a good example to review.
# 
# Hint 2: Now that the first layer of the network is a convolutional layer, you no longer need to reshape the input images before passing them to the network. You might need to reload your training data to recover the original shape.
# 
# Hint 3: Add a [`Flatten()` layer](https://keras.io/layers/core/#flatten) between the convolutional layer and the fully-connected hidden layer.

# In[16]:


# TODO: Re-construct the network and add a convolutional layer before the first fully-connected layer.

model = Sequential()
model.add(Convolution2D(32, 3, 3, 
                        border_mode='valid', 
                        input_shape=(32, 32, 3), 
                        activation='relu', 
                        dim_ordering='tf'))
model.add(Flatten())
model.add(Dense(128, activation='relu'))
model.add(Dense(43, activation='softmax'))
model.summary()
model.compile(optimizer='adam',
              loss='categorical_crossentropy',
              metrics=['accuracy'])

# TODO: Compile and train the model here.

history = model.fit(X_train, y_train,
                    batch_size=128, nb_epoch=2,
                    verbose=1, validation_data=(X_val, y_val))
score = model.evaluate(X_test, y_test, verbose=0)
print('Test score:', score[0])
print('Test accuracy:', score[1])


# In[17]:


# STOP: Do not change the tests below. Your implementation should pass these tests.
assert(history.history['val_acc'][-1] > 0.95), "The validation accuracy is: %.3f" % history.history['val_acc'][-1]


# **Validation Accuracy**: (fill in here)

# ## Pooling
# Re-construct your network and add a 2x2 [pooling layer](https://keras.io/layers/pooling/#maxpooling2d) immediately following your convolutional layer.
# 
# Then compile and train the network.

# In[20]:


# TODO: Re-construct the network and add a pooling layer after the convolutional layer.

model = Sequential()
model.add(Convolution2D(32, 3, 3, 
                        border_mode='valid', 
                        input_shape=(32, 32, 3), 
                        dim_ordering='tf'))
model.add(MaxPooling2D())
model.add(Activation('relu'))
model.add(Flatten())
model.add(Dense(128, activation='relu'))
model.add(Dense(43, activation='softmax'))
model.summary()
model.compile(optimizer='adam',
              loss='categorical_crossentropy',
              metrics=['accuracy'])

# TODO: Compile and train the model here.

history = model.fit(X_train, y_train,
                    batch_size=64, nb_epoch=2,
                    verbose=1, validation_data=(X_val, y_val))
model.save_weights('keras-lab-weights.h5', overwrite=True)
score = model.evaluate(X_test, y_test, verbose=0)
print('Test score:', score[0])
print('Test accuracy:', score[1])


# In[21]:


# STOP: Do not change the tests below. Your implementation should pass these tests.
assert(history.history['val_acc'][-1] > 0.95), "The validation accuracy is: %.3f" % history.history['val_acc'][-1]


# **Validation Accuracy**: (fill in here)

# ## Dropout
# Re-construct your network and add [dropout](https://keras.io/layers/core/#dropout) after the pooling layer. Set the dropout rate to 50%.

# In[22]:


# TODO: Re-construct the network and add dropout after the pooling layer.

model = Sequential()
model.add(Convolution2D(32, 3, 3, 
                        border_mode='valid', 
                        input_shape=(32, 32, 3), 
                        dim_ordering='tf'))
model.add(MaxPooling2D())
model.add(Dropout(0.5))
model.add(Activation('relu'))
model.add(Flatten())
model.add(Dense(128, activation='relu'))
model.add(Dense(43, activation='softmax'))
model.summary()
model.compile(optimizer='adam',
              loss='categorical_crossentropy',
              metrics=['accuracy'])

# TODO: Compile and train the model here.
model.load_weights('keras-lab-weights.h5')
history = model.fit(X_train, y_train,
                    batch_size=64, nb_epoch=2,
                    verbose=1, validation_data=(X_val, y_val))
model.save_weights('keras-lab-weights.h5', overwrite=True)
score = model.evaluate(X_test, y_test, verbose=0)
print('Test score:', score[0])
print('Test accuracy:', score[1])


# In[23]:


# STOP: Do not change the tests below. Your implementation should pass these tests.
assert(history.history['val_acc'][-1] > 0.95), "The validation accuracy is: %.3f" % history.history['val_acc'][-1]


# **Validation Accuracy**: (fill in here)

# ## Optimization
# Congratulations! You've built a neural network with convolutions, pooling, dropout, and fully-connected layers, all in just a few lines of code.
# 
# Have fun with the model and see how well you can do! Add more layers, or regularization, or different padding, or batches, or more training epochs.
# 
# What is the best validation accuracy you can achieve?

# **Best Validation Accuracy:** (fill in here)

# ## Testing
# Once you've picked out your best model, it's time to test it.
# 
# Load up the test data and use the [`evaluate()` method](https://keras.io/models/model/#evaluate) to see how well it does.
# 
# Hint 1: The `evaluate()` method should return an array of numbers. Use the `metrics_names()` method to get the labels.

# In[ ]:


# TODO: Load test data
    
# TODO: Preprocess data & one-hot encode the labels

# TODO: Evaluate model on test data


# **Test Accuracy:** (fill in here)

# ## Summary
# Keras is a great tool to use if you want to quickly build a neural network and evaluate performance.
