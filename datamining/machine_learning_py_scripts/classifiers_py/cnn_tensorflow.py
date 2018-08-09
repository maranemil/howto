import numpy as np
import tensorflow as tf
import cnn_model as cnn
import math
import matplotlib.pyplot as plt


# hyper-parameters
adam_beta1 = 0.88
adam_lr = 5e-4
train_batch_size = 128
plot_losses = True


# to generate new names for directory of model checkpoints
train_iter = 0
last_checkpoints_dir = 50
model_iter = last_checkpoints_dir + train_iter
model_dir_restore = './model_dir/model_dir{0}/model{0}.ckpt'.format(last_checkpoints_dir, last_checkpoints_dir)
model_dir_save = './model_dir/model_dir{0}/model{0}.ckpt'.format(model_iter, model_iter)

'''
Build the model

'''

# clear old variables
tf.reset_default_graph()

# setup input (e.g. the data)
# the first dim is None, and get sets based on batch size fed in
x = tf.placeholder(tf.float32, [None, 32, 32, 3])
y = tf.placeholder(tf.int64, [None])
is_training = tf.placeholder(tf.bool)

# use the imported model cnn_model

y_out = cnn.cnn_model(x, y, is_training)

# define loss
total_loss = tf.nn.softmax_cross_entropy_with_logits(logits=y_out, labels=tf.one_hot(y, 10, dtype=tf.int64), )
mean_loss = tf.reduce_mean(total_loss)

# define optimizer

optimizer = tf.train.AdamOptimizer(adam_lr, beta1=adam_beta1)
train_step = optimizer.minimize(mean_loss)


'''
define a function to run the model

'''


def run_model(session, xd, loss_val=None, predict=None, yd=None,
              epochs=1, batch_size=64, print_every=100,
              training=None, plot_losses=False):
    '''
    :param predict: logits
    :param xd: block of input data with shape of [N, W, H, C]
    :param yd: labels
    :param epochs: training epochs
    :param batch_size: batch size for training
    :param print_every: logging every_n_iter
    :param training: a training_op when training
    '''

    if predict is None:
        feed_dict = {x: xd,
                     is_training: False}
        session.run(y_out, feed_dict=feed_dict)

    else:
        # compute accuracy
        correct_prediction = tf.equal(tf.argmax(predict, 1), y)
        accuracy = tf.reduce_mean(tf.cast(correct_prediction, tf.float32))

        # shuffle indices
        train_indices = np.arange(xd.shape[0])
        np.random.shuffle(train_indices)

        # Training_now = True if training was assigned, i.e. it's training time
        training_now = training is not None

        # setting up variable we want to compute and train
        variables = [mean_loss, correct_prediction, accuracy]

        # change the last item from 'accuracy' to 'training' when training
        if training_now:
            variables[-1] = training

        # count iterations
        iter_cnt = 0

        for e in range(epochs):
            # keep track of losses and accuracy
            correct = 0
            losses = []
            # make sure we iterate over the dataset once
            for i in range(int(math.ceil(xd.shape[0] / batch_size))):
                start_idx = (i * batch_size) % xd.shape[0]
                # idx is ndarray to determine which batch to train
                idx = train_indices[start_idx:start_idx + batch_size]

                # create a feed dictionary for this batch, for this batch!
                feed_dict = {x: xd[idx, :],
                             y: yd[idx],
                             is_training: training_now}
                # in case residual batch has the size < batch_size
                actual_batch_size = yd[idx].shape[0]

                # have tensorflow compute loss and correct predictions
                # and (if given) perform a training step
                loss, corr, _ = session.run(variables, feed_dict=feed_dict)
                # reg_losses = tf.reduce_sum(tf.get_collection(tf.GraphKeys.REGULARIZATION_LOSSES))
                # loss = loss_train + reg_losses.eval()

                # aggregate performance stats
                # 'loss' for mean_loss, so multiplied by actual_batch_size
                losses.append(loss * actual_batch_size)
                correct += np.sum(corr)

                # print every_n_iter logging
                if training_now and (iter_cnt % print_every) == 0:
                    print("Iteration{0}: with minibatch training loss = {1:.3g} and accuracy of {2:.2g}"
                          .format(iter_cnt, loss, np.sum(corr) / actual_batch_size))
                iter_cnt += 1

            # compute the overall loss and accuracy
            total_correct = correct / xd.shape[0]
            total_loss = np.sum(losses) / xd.shape[0]
            print("Epoch {2}, Overall loss = {0:.3g} and accuracy of {1:.3g}"
                  .format(total_loss, total_correct, e + 1))

            # plot the training process
            if plot_losses:
                plt.ion()
                plt.plot(losses)
                plt.grid()
                plt.title('Epoch {} Loss'.format(e + 1))
                plt.xlabel('minibatch number')
                plt.ylabel('minibatch loss')
                # display for 2 seconds
                plt.pause(2)
                plt.close()

    return total_loss, total_correct, y_out


def main(unused_argv):

    '''
        Load Datasets

    '''

    from load_data.data_utils import load_CIFAR10

    def get_cifar10_data(num_training=49000, num_validation=1000, num_test=1000):
        '''
        Load the CIFAR - 10 datasets and preprocessing it for neural networks
        '''

        # load the raw CIFAR-10 data
        cifar10_dir = './load_data/datasets/cifar-10-batches-py'
        x_train, y_train, x_test, y_test = load_CIFAR10(cifar10_dir)

        # subsample the data [0, num_training - 1], [num_training, num_training + num_validation]
        # raw datasets were extracted to be lists by op 'load_CIFAR10(cifar10_dir)'
        mask = range(num_training, num_training + num_validation)
        x_val = x_train[mask]
        y_val = y_train[mask]
        mask = range(num_training)
        x_train = x_train[mask]
        y_train = y_train[mask]
        mask = range(num_test)
        x_test = x_test[mask]
        y_test = y_test[mask]

        # normalize the data: subtract the mean image
        # where every img is a row vector
        mean_img = np.mean(x_train, axis=0)
        x_train -= mean_img
        x_val -= mean_img
        x_test -= mean_img

        return x_train, y_train, x_val, y_val, x_test, y_test

    # invoke the above function to get data
    x_train, y_train, x_val, y_val, x_test, y_test = get_cifar10_data()
    print('Train data shape: ', x_train.shape)
    print('Train labels shape: ', y_train.shape)
    print('Validation data shape: ', x_val.shape)
    print('Validation labels shape: ', y_val.shape)
    print('Test data shape: ', x_test.shape)
    print('Test labels shape: ', y_test.shape)

    saver = tf.train.Saver()

    with tf.Session() as sess:
        if last_checkpoints_dir == 0:
            sess.run(tf.global_variables_initializer())
        else:
            saver.restore(sess, model_dir_restore)

        if train_iter > 0:
            # training part
            print('Training')
            run_model(sess, x_train, mean_loss, y_out, y_train, train_iter,
                      train_batch_size, 100, train_step, plot_losses=plot_losses)
            saver.save(sess, model_dir_save)
            writer = tf.summary.FileWriter('./graph', sess.graph)

        # validation part
        print('Validation')
        run_model(sess, x_val, mean_loss, y_out, y_val, 1, 64)

        # test part
        print('test')
        run_model(sess, x_test, mean_loss, y_out, y_test, 1, 64)


if __name__ == '__main__':
    tf.app.run()
















