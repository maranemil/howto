
# coding: utf-8

# # Self-Driving Car Engineer Nanodegree
# 
# ## Deep Learning
# 
# ## Project: Build a Traffic Sign Recognition Classifier
# 
# In this notebook, a template is provided for you to implement your functionality in stages, which is required to successfully complete this project. If additional code is required that cannot be included in the notebook, be sure that the Python code is successfully imported and included in your submission if necessary. 
# 
# > **Note**: Once you have completed all of the code implementations, you need to finalize your work by exporting the iPython Notebook as an HTML document. Before exporting the notebook to html, all of the code cells need to have been run so that reviewers can see the final implementation and output. You can then export the notebook by using the menu above and navigating to  \n",
#     "**File -> Download as -> HTML (.html)**. Include the finished document along with this notebook as your submission. 
# 
# In addition to implementing code, there is a writeup to complete. The writeup should be completed in a separate file, which can be either a markdown file or a pdf document. There is a [write up template](https://github.com/udacity/CarND-Traffic-Sign-Classifier-Project/blob/master/writeup_template.md) that can be used to guide the writing process. Completing the code template and writeup template will cover all of the [rubric points](https://review.udacity.com/#!/rubrics/481/view) for this project.
# 
# The [rubric](https://review.udacity.com/#!/rubrics/481/view) contains "Stand Out Suggestions" for enhancing the project beyond the minimum requirements. The stand out suggestions are optional. If you decide to pursue the "stand out suggestions", you can include the code in this Ipython notebook and also discuss the results in the writeup file.
# 
# 
# >**Note:** Code and Markdown cells can be executed using the **Shift + Enter** keyboard shortcut. In addition, Markdown cells can be edited by typically double-clicking the cell to enter edit mode.

# ---
# ## Step 0: Load The Data

# In[1]:


# Load pickled data
import pickle

#load datasets

training_file = 'data/train.p'
validation_file='data/valid.p'
testing_file = 'data/test.p'

with open(training_file, mode='rb') as f:
    train = pickle.load(f)
with open(validation_file, mode='rb') as f:
    valid = pickle.load(f)
with open(testing_file, mode='rb') as f:
    test = pickle.load(f)

X_train, y_train = train['features'], train['labels']
X_valid, y_valid = valid['features'], valid['labels']
X_test, y_test = test['features'], test['labels']


# ---
# 
# ## Step 1: Dataset Summary & Exploration
# 
# The pickled data is a dictionary with 4 key/value pairs:
# 
# - `'features'` is a 4D array containing raw pixel data of the traffic sign images, (num examples, width, height, channels).
# - `'labels'` is a 1D array containing the label/class id of the traffic sign. The file `signnames.csv` contains id -> name mappings for each id.
# - `'sizes'` is a list containing tuples, (width, height) representing the original width and height the image.
# - `'coords'` is a list containing tuples, (x1, y1, x2, y2) representing coordinates of a bounding box around the sign in the image. **THESE COORDINATES ASSUME THE ORIGINAL IMAGE. THE PICKLED DATA CONTAINS RESIZED VERSIONS (32 by 32) OF THESE IMAGES**
# 
# Complete the basic data summary below. Use python, numpy and/or pandas methods to calculate the data summary rather than hard coding the results. For example, the [pandas shape method](http://pandas.pydata.org/pandas-docs/stable/generated/pandas.DataFrame.shape.html) might be useful for calculating some of the summary results. 

# ### Provide a Basic Summary of the Data Set Using Python, Numpy and/or Pandas

# In[2]:


### Replace each question mark with the appropriate value. 
### Use python, pandas or numpy methods rather than hard coding the results

# Number of training examples
n_train = len(y_train)

# Number of validation examples
n_validation = len(y_valid)

# Number of testing examples.
n_test = len(y_test)

# What's the shape of an traffic sign image?
image_shape = X_train[0].shape[:-1]

# TODO: How many unique classes/labels there are in the dataset.
n_classes = len(set(y_test))

print("Number of training examples =", n_train)
print("Number of validation examples =", n_validation)
print("Number of testing examples =", n_test)
print("Image data shape =", image_shape)
print("Number of classes =", n_classes)


# ### Include an exploratory visualization of the dataset

# Visualize the German Traffic Signs Dataset using the pickled file(s). This is open ended, suggestions include: plotting traffic sign images, plotting the count of each sign, etc. 
# 
# The [Matplotlib](http://matplotlib.org/) [examples](http://matplotlib.org/examples/index.html) and [gallery](http://matplotlib.org/gallery.html) pages are a great resource for doing visualizations in Python.
# 
# **NOTE:** It's recommended you start with something simple first. If you wish to do more, come back to it after you've completed the rest of the sections. It can be interesting to look at the distribution of classes in the training, validation and test set. Is the distribution the same? Are there more examples of some classes than others?

# **Loading the traffic class text labels**
# 

# In[3]:


import  csv
labels  = []
with open('signnames.csv', 'r') as f:
    reader = csv.reader(f)
    for label in reader:
        labels.append(label[1])
labels = labels[1:]

print(labels[0:5],'...')


# In[6]:


### Data exploration visualization code goes here.

# Visualizations will be shown in the notebook.
import matplotlib.pyplot as plt
import random

rows = 7
cols = 7
fig, axs = plt.subplots(rows,cols)
fig.set_size_inches(25,25)

for i in range(43):

    class_image = X_train[y_train==i]
    index = random.randint(0, len(class_image)-1)
    image = class_image[index]

    axs[int(i/rows)][i%cols].imshow(image)
    axs[int(i/rows)][i%cols].set_title(labels[i], fontsize=11)

plt.show()


# # Distribution
# Now we are going to explore the distribution and take look at the distribution of classes in the training, validation and test set.
# 
# From the histograms below, we can clearly see that the distribution between train, validation and test is nearly the same, but the problem is that there is a huge variability of the distribution between class instances within the dataset, and we can further investigate whether it can cause some problems during our training, and maybe we can develop augmentation techniques to equalize them

# In[5]:


#We are going visualize the distribution of classes in the training, validation and test set.

#number of bins is the number of classes
n_bins = n_classes

#draw a subplot table of 1x3 
fig, axs = plt.subplots(1, 3, sharey=False, tight_layout=True, figsize=[15,5])

# We can set the number of bins with the `bins` kwarg
axs[0].set_title('Train classes distribution histogram', fontsize=11)
axs[1].set_title('Validation classes distribution histogram', fontsize=11)
axs[2].set_title('Test classes distribution histogram', fontsize=11)

x_train_hist, y_train_hist, _ = axs[0].hist(y_train, bins=n_bins)
x_valid_hist, y_valid_hist, _ = axs[1].hist(y_valid, bins=n_bins)
x_test_hist, y_test_hist, _ = axs[2].hist(y_test, bins=n_bins)

print("Maximum class labels instances in train data",x_train_hist.max())
print("Minimum class labels instances in test data",x_train_hist.min(),'\n')

print("Maximum class labels instances in validation data",x_valid_hist.max())
print("Mininum class labels instances in validation data",x_valid_hist.min(),'\n')

print("Maximum class labels instances in test data",x_test_hist.max())
print("Minimum class labels instances in test data",x_test_hist.min())


# ----
# 
# ## Step 2: Design and Test a Model Architecture
# 
# Design and implement a deep learning model that learns to recognize traffic signs. Train and test your model on the [German Traffic Sign Dataset](http://benchmark.ini.rub.de/?section=gtsrb&subsection=dataset).
# 
# The LeNet-5 implementation shown in the [classroom](https://classroom.udacity.com/nanodegrees/nd013/parts/fbf77062-5703-404e-b60c-95b78b2f3f9e/modules/6df7ae49-c61c-4bb2-a23e-6527e69209ec/lessons/601ae704-1035-4287-8b11-e2c2716217ad/concepts/d4aca031-508f-4e0b-b493-e7b706120f81) at the end of the CNN lesson is a solid starting point. You'll have to change the number of classes and possibly the preprocessing, but aside from that it's plug and play! 
# 
# With the LeNet-5 solution from the lecture, you should expect a validation set accuracy of about 0.89. To meet specifications, the validation set accuracy will need to be at least 0.93. It is possible to get an even higher accuracy, but 0.93 is the minimum for a successful project submission. 
# 
# There are various aspects to consider when thinking about this problem:
# 
# - Neural network architecture (is the network over or underfitting?)
# - Play around preprocessing techniques (normalization, rgb to grayscale, etc)
# - Number of examples per label (some have more than others).
# - Generate fake data.
# 
# Here is an example of a [published baseline model on this problem](http://yann.lecun.com/exdb/publis/pdf/sermanet-ijcnn-11.pdf). It's not required to be familiar with the approach used in the paper but, it's good practice to try to read papers like these.

# ### Pre-process the Data Set (normalization, grayscale, etc.)

# Minimally, the image data should be normalized so that the data has mean zero and equal variance. For image data, `(pixel - 128)/ 128` is a quick way to approximately normalize the data and can be used in this project. 
# 
# Other pre-processing steps are optional. You can try different techniques to see if it improves performance. 
# 
# Use the code cell (or multiple code cells, if necessary) to implement the first step of your project.

# In[6]:


### Preprocess the data here. It is required to normalize the data. 
### The data is scalled from 0 to 1 

def preprocess_dataset(dataset):

    # normalize dataset
    dataset = (dataset.astype(float))/float(255)

    return dataset


# # Data augmentation
# 
# The first thing I tried is to augment the data replicating the class labels which are rare in the dataset, so it can reduce ***high variance of our model*** (Overfitting)
# 
# ***Conclusion : I realized that data augmentation cannot make drastic improvements to the performance of my model, and the augmentation step was ommited due to slowing down the entire training procedure***

# In[7]:


#augmentation 
from utils import *

def augment_image(img):
    '''
    This function helps to generate new images for replicating the rare images from certain labels.
    The function takes in following arguments,
    1- Image
    '''      
    img = clipped_zoom(img)
    img = sharpen_image(img)
    img = contr_img(img)
    img = translate_image(img)
    #img = rotate_images(img)  
    #img = add_salt_pepper_noise(img)
    
    return img


# In[8]:


X_train= preprocess_dataset(X_train)
X_test= preprocess_dataset(X_test)
X_valid= preprocess_dataset(X_valid)

# np.save('X_train',X_process)
# np.save('X_test',X_valid)
# np.save('X_valid',X_test)


# In[9]:


#disabling deprecated log messages on old version of tensorflow
import logging
class WarningFilter(logging.Filter):
    def filter(self, record):
        msg = record.getMessage()
        tf_warning = 'retry (from tensorflow.contrib.learn.python.learn.datasets.base)' in msg
        return not tf_warning
            
logger = logging.getLogger('tensorflow')
logger.addFilter(WarningFilter())


# ## Model Architecture

# In[10]:


import tensorflow as tf
import tensorflow.contrib.layers as layers
import tensorflow.contrib.framework as ops
from sklearn.utils import shuffle


def get_inception_layer( inputs, conv11_size, conv33_11_size, conv33_size,
                         conv55_11_size, conv55_size, pool11_size):
    
    """
    This is an implementation for inception layer, the inception layer consist of stacking together the following convolutions : 
        [Convolution, filter size = 1x1]
        +
        [Convolution, filter size = 1x1,
         Convolution, filter size = 3x3]
        + 
        [Convolution, filter size = 1x1
        Convolution, filter size = 5x5]
        +
        [Max Pooling, fiter size = 3x3, stride = 1,
        [Convolution, filter size = 1x1]


    `inputs` Input data 
    
    `convolutions sizes : ` Integer, the number of output filters 
    
    """
    
    with tf.variable_scope("conv_1x1"):
        conv11 = layers.conv2d( inputs, conv11_size, [ 1, 1 ] )
    with tf.variable_scope("conv_3x3"):
        conv33_11 = layers.conv2d( inputs, conv33_11_size, [ 1, 1 ] )
        conv33 = layers.conv2d( conv33_11, conv33_size, [ 3, 3 ] )
    with tf.variable_scope("conv_5x5"):
        conv55_11 = layers.conv2d( inputs, conv55_11_size, [ 1, 1 ] )
        conv55 = layers.conv2d( conv55_11, conv55_size, [ 5, 5 ] )
    with tf.variable_scope("pool_proj"):
        pool_proj = layers.max_pool2d( inputs, [ 3, 3 ], stride = 1 )
        pool11 = layers.conv2d( pool_proj, pool11_size, [ 1, 1 ] )
    if tf.__version__ == '0.11.0rc0':
        return tf.concat(3, [conv11, conv33, conv55, pool11])
    return tf.concat([conv11, conv33, conv55, pool11], 3)

end_points = {}

def model(inputs, dropout_keep_prob=0.5, num_classes=43, is_training=True, scope=''):
    
    """
    This is the implementation of the current model: 
        2DConvolution
        Inception module 
        Inceptiuon Module
        Max Pooling
        Fully Connected Layer, Relu, Xavier initialization
        Dropout
        Fully Connected Layer, Relu, Xavier initialization
        Dropout
        Fully Connected Layer, Relu, Xavier initialization
        Dropout
        Softmax

    `inputs` Input data 
    `dropout_keep_prob` : Float, The probability that each element is kept.
    `num_classes` : Integer, Number of data classes.
    `is_training` : Bool,  indicating whether or not the model is in training mode. 
                    If so, dropout is applied and values scaled. Otherwise, inputs is returned.
    `scope` : String, scope of the current model
    """
        
    with tf.name_scope(scope, "model", [inputs] ):
        with ops.arg_scope( [ layers.max_pool2d ], padding = 'SAME'):
            end_points['conv0'] = layers.conv2d( inputs, 64, [ 7, 7 ], stride = 2, scope = 'conv0')

            with tf.variable_scope("inception_3a"):
                end_points['inception_3a'] = get_inception_layer( end_points['conv0'], 64, 96, 128, 16, 32, 32)

            with tf.variable_scope("inception_3b"):
                end_points['inception_3b'] = get_inception_layer( end_points['inception_3a'], 128, 128, 192, 32, 96, 64)

            end_points['pool2'] = layers.max_pool2d(end_points['inception_3b'], [ 3, 3 ], scope='pool2')

            #print(end_points['pool2'].shape)

            end_points['reshape'] = tf.reshape( end_points['pool2'], [-1, 8*8*480] )

            end_points['fully_2'] = layers.fully_connected(  end_points['reshape'], 200, activation_fn=tf.nn.relu, scope='fully_2')
            end_points['dropout1'] = layers.dropout( end_points['fully_2'], dropout_keep_prob, is_training = is_training )

            end_points['fully_3'] = layers.fully_connected(  end_points['dropout1'], 400, activation_fn=tf.nn.relu, scope='fully_3')
            end_points['dropout2'] =layers.dropout( end_points['fully_3'], dropout_keep_prob, is_training = is_training)

            end_points['fully_4'] = layers.fully_connected(  end_points['dropout2'], 300, activation_fn=tf.nn.relu, scope='fully_4')
            end_points['dropout3'] = layers.dropout( end_points['fully_4'], dropout_keep_prob, is_training = is_training )

            end_points['logits'] = layers.fully_connected( end_points['dropout3'], num_classes, activation_fn=None, scope='logits')
            end_points['predictions'] = tf.nn.softmax(end_points['logits'], name='predictions')

    return end_points['logits'], end_points


# ### Train, Validate and Test the Model

# A validation set can be used to assess how well the model is performing. A low accuracy on the training and validation
# sets imply underfitting. A high accuracy on the training set but low accuracy on the validation set implies overfitting.

# In[11]:


### Model tensor parameters

EPOCHS = 350
BATCH_SIZE = 128

tf.reset_default_graph()

x = tf.placeholder(tf.float32, (None, 32, 32, 3), name='X')
y = tf.placeholder(tf.int32, (None), name='Y')
isTrain = tf.placeholder(tf.bool, shape=(), name='IsTraining')
learning_rate = tf.placeholder(tf.float32, shape=(), name = 'LearningRate')

one_hot_y = tf.one_hot(y, 43)

logits,_ = model(x, is_training=isTrain)
cross_entropy = tf.nn.softmax_cross_entropy_with_logits_v2(labels=one_hot_y, logits=logits)
loss_operation = tf.reduce_mean(cross_entropy)

top_predictions = tf.nn.top_k(tf.nn.softmax(logits), k=5)

#L2 Regularization
#loss_operation = tf.reduce_mean(loss_operation+beta*tf.nn.l2_loss(end_points['fully_2']))

optimizer = tf.train.AdamOptimizer(learning_rate = learning_rate)
training_operation = optimizer.minimize(loss_operation)


# In[12]:


#model evaluation

correct_prediction = tf.equal(tf.argmax(logits, 1), tf.argmax(one_hot_y, 1))
accuracy_operation = tf.reduce_mean(tf.cast(correct_prediction, tf.float32))
saver = tf.train.Saver()

def evaluate(X_data, y_data, print_loss=False):
    num_examples = len(X_data)
    total_accuracy = 0
    total_loss=0
    sess = tf.get_default_session()
    image=None
    for offset in range(0, num_examples, BATCH_SIZE):
        batch_x, batch_y = X_data[offset:offset+BATCH_SIZE], y_data[offset:offset+BATCH_SIZE]
        accuracy,loss = sess.run([accuracy_operation,loss_operation], feed_dict={x: batch_x, y: batch_y, isTrain: False})
        total_accuracy += (accuracy * len(batch_x))
        total_loss+=(loss* len(batch_x))

    if print_loss:
        print('loss: ',total_loss/num_examples)

    return total_accuracy / num_examples


# In[156]:



"""" 
Hyper params on initial trainign start: 
`learning rate` = 0.0005 
`dropout keep probability` = 0.5
`epochs` = 350

Training time till achieving the optima : 1.5 hours
Configuration : 1x1080Ti GPU, CPU : i5 8600k 
"""
# train the model here

with tf.Session() as sess:
    
    #get number of samples
    num_examples = len(X_train)

    #restore last saved model 
    saver.restore(sess, tf.train.latest_checkpoint('.'))
    
    #set the learning rate value to continue with training
    rate=0.00001
    count=0

    print("Training... \n")
    for i in range(EPOCHS):
        X_process, Y_process = shuffle(X_train, y_train)
        for offset in range(0, num_examples, BATCH_SIZE):
            count+=1

            end = offset + BATCH_SIZE
            batch_x, batch_y = X_process[offset:end], Y_process[offset:end]
            r=sess.run(training_operation, feed_dict={x: batch_x, 
                                                      y: batch_y,
                                                      isTrain: True, 
                                                      learning_rate:rate})
            
           # Print validation accuracy periodically on every 100 iterations 
            if(count%100==0):
                validation_accuracy = evaluate(X_valid, y_valid, rate)
                print("---------------Validation Accuracy = {:.3f}".format(validation_accuracy))   
        
        # Print train accuracy and validation accuracy after finishing training epoch 
        train_accuracy = evaluate(X_process, Y_process)
        validation_accuracy = evaluate(X_valid, y_valid, print_loss=True)
       
        print("EPOCH {} ...".format(i+1))
        print("Train Accuracy = {0}".format(train_accuracy))
        print("Validation Accuracy = {0}".format(validation_accuracy))
        print("learning_rate", rate)

    test_accuracy = evaluate(X_test, y_test)
    print("Test Accuracy = {0}".format(test_accuracy))

    saver.save(sess, './lenet')
    print("Model saved")


# In[13]:



### Run the predictions here.
with tf.Session() as sess:
    saver.restore(sess, tf.train.latest_checkpoint('.'))

    validation_accuracy = evaluate(X_valid, y_valid, print_loss=True)
    test_accuracy = evaluate(X_test, y_test, print_loss=True)
    train_accuracy = evaluate(X_train, y_train, print_loss=True)

    print('Train Accuracy', train_accuracy)
    print('Validation Accuracy', validation_accuracy)
    print('Test Accuracy', test_accuracy)


# ---
# 
# ## Step 3: Test a Model on New Images
# 
# To give yourself more insight into how your model is working, download at least five pictures of German traffic signs from the web and use your model to predict the traffic sign type.
# 
# You may find `signnames.csv` useful as it contains mappings from the class id (integer) to the actual sign name.

# ### Load and Output the Images

# In[14]:


def evaluate_custom(X_data, Y_data):
    """
    Evaluate and return info for top 5 predictions for a given input
    
    `X_data` Array, Input data 
    """
    with tf.Session() as sess:
        saver.restore(sess, tf.train.latest_checkpoint('.'))
        predictions, c_accuracy, c_loss = sess.run([top_predictions, accuracy_operation, loss_operation], feed_dict={x: X_data, y:Y_data,  isTrain: False})
        return predictions, c_accuracy, c_loss


# In[15]:


from utils import *

def get_custom_dataset():
    """
    Get custom dataset downloaded from internet and preprocessed for our need
    
    `X_data` Array, Input data 
    """
    directory = 'test_images'
    download_files(directory)

    X_custom_set = []
    X_readable_set = []
    for i in range (1,9):
        image, readable_image = apply_model_to_image_raw_bytes(open(directory+'/'+str(i)+".jpg", "rb").read())
        X_custom_set.append(image)
        X_readable_set.append(readable_image)
        
    custom_set_X = np.array(X_custom_set)
    custom_set_Y = [1,14,30,25,29,11,8,31]
    return preprocess_dataset(custom_set_X), X_readable_set, custom_set_Y

### Load the images
X_custom, X_custom_readable, Y_custom = get_custom_dataset()

#plot images
rows = 2
cols = 4
fig, axs = plt.subplots(rows,cols)
fig.set_size_inches(25,15)
for i, image in enumerate(X_custom_readable):
    axs[int(i/cols)][i%cols].imshow(image)


# ### Predict the Sign Type for Each Image

# In[20]:


### Run the predictions with using the model to output the prediction for each image.
predictions, c_accuracy, c_loss = evaluate_custom(X_custom, Y_custom)
rows = 2
cols = 4
fig, axs = plt.subplots(rows,cols)
fig.set_size_inches(25,15)


# plot the predictions
for i, image in enumerate(X_custom_readable):
    axs[int(i/cols)][i%cols].imshow(image)

    title = (labels[predictions.indices[i][0]])
    axs[int(i/cols)][i%cols].set_title(title, fontsize=20)


# ### Analyze Performance

# In[17]:


### Calculate the accuracy for these 5 new images. 
### For example, if the model predicted 1 out of 5 signs correctly, it's 20% accurate on these new images.
print("Accuracy", c_accuracy*100)
print("Loss", c_loss)


# ### Output Top 5 Softmax Probabilities For Each Image Found on the Web

# For each of the new images, print out the model's softmax probabilities to show the **certainty** of the model's predictions (limit the output to the top 5 probabilities for each image). [`tf.nn.top_k`](https://www.tensorflow.org/versions/r0.12/api_docs/python/nn.html#top_k) could prove helpful here. 
# 
# The example below demonstrates how tf.nn.top_k can be used to find the top k predictions for each image.
# 
# `tf.nn.top_k` will return the values and indices (class ids) of the top k predictions. So if k=3, for each sign, it'll return the 3 largest probabilities (out of a possible 43) and the correspoding class ids.
# 
# Take this numpy array as an example. The values in the array represent predictions. The array contains softmax probabilities for five candidate images with six possible classes. `tf.nn.top_k` is used to choose the three classes with the highest probability:
# 
# ```
# # (5, 6) array
# a = np.array([[ 0.24879643,  0.07032244,  0.12641572,  0.34763842,  0.07893497,
#          0.12789202],
#        [ 0.28086119,  0.27569815,  0.08594638,  0.0178669 ,  0.18063401,
#          0.15899337],
#        [ 0.26076848,  0.23664738,  0.08020603,  0.07001922,  0.1134371 ,
#          0.23892179],
#        [ 0.11943333,  0.29198961,  0.02605103,  0.26234032,  0.1351348 ,
#          0.16505091],
#        [ 0.09561176,  0.34396535,  0.0643941 ,  0.16240774,  0.24206137,
#          0.09155967]])
# ```
# 
# Running it through `sess.run(tf.nn.top_k(tf.constant(a), k=3))` produces:
# 
# ```
# TopKV2(values=array([[ 0.34763842,  0.24879643,  0.12789202],
#        [ 0.28086119,  0.27569815,  0.18063401],
#        [ 0.26076848,  0.23892179,  0.23664738],
#        [ 0.29198961,  0.26234032,  0.16505091],
#        [ 0.34396535,  0.24206137,  0.16240774]]), indices=array([[3, 0, 5],
#        [0, 1, 4],
#        [0, 5, 1],
#        [1, 3, 5],
#        [1, 4, 3]], dtype=int32))
# ```
# 
# Looking just at the first row we get `[ 0.34763842,  0.24879643,  0.12789202]`, you can confirm these are the 3 largest probabilities in `a`. You'll also notice `[3, 0, 5]` are the corresponding indices.

# In[18]:


### Print out the top five softmax probabilities for the predictions on the German traffic sign images found on the web. 
### Feel free to use as many code cells as needed.
rows = 2
cols = 4
fig, axs = plt.subplots(rows,cols)
fig.set_size_inches(25,15)


# plot the predictions
for i, image in enumerate(X_custom_readable):
    axs[int(i/cols)][i%cols].imshow(image)

    values = (predictions.values[i]*100).tolist()
    indeces = (predictions.indices[i]).tolist()
    captions = list(map(lambda x:labels[x], indeces))
    
    title = '\n'.join('%s=%s%%' % t for t in zip(captions, values))
        
    axs[int(i/cols)][i%cols].set_title(title, fontsize=12)


# ### Project Writeup
# 
# Once you have completed the code implementation, document your results in a project writeup using this [template](https://github.com/udacity/CarND-Traffic-Sign-Classifier-Project/blob/master/writeup_template.md) as a guide. The writeup can be in a markdown or pdf file. 

# > **Note**: Once you have completed all of the code implementations and successfully answered each question above, you may finalize your work by exporting the iPython Notebook as an HTML document. You can do this by using the menu above and navigating to  \n",
#     "**File -> Download as -> HTML (.html)**. Include the finished document along with this notebook as your submission.

# ---
# 
# ## Step 4 (Optional): Visualize the Neural Network's State with Test Images
# 
#  This Section is not required to complete but acts as an additional excersise for understaning the output of a neural network's weights. While neural networks can be a great learning device they are often referred to as a black box. We can understand what the weights of a neural network look like better by plotting their feature maps. After successfully training your neural network you can see what it's feature maps look like by plotting the output of the network's weight layers in response to a test stimuli image. From these plotted feature maps, it's possible to see what characteristics of an image the network finds interesting. For a sign, maybe the inner network feature maps react with high activation to the sign's boundary outline or to the contrast in the sign's painted symbol.
# 
#  Provided for you below is the function code that allows you to get the visualization output of any tensorflow weight layer you want. The inputs to the function should be a stimuli image, one used during training or a new one you provided, and then the tensorflow variable name that represents the layer's state during the training process, for instance if you wanted to see what the [LeNet lab's](https://classroom.udacity.com/nanodegrees/nd013/parts/fbf77062-5703-404e-b60c-95b78b2f3f9e/modules/6df7ae49-c61c-4bb2-a23e-6527e69209ec/lessons/601ae704-1035-4287-8b11-e2c2716217ad/concepts/d4aca031-508f-4e0b-b493-e7b706120f81) feature maps looked like for it's second convolutional layer you could enter conv2 as the tf_activation variable.
# 
# For an example of what feature map outputs look like, check out NVIDIA's results in their paper [End-to-End Deep Learning for Self-Driving Cars](https://devblogs.nvidia.com/parallelforall/deep-learning-self-driving-cars/) in the section Visualization of internal CNN State. NVIDIA was able to show that their network's inner weights had high activations to road boundary lines by comparing feature maps from an image with a clear path to one without. Try experimenting with a similar test to show that your trained network's weights are looking for interesting features, whether it's looking at differences in feature maps from images with or without a sign, or even what feature maps look like in a trained network vs a completely untrained one on the same sign image.
# 
# <figure>
#  <img src="visualize_cnn.png" width="380" alt="Combined Image" />
#  <figcaption>
#  <p></p> 
#  <p style="text-align: center;"> Your output should look something like this (above)</p> 
#  </figcaption>
# </figure>
#  <p></p> 
# 

# In[151]:



### Visualize your network's feature maps here.
### Feel free to use as many code cells as needed.

# image_input: the test image being fed into the network to produce the feature maps
# tf_activation: should be a tf variable name used during your training procedure that represents the calculated state of a specific weight layer
# activation_min/max: can be used to view the activation contrast in more detail, by default matplot sets min and max to the actual min and max values of the output
# plt_num: used to plot out multiple different weight feature map sets on the same block, just extend the plt number for each new feature map entry

def outputFeatureMap(image_input, tf_activation, activation_min=-1, activation_max=-1 ,plt_num=1):
    # Here make sure to preprocess your image_input in a way your network expects
    # with size, normalization, ect if needed
    # image_input =
    # Note: x should be the same name as your network's tensorflow data placeholder variable
    # If you get an error tf_activation is not defined it may be having trouble accessing the variable from inside a function
    activation = tf_activation.eval(session=sess,feed_dict={x : image_input})
    featuremaps = activation.shape[3]
    plt.figure(plt_num, figsize=(15,15))
    for featuremap in range(featuremaps):
        plt.subplot(6,8, min(featuremap+1,48)) # sets the number of feature maps to show on each row and column
        plt.title('FeatureMap ' + str(featuremap)) # displays the feature map number
        if activation_min != -1 & activation_max != -1:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", vmin =activation_min, vmax=activation_max, cmap="gray")
        elif activation_max != -1:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", vmax=activation_max, cmap="gray")
        elif activation_min !=-1:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", vmin=activation_min, cmap="gray")
        else:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", cmap="gray")


# In[154]:



with tf.Session() as sess:
    # Convolution (layer 1 after 'tf.nn.conv2d' operation)
    saver.restore(sess, tf.train.latest_checkpoint('.'))
    conv1 = sess.graph.get_tensor_by_name('conv0/weights:0')
    outputFeatureMap(X_train, conv1)

