##########################################
# requirements
##########################################

# pip3 install h5py
# pip3 install keras
# pip3 install tensorflow
# pip3 install matplotlib

import tensorflow as tf
import numpy as np
import os
import sys

from tensorflow import keras
from tensorflow.keras import layers
import matplotlib.pyplot as plt

##########################################
# create the model
##########################################

inputs = keras.Input(shape=(784,), name='digits')
x = layers.Dense(64, activation='relu', name='dense_1')(inputs)
x = layers.Dense(64, activation='relu', name='dense_2')(x)
outputs = layers.Dense(10, activation='softmax', name='predictions')(x)
model = keras.Model(inputs=inputs, outputs=outputs)
model.summary()
# Load a toy dataset for the sake of this example
(x_train, y_train), (x_test, y_test) = keras.datasets.mnist.load_data()
# Preprocess the data (these are Numpy arrays)
x_train = x_train.reshape(60000, 784).astype('float32') / 255
x_test = x_test.reshape(10000, 784).astype('float32') / 255
# Reserve 10,000 samples for validation
x_val = x_train[-10000:]
y_val = y_train[-10000:]
x_train = x_train[:-10000]
y_train = y_train[:-10000]
# Specify the training configuration (optimizer, loss, metrics)
model.compile(optimizer=keras.optimizers.RMSprop(),  # Optimizer
              # Loss function to minimize
              loss=keras.losses.SparseCategoricalCrossentropy(),
              # List of metrics to monitor
              metrics=[keras.metrics.SparseCategoricalAccuracy()])
# Train the model by slicing the data into "batches"
# of size "batch_size", and repeatedly iterating over
# the entire dataset for a given number of "epochs"
print('# Fit model on training data')
history = model.fit(x_train, y_train,
                    batch_size=32, # 64
                    epochs=1, # 3
                    # We pass some validation for monitoring
                    # validation loss and metrics at the end of each epoch
                    validation_data=(x_val, y_val))
# The returned "history" object holds a record
# of the loss values and metric values during training
print('\nhistory dict:', history.history)
# Evaluate the model on the test data using `evaluate`
print('\n# Evaluate on test data')
results = model.evaluate(x_test, y_test, batch_size=128)
print('test loss, test acc:', results)
#model.save('my_model.h5')
model.save_weights("./weights.h5")
# Creates a HDF5 file 'my_model.h5'
# model.save("./weights.h5")

del model

##########################################
# Recreate the model
##########################################

inputs2 = keras.Input(shape=(784,), name='digits')
x2 = layers.Dense(64, activation='relu', name='dense_1')(inputs2)
x2 = layers.Dense(64, activation='relu', name='dense_2')(x2)
outputs2 = layers.Dense(10, activation='softmax', name='predictions')(x2)
# restore weights
model2 = keras.Model(inputs=inputs2, outputs=outputs2)
model2.compile(loss='sparse_categorical_crossentropy',
                  optimizer=keras.optimizers.RMSprop())
model2.load_weights("./weights.h5")

# Generate predictions (probabilities -- the output of the last layer)
# on new data using `predict`
print('\n# Generate predictions for 3 samples')
predictions = model2.predict(x_test[:3])
print('predictions shape:', predictions.shape)


img = x_test[160]
test_img = img.reshape((1,784))
img_class = model2.predict(test_img)
prediction = img_class[0]
classname = img_class[0]
print("Class: ",classname)
img = img.reshape((28,28))
plt.imshow(img)
plt.title(classname)
plt.show()


"""
https://www.tensorflow.org/guide/keras


https://keras.io/models/about-keras-models/
https://keras.io/getting-started/faq/
https://www.tensorflow.org/tutorials/keras/save_and_restore_models
https://www.tensorflow.org/api_docs/python/tf/keras/models/load_model

http://faroit.com/keras-docs/2.0.2/models/about-keras-models/
https://www.tensorflow.org/api_docs/python/tf/keras/Sequential
https://www.tensorflow.org/beta/guide/keras/saving_and_serializing
https://www.tensorflow.org/tutorials/keras/save_and_restore_models
https://www.tensorflow.org/api_docs/python/tf/keras/models/load_model
https://www.tensorflow.org/guide/keras
https://www.tensorflow.org/api_docs/python/tf/data/Dataset
https://www.tensorflow.org/beta/guide/keras/training_and_evaluation


https://pillow.readthedocs.io/en/3.1.x/reference/Image.html
https://realpython.com/python-matplotlib-guide/

"""
