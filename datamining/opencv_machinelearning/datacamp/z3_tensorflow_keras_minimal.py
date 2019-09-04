import warnings
warnings.filterwarnings('ignore',category=FutureWarning)
import tensorflow as tf
import numpy as np
from tensorflow import keras
#warnings.filterwarnings('ignore')
print(tf.version.GIT_VERSION, tf.version.VERSION)

model = tf.keras.Sequential(
  [keras.layers.Dense(units=1, input_shape=[1])]
  )
#model.compile(optimizer='sgd', loss='mean_squared_error')
model.compile(optimizer='rmsprop', loss='binary_crossentropy')

#xs = np.array([1.0, 2.0, 3.0], dtype=float)
#ys = np.array([1.0, 2.0, 3.0], dtype=float)
#model.fit(xs, ys, epochs=100)
#print(model.predict([5.0]))

data = np.random.random((100, 1))
labels = np.random.randint(2, size=(100, 1))
# Train the model, iterating on the data in batches of 32 samples
model.fit(data, labels, epochs=10, batch_size=32)
model.evaluate(data, labels, batch_size=32)
print(model.predict([5.0]))

"""
https://keras.io/getting-started/sequential-model-guide/
https://stanford.edu/~shervine/blog/keras-how-to-generate-data-on-the-fly
https://www.tensorflow.org/api_docs/python/tf/keras/utils/to_categorical
https://keras.io/models/sequential/
https://docs.scipy.org/doc/numpy/reference/arrays.dtypes.html
https://keras.io/getting-started/sequential-model-guide/
https://codelabs.developers.google.com/codelabs/tensorflow-lab1-helloworld/#5
https://www.tensorflow.org/js/guide/train_models
https://github.com/keras-team/keras/issues/741
"""