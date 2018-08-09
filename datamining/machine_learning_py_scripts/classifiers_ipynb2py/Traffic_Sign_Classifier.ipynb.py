
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

# In[28]:


# Load pickled data
import pickle

#paths
training_file = "data/train.p"
validation_file= "data/valid.p"
testing_file = "data/test.p"

with open(training_file, mode='rb') as f:
    train = pickle.load(f)
with open(validation_file, mode='rb') as f:
    valid = pickle.load(f)
with open(testing_file, mode='rb') as f:
    test = pickle.load(f)

#Set Train, Validation and Test Data
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

# In[29]:


import pandas as pd
import numpy as np

#read signnames file with pandas
signnames = pd.read_csv("data/signnames.csv")
signnames.head(10)


# In[30]:


#Number of training examples
n_train = len(X_train)

#Number of validation examples
n_validation = len(X_valid)

#Number of testing examples.
n_test = len(X_test)

#The shape of an traffic sign image
image_shape = X_train.shape[1:3]

#How many unique classes/labels there are in the dataset.
n_classes = len(signnames)

print("Number of training examples =", n_train)
print("Number of testing examples =", n_test)
print("Image data shape =", image_shape)
print("Number of classes =", n_classes)


# ### Include an exploratory visualization of the dataset

# Visualize the German Traffic Signs Dataset using the pickled file(s). This is open ended, suggestions include: plotting traffic sign images, plotting the count of each sign, etc. 
# 
# The [Matplotlib](http://matplotlib.org/) [examples](http://matplotlib.org/examples/index.html) and [gallery](http://matplotlib.org/gallery.html) pages are a great resource for doing visualizations in Python.
# 
# **NOTE:** It's recommended you start with something simple first. If you wish to do more, come back to it after you've completed the rest of the sections. It can be interesting to look at the distribution of classes in the training, validation and test set. Is the distribution the same? Are there more examples of some classes than others?

# In[31]:


#import matplotlib for visualizations
import matplotlib.pyplot as plt
# Visualizations will be shown in the notebook.
get_ipython().run_line_magic('matplotlib', 'inline')


# ## Printing a Random Example

# In[34]:


#Set a random index
index = np.random.randint(0, len(X_train))

#Visualizing a random image
image = X_train[index].squeeze()

plt.figure(figsize=(8,8))
plt.imshow(image)

#Print Label
print(signnames.iloc[y_train[index], 1])


# ### Printing a Example for Each Class
# 
# Scaning Labeled data looking for indices and using that grabed indices to print a example from train data.

# In[35]:


#Printing a example for each class
fig = plt.figure(figsize=(20,50))
for i in range(n_classes):
    #grab indice
    k = np.where(y_train==i)
    #using indice
    img = X_train[k[0][0]]
    ax = fig.add_subplot(int(n_classes/4)+1,4,i+1) 
    ax.imshow(img, interpolation='none')
    ax.set_title(signnames.iloc[y_train[k[0][0]], 1], fontsize=15)
plt.show()


# ### Label Distribution in Training Data
# 
# Plot total number of examples for each class

# In[7]:


#turn y_train in a dataframe to make visualizations
y_train_df = pd.DataFrame(y_train)


# In[8]:


#Plot total number of examples for each class
plot = y_train_df.iloc[:, 0].value_counts().plot(kind='barh', figsize = (10,10), title='Samples per Class');
plot.set_yticklabels(list(map(lambda x: signnames.iloc[x, 1], y_train_df.iloc[:, 0].value_counts().index.tolist()))) ;


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
# Here is an example of a [published baseline model on this problem](http://yann.lecun.com/exdb/publis/pdf/sermanet-ijcnn-11.pdf). 

# ### Pre-process the Data Set

# Minimally, the image data should be normalized so that the data has mean zero and equal variance. For image data, `(pixel - 128)/ 128` is a quick way to approximately normalize the data and will be used in this project. 

# ### Shuffle Data

# In[9]:


#import shuffle from scikit learn
from sklearn.utils import shuffle

#using shuffle
X_train, y_train = shuffle(X_train, y_train)


# ### Normalizing Data

# In[10]:


#defining a function
def normalize(data):
    #Normalize each image
    return ((data-128.)/128)

#applying function to train and valid data 
X_train = normalize(X_train)
X_valid = normalize(X_valid)


# ### Model Architecture

# To classify German Traffic Signs we'll use LeNet Architecture, developed for [Yann LeCun](http://yann.lecun.com/exdb/publis/index.html)

# In[11]:


#importing tensorflow
import tensorflow as tf
from tensorflow.contrib.layers import flatten


# In[12]:


#Set parameters

EPOCHS = 100
BATCH_SIZE = 128


# In[13]:


def LeNet(x):    
    # Arguments used for tf.truncated_normal, randomly defines variables for the weights and biases for each layer
    mu = 0
    sigma = 0.1
    
    # Layer 1: Convolutional. Input = 32x32x3. Output = 28x28x6.
    conv1_W = tf.Variable(tf.truncated_normal(shape=(5, 5, 3, 6), mean = mu, stddev = sigma))
    conv1_b = tf.Variable(tf.zeros(6))
    conv1   = tf.nn.conv2d(x, conv1_W, strides=[1, 1, 1, 1], padding='VALID') + conv1_b

    # Activation.
    conv1 = tf.nn.relu(conv1)

    # Pooling. Input = 28x28x6. Output = 14x14x6.
    conv1 = tf.nn.max_pool(conv1, ksize=[1, 2, 2, 1], strides=[1, 2, 2, 1], padding='VALID')

    # Layer 2: Convolutional. Output = 10x10x16.
    conv2_W = tf.Variable(tf.truncated_normal(shape=(5, 5, 6, 16), mean = mu, stddev = sigma))
    conv2_b = tf.Variable(tf.zeros(16))
    conv2   = tf.nn.conv2d(conv1, conv2_W, strides=[1, 1, 1, 1], padding='VALID') + conv2_b
    
    # Activation.
    conv2 = tf.nn.relu(conv2)

    # Pooling. Input = 10x10x16. Output = 5x5x16.
    conv2 = tf.nn.max_pool(conv2, ksize=[1, 2, 2, 1], strides=[1, 2, 2, 1], padding='VALID')

    # Flatten. Input = 5x5x16. Output = 400.
    fc0   = flatten(conv2)
    
    # Layer 3: Fully Connected. Input = 400. Output = 120.
    fc1_W = tf.Variable(tf.truncated_normal(shape=(400, 120), mean = mu, stddev = sigma))
    fc1_b = tf.Variable(tf.zeros(120))
    fc1   = tf.matmul(fc0, fc1_W) + fc1_b
    
    # Activation.
    fc1    = tf.nn.relu(fc1)

    # Layer 4: Fully Connected. Input = 120. Output = 84.
    fc2_W  = tf.Variable(tf.truncated_normal(shape=(120, 84), mean = mu, stddev = sigma))
    fc2_b  = tf.Variable(tf.zeros(84))
    fc2    = tf.matmul(fc1, fc2_W) + fc2_b
    
    # Activation.
    fc2    = tf.nn.relu(fc2)

    # Layer 5: Fully Connected. Input = 84. Output = 43.
    fc3_W  = tf.Variable(tf.truncated_normal(shape=(84, 43), mean = mu, stddev = sigma))
    fc3_b  = tf.Variable(tf.zeros(43))
    logits = tf.matmul(fc2, fc3_W) + fc3_b
    
    return logits


# ### Train, Validate and Test the Model

# A validation set can be used to assess how well the model is performing. A low accuracy on the training and validation
# sets imply underfitting. A high accuracy on the training set but low accuracy on the validation set implies overfitting.

# In[14]:


#Setting place holders and one hot
x = tf.placeholder(tf.float32, (None, 32, 32, 3))
y = tf.placeholder(tf.int32, (None))
one_hot_y = tf.one_hot(y, 43)


# In[15]:


#Setting training parameters
rate = 0.001

logits = LeNet(x)
cross_entropy = tf.nn.softmax_cross_entropy_with_logits(labels=one_hot_y, logits=logits)
loss_operation = tf.reduce_mean(cross_entropy)
optimizer = tf.train.AdamOptimizer(learning_rate = rate)
training_operation = optimizer.minimize(loss_operation)


# In[16]:


#Setting a evaluate method using evaluate function
correct_prediction = tf.equal(tf.argmax(logits, 1), tf.argmax(one_hot_y, 1))
accuracy_operation = tf.reduce_mean(tf.cast(correct_prediction, tf.float32))
saver = tf.train.Saver()

def evaluate(X_data, y_data):
    num_examples = len(X_data)
    total_accuracy = 0
    sess = tf.get_default_session()
    for offset in range(0, num_examples, BATCH_SIZE):
        batch_x, batch_y = X_data[offset:offset+BATCH_SIZE], y_data[offset:offset+BATCH_SIZE]
        accuracy = sess.run(accuracy_operation, feed_dict={x: batch_x, y: batch_y})
        total_accuracy += (accuracy * len(batch_x))
    return total_accuracy / num_examples


# In[35]:


# training model
with tf.Session() as sess:
    sess.run(tf.global_variables_initializer())
    num_examples = len(X_train)
    
    print("Training...")
    print()
    for i in range(EPOCHS):
        X_train, y_train = shuffle(X_train, y_train)
        for offset in range(0, num_examples, BATCH_SIZE):
            end = offset + BATCH_SIZE
            batch_x, batch_y = X_train[offset:end], y_train[offset:end]
            sess.run(training_operation, feed_dict={x: batch_x, y: batch_y})
            
        validation_accuracy = evaluate(X_valid, y_valid)
        print("EPOCH {} ...".format(i+1))
        print("Validation Accuracy = {:.3f}".format(validation_accuracy))
        print()
        
    saver.save(sess, './lenet')
    print("Model saved")


# #### Validation Accuracy = 0.942

# In[17]:


with tf.Session() as sess:
    saver.restore(sess, tf.train.latest_checkpoint('.'))

    test_accuracy = evaluate(X_test, y_test)
    print("Test Accuracy = {:.3f}".format(test_accuracy))


# ---
# 
# ## Step 3: Test a Model on New Images
# 
# To give yourself more insight into how your model is working, download at least five pictures of German traffic signs from the web and use your model to predict the traffic sign type.
# 
# You may find `signnames.csv` useful as it contains mappings from the class id (integer) to the actual sign name.

# ### Load and Output the Images

# Images from Google's Search

# In[27]:


import os
import matplotlib.image as mpimg

fig = plt.figure(figsize=(32,32), tight_layout={'h_pad':4})
i = 0
for file in os.listdir('images'):
    if '.jpg' in file:
        ax = fig.add_subplot(10,4,i+1) 
        img = mpimg.imread('images/' + file)
        ax.imshow(img)
        i+=1
plt.show()


# ### Predict the Sign Type for Each Image

# #### Resizing Images
# 
# Our model expect 32 by 32 pixels images, so we must to resize images. We'll use [Python Imaging Library](http://www.pythonware.com/products/pil/) to do this. 

# In[19]:


#import and use PIL library 
from PIL import Image

fig = plt.figure(figsize=(32,32))
i = 0
for file in os.listdir('images'):
    outfile = os.path.splitext(file)[0] + ".jpg"
    if '.jpg' in file:
        img = Image.open('images/' + file)
        #resize images
        img.thumbnail((32, 32), Image.ANTIALIAS)
        half_the_width = img.size[0] / 2
        half_the_height = img.size[1] / 2
        img = img.crop((
        half_the_width - 16,
        half_the_height - 16,
        half_the_width + 16,
        half_the_height + 16))
        ax = fig.add_subplot(10,4,i+1) 
        img.save("images/32by32/"+outfile, "JPEG")
        ax.imshow(img)
        i+=1
plt.show()


# ### Testing Model with Random Image from provided Test Data

# In[21]:


#set a random index
index = np.random.randint(0, len(X_test))
image = X_test[index].squeeze()
#Normalize and reshape image from 32x32x3 to 1x32x32x3
image_reshaped = normalize(image).reshape(1, 32,32,3)

#open a tensorflow session
with tf.Session() as sess:
    #retore previously session
    saver.restore(sess, tf.train.latest_checkpoint('.'))
    
    sess = tf.get_default_session()
    #feed, run and get result
    logit = sess.run(tf.argmax(logits, 1), feed_dict={x: image_reshaped})

plt.figure(figsize=(8,8))
plt.imshow(image, cmap="gray")
#print predicted and true label
print("True:", signnames.iloc[y_test[index], 1])
print("Predited:", signnames.iloc[logit[0], 1])
if signnames.iloc[y_test[index], 1] == signnames.iloc[logit[0], 1]:
    print("Right !")


# ### Testing Model with New Images
# 
# Images from Google's Search

# In[25]:


fig = plt.figure(figsize=(32,32))
i = 0
for file in os.listdir('images/32by32/'):
    if '.jpg' in file:
        img = Image.open('images/32by32/' + file)
        ax = fig.add_subplot(10,3,i+1) 
        fig.subplots_adjust(hspace=0.5)
        #img = mpimg.imread('Data/' + file)
        ax.imshow(Image.open('images/' + file))
        image = np.array((np.array(img)-128.)/128).reshape(1, 32,32,3)
        
        with tf.Session() as sess:
            saver.restore(sess, tf.train.latest_checkpoint('.'))
    
            sess = tf.get_default_session()
            logit = sess.run(tf.argmax(logits, 1), feed_dict={x: image})
        ax.set_title(signnames.iloc[logit[0], 1], fontsize=20)
        i+=1
plt.show()


# ### Analyze Performance

# In[59]:


#predicted right
right = 17
#total
total = 23

Accuracy = right/total
print("Accuracy: ", Accuracy)


# ### Output Top 5 Softmax Probabilities For Each Image Found on the Web

# For each of the new images, print out the model's softmax probabilities to show the **certainty** of the model's predictions (limit the output to the top 5 probabilities for each image). [`tf.nn.top_k`](https://www.tensorflow.org/versions/r0.12/api_docs/python/nn.html#top_k) could prove helpful here. 
# 
# The example below demonstrates how tf.nn.top_k can be used to find the top k predictions for each image.
# 
# `tf.nn.top_k` will return the values and indices (class ids) of the top k predictions. So if k=3, for each sign, it'll return the 3 largest probabilities (out of a possible 43) and the correspoding class ids.
# 
# Take this numpy array as an example. The values in the array represent predictions. The array contains softmax probabilities for five candidate images with six possible classes. `tk.nn.top_k` is used to choose the three classes with the highest probability:
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

# ### Visualizing Top 5 Softmax Probabilities For Each Image
# 
# The following code will feed our neural network with all images in selected folder, then will grab Top 5 Softmax Probabilities For Each Image and print it.
# 
# <figure>
#  <img src="softmax.jpg" width="380" alt="Combined Image" />
#  <figcaption>
#  <p></p> 
#  <p style="text-align: center;"> Example output of following code</p> 
#  </figcaption>
# </figure>
#  <p></p> 
#  
#                            Class  |         Label          |   Probability (%)
#                            ----------------------------------------------------------------------------
#                              1    | Speed limit (30km/h)   |    100
#                              2    | Speed limit (50km/h)   |    0.000000000000000222
#                              5    | Speed limit (80km/h)   |    0.0000000000000000619
#                              3    | Speed limit (60km/h)   |    0.00000000000000000000000824
#                              7    | Speed limit (100km/h)  |    0.0000000000000000000000000000000137

# In[61]:


fig = plt.figure(figsize=(15,70))
i = 0

#loop for each image in folder
for file in os.listdir('data/32by32/'):
    if '.jpg' in file:
        img = Image.open('data/32by32/' + file)
        ax = fig.add_subplot(20,2,i+1) 
        fig.subplots_adjust(hspace=0.5)
        ax.imshow(Image.open('data/32by32/' + file))
        image = np.array((np.array(img)-128.)/128).reshape(1, 32,32,3)
        
        #open session 
        with tf.Session() as sess:
            #restore previously session
            saver.restore(sess, tf.train.latest_checkpoint('.'))
            
            sess = tf.get_default_session()
            #feed, run and get result
            logit = sess.run(tf.argmax(logits, 1), feed_dict={x: image})
            #softmax
            out = sess.run(tf.nn.softmax(logits), feed_dict={x: image})
            # Top 5 Softmax Probabilities For Each Image
            probabilities = sess.run(tf.nn.top_k(out, 5))
            
        #Visualizing results for each image in folder    
        ax.set_title(signnames.iloc[logit[0], 1], fontsize=15)
        ax.text(40,3,probabilities.indices[0,0], fontsize=15)
        ax.text(40,8,probabilities.indices[0,1], fontsize=15)
        ax.text(40,13,probabilities.indices[0,2], fontsize=15)
        ax.text(40,18,probabilities.indices[0,3], fontsize=15)
        ax.text(40,23,probabilities.indices[0,4], fontsize=15)
        ax.text(50,3,probabilities.values[0, 0], fontsize=15)
        ax.text(50,8,probabilities.values[0, 1], fontsize=15)
        ax.text(50,13,probabilities.values[0, 2], fontsize=15)
        ax.text(50,18,probabilities.values[0, 3], fontsize=15)
        ax.text(50,23,probabilities.values[0, 4], fontsize=15)
        i+=1
plt.show()


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

# In[28]:


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
        plt.subplot(6,8, featuremap+1) # sets the number of feature maps to show on each row and column
        plt.title('FeatureMap ' + str(featuremap)) # displays the feature map number
        if activation_min != -1 & activation_max != -1:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", vmin =activation_min, vmax=activation_max, cmap="gray")
        elif activation_max != -1:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", vmax=activation_max, cmap="gray")
        elif activation_min !=-1:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", vmin=activation_min, cmap="gray")
        else:
            plt.imshow(activation[0,:,:, featuremap], interpolation="nearest", cmap="gray")

