
# TensorFlow and tf.keras
import tensorflow as tf
from tensorflow import keras

# Helper libraries
import numpy as np
import matplotlib as plt

print(tf.__version__)
# print(tf.version.GIT_VERSION)
# print(tf.version.VERSION)

# https://github.com/tensorflow/tensorflow/issues/29878
# https://www.tensorflow.org/xla
# https://www.tensorflow.org/tutorials/customization/basics
# https://docs.scipy.org/doc/numpy/reference/generated/numpy.ones.html
# https://github.com/tensorflow/tensorflow/issues/36979
# https://github.com/tensorflow/tensorflow/issues/11614
# https://github.com/tensorflow/tensorflow/issues/36979
# https://www.geeksforgeeks.org/numpy-zeros-python/
# https://www.tensorflow.org/api_docs/python/tf/reshape
# https://www.tensorflow.org/api_docs/python/tf/convert_to_tensor
# https://www.tensorflow.org/api_docs/python/tf/numpy_function
# https://www.tensorflow.org/tutorials/keras/regression
# https://www.tensorflow.org/tutorials/customization/custom_training_walkthrough
# https://docs.python.org/3/library/tkinter.html
# https://towardsdatascience.com/train-test-split-and-cross-validation-in-python-80b61beca4b6


# tensorboard            1.14.0
# tensorflow             1.14.0
# tensorflow-estimator   1.14.0
# python 2.7


import sys

# print (sys.version_info)
# print(".".join(map(str, sys.version_info[:3])))
print("Python version")
print (sys.version)
print("Version info.")
print (sys.version_info)

# tf.enable_eager_execution
tf.compat.v1.enable_eager_execution()
tf.executing_eagerly()

# Config to turn on JIT compilation
config = tf.compat.v1.ConfigProto(device_count={'CPU' :1})
config.graph_options.optimizer_options.global_jit_level = tf.compat.v1.OptimizerOptions.ON_1
sess = tf.compat.v1.Session(config=config)

# serialized1 = config.SerializeToString()
# print(list(serialized1))

# test numpy
print(np.array([1 ,2 ,3]))
print(tf.add(1, 2))
print(tf.add([1, 2], [3, 4]))
print(tf.square(5))
print(tf.reduce_sum([1, 2, 3]))
# Operator overloading is also supported
print(tf.square(2) + tf.square(3))
x = tf.matmul([[1]], [[2, 3]])
print(x)
print(x.shape)
print(x.dtype)

g1 = tf.Graph()
with g1.as_default():
    v = tf.compat.v1.get_variable("v", shape=[1], initializer=tf.zeros_initializer())




print ('----------------------')

import numpy as np
ndarray = np.ones([3, 3])
print("TensorFlow operations convert numpy arrays to Tensors automatically")
tensor = tf.multiply(ndarray, 42)
print(tensor)
print("And NumPy operations convert Tensors to numpy arrays automatically")
print(np.add(tensor, 1))
print("The .numpy() method explicitly converts a Tensor to a numpy array")
print(tensor.numpy())

print ('----------------------')


print("Matrix b :", np.zeros(2, dtype = int) )
print("Matrix a :", np.zeros([1, 3], dtype = np.int32) )
c = np.zeros([3, 3])
print("Matrix c : ", c)

print ('----------------------')

print("Matrix 5 :" ,np.ones(5))
print("Matrix 5 :" ,np.ones((5,), dtype=int))
print(np.ones((2, 1)))
s = (2 ,2)
print(np.ones(s))


print ('----------------------')

ds_tensors = tf.data.Dataset.from_tensor_slices([1, 2, 3, 4, 5, 6])
# ds_tensors = ds_tensors.map(tf.square).shuffle(2).batch(2)
print(ds_tensors)

print ('----------------------')

m = tf.keras.metrics.Accuracy()
m.update_state([1, 2, 3, 4], [1, 2, 3, 4])
print('Final result: ', m.result().numpy())

print ('----------------------')

t1 = [[1, 2, 3],
      [4, 5, 6]]
print(tf.shape(t1).numpy())
print(tf.transpose(t1, perm=[1, 0]).numpy() )
print(tf.reshape(t1, [-1]) )
print(tf.reshape(t1, [3, -1]) )
print(tf.reshape(t1, [-1, 2]) )

t = [1, 2, 3, 4, 5, 6, 7, 8, 9]
print(tf.shape(t).numpy())
print(tf.reshape(t, [3, 3]))

print ('----------------------')

def my_func(arg):
    arg = tf.convert_to_tensor(arg, dtype=tf.float32)
    return tf.matmul(arg, arg) + arg

# The following calls are equivalent.
value_1 = my_func(tf.constant([[1.0, 2.0], [3.0, 4.0]]))
value_2 = my_func([[1.0, 2.0], [3.0, 4.0]])
value_3 = my_func(np.array([[1.0, 2.0], [3.0, 4.0]], dtype=np.float32))

print(value_1)
print(value_2)
print(value_3)

print ('----------------------')

# exit(0)


# python -c "import tensorflow as tf; print(tf.GIT_VERSION, tf.VERSION)" 2. TF 2.0:
# python -c "import tensorflow as tf; print(tf.version.GIT_VERSION, tf.version.VERSION)"

# python -c 'import sys; print sys.version_info'
# python -c 'import sys; print(".".join(map(str, sys.version_info[:3])))'

mnist = tf.keras.datasets.mnist

(x_train, y_train), (x_test, y_test) = mnist.load_data()
x_train, x_test = x_train / 255.0, x_test / 255.0


print(x_train[:1])
print(y_train[:1])
print(x_train[: ,0])
print(x_train[:, :-1])

model = tf.keras.models.Sequential([
    tf.keras.layers.Flatten(input_shape=(28, 28)),
    tf.keras.layers.Dense(128, activation='relu'),
    tf.keras.layers.Dropout(0.2),
    tf.keras.layers.Dense(10)
])

predictions = model(x_train[:1]).numpy()
predictions

print(x_test.shape)
print(y_test.shape)


"""
## The line / model
# sudo apt-get install python-tk
# sudo apt-get install python3-tk 
#import tkinter
#from tkinter import *
from Tkinter import * # py2
#from tkinter import * #py3
from matplotlib import pyplot as plt
import pandas as pd
import seaborn as sns

sns.pairplot(x_test, diag_kind="kde")
"""
exit(0)

tf.nn.softmax(predictions).numpy()
loss_fn = tf.keras.losses.SparseCategoricalCrossentropy(from_logits=True)
loss_fn(y_train[:1], predictions).numpy()

model.compile(optimizer='adam',
              loss=loss_fn,
              metrics=['accuracy'])

model.fit(x_train, y_train, epochs=2)
model.evaluate(x_test,  y_test, verbose=2)

probability_model = tf.keras.Sequential([
    model,
    tf.keras.layers.Softmax()
])
probability_model(x_test[:5])




