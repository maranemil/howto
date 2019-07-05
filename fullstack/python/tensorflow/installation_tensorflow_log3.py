#############################################
#
#  Quick Install pip3 tensorflow jupyter
#
##############################################

"""

sudo apt install python3-pip
pip3 install tensorflow
pip3 install jupyter
pip3 install matplotlib
pip3 install keras
pip3 install opencv-python

reboot
jupyter notebook

---------------------------------------------
https://towardsdatascience.com/basics-of-image-classification-with-keras-43779a299c8b
https://keras.io/models/model/
https://www.tensorflow.org/overview/
https://scipy-lectures.org/packages/scikit-learn/auto_examples/plot_digits_simple_classif.html

"""

import tensorflow as tf
mnist = tf.keras.datasets.mnist

(x_train, y_train),(x_test, y_test) = mnist.load_data()
x_train, x_test = x_train / 255.0, x_test / 255.0


import matplotlib.pyplot as plt
first_array=x_train[0]
# plt.imshow(first_array)
# plt.show()
# plt.savefig("fig.png")
X = first_array.reshape([28, 28]);
plt.gray()
plt.imshow(X)

model = tf.keras.models.Sequential([
  tf.keras.layers.Flatten(input_shape=(28, 28)),
  tf.keras.layers.Dense(128, activation='relu'),
  tf.keras.layers.Dropout(0.2),
  tf.keras.layers.Dense(10, activation='softmax')
])

model.compile(optimizer='adam',
              loss='sparse_categorical_crossentropy',
              metrics=['accuracy'])

model.fit(x_train, y_train, epochs=5)
model.evaluate(x_test, y_test)

predictions = model.predict(x_test)
print('First prediction:', predictions[0])
score = model.evaluate(x_test, y_test, verbose=0)
print('Test loss:', score[0])
print('Test accuracy:', score[1])

img = x_test[130]
img = img.reshape((28,28))
plt.gray()
plt.imshow(img)

"""

def img_to_array(img, data_format='channels_last', dtype='float32'):
    if data_format not in {'channels_first', 'channels_last'}:
        raise ValueError('Unknown data_format: %s' % data_format)
    x = np.asarray(img, dtype=dtype)
    if len(x.shape) == 3:
        if data_format == 'channels_first':
            x = x.transpose(2, 0, 1)
    elif len(x.shape) == 2:
        if data_format == 'channels_first':
            x = x.reshape((1, x.shape[0], x.shape[1]))
        else:
            x = x.reshape((x.shape[0], x.shape[1], 1))
    else:
        raise ValueError('Unsupported image shape: %s' % (x.shape,))
    return x


# predicting images
from keras.preprocessing import image
import numpy as np
img = image.load_img('test6.png', target_size=(128,128))
x = image.img_to_array(img)
x = np.expand_dims(x, axis=0)
images = np.vstack([x]).reshape([])
classes = model.predict_classes(images, batch_size=10)
print (classes)

# predicting images
from keras.preprocessing import image
import numpy as np
import cv2

image_file = 'test1.jpg'
image = cv2.imread(image_file)
image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
image = image_fit.resize_to_fit(image, 12, 22)

data = [image]

new_model = tf.keras.models.load_model(MODEL_FILENAME)
predicitions = new_model.predict(np.array(data))
print(np.argmax(predicitions[0]))


"""

#---------------------------------------------
#https://www.tensorflow.org/tutorials/
#---------------------------------------------

import tensorflow as tf
mnist = tf.keras.datasets.mnist

(x_train, y_train),(x_test, y_test) = mnist.load_data()
x_train, x_test = x_train / 255.0, x_test / 255.0

model = tf.keras.models.Sequential([
  tf.keras.layers.Flatten(input_shape=(28, 28)),
  tf.keras.layers.Dense(512, activation=tf.nn.relu),
  tf.keras.layers.Dropout(0.2),
  tf.keras.layers.Dense(10, activation=tf.nn.softmax)
])
model.compile(optimizer='adam',
              loss='sparse_categorical_crossentropy',
              metrics=['accuracy'])

model.fit(x_train, y_train, epochs=5)
model.evaluate(x_test, y_test)

predictions = model.predict(x_test)
print('First prediction:', predictions[0])
score = model.evaluate(x_test, y_test, verbose=0)
print('Test loss:', score[0])
print('Test accuracy:', score[1])