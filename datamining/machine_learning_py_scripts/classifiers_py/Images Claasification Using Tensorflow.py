# -*- coding: utf-8 -*-
"""
Created on Thu Jul 12 01:04:55 2018

@author: Panu
"""

#import theano
import tensorflow as tf
from tensorflow import keras
#import keras
import matplotlib.pyplot as plt
import numpy as np
print(tf.__version__)

'''Import the Fashion MNIST dataset'''
fashion_mnist = keras.datasets.fashion_mnist
(train_images, train_labels),(test_images, test_labels) = fashion_mnist.load_data()

'''Crating Labels names'''

class_names = ['T-shirt/top', 'Trouser', 'Pullover', 'Dress', 'Coat', 
               'Sandal', 'Shirt', 'Sneaker', 'Bag', 'Ankle boot']

'''Explore the data'''

train_images.shape

'''Len'''
len(train_labels)
#Each label is an integer between 0 and 9:
train_labels


#There are 10,000 images in the test set. Again, each image is represented as 28 x 28 pixels:

test_images.shape

#And the test set contains 10,000 images labels:

len(test_labels)

'''Preprocess the data:-
The data must be preprocessed before training the network. If you inspect the first image in the 
training set, you will see that the pixel values fall in the range of 0 to 255:'''

plt.figure()
plt.imshow(train_images[0])
plt.colorbar()
plt.gca().grid(False)

'''We will scale these values to a range of 0 to 1 before feeding to the neural 
network model. 
For this, cast the datatype of the image components from and integer to a float, 
and divide by 255. Here's the function to preprocess the images:'''

#It's important that the training set and the testing set are preprocessed in the same way:

train_images = train_images / 255.0
test_images = test_images / 255.0

'''Display the first 25 images from the training set and display the class name below each image. 
Verify that the data is in the correct format and we're ready to build and train the network.'''

plt.figure(figsize=(10,10))
for i in range(25):
    plt.subplot(5,5,i+1)
    plt.xticks([])
    plt.yticks([])
    plt.grid('off')
    plt.imshow(train_images[i], cmap=plt.cm.binary)
    plt.xlabel(class_names[train_labels[i]])
    
    
'''Build the model'''

#Building the neural network requires configuring the layers of the model, then compiling the model.

model = keras.Sequential([
        keras.layers.Flatten(input_shape=(28,28)),
        keras.layers.Dense(128, activation = tf.nn.relu),
        keras.layers.Dense(10, activation=tf.nn.softmax),
        ])
    

'''Compile the model'''

model.compile(optimizer=tf.train.AdamOptimizer(), 
              loss='sparse_categorical_crossentropy',
              metrics=['accuracy'])

'''Train the model'''
#Feed the training data to the model—in this example, the train_images and train_labels arrays.
#To start training, call the model.fit method—the model is "fit" to the training data:

model.fit(train_images, train_labels, epochs = 5)

#As the model trains, the loss and accuracy metrics are displayed. This model reaches an accuracy 
#of about 0.88 (or 88%) on the training data.

'''Evaluate accuracy'''

#Next, compare how the model performs on the test dataset:

test_loss, test_acc = model.evaluate(test_images,test_labels)
print('Test Accuracy:', test_acc)

'''It turns out, the accuracy on the test dataset is a little 
less than the accuracy on the training dataset. This gap between training 
accuracy and test accuracy is an example of overfitting. 
Overfitting is when a machine learning model performs worse on new data than on their training data.'''
#....


'''Make predictions'''

#With the model trained, we can use it to make predictions about some images.s

predictions = model.predict(test_images)

#Here, the model has predicted the label for each image in the testing set. Let's 
#take a look at the first prediction:

predictions[0]

#A prediction is an array of 10 numbers. 
#These describe the "confidence" of the model that the image corresponds 
#to each of the 10 different articles of clothing. 
#We can see see which label has the highest confidence value:


np.argmax(predictions[0])


'''So the model is most confident that this image is an ankle boot, or class_names[9].
 And we can check the test label to see this is correct:'''
 
test_labels[0]

'''Let's plot several images with their predictions. Correct prediction labels are green 
and incorrect prediction labels are red.'''

# Plot the first 25 test images, their predicted label, and the true label
# Color correct predictions in green, incorrect predictions in red


plt.figure(figsize=(10,10))
for i in range(25):
    plt.subplot(5,5,i+1)
    plt.xticks([])
    plt.yticks([])
    plt.grid('off')
    plt.imshow(test_images[i], cmap=plt.cm.binary)
    predicted_label = np.argmax(predictions[i])
    true_label = test_labels[i]
    if predicted_label == true_label:
      color = 'green'
    else:
      color = 'red'
    plt.xlabel("{} ({})".format(class_names[predicted_label], 
                                  class_names[true_label]),
                                  color=color)

'''Finally, use the trained model to make a prediction about a single image.'''

# Grab an image from the test dataset

img = test_images[0]
print(img.shape)

# Add the image to a batch where it's the only member.
img = (np.expand_dims(img,0))

print(img.shape)

(1, 28, 28)

#Now predict the image:

predictions = model.predict(img)

print(predictions)

 #Grab the predictions for our (only) image in the batch:
 
prediction = predictions[0]

np.argmax(prediction)


