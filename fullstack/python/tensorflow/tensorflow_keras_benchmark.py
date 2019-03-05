#------------------
# Test Tensorflow Benchmark
#------------------

import tensorflow as tf
mnist = tf.keras.datasets.mnist

(x_train, y_train),(x_test, y_test) = mnist.load_data()
x_train, x_test = x_train / 255.0, x_test / 255.0

model = tf.keras.models.Sequential([
  tf.keras.layers.Flatten(),
  tf.keras.layers.Dense(512, activation=tf.nn.relu),
  tf.keras.layers.Dropout(0.2),
  tf.keras.layers.Dense(10, activation=tf.nn.softmax)
])
model.compile(optimizer='adam',
              loss='sparse_categorical_crossentropy',
              metrics=['accuracy'])

model.fit(x_train, y_train, epochs=5)
model.evaluate(x_test, y_test)

#------------------
# Test TF Session
#------------------

import tensorflow as tf

data = tf.constant([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], dtype=tf.float32)
data = tf.reshape(data, shape=[1, 2, 5, 1])
pool = tf.layers.max_pooling2d(data, pool_size=[2, 2], strides=2, padding='same')

sess = tf.Session()
print(sess.run(pool))

#------------------
# Test TF Session
#------------------

""" 
https://github.com/tensorflow/tensorflow/issues/1578
https://github.com/tensorflow/tensorflow/blob/08ed32dbb9e8f67eec9efce3807b5bdb3933eb2f/tensorflow/core/protobuf/config.proto
https://github.com/tensorflow/tensorflow/issues/19731
https://stackoverflow.com/questions/39758094/clearing-tensorflow-gpu-memory-after-model-execution
https://github.com/tensorflow/tensorflow/issues/1727
https://forums.fast.ai/t/tip-clear-tensorflow-gpu-memory/1979
https://www.tensorflow.org/api_docs/python/tf/keras/backend/clear_session
"""


import time
import tensorflow as tf

for i in range(0,10000000):
  t0 = time.clock()

  with tf.Graph().as_default():
    sess = tf.Session()

    a = tf.placeholder(tf.int16, name='a')
    y = tf.identity(a, name='y')

    sess.run(y, feed_dict={a: 3})
    sess.close()

  del sess
  time.sleep(20)

print (time.clock() - t0)


#------------------
# Test TF Session
#------------------



import tensorflow as tf
with tf.Session() as sess:
    with tf.device('/cpu:0'):
        matrix1 = tf.constant([[3., 3]])
        matrix2 = tf.constant([[2.], [2.]])
        product = tf.matmul(matrix1, matrix2)
        result = sess.run(product)
        print(result)


#------------------
# Test TF Session
#------------------

import tensorflow as tf
import multiprocessing
import numpy as np

def run_tensorflow():

    n_input = 10000
    n_classes = 1000

    # Create model
    def multilayer_perceptron(x, weight):
        # Hidden layer with RELU activation
        layer_1 = tf.matmul(x, weight)
        return layer_1

    # Store layers weight & bias
    weights = tf.Variable(tf.random_normal([n_input, n_classes]))


    x = tf.placeholder("float", [None, n_input])
    y = tf.placeholder("float", [None, n_classes])
    pred = multilayer_perceptron(x, weights)

    cost = tf.reduce_mean(tf.nn.softmax_cross_entropy_with_logits(logits=pred, labels=y))
    optimizer = tf.train.AdamOptimizer(learning_rate=0.001).minimize(cost)

    init = tf.global_variables_initializer()

    with tf.Session() as sess:
        sess.run(init)

        for i in range(100):
            batch_x = np.random.rand(10, 10000)
            batch_y = np.random.rand(10, 1000)
            sess.run([optimizer, cost], feed_dict={x: batch_x, y: batch_y})

    print "finished doing stuff with tensorflow!"


if __name__ == "__main__":

    # option 1: execute code with extra process
    p = multiprocessing.Process(target=run_tensorflow)
    p.start()
    p.join()






