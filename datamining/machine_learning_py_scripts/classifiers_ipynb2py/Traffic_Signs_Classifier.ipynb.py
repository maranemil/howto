
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

# In[1]:


# Imports 
import os
import time
import numpy as np
import tensorflow as tf
import matplotlib.pyplot as plt
import csv
import zipfile
import os
from urllib.request import urlretrieve
import cv2
import sklearn.model_selection

get_ipython().run_line_magic('matplotlib', 'inline')


# In[2]:


# Name of the model to be used. If None, the network will be retrained
network_model_dir = None#'model/20161126_094622'


# ## Step 0: Dataset Download
# Download link: https://d17h27t6h515a5.cloudfront.net/topher/2016/October/5811165e_traffic-signs-data.zip/traffic-signs-data.zip.zip
# 
# Rename train.p and test.p to train.pickle and test.pickle, respectively

# In[3]:


def download(url, file):
    """
    Download file from <url>
    :param url: URL to file
    :param file: Local file path
    """
    print('Downloading ' + file + '...')
    if not os.path.isfile(file):
        urlretrieve(url, file)
        print('Download Finished')
    else:
        print('File already in the filesystem!')

download('https://d17h27t6h515a5.cloudfront.net/topher/2016/October/5811165e_traffic-signs-data.zip/traffic-signs-data.zip.zip', 'traffic-signs-data.zip.zip')


# In[4]:


train_filename = 'train.pickle'
test_filename = 'test.pickle'

if not os.path.isfile(train_filename) or not os.path.isfile(test_filename):
    # Unzip
    print('Unzipping file...')
    with zipfile.ZipFile("traffic-signs-data.zip.zip","r") as zip_ref:
        zip_ref.extractall()

    # Rename    
    print('Renaming pickle files...')
    os.rename('train.p', 'train.pickle')
    os.rename('test.p', 'test.pickle')
    print('Done')
else:
    print('Pickle files already in the filesystem!')


# ---
# 
# ## Step 1: Dataset Exploration
# 
# Visualize the German Traffic Signs Dataset. This is open ended, some suggestions include: plotting traffic signs images, plotting the count of each sign, etc. Be creative!
# 
# 
# The pickled data is a dictionary with 4 key/value pairs:
# 
# - features -> the images pixel values, (width, height, channels)
# - labels -> the label of the traffic sign
# - sizes -> the original width and height of the image, (width, height)
# - coords -> coordinates of a bounding box around the sign in the image, (x1, y1, x2, y2). Based the original image (not the resized version).

# In[5]:


# Load pickled data
import pickle

# TODO: fill this in based on where you saved the training and testing data
training_file = 'train.pickle'
testing_file = 'test.pickle'

with open(training_file, mode='rb') as f:
    train = pickle.load(f)
with open(testing_file, mode='rb') as f:
    test = pickle.load(f)
    
X_train, y_train = train['features'], train['labels']
X_test, y_test = test['features'], test['labels']


# In[6]:


### To start off let's do a basic data summary.
# TODO: number of training examples
n_train = len(y_train)

# TODO: number of testing examples
n_test = len(y_test)

# TODO: what's the shape of an image?
image_shape = X_train.shape[1:3]

# TODO: how many classes are in the dataset
n_classes = len(set(y_train))

print("Number of training examples =", n_train)
print("Number of testing examples =", n_test)
print("Image data shape =", image_shape)
print("Number of classes =", n_classes)


# In[7]:


### Data exploration visualization goes here.
### Feel free to use as many code cells as needed.


# In[8]:


# Shapes of the input arrays
print("X_train.shape = ", X_train.shape)
print("y_train.shape = ", y_train.shape)
print("X_test.shape = ", X_test.shape)
print("y_test.shape = ", y_test.shape)


# In[9]:


# Plot one example of the 43 different classes
_, idx = np.unique(y_test, return_index=True)
X_test_unique = X_test[idx, :, :, :]
for i in range(0, len(idx)):
    plt.subplot(4, 11, i+1);
    plt.imshow(X_test_unique[i, :, :, :]);
    plt.axis('off');


# In[10]:


# Print the labels
labels_text = []
with open('signnames.csv', 'r') as csvfile:
    reader = csv.reader(csvfile, delimiter=',')
    i = 0
    for row in reader:
        print(', '.join(row))        
        if i > 0:
            labels_text.append(row[1])        
        i = i + 1


# In[11]:


# Display the number of examples for each class, for training and test set
def get_class_distribution(y, n_classes):
    labels = np.array(range(0, n_classes))
    n_examples = np.zeros(n_classes, dtype=np.int32)
    for i in labels:
        # Get indices in Y that correspond to 'i', for train and test sets
        n_examples[i] = sum(y == i)
        
    return (labels, n_examples)
    
# Plot in a bar diagram
plt.subplot(1,2,1)
labels, dist_train = get_class_distribution(y_train, n_classes)
plt.bar(labels, dist_train);
plt.title('Train set');
plt.subplot(1,2,2)
labels, dist_test = get_class_distribution(y_test, n_classes)
plt.bar(labels, dist_test);    
plt.title('Test set');


# We can observe that the training data is **not equally distributed** among the different classes. This indicates that the algorithm will be more fine-tuned for those classes for which there are more examples. If we want to improve the network's ability to generalize, we should have roughly the same number of examples for each class. 
# 
# The training set is balanced at the same time as fake data is generated, as shown in the following sections.

# ----
# 
# ## Step 2: Design and Test a Model Architecture
# 
# Design and implement a deep learning model that learns to recognize traffic signs. Train and test your model on the [German Traffic Sign Dataset](http://benchmark.ini.rub.de/?section=gtsrb&subsection=dataset).
# 
# There are various aspects to consider when thinking about this problem:
# 
# - Your model can be derived from a deep feedforward net or a deep convolutional network.
# - Play around preprocessing techniques (normalization, rgb to grayscale, etc)
# - Number of examples per label (some have more than others).
# - Generate fake data.
# 
# Here is an example of a [published baseline model on this problem](http://yann.lecun.com/exdb/publis/pdf/sermanet-ijcnn-11.pdf). It's not required to be familiar with the approach used in the paper but, it's good practice to try to read papers like these.

# ### Implementation
# 
# Use the code cell (or multiple code cells, if necessary) to implement the first step of your project. Once you have completed your implementation and are satisfied with the results, be sure to thoroughly answer the questions that follow.

# In[12]:


### Generate data additional (if you want to!)
### and split the data into training/validation/testing sets here.
### Feel free to use as many code cells as needed.


# ### Fake data generation
# We generate fake data in order for the network to be more robust and prevent overfitting. The following transformations are applied to each image of the training set, which is extended:
# 
#   * Translation
#   * Rotation
#   * Scaling
#   * Shearing  
#  
# We do not apply all 4 transformations at the same time to the image, because the bilinear interpolation in cv2.warpAffine makes the output image a bit blurrier every step. After applying the process 4 times, the image is too blurry to get good features. Therefore we opt for randomly choose one of those functions.
# 
# The dataset becomes then 10x bigger than the previous.

# In[13]:


### Helper functions
def apply_affine_transform(img, T):
    rows, cols, ch = img.shape
    return cv2.warpAffine(img, T, (cols, rows))

def random_translate(img, max_relative_displacement = 0.1):
    h, w =  img.shape[0:2]
    
    tx = np.random.uniform(-max_relative_displacement * w, max_relative_displacement * w)
    ty = np.random.uniform(-max_relative_displacement * h, max_relative_displacement * h)
    
    T = np.array([[1.0, 0.0, tx], [0.0, 1.0, ty]], dtype = np.float32)

    return apply_affine_transform(img, T)

def random_rotate(img, max_angle_degrees = 5.0):
    theta = np.random.uniform(-max_angle_degrees, max_angle_degrees) * np.pi/180.0
    
    c = np.cos(theta)
    s = np.sin(theta)
    
    T = np.array([[c, -s, 0.0], [s, c, 0.0]], dtype = np.float32)
    return apply_affine_transform(img, T)

def random_scale(img, max_scale_factor = 0.05):    
    sx = 1.0 + np.random.uniform(-max_scale_factor, max_scale_factor)
    sy = 1.0 + np.random.uniform(-max_scale_factor, max_scale_factor)
    
    T = np.array([[sx, 0.0, 0.0], [0.0, sy, 0.0]], dtype = np.float32)
    return apply_affine_transform(img, T)

def random_shear(img, max_sheer_factor = 0.05):
    kx = np.random.uniform(-max_sheer_factor, max_sheer_factor)
    ky = np.random.uniform(-max_sheer_factor, max_sheer_factor)
    
    T = np.array([[1.0, kx, 0.0], [ky, 1.0, 0]], dtype = np.float32)
    return apply_affine_transform(img, T)

def jitter_image(img):
    fnc = np.random.randint(0, 4)
    
    if fnc == 0:
        return random_translate(img)    
    elif fnc == 1:
        return random_rotate(img)    
    elif fnc == 2:
        return random_scale(img)
    else:
        return random_shear(img)        
    
def generate_fake_data(X, y, old_class_distribution, extend_factor = 10):
    X_fake = []
    y_fake = []
    
    # Get minimum final size of dataset, as well as nr of images per class
    final_size = extend_factor * X.shape[0]
    n_classes = len(old_class_distribution)
    n_images_per_class = int(np.ceil(final_size / n_classes))
    
    for i in range(X.shape[0]):
        # Compute number of required images
        class_idx = y[i]
        current_distribution_i = old_class_distribution[class_idx]        
        n_fake_images = int(np.ceil((n_images_per_class - current_distribution_i) / current_distribution_i))        
        
        # Generate fake images
        for j in range(n_fake_images):
            X_fake.append(jitter_image(X[i]))
            y_fake.append(y[i])
        
    return (np.array(X_fake), np.array(y_fake))

def extend_training_data(X, y, old_class_distribution):
    X_fake, y_fake = generate_fake_data(X, y, old_class_distribution)
    
    X = np.concatenate((X, X_fake), axis = 0)
    y = np.concatenate((y, y_fake), axis = 0)
    
    return (X, y)   


# In[14]:


x_in = X_train[1000]
x_out = jitter_image(x_in)

plt.subplot(1,2,1)
plt.imshow(np.squeeze(x_in), cmap='gray');
plt.subplot(1,2,2)
plt.imshow(np.squeeze(x_out), cmap='gray');


# In[15]:


# Extended training set with fake data
_, old_distribution = get_class_distribution(y_train, n_classes)
X_train, y_train = extend_training_data(X_train, y_train, old_distribution)
print('Extended training set size: ', X_train.shape)

# Plot new class distribution. It should be close to a uniform distribution
labels, dist_train = get_class_distribution(y_train, n_classes)
plt.bar(labels, dist_train);
plt.title('Extended training set - class distribution');


# We can see that the training set is now balanced, so it will not be biased towards some classes.

# ### Data preprocessing

# In[16]:


### Preprocess the data here.
### Feel free to use as many code cells as needed.


# In[17]:


### RGB to grayscale conversion. According to the paper, it gives better results
def rgb_to_grayscale(img):
    return cv2.cvtColor(img, cv2.COLOR_RGB2GRAY)

### Normalization: zero mean and unit variance
def normalization(x):
    a = 0.1
    b = 0.9
    x_min = 0
    x_max = 255
    
    return a + (x - x_min) * (b - a) / (x_max - x_min)

def preprocess_set(dataset):
    # Declare output array
    shape = [x for x in dataset.shape]
    shape[3] = 1 # Will convert to grayscale
    dataset_preprocessed = np.zeros(shape)
    
    # Convert from RGB to grayscale
    for i in range(0, dataset.shape[0]):
        dataset_preprocessed[i, :, :, :] = np.expand_dims(rgb_to_grayscale(dataset[i, :, :]), axis=2)
    
    #dataset_preprocessed = dataset
        
    # Perform normalization
    dataset_preprocessed = normalization(dataset_preprocessed)
    
    return dataset_preprocessed

def one_hot_encoding(y_data, depth):
    return np.eye(depth)[y_data]


# In[18]:


print('Preprocessing train and test datasets...')
X_train_preprocessed = preprocess_set(X_train)
X_test_preprocessed = preprocess_set(X_test)

y_train_preprocessed = one_hot_encoding(y_train, depth = n_classes)
y_test_preprocessed = one_hot_encoding(y_test, depth = n_classes)
print('Done')


# ### Dataset splitting

# In[19]:


### Dataset splitting
validation_size = 0.1
X_train_final, X_dev_final, y_train_final, y_dev_final = sklearn.model_selection.train_test_split(X_train_preprocessed, y_train_preprocessed, random_state=918273645)

# Plot a few images to see if they look good
print('Training set')
plt.figure()
for i in range(4):
    plt.subplot(2, 2, i + 1);
    plt.imshow(np.squeeze(X_train_final[i, :, :, :]), cmap='gray');
    plt.axis('off');

print('Validation set')
plt.figure();
for i in range(4):
    plt.subplot(2, 2, i + 1);
    plt.imshow(np.squeeze(X_dev_final[i, :, :, :]), cmap='gray');
    plt.axis('off');


# ---
# ## 2.1. Network architecture

# In[20]:


### Define your architecture here.
### Feel free to use as many code cells as needed.


# ### 2.1.1 Helper functions

# In[21]:


### Helper functions
def create_weights(shape):
    return tf.Variable(tf.truncated_normal(shape, stddev=0.05))    
    
def create_biases(shape):    
    return tf.Variable(tf.zeros(shape) + 0.05)

def flatten_layer(layer):
    # Shape is [batch_size, img_h, img_w, img_depth]    
    layer_shape = layer.get_shape()
    
    # Number of features per image
    num_features = layer_shape[1:4].num_elements()
    
    # Must reshape into [batch_size, n_features]. Since the batch_size is unknown
    # we type -1 so tf will figure it out itself
    return tf.reshape(layer, [-1, num_features])


# ### 2.1.2 Convolutional layer
# 
# This function creates a convolutional layer, taking as input a 4D tensor of shape [batch_size, width, height, depth]. The parameters are the filter size, number of filters, and options to include a Max Pooling layer, ReLU and Dropout.

# In[22]:


def create_conv_layer(input_layer,               # 4D tensor
                      filter_size,               # scalar
                      n_filters,                 # scalar
                      use_pooling=True,          # boolean
                      use_relu=True,             # boolean
                      dropout_keep_prob=None     # tensor variable
                     ):    
    # Review https://www.tensorflow.org/versions/r0.11/api_docs/python/nn.html#conv2d
    # for conventions about input shapes

    # Create weights (4D tensor) and biases (1D vector)
    input_depth = int(input_layer.get_shape()[3])
    weight_shape = [filter_size, filter_size, input_depth, n_filters]
    bias_shape = [n_filters]
    
    weights = create_weights(weight_shape)
    biases = create_biases(bias_shape)
    
    # Convolution
    layer = tf.nn.conv2d(input=input_layer, 
                         filter=weights,
                         strides=[1,1,1,1], 
                         padding='SAME')
    # Add bias
    layer = tf.nn.bias_add(layer, biases)
    
    # Max pooling
    if use_pooling:
        layer = tf.nn.max_pool(value=layer,
                               ksize=[1,2,2,1],
                               strides=[1,2,2,1],
                               padding='SAME')
    
    # ReLU. Should be applied before pooling. However the result is the same and in this
    # case we perform fewer computations, since there are fewer pixels
    if use_relu:
        layer = tf.nn.relu(layer)
    
    # Dropout
    if dropout_keep_prob is not None:
        layer = tf.nn.dropout(layer, dropout_keep_prob)
    
    return layer


# ### 2.1.3 Fully-connected layer
# This function creates a fully connected layer, taking as input a 2D matrix of shape [batch_size, n_features] and having a number of outputs as a parameter. It also includes an optional boolean argument to include ReLU and dropout.

# In[23]:


def create_fc_layer(input_layer,               # 2D matrix [batch_size, n_inputs]
                    n_outputs,                 # scalar
                    use_relu=True,             # scalar
                    dropout_keep_prob=None     # tensor variable
                   ):        

    n_inputs = int(input_layer.get_shape()[1])
    weights = create_weights([n_inputs, n_outputs])
    biases = create_biases([n_outputs])
    
    # XW + b
    layer = tf.matmul(input_layer, weights)
    layer = tf.nn.bias_add(layer, biases)
    
    # ReLU
    if use_relu:
        layer = tf.nn.relu(layer)
    
    # Dropout
    if dropout_keep_prob is not None:
        layer = tf.nn.dropout(layer, dropout_keep_prob)
    
    return layer   


# ### 2.1.4 Network parameter design
# In the following code cell, we define the sizes of the layers of the convolutional neural network.

# In[24]:


### Network parameters
# Input
img_size_w = X_train_final.shape[1]
img_size_h = X_train_final.shape[2]
img_size_d = X_train_final.shape[3]
img_size_total = img_size_w * img_size_h * img_size_d

# Conv layer 1
conv1_filter_size = 5
conv1_n_filters = 16

# Conv layer 2
conv2_filter_size = 5
conv2_n_filters = 32

# Conv layer 3
conv3_filter_size = 5
conv3_n_filters = 64

# Fully Connected 1
fc1_n_neurons = 512

# Fully Connected 2
fc2_n_neurons = n_classes


# ### 2.1.5 Placeholder variables
# This code cell contains placeholder variables, i.e. variables that we feed with data inside the TensorFlow session.

# In[25]:


### Placeholder variables
# Input: batch of images - 4D tensor [batch_size, img_h, img_w, img_d]
x = tf.placeholder(tf.float32, shape=[None, img_size_h, img_size_w, img_size_d])

# Output: true class - 2D matrix, one-hot encoded value [batch_size, n_classes]
y_true = tf.placeholder(tf.float32, shape=[None, n_classes])

# True class (not hot encoded) vector [batch_size]
y_true_class = tf.argmax(y_true, dimension=1)

# Dropout keep probability
dropout_keep_p = tf.placeholder(tf.float32)

print('x = ', x)
print('y_true = ', y_true)


# ### 2.1.6 Network implementation
# After implementing some helper functions and designing the network, now we include code cells that actually implement each one of the layers of the convolutional neural network.

# In[26]:


### Network architecture
# First Layer: Conv + ReLU + Max pool
conv1 = create_conv_layer(input_layer=x,
                          filter_size=conv1_filter_size,
                          n_filters=conv1_n_filters,
                          use_pooling=True,
                          use_relu=True,
                          dropout_keep_prob=dropout_keep_p)
print("Layer 1 = ", conv1)


# In[27]:


# Second Layer: Conv + ReLU + Max pool
conv2 = create_conv_layer(input_layer=conv1,
                          filter_size=conv2_filter_size,
                          n_filters=conv2_n_filters,
                          use_pooling=True,
                          use_relu=True,
                          dropout_keep_prob=dropout_keep_p)
print("Layer 2 = ", conv2)


# In[28]:


# Third Layer: Conv + ReLU + Max pool
conv3 = create_conv_layer(input_layer=conv2,
                          filter_size=conv3_filter_size,
                          n_filters=conv3_n_filters,
                          use_pooling=True,
                          use_relu=True,
                          dropout_keep_prob=dropout_keep_p)
print("Layer 3 = ", conv3)


# In[29]:


# Fourth Layer: Fully Connected + ReLU
flattened_conv3 = flatten_layer(conv3)
print(flattened_conv3)
fc1 = create_fc_layer(input_layer=flattened_conv3,
                      n_outputs=fc1_n_neurons,
                      use_relu=True,
                      dropout_keep_prob=dropout_keep_p)
print("FC 1 = ", fc1)


# In[30]:


# Fifth Layer: Fully Connected
# NOTE: ReLU is not used, since the output will go directly to the Softmax function
fc2 = create_fc_layer(input_layer=fc1,
                      n_outputs=fc2_n_neurons,
                      use_relu=False,
                      dropout_keep_prob=None)
print("FC 2 = ", fc2)


# In[31]:


# Softmax
y_predicted = tf.nn.softmax(fc2)
y_predicted_class = tf.argmax(y_predicted, dimension=1)
print(y_predicted)


# In[32]:


### Optimization
cross_entropy = tf.nn.softmax_cross_entropy_with_logits(logits=fc2,
                                                        labels=y_true)
cost = tf.reduce_mean(cross_entropy)

learning_rate = 0.0001
optimizer = tf.train.AdamOptimizer(learning_rate).minimize(cost)


# ### 2.1.7 Performance evaluation
# Finally, we define the computations required in order to obtain the training, validation and test accuracy, with which we can evaluate the performance of the proposed network.

# In[33]:


### Performance evaluation
# Check if the predicted class is equal to the true class
is_correct_prediction = tf.equal(y_predicted_class, y_true_class)

# Compute the accuracy by averaging out the previous variable
accuracy = 100.0 * tf.reduce_mean(tf.cast(is_correct_prediction, tf.float32))


# ---
# ## 2.2 Network training

# In[34]:


### Train your model here.
### Feel free to use as many code cells as needed.


# In[35]:


# Training paramters
n_epochs = 200
train_batch_size = 128
test_batch_size = 128

n_batches = int(np.floor(X_train_final.shape[0] / train_batch_size))

print ("Training the network for %d epochs." % n_epochs)
print ("The batch size is %d, and there are %d training examples, so we use %d batches per epoch" % (train_batch_size, X_train_final.shape[0], n_batches))


# In[36]:


# Helper function to get a batch from a dataset
def get_batch(x, y, batch_size, batch_idx):
    max_size = x.shape[0]
    start_idx = batch_idx * batch_size

    x_batch = x[start_idx : np.minimum(start_idx + batch_size, max_size), :, :, :]
    y_batch = y[start_idx : np.minimum(start_idx + batch_size, max_size), :]
    
    return (x_batch, y_batch)


# In[37]:


def get_test_accuracy(x_data, y_data, batch_size):
    n_batches = int(np.ceil(x_data.shape[0] / batch_size))
    accuracies = np.zeros([n_batches])

    for i in range(n_batches):
         # Get batch
        batch_x, batch_y = get_batch(x_data, y_data, batch_size, i)
        
        # Create feed dictionary
        feed_data = {x: batch_x, y_true: batch_y, dropout_keep_p: 1.0}

        # Feed it to the network and update the weights
        accuracies[i] = sess.run(accuracy, feed_dict=feed_data)
       
    return np.mean(accuracies)


# In[38]:


# Create TensorFlow session
sess = tf.Session()


# In[39]:


# Train network
training_accuracy = []
validation_accuracy = []

desired_validation_acc = 99.5  # %

if network_model_dir is None:
    # Initialize variables
    sess.run(tf.initialize_all_variables())

    shuffle_idx = np.arange(0, X_train_final.shape[0])

    for i_epoch in range(n_epochs):
        # Shuffle training data
        np.random.shuffle(shuffle_idx)   
        X_train_final = X_train_final[shuffle_idx]
        y_train_final = y_train_final[shuffle_idx]

        # Loop through batches
        for i_batch in range(n_batches):
            # Get batch
            batch_x_train, batch_y_train = get_batch(X_train_final, y_train_final, train_batch_size, i_batch)

            # Create feed dictionary
            feed_data_train = {x: batch_x_train, y_true: batch_y_train, dropout_keep_p: 0.5}

            # Feed it to the network and update the weights
            sess.run(optimizer, feed_dict=feed_data_train)       

        # Compute the training and validation accuracy for each epoch
        feed_data_train_acc = {x: batch_x_train, y_true: batch_y_train, dropout_keep_p: 1.0}    
        training_acc_i = sess.run(accuracy, feed_data_train_acc)

        validation_acc_i = get_test_accuracy(X_dev_final, y_dev_final, test_batch_size)

        training_accuracy.append(training_acc_i )
        validation_accuracy.append(validation_acc_i)
        print('Epoch %3d - training acc: %3.1f%%, validation acc: %3.1f%%'
              % (i_epoch, training_acc_i, validation_acc_i))

        # Exit if conditions met
        if validation_acc_i > desired_validation_acc:
            print('Reached validation accuracy of %3.1f%%! Finished training...'
                  % (validation_acc_i))
            break


# It can be observed that the training accuracy is smaller than the validation accuracy. It even reached 100% a few times and then went down.
# 
# It's important to notice that this training accuracy is **not** as reliable as the validation accuracy, since it's only considering the error over a mini-batch (128 examples), whereas the validation accuracy uses the whole validation set (more than 40000 examples).
# 
# We only provide the training accuracy for completeness, but we train the network evaluating only the validation accuracy.

# ### 2.3 Saving network parameters

# In[40]:


if network_model_dir is None:
    # Same the network parameters
    saver = tf.train.Saver()
    model_dir = os.path.join('model', time.strftime("%Y%m%d_%H%M%S"))
    if not os.path.isdir(model_dir):
        os.mkdir(model_dir)
    save_path = os.path.join(model_dir, 'model.ckpt')
    saver.save(sess, save_path);
    
    # Save metainfo about the training
    training_curve_file = os.path.join(model_dir, 'training_info.pickle')
    with open(training_curve_file, mode='wb') as f:
        pickle.dump({'training_acc': training_accuracy, 'validation_acc': validation_accuracy}, f)


# ### 2.4 Restoring network parameters

# In[41]:


if network_model_dir is not None:
    saver = tf.train.Saver()
    saver.restore(sess, os.path.join(network_model_dir, 'model.ckpt'))
                  
    training_info_file = os.path.join(network_model_dir, 'training_info.pickle')
    with open(training_info_file, 'rb') as f:
        d = pickle.load(f)
        
        training_accuracy = d['training_acc']
        validation_accuracy = d['validation_acc']


# ### 2.5 Displaying trainining information

# In[42]:


# Plot training and validation accuracy, and print the final value
iteration_vector = range(len(training_accuracy))

plt.subplot(121)
plt.plot(iteration_vector, np.array(training_accuracy));
plt.title('Training accuracy');

plt.subplot(122)
plt.plot(iteration_vector, np.array(validation_accuracy));
plt.title('Validation accuracy');

final_train_acc = training_accuracy[-1]
final_val_acc = validation_accuracy[-1]
   
print("Training accuracy: %.1f%%" % final_train_acc)
print('Validation accuracy: %.1f%%' % final_val_acc)      


# Again, we observe that the training accuracy graph is very shaky and not monotonically increasing, compared to the validation graph. This is because the training accuracy is measured only over a mini-batch of 128 examples for each epoch, whereas the validation accuracy uses the whole validation set.
# 
# We can see that the learning process was very successful, reaching 99.5% accuracy in the validation set, which was never used for training.

# ### 2.6 Network evaluation on Test set

# In[43]:


print('Test accuracy: %.1f%%' % get_test_accuracy(X_test_preprocessed, y_test_preprocessed, test_batch_size))


# ---
# 
# ## Step 3: Test a Model on New Images
# 
# Take several pictures of traffic signs that you find on the web or around you (at least five), and run them through your classifier on your computer to produce example results. The classifier might not recognize some local signs but it could prove interesting nonetheless.
# 
# You may find `signnames.csv` useful as it contains mappings from the class id (integer) to the actual sign name.

# ### Implementation
# 
# Use the code cell (or multiple code cells, if necessary) to implement the first step of your project. Once you have completed your implementation and are satisfied with the results, be sure to thoroughly answer the questions that follow.

# In[44]:


### Load the images and plot them here.
### Feel free to use as many code cells as needed.


# In[45]:


# Helper functions to process the input images
def load_img(img_path):
    img = cv2.imread(img_path)
    return cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

def crop_img(img, crop_info):
    crop_x1 = crop_info[0]
    crop_y1 = crop_info[1]
    crop_size = crop_info[2]
    
    return img[crop_y1:crop_y1 + crop_size, crop_x1:crop_x1 +  crop_size, :]
    
def resize_img(img, new_size):
    return cv2.resize(img, new_size)


# In[46]:


# Read CSV containing: image path, crop_x, crop_y, class
test_img_csv = 'test_img/test_img.csv'

n_tests = 10
X_test_own = np.zeros([n_tests, img_size_h, img_size_w, 3], dtype=np.float32)
y_test_own_labels = np.zeros([n_tests], dtype=int)

resize_size = (img_size_h, img_size_w)

with open(test_img_csv, 'r') as csvfile:
    i_img = 0
    reader = csv.reader(csvfile, delimiter=',')    
    for row in reader:
        # Read information from CSV file
        filename = row[0]
        crop_info = np.array(row[1:4], dtype=int)
        img_class = row[4]
        
        # Update test set
        img = load_img(filename)
        img = crop_img(img, crop_info)
        img = resize_img(img, resize_size)
        
        X_test_own[i_img, :, :, :] = img
        y_test_own_labels[i_img] = labels_text.index(img_class);
        
        # Plot image
        plt.subplot(2, 5, i_img+1)
        plt.imshow(img);
        plt.title(img_class);
        plt.axis('off')
        i_img = i_img + 1

# Preprocessing
X_test_own = preprocess_set(X_test_own)
y_test_own = one_hot_encoding(y_test_own_labels, n_classes)


# In[47]:


### Run the predictions here.
### Feel free to use as many code cells as needed.


# In[48]:


# Prediction
y_pred_own_class = sess.run(y_predicted_class, feed_dict={x: X_test_own, dropout_keep_p: 1.0})

for i in y_pred_own_class.astype(int):
    print(labels_text[i])


# In[49]:


### Visualize the softmax probabilities here.
### Feel free to use as many code cells as needed.
top_k_classes = 5
y_pred_own_top_k_prob = tf.nn.top_k(y_predicted, top_k_classes);

y_pred_own_prob, y_pred_own_idx = sess.run(y_pred_own_top_k_prob, feed_dict={x: X_test_own, dropout_keep_p: 1.0})

for i in range(X_test_own.shape[0]):
    plt.figure();
    plt.imshow(np.squeeze(X_test_own[i, :, :, :]), cmap='gray')
    text = ''
    for j in range(top_k_classes):
        text += labels_text[y_pred_own_idx[i, j]] + ' - %.1f%%' % (100.0 * y_pred_own_prob[i,j]) + '\n'
    plt.xlabel(text);    


# > **Note**: Once you have completed all of the code implementations and successfully answered each question above, you may finalize your work by exporting the iPython Notebook as an HTML document. You can do this by using the menu above and navigating to  \n",
#     "**File -> Download as -> HTML (.html)**. Include the finished document along with this notebook as your submission.
