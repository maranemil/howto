from __future__ import absolute_import
from __future__ import division
from __future__ import print_function

import argparse
from os.path import join

import matplotlib.pyplot as plt
import numpy as np
import tensorflow as tf

# define the CLI arguments
parser = argparse.ArgumentParser()
parser.add_argument('--batch_size', default=100, type=int, help='batch size')
parser.add_argument('--train_steps', default=1000, type=int,
                    help='number of training steps')
parser.add_argument('--no_train', help='disable training', action='store_true')

# Constants for int labels
CAT_LABEL = 0
DOG_LABEL = 1

# the basepath of the training images. Make sure to have the data setup in the described way.
base_path = 'data'

# Dimensions of the images. Preventing some magic numbers
image_size_rows = 112
image_size_cols = 112

# set this to 1 to have grayscale images. Then you will have to check how to display grayscale images.
image_size_channels = 3
image_size = [image_size_cols, image_size_rows, image_size_channels]


# load and decode the image from the disk.
def prepare_image_fn(image_path, label):
    img_file = tf.read_file(image_path)

    # TODO: This might fail from time to time. Take a close look at image 666.jpg. There are others like this :)
    # TODO: see https://www.tensorflow.org/api_docs/python/tf/contrib/data/ignore_errors, I din't try it...
    img = tf.image.decode_image(img_file, channels=image_size_channels)
    img.set_shape([None, None, None])

    # TODO: You may want to handle this externally
    img = tf.image.resize_images(img, [image_size_cols, image_size_rows])

    return img, label


# Get all images from a folder, assign a label to each of them.
def get_class_dataset(dataset, label, class_name):
    # list all images
    files = tf.data.Dataset.list_files(join(base_path, dataset, class_name, '*.jpg'))

    # TODO: We process 4 imahes in parallel, maybe use more, maybe less.
    images = files.map(lambda x: (x, label), 4)
    return images


def get_dataset(dataset='train', shuffle=True, batch_size=250, buffer_size=20000, repeat=True, prefetch=500):
    '''
    Create a dataset using the tensorflow.data.Dataset API.
    :param dataset: The name of the dataset, eg. train or test
    :param shuffle: Shuffle the data?
    :param batch_size: Return batches of this size.
    :param buffer_size: Buffer size for shuffle. Should be equal to dataset size.
    :param repeat: If true, repeats infinitely
    :param prefetch: Prefetch some data. Can be used to load new data while old data is processed on the GPU.
    :return: Returns a tf.data.Dataset of both cats and dogs
    '''
    cats = get_class_dataset(dataset, tf.constant(CAT_LABEL), 'Cat')
    dogs = get_class_dataset(dataset, tf.constant(DOG_LABEL), 'Dog')
    data = cats.concatenate(dogs)

    if repeat:
        data = data.repeat()

    if shuffle:
        data = data.shuffle(buffer_size=buffer_size)

    # use this, if you have a weaker gpu :(
    # TODO: We load 10 images parallel. That might be too much.
    # https://www.tensorflow.org/api_docs/python/tf/contrib/data/ignore_errors
    data = data.map(prepare_image_fn, 10)
    data = data.apply(tf.contrib.data.ignore_errors())
    data = data.batch(batch_size)

    # Use this, if you have a proper gpu :)
    # data = data.apply(tf.contrib.data.map_and_batch(
    #    map_func=prepare_image_fn, batch_size=batch_size, num_parallel_batches=1))

    if prefetch is not None:
        data = data.prefetch(prefetch)

    return data


# see https://www.tensorflow.org/tutorials/layers
# see https://github.com/tensorflow/tensorflow/blob/r1.8/tensorflow/examples/tutorials/layers/cnn_mnist.py
def cnn_model_fn(features, labels, mode):
    '''Model function for CNN.'''
    # Input Layer
    # Reshape X to 4-D tensor: [batch_size, width, height, channels]
    input_layer = tf.reshape(features, [-1, image_size_cols, image_size_rows, image_size_channels])
    conv1 = tf.layers.conv2d(
        inputs=input_layer,
        filters=16,
        kernel_size=[5, 5],
        padding='same',
        activation=tf.nn.relu)
    conv2 = tf.layers.conv2d(
        inputs=conv1,
        filters=32,
        kernel_size=[5, 5],
        padding='same',
        activation=tf.nn.relu)
    pool1 = tf.layers.max_pooling2d(inputs=conv2, pool_size=[4, 4], strides=4)
    conv3 = tf.layers.conv2d(
        inputs=pool1,
        filters=64,
        kernel_size=[5, 5],
        padding='same',
        activation=tf.nn.relu)

    pool2 = tf.layers.max_pooling2d(inputs=conv3, pool_size=[4, 4], strides=4)

    # TODO: If you change the input size, make sure to adapt these settings. 7*7 is the image size, 64 the number of filters.
    pool2_flat = tf.reshape(pool2, [-1, 7 * 7 * 64])
    dense = tf.layers.dense(inputs=pool2_flat, units=1024, activation=tf.nn.relu)
    dense = tf.layers.dense(inputs=dense, units=512, activation=tf.nn.relu)
    dropout = tf.layers.dropout(
        inputs=dense, rate=0.4, training=mode == tf.estimator.ModeKeys.TRAIN)

    # Use 2 units, as we have 2 classes.
    logits = tf.layers.dense(inputs=dropout, units=2)

    predictions = {
        # Generate predictions (for PREDICT and EVAL mode)
        'classes': tf.argmax(input=logits, axis=1),
        # Add `softmax_tensor` to the graph. It is used for PREDICT and by the
        # `logging_hook`.
        'probabilities': tf.nn.softmax(logits, name='softmax_tensor')
    }
    if mode == tf.estimator.ModeKeys.PREDICT:
        return tf.estimator.EstimatorSpec(mode=mode, predictions=predictions)

    # Calculate Loss (for both TRAIN and EVAL modes)
    loss = tf.losses.sparse_softmax_cross_entropy(labels=labels, logits=logits)

    # Configure the Training Op (for TRAIN mode)
    if mode == tf.estimator.ModeKeys.TRAIN:
        # optimizer = tf.train.GradientDescentOptimizer(learning_rate=0.002)
        optimizer = tf.train.MomentumOptimizer(learning_rate=0.001, momentum=0.9)
        train_op = optimizer.minimize(
            loss=loss,
            global_step=tf.train.get_global_step())
        return tf.estimator.EstimatorSpec(mode=mode, loss=loss, train_op=train_op)

    # Add evaluation metrics (for EVAL mode)
    eval_metric_ops = {
        'accuracy': tf.metrics.accuracy(
            labels=labels, predictions=predictions['classes'])}
    return tf.estimator.EstimatorSpec(
        mode=mode, loss=loss, eval_metric_ops=eval_metric_ops)


def main(argv):
    args = parser.parse_args(argv[1:])

    # TODO: change the model dir, if you want to start a new model
    classifier = tf.estimator.Estimator(
        model_fn=cnn_model_fn, model_dir='model/model_01')

    if not args.no_train:
        # train the model
        print('Start training...')

        classifier.train(
            input_fn=lambda: get_dataset('train',
                                         shuffle=True,
                                         batch_size=args.batch_size,
                                         repeat=True,
                                         prefetch=500
                                         ),
            steps=args.train_steps)

    # Evaluate the model. Use 5000 steps, as we have that many test images
    eval_result = classifier.evaluate(
        input_fn=lambda: get_dataset('test',
                                     shuffle=False,
                                     batch_size=100,
                                     repeat=False,
                                     prefetch=100
                                     ),
        steps=5000)

    print('\nTest set accuracy: {accuracy:0.3f}\n'.format(**eval_result))

    test_dataset = get_dataset('test',
                               shuffle=True,
                               batch_size=1,
                               repeat=False,
                               prefetch=1,
                               buffer_size=5000
                               ).make_one_shot_iterator()

    next_batch = test_dataset.get_next()
    while True:
        try:
            # TODO: This whole thing feels like an ugly hack. But works...
            image = next_batch[0].eval()

            predict_input_fn = tf.estimator.inputs.numpy_input_fn(
                x=image,
                num_epochs=1,
                shuffle=False)

            predictions = classifier.predict(input_fn=predict_input_fn)

            prediction = predictions.__next__()

            image = np.reshape(image, image.shape[-3:])

            # Images have output values from 0-255, matplot expects values from 0-1
            image = image / 255
            plt.imshow(image)
            plt.title('Predicted class: ' + str(prediction['classes']))
            plt.show()
            plt.waitforbuttonpress(timeout=1)

            # if you use scientific mode of pycharm, this might not work. Feel free to find a solution.
            # closes all plots to prevent OOM errors of pycharm.
            plt.close('all')

        except Exception as e:
            print(e)
            break


if __name__ == '__main__':
    # TODO: if you want to train on your CPU for some reason (eg. not enough RAM)
    # import os
    # os.environ['CUDA_VISIBLE_DEVICES'] = '-1'
    sess = tf.Session()
    with sess.as_default():
        tf.logging.set_verbosity(tf.logging.INFO)
        tf.app.run(main)