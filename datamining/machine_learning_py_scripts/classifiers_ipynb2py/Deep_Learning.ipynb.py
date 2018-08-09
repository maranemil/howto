
# coding: utf-8

# In[1]:


## import libaries
import pandas as pd
import numpy as np
import cv2
import os, sys
import h5py
from tqdm import tqdm


# In[2]:


## load data
train = pd.read_csv('train.csv')
test = pd.read_csv('test.csv')


# In[3]:


# function to read image
def read_img(img_path):
    img = cv2.imread(img_path, cv2.IMREAD_COLOR)
    img = cv2.resize(img, (128,128))
    return img


# In[4]:


## set path for images
TRAIN_PATH = 'train_img/'
TEST_PATH = 'test_img/'


# In[5]:


# load data
train_img, test_img = [],[]
for img_path in tqdm(train['image_id'].values):
    train_img.append(read_img(TRAIN_PATH + img_path + '.png'))

for img_path in tqdm(test['image_id'].values):
    test_img.append(read_img(TEST_PATH + img_path + '.png'))


# In[6]:


# normalize images
x_train = np.array(train_img, np.float32) / 255.
x_test = np.array(test_img, np.float32) / 255.


# In[7]:


# target variable - encoding numeric value
label_list = train['label'].tolist()
Y_train = {k:v+1 for v,k in enumerate(set(label_list))}
y_train = [Y_train[k] for k in label_list]   
y_train = np.array(y_train)


# In[8]:


from keras import applications
from keras.models import Model
from keras import optimizers
from keras.models import Sequential
from keras.layers import Dense, Dropout, Flatten
from keras.layers import Conv2D, MaxPooling2D
from keras.layers.normalization import BatchNormalization
from keras.metrics import categorical_accuracy
from keras.preprocessing.image import ImageDataGenerator
from keras.callbacks import EarlyStopping
from keras.utils import to_categorical
from keras.preprocessing.image import ImageDataGenerator
from keras.callbacks import ModelCheckpoint
import h5py


# In[9]:


y_train = to_categorical(y_train)


# In[10]:


#Transfer learning with Inception V3 
base_model = applications.VGG16(weights='imagenet', include_top=False, input_shape=(128, 128, 3))


# In[11]:


## set model architechture 
add_model = Sequential()
add_model.add(Flatten(input_shape=base_model.output_shape[1:]))
add_model.add(Dense(256, activation='relu'))
add_model.add(Dense(y_train.shape[1], activation='softmax'))

model = Model(inputs=base_model.input, outputs=add_model(base_model.output))
model.compile(loss='categorical_crossentropy', optimizer=optimizers.SGD(lr=1e-4, momentum=0.9),
              metrics=['accuracy'])

model.summary()


# In[12]:


batch_size = 10 # tune it
epochs = 50 # increase it

train_datagen = ImageDataGenerator(
        rotation_range=30, 
        width_shift_range=0.1,
        height_shift_range=0.1, 
        horizontal_flip=True)
train_datagen.fit(x_train)


# In[ ]:


history = model.fit_generator(
    train_datagen.flow(x_train, y_train, batch_size=batch_size),
    steps_per_epoch=x_train.shape[0] // batch_size,
    epochs=epochs,
    callbacks=[ModelCheckpoint('VGG16-transferlearning.model', monitor='val_acc', save_best_only=True)]
)


# In[ ]:


predictions = np.argmax(predictions, axis=1)
rev_y = {v:k for k,v in Y_train.items()}
pred_labels = [rev_y[k] for k in predictions]


# In[ ]:


sub = pd.DataFrame({'image_id':test.image_id, 'label':pred_labels})
sub.to_csv('sub_vgg.csv', index=False) ## ~0.59

