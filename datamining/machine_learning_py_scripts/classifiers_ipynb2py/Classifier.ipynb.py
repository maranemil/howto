
# coding: utf-8

# # Image Recognition Challenge.

# Import Required Libraries/Packages

# In[1]:


import PIL
from PIL import Image
import cv2, numpy as np
import matplotlib.pyplot as plt
get_ipython().run_line_magic('matplotlib', 'inline')
import os


# Reading the image file in to Python

# In[2]:


im = Image.open("D:\\test_samples\\1.jpg")


# In[3]:


print type(im)


# In[4]:


im = np.asarray(im)


# In[5]:


print type(im)
im.shape


# Plot the Image using matplotlib

# In[6]:


plt.imshow(im)


# Image Augmentation:
# Augment the image to resize, shift(horizontal and vertical), rotate and flip

# In[7]:


resize_shape = 150
hshift = 0.2
vshift = 0.2
rotate = 40
flip = 0.4


# In[8]:


def augmentation(image, size = 0, rotate = 0, hshift = 0, vshift =0, flip =0):
    img = image.resize((size, size), PIL.Image.NEAREST)
    img = PIL.ImageChops.offset(image = img, xoffset=(np.random.uniform(0,hshift ,1)), yoffset=(np.random.uniform(0,vshift,1)))
    r = np.random.choice(np.arange(rotate),1)
    img = img.rotate(r)
    f= np.random.uniform(0,1,1)
    if f<flip:
        img = img.transpose(Image.FLIP_LEFT_RIGHT)
    return img
def resize(image,size=0):
    img = image.resize((size,size),PIL.Image.NEAREST)
    return img


# Example:

# In[10]:


p = np.random.uniform(0,1,1)
im = Image.open("D:\\test_samples\\116.jpg")
if p<0.4:
    im = augmentation(im, size = resize_shape, rotate = rotate, hshift = hshift, vshift = vshift, flip = flip)
im = np.asarray(im)
plt.imshow(im)


# In[11]:


print im.shape


# How to identify the class?

# In[12]:


tags = ['cat0.jpg', 'cat7.jpg','dog3.jpg']


# In[13]:


cls = [0 if i[:3]=='cat' else 1 for i in tags]


# In[14]:


print cls


# Read files names of images in the train folder.

# In[15]:


path = 'D:\\train_samples'


# In[16]:


for root, dirs, files in os.walk(path):
    train_ids = files


# In[17]:


print train_ids[2000:2010]


# In[18]:


len(train_ids)


# Shuffle to randomize learning

# In[19]:


from random import shuffle
shuffle(train_ids)


# Images from train data transformed to 150x150 and few of them augmented as well

# In[20]:


print train_ids[2000:2010]


# In[21]:


train_list =[]
train_labels = []
for i in train_ids:
    im1 = Image.open("D:\\train_samples\\"+i)
    if i[:3].lower() == "cat":
        b = 0
    else:
        b = 1
    im1 = resize(im1,size=resize_shape)
    p = np.random.uniform(0,1,1)
    if p<0.4:    
        im1 = augmentation(im1,size=resize_shape,rotate=rotate,hshift=hshift,vshift=vshift,flip=flip)
    im1 = np.array(im1)
    train_list.append(im1)
    train_labels.append(b)


# In[22]:


from __future__ import division


# In[23]:


train_images = np.array(train_list)
train_images1 = 255-train_images
train_images1=train_images1/255


# In[24]:


train_labels = np.array(train_labels)


# In[27]:


train_labels[0:5]


# In[28]:


import numpy
from keras.models import Sequential
from keras.layers import Conv2D, MaxPooling2D
from keras.layers import Activation, Dropout, Flatten, Dense


# In[29]:


from keras.utils.np_utils import to_categorical


# In[30]:


train_labels1 = to_categorical(train_labels)


# In[32]:


print train_labels1[0:5]


# Model Building

# In[33]:


model = Sequential()

model.add(Conv2D(32, 5, 5, activation='relu', input_shape=(150,150,3)))
model.add(MaxPooling2D(pool_size=(2,2)))

model.add(Conv2D(32, 3, 3, activation='relu'))

model.add(Conv2D(32, 3, 3, activation='relu'))
model.add(MaxPooling2D(pool_size=(2,2)))
model.add(Flatten())

model.add(Dense(128, init='uniform', activation='relu'))
model.add(Dropout(0.4))

model.add(Dense(32, init='uniform', activation='relu'))
model.add(Dropout(0.4))

model.add(Dense(1, activation='sigmoid'))


# In[34]:


model.compile(loss = "binary_crossentropy",
              optimizer = 'rmsprop',
              metrics = ['accuracy'])


# Training the model

# In[35]:


import time
start_time = time.time()

model.fit(train_images1, train_labels, nb_epoch=30, batch_size=32, show_accuracy=True, verbose=2)
          
print("--- %s seconds ---" % (time.time() - start_time))


# Predictions on Test data:

# In[39]:


test_path = 'D:\\test_samples\\'


# In[40]:


for root, dirs, files in os.walk(test_path):
    test_ids = files


# In[41]:


print len(test_ids)


# In[42]:


Test_list =[]
for i in test_ids:
    im = Image.open("D:\\test_samples\\"+i)
    im = resize(im,size=resize_shape)
    im = np.array(im)
    Test_list.append(im)


# In[43]:


test_images = np.array(Test_list)
test_images1 = 255-test_images
test_images1 = test_images1/255


# In[44]:


predictions = model.predict(test_images1)


# In[46]:


predictions[0:5]


# In[53]:


type(predictions)


# In[74]:


probability = []
for x in predictions:
    g = '{0:.2f}'.format(float(x))
    probability.append(g)


# In[75]:


type(probability)


# Write test predictions to a csv file

# In[58]:


import pandas as pd


# In[71]:


Id = list(range(1000)) 


# In[76]:


submit = pd.DataFrame(data={"Id": Id, "Probability": probability})


# In[77]:


type(submit)
submit.head(5)


# In[79]:


submit.to_csv("submission_Bharath.csv", sep=',', encoding='utf-8',index=False)

