"""
##########################################
Dogs vs. Cats Redux: Kernels Edition
Create dataset with Tensorflow
https://www.kaggle.com/freeman89/create-dataset-with-tensorflow

Extracts the data from the files,
Gives some insight on image size,
Resizes the images so they can be used as input for NNs,
Saves the results and drinks a coffee
##########################################
"""

import os
import numpy as np
import tensorflow as tf
from matplotlib import pyplot as plt
% matplotlib
inline
import pickle

TRAIN_DIR = '../input/train/'
TEST_DIR = '../input/test/'

# On the kaggle notebook
# we only take the first 2000 from the training set
# and only the first 1000 from the test set
# REMOVE [0:2000] and [0:1000] when running locally
train_image_file_names = [TRAIN_DIR + i for i in os.listdir(TRAIN_DIR)][0:2000]
test_image_file_names = [TEST_DIR + i for i in os.listdir(TEST_DIR)][0:1000]


# Slow, yet simple implementation with tensorflow
# could be rewritten to be much faster
# (which is not really needed as it takes less than 5 minutes on my laptop)
def decode_image(image_file_names, resize_func=None):
    images = []

    graph = tf.Graph()
    with graph.as_default():
        file_name = tf.placeholder(dtype=tf.string)
        file = tf.read_file(file_name)
        image = tf.image.decode_jpeg(file)
        if resize_func != None:
            image = resize_func(image)

    with tf.Session(graph=graph) as session:
        tf.initialize_all_variables().run()
        for i in range(len(image_file_names)):
            images.append(session.run(image, feed_dict={file_name: image_file_names[i]}))
            if (i + 1) % 1000 == 0:
                print('Images processed: ', i + 1)

        session.close()

    return images


train_images = decode_image(train_image_file_names)
test_images = decode_image(test_image_file_names)
all_images = train_images + test_images

# Check mean aspect ratio (width/height), mean width and mean height
width = []
height = []
aspect_ratio = []
for image in all_images:
    h, w, d = np.shape(image)
    aspect_ratio.append(float(w) / float(h))
    width.append(w)
    height.append(h)

print('Mean aspect ratio: ', np.mean(aspect_ratio))
plt.plot(aspect_ratio)
plt.show()

print('Mean width:', np.mean(width))
print('Mean height:', np.mean(height))
plt.plot(width, height, '.r')
plt.show()

print("Images widther than 500 pixel: ", np.sum(np.array(width) > 500))
print("Images higher than 500 pixel: ", np.sum(np.array(height) > 500))

# Free up some memory
del train_images
del test_images
del all_images

WIDTH = 500
HEIGHT = 500
resize_func = lambda image: tf.image.resize_image_with_crop_or_pad(image, HEIGHT, WIDTH)

processed_train_images = decode_image(train_image_file_names, resize_func=resize_func)
processed_test_images = decode_image(test_image_file_names, resize_func=resize_func)

# Chech the shapes
print(np.shape(processed_train_images))
print(np.shape(processed_test_images))

# Let's check how the images look like
for i in range(10):
    plt.imshow(processed_train_images[i])
    plt.show()


def create_batch(data, label, batch_size):
    i = 0
    while i * batch_size <= len(data):
        with open(label + '_' + str(i) + '.pickle', 'wb') as handle:
            content = data[(i * batch_size):((i + 1) * batch_size)]
            pickle.dump(content, handle)
            print('Saved', label, 'part #' + str(i), 'with', len(content), 'entries.')
        i += 1


# Create one hot encoding for labels
labels = [[1., 0.] if 'dog' in name else [0., 1.] for name in train_image_file_names]

# TO EXPORT DATA WHEN RUNNING LOCALLY - UNCOMMENT THIS LINES
# a batch with 5000 images has a size of around 3.5 GB
# create_batch(labels, 'data/train_labels', 5000)
# create_batch(processed_train_images, 'data/train_images', 5000)
# create_batch(processed_test_images, 'data/test_images', 5000)


"""
##########################################

Create dataset with Tensorflow d915e134
https://www.kaggle.com/jangho/create-dataset-with-tensorflow-d915e134

##########################################
"""

import os
import numpy as np
import tensorflow as tf
from matplotlib import pyplot as plt
% matplotlib
inline
import pickle

TRAIN_DIR = '../input/train/'
TEST_DIR = '../input/test/'

# On the kaggle notebook
# we only take the first 2000 from the training set
# and only the first 1000 from the test set
# REMOVE [0:2000] and [0:1000] when running locally
train_image_file_names = [TRAIN_DIR + i for i in os.listdir(TRAIN_DIR)][0:2000]
test_image_file_names = [TEST_DIR + i for i in os.listdir(TEST_DIR)][0:1000]


# print(train_image_file_names)

# Slow, yet simple implementation with tensorflow
# could be rewritten to be much faster
# (which is not really needed as it takes less than 5 minutes on my laptop)
def decode_image(image_file_names, resize_func=None):
    images = []

    graph = tf.Graph()
    with graph.as_default():
        file_name = tf.placeholder(dtype=tf.string)
        file = tf.read_file(file_name)
        image = tf.image.decode_jpeg(file)
        if resize_func != None:
            image = resize_func(image)

    with tf.Session(graph=graph) as session:
        tf.initialize_all_variables().run()
        for i in range(len(image_file_names)):
            images.append(session.run(image, feed_dict={file_name: image_file_names[i]}))
            if (i + 1) % 1000 == 0:
                print('Images processed: ', i + 1)

        session.close()

    return images


train_images = decode_image(train_image_file_names)
test_images = decode_image(test_image_file_names)
all_images = train_images + test_images

# Check mean aspect ratio (width/height), mean width and mean height
width = []
height = []
aspect_ratio = []
for image in all_images:
    h, w, d = np.shape(image)
    aspect_ratio.append(float(w) / float(h))
    width.append(w)
    height.append(h)

print('Mean aspect ratio: ', np.mean(aspect_ratio))
plt.plot(aspect_ratio)
plt.show()

print('Mean width:', np.mean(width))
print('Mean height:', np.mean(height))
plt.plot(width, height, '.r')
plt.show()

print("Images widther than 500 pixel: ", np.sum(np.array(width) > 500))
print("Images higher than 500 pixel: ", np.sum(np.array(height) > 500))

# Free up some memory
del train_images
del test_images
del all_images

WIDTH = 500
HEIGHT = 500
resize_func = lambda image: tf.image.resize_image_with_crop_or_pad(image, HEIGHT, WIDTH)

processed_train_images = decode_image(train_image_file_names, resize_func=resize_func)
processed_test_images = decode_image(test_image_file_names, resize_func=resize_func)

# Chech the shapes
print(np.shape(processed_train_images))
print(np.shape(processed_test_images))

# Let's check how the images look like
for i in range(10):
    plt.imshow(processed_train_images[i])
    plt.show()


def create_batch(data, label, batch_size):
    i = 0
    while i * batch_size <= len(data):
        with open(label + '_' + str(i) + '.pickle', 'wb') as handle:
            content = data[(i * batch_size):((i + 1) * batch_size)]
            pickle.dump(content, handle)
            print('Saved', label, 'part #' + str(i), 'with', len(content), 'entries.')
        i += 1


# Create one hot encoding for labels
labels = [[1., 0.] if 'dog' in name else [0., 1.] for name in train_image_file_names]

# TO EXPORT DATA WHEN RUNNING LOCALLY - UNCOMMENT THIS LINES
# a batch with 5000 images has a size of around 3.5 GB
# create_batch(labels, 'data/train_labels', 5000)
# create_batch(processed_train_images, 'data/train_images', 5000)
# create_batch(processed_test_images, 'data/test_images', 5000)


"""
##########################################

Create dataset with Tensorflow
https://www.kaggle.com/heslicia/create-dataset-with-tensorflow

##########################################
"""

import os
import numpy as np
import tensorflow as tf
from matplotlib import pyplot as plt
% matplotlib
inline
import pickle

TRAIN_DIR = '../input/train/'
TEST_DIR = '../input/test/'

# On the kaggle notebook
# we only take the first 2000 from the training set
# and only the first 1000 from the test set
# REMOVE [0:2000] and [0:1000] when running locally
train_image_file_names = [TRAIN_DIR + i for i in os.listdir(TRAIN_DIR)][0:2000]
test_image_file_names = [TEST_DIR + i for i in os.listdir(TEST_DIR)][0:1000]


# Slow, yet simple implementation with tensorflow
# could be rewritten to be much faster
# (which is not really needed as it takes less than 5 minutes on my laptop)
def decode_image(image_file_names, resize_func=None):
    images = []

    graph = tf.Graph()
    with graph.as_default():
        file_name = tf.placeholder(dtype=tf.string)
        file = tf.read_file(file_name)
        image = tf.image.decode_jpeg(file)
        if resize_func != None:
            image = resize_func(image)

    with tf.Session(graph=graph) as session:
        tf.initialize_all_variables().run()
        for i in range(len(image_file_names)):
            images.append(session.run(image, feed_dict={file_name: image_file_names[i]}))
            if (i + 1) % 1000 == 0:
                print('Images processed: ', i + 1)

        session.close()

    return images


train_images = decode_image(train_image_file_names)
test_images = decode_image(test_image_file_names)
all_images = train_images + test_images

# Check mean aspect ratio (width/height), mean width and mean height
width = []
height = []
aspect_ratio = []
for image in all_images:
    h, w, d = np.shape(image)
    aspect_ratio.append(float(w) / float(h))
    width.append(w)
    height.append(h)

print('Mean aspect ratio: ', np.mean(aspect_ratio))
plt.plot(aspect_ratio)
plt.show()

print('Mean width:', np.mean(width))
print('Mean height:', np.mean(height))
plt.plot(width, height, '.r')
plt.show()
print("Images widther than 500 pixel: ", np.sum(np.array(width) > 500))
print("Images higher than 500 pixel: ", np.sum(np.array(height) > 500))

# Free up some memory
del train_images
del test_images
del all_images

WIDTH = 500
HEIGHT = 500
resize_func = lambda image: tf.image.resize_image_with_crop_or_pad(image, HEIGHT, WIDTH)

processed_train_images = decode_image(train_image_file_names, resize_func=resize_func)
processed_test_images = decode_image(test_image_file_names, resize_func=resize_func)

# Chech the shapes
print(np.shape(processed_train_images))
print(np.shape(processed_test_images))

# Let's check how the images look like
for i in range(10):
    plt.imshow(processed_train_images[i])
    plt.show()


def create_batch(data, label, batch_size):
    i = 0
    while i * batch_size <= len(data):
        with open(label + '_' + str(i) + '.pickle', 'wb') as handle:
            content = data[(i * batch_size):((i + 1) * batch_size)]
            pickle.dump(content, handle)
            print('Saved', label, 'part #' + str(i), 'with', len(content), 'entries.')
        i += 1


# Create one hot encoding for labels
labels = [[1., 0.] if 'dog' in name else [0., 1.] for name in train_image_file_names]

# TO EXPORT DATA WHEN RUNNING LOCALLY - UNCOMMENT THIS LINES
# a batch with 5000 images has a size of around 3.5 GB
# create_batch(labels, 'data/train_labels', 5000)
# create_batch(processed_train_images, 'data/train_images', 5000)
# create_batch(processed_test_images, 'data/test_images', 5000)

