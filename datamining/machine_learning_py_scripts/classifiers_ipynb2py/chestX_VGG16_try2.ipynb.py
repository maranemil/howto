
# coding: utf-8

# In[1]:


get_ipython().run_line_magic('matplotlib', 'inline')
get_ipython().run_line_magic('config', "InlineBackend.figure_format = 'retina'")

import keras
import os
import time
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
from vgg16 import VGG16
from keras.preprocessing import image
from keras.applications.imagenet_utils import preprocess_input
from imagenet_utils import decode_predictions
from keras.layers import Dense, Activation, Flatten
from keras.layers import merge, Input
from keras.models import Model
from keras.utils import np_utils


# In[2]:


# Custom_vgg_model_1
#Training the classifier alone
image_input = Input(shape=(224, 224, 3))

model = VGG16(include_top=True,input_tensor=image_input,weights='imagenet')
#model = VGG16("qfeDf")
model.summary()


# In[ ]:


data_path = 'sample_labels.csv'
NIH_Data = pd.read_csv(data_path)


# In[ ]:


NIH_Data[:1]


# In[ ]:


NIH_Data["Finding Labels"][0].split('|')[0] == 'Emphysema'


# In[ ]:


train_data = NIH_Data[:2803] #50% of total data
test_data = NIH_Data[2803:5046] #40% of total data
validation_data = NIH_Data[5046:5607] #10% of total data


# In[ ]:


def getTarget(data):
    target = np.zeros([13])
    split_data = data.split('|')
    for i in range(0,len(split_data)):
        if(split_data[i] == 'Cardiomegaly'):
            target[0]=1
        if(split_data[i] == 'Emphysema'):
            target[1]=1
        if(split_data[i] == 'Atelectasis'):
            target[2]=1
        if(split_data[i] == 'Infiltration'):
            target[3]=1
        if(split_data[i] == 'Effusion'):
            target[4]=1
        if(split_data[i] == 'Pneumothorax'):
            target[5]=1
        if(split_data[i] == 'Pleural_Thickening'):
            target[6]=1
        if(split_data[i] == 'Edema'):
            target[7]=1
        if(split_data[i] == 'Mass'):
            target[8]=1
        if(split_data[i] == 'Nodule'):
            target[9]=1
        if(split_data[i] == 'Consolidation'):
            target[10]=1
        if(split_data[i] == 'Fibrosis'):
            target[11]=1
        if(split_data[i] == 'No Finding'):
            target[12]=1
            
    return target


# In[ ]:


def getDataTarget(data,start_val):
    data_targets = np.zeros([data.shape[0],13])
    for i in range(0,data.shape[0]):
        data_targets[i,:] = getTarget(data["Finding Labels"][i+start_val])
    return data_targets


# In[ ]:


def load_data(data,start_val):
    #print(data.shape[0])
    data_files = ["" for x in range(data.shape[0])]
    for i in range(0,data.shape[0]):
        #print(data["Image Index"][i+start_val])
        data_files[i] = ('images/'+data["Image Index"][i+start_val])
    data_files = np.asarray(data_files)
    #print(data_files)
    data_targets = getDataTarget(data,start_val)
    return data_files, data_targets


# In[ ]:


train_files, train_targets = load_data(train_data,0)
valid_files, valid_targets = load_data(validation_data,5046)
test_files, test_targets = load_data(test_data,2803)


# In[ ]:


from keras.preprocessing import image                  
from tqdm import tqdm

def path_to_tensor(img_path):
    # loads RGB image as PIL.Image.Image type
    img = image.load_img(img_path, target_size=(224, 224))
    # convert PIL.Image.Image type to 3D tensor with shape (224, 224, 3)
    x = image.img_to_array(img)
    # convert 3D tensor to 4D tensor with shape (1, 224, 224, 3) and return 4D tensor
    return np.expand_dims(x, axis=0)

def paths_to_tensor(img_paths):
    list_of_tensors = [path_to_tensor(img_path) for img_path in tqdm(img_paths)]
    return np.vstack(list_of_tensors)


# In[ ]:


from PIL import ImageFile                            
ImageFile.LOAD_TRUNCATED_IMAGES = True                 

# pre-process the data for Keras
train_tensors = paths_to_tensor(train_files).astype('float32')/255
valid_tensors = paths_to_tensor(valid_files).astype('float32')/255
test_tensors = paths_to_tensor(test_files).astype('float32')/255


# In[ ]:


train_tensors[0].shape

