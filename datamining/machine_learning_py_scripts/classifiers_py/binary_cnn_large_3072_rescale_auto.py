# D. Wen, A. Romriell, J. Pollard


import time
import random
import matplotlib
matplotlib.use('Agg')
from glob import glob
from skimage.io import imread
from skimage.util import crop
import numpy as np
import theano
import theano.tensor as T
import lasagne


TRAIN = "/home/ubuntu/images_emotion/distort_and_original_images/"
EMOS = {"A": 0, "D": 1, "F": 2, "H": 3, "U": 4, "S": 5, "N": 6}
EM_ABBREV = {"Angry": "A", "Disgust": "D", "Fear": "F", "Happy": "H", "Unhappy": "U", "Surprise": "S", "Neutral": "N"}
EPOCHS = 100


def get_emo_int_binary(filename, emos):

    pieces = filename.split('/')
    emo_key = pieces[-1][0]

    return emos[emo_key]


def get_image_files_two_emos(emo1, emo2, im_dir):
    """
    -load in the image filenames for two specified emotions
    :param emo1:
    :param emo2:
    :param im_dir:
    :return:
    """
    random.seed(time.time())
    image_filenames = glob('{}/{}*.png'.format(im_dir, EM_ABBREV[emo1]))
    more_image_filenames = glob('{}/{}*.png'.format(im_dir, EM_ABBREV[emo2]))

    for im in more_image_filenames:
        image_filenames.append(im)

    image_filenames.sort()
    random.shuffle(image_filenames)

    return image_filenames, {EM_ABBREV[emo1]: 1, EM_ABBREV[emo2]: 0}


def rescale_image(image):

    rows, columns = np.shape(image)
    rescale = [[float(image[r, c]) / 255 for c in range(columns)] for r in range(rows)]

    return np.array(rescale)


def normalize_image(image):

    rows, columns = np.shape(image)
    m = np.mean(image)
    s = np.std(image)
    normalized = [[float(image[r, c] - m) / s for c in range(columns)] for r in range(rows)]

    return np.array(normalized)


def load_image_data(filelist, perc_tr=0.7, im_func=None, emo_ints=None):
    """
    -load in the images as numpy arrays and return the following:
    1. a numpy array of shape (perc_tr*len(filelist), 1, 42, 42) that contains the training image data
    2. a numpy array of shape (perc_tr*len(filelist),) that contains the training emotion code for each training image
    3. a numpy array of shape ((1-perc_tr)*len(filelist), 1, 42, 42) that contains the test image data
    4. a numpy array of shape ((1-perc_tr)*len(filelist), ) that contains the test emotion codes for each test image
    :return:
    """
    if perc_tr < 0.5:
        print "Training subset percent too low, defaulting to 50%%..."
        perc_tr = 0.5

    # subset the list of file names into training and testing
    # note that the file names have been shuffled randomly before coming
    # in to the function
    tr_len = int(round(perc_tr * len(filelist)))
    te_len = len(filelist) - tr_len
    training = filelist[:tr_len]
    test = filelist[tr_len:]

    # initialize empty arrays to hold the training and testing image data
    # we are cropping the images to 42 X 42
    imgs_train = np.empty(shape=(tr_len, 1, 42, 42), dtype=np.float32)
    emos_train = np.empty(shape=tr_len, dtype=np.int8)
    imgs_test = np.empty(shape=(te_len, 1, 42, 42), dtype=np.float32)
    emos_test = np.empty(shape=te_len, dtype=np.int8)

    # populate the training arrays
    for i in range(len(training)):
        img = imread(training[i], as_grey=True)
        img_crop = crop(img, crop_width=3)
        img_crop = im_func(img_crop)
        imgs_train[i, 0] = img_crop
        emos_train[i,] = get_emo_int_binary(training[i], emo_ints)

    # populate the test arrays
    for i in range(len(test)):
        img = imread(test[i], as_grey=True)
        img_crop = crop(img, crop_width=3)
        img_crop = im_func(img_crop)
        imgs_test[i, 0] = img_crop
        emos_test[i] = get_emo_int_binary(test[i], emo_ints)

    return imgs_train, emos_train, imgs_test, emos_test


def build_cnn(input_var=None):

    # input layer is 42 X 42 image
    network = lasagne.layers.InputLayer(shape=(None, 1, 42, 42), input_var=input_var)

    # conv1 layer
    network = lasagne.layers.Conv2DLayer(network, num_filters=32, filter_size=(7, 7),
                                         stride=1, pad=3, W=lasagne.init.GlorotUniform(),
                                         nonlinearity=lasagne.nonlinearities.rectify)

    # max pool layer 1
    network = lasagne.layers.MaxPool2DLayer(network, pool_size=(2, 2), stride=2, pad=0)

    # conv2 layer
    network = lasagne.layers.Conv2DLayer(network, num_filters=32, filter_size=(7, 7),
                                         stride=1, pad=2, W=lasagne.init.GlorotUniform(),
                                         nonlinearity=lasagne.nonlinearities.rectify)

    # max pool layer 2
    network = lasagne.layers.MaxPool2DLayer(network, pool_size=(2, 2), stride=2, pad=(1, 0))

    # conv3 layer
    network = lasagne.layers.Conv2DLayer(network, num_filters=64, filter_size=(7, 7),
                                         stride=1, pad=3, W=lasagne.init.GlorotUniform(),
                                         nonlinearity=lasagne.nonlinearities.rectify)

    # max pool layer 3
    network = lasagne.layers.MaxPool2DLayer(network, pool_size=(2, 2), stride=2, pad=0)

    # enter the fully connected hidden layer 3072 neurons
    network = lasagne.layers.DenseLayer(lasagne.layers.dropout(network, p=0.5),
                                        num_units=3072, W=lasagne.init.GlorotUniform(),
                                        nonlinearity=lasagne.nonlinearities.sigmoid)

    # again the num_units=7 refers to the 7 emotions we are classifying
    network = lasagne.layers.DenseLayer(network, num_units=2,
                                        nonlinearity=lasagne.nonlinearities.softmax)

    return network


# note that we need to build this function up
def minibatch_iterator(inputs, targets, batchsize):
    """
    -returns subsets of the input data
    -note that the function assumes the data has been randomly shuffled already
    before being passed
    :param inputs:
    :param targets:
    :param batchsize:
    :return:
    """

    num_batches = int(len(inputs)/batchsize)

    for i in range(num_batches):
        if i != num_batches - 1:
            yield inputs[i*batchsize:(i+1)*batchsize, :, :, :], targets[i*batchsize:(i+1)*batchsize, ]
        else:
            yield inputs[i*batchsize:, :, :, :], targets[i*batchsize:, ]


if __name__ == "__main__":

    emotions = EM_ABBREV.keys()
    for emo1 in emotions:
        for emo2 in emotions[emotions.index(emo1)+1:]:

            start = time.time()

            print "Beginning the binary CNN classifier..."

            CSV = "/home/ubuntu/emotobot/log/large_3072_rescale_%s_%s.csv" % (emo1.lower(), emo2.lower())
            files, binary_emos = get_image_files_two_emos(emo1, emo2, TRAIN)

            X_tr, Y_tr, X_te, Y_te = load_image_data(files, perc_tr=0.8, im_func=rescale_image, emo_ints=binary_emos)

            print len(X_tr), np.shape(X_tr)
            print len(Y_tr), np.shape(Y_tr)
            print len(X_te), np.shape(X_te)
            print len(Y_te), np.shape(Y_te)

            csv_file = open(CSV, 'w')
            csv_file.write('epoch,trainloss,testloss,testacc\n')

            # time to begin building the network

            # name the Theano input variables
            images = T.tensor4('inputs')
            emos = T.ivector('targets')

            # create the network
            emo_cnn = build_cnn(images)
            pred = lasagne.layers.get_output(emo_cnn)
            loss = lasagne.objectives.categorical_crossentropy(pred, emos)
            loss = loss.mean()

            params = lasagne.layers.get_all_params(emo_cnn, trainable=True)
            updates = lasagne.updates.nesterov_momentum(loss, params, learning_rate=0.004, momentum=0.9)
            test_prediction = lasagne.layers.get_output(emo_cnn, deterministic=True)
            test_loss = lasagne.objectives.categorical_crossentropy(test_prediction, emos)
            test_loss = test_loss.mean()
            test_acc = T.mean(T.eq(T.argmax(test_prediction, axis=1), emos), dtype=theano.config.floatX)

            train_func = theano.function([images, emos], loss, updates=updates)
            test_func = theano.function([images, emos], [test_loss, test_acc])

            # begin the training epochs
            for epoch in range(EPOCHS):
                # In each epoch, we do a full pass over the training data:
                train_err = 0
                train_batches = 0
                start_time = time.time()

                # if epoch != 0 and epoch % 4 == 0:
                #     eta.set_value(eta.get_value() * decay)

                for batch in minibatch_iterator(X_tr, Y_tr, 200):
                    inputs, targets = batch
                    train_err += train_func(inputs, targets)
                    train_batches += 1

                # And a full pass over the test data:
                test_err = 0
                test_acc = 0
                test_batches = 0
                for batch in minibatch_iterator(X_te, Y_te, 200):
                    inputs, targets = batch
                    err, acc = test_func(inputs, targets)
                    test_err += err
                    test_acc += acc
                    test_batches += 1

                # Then we print the results for this epoch:
                print "Epoch {0} of {1} took {2:.3f}s".format(epoch + 1, EPOCHS, time.time() - start_time)
                print "  training loss:\t\t{:.6f}".format(train_err / train_batches)
                print "  test loss:\t\t{:.6f}".format(test_err / test_batches)
                print "  test accuracy:\t\t{:.2f} %".format(test_acc / test_batches * 100)
                print "Total time elapsed since start:\t\t{}".format(time.time() - start)

                csv_str = "{},{:.6f},{:.6f},{:.4f}\n".format(epoch + 1, train_err / train_batches,
                                                             test_err / test_batches, test_acc / test_batches)
                csv_file.write(csv_str)

            # close the csv file
            csv_file.close()

            print "Total time: {:.4f} seconds...".format(time.time() - start)


