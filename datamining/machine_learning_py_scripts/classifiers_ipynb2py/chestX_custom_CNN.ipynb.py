
# coding: utf-8

# In[1]:


get_ipython().run_line_magic('matplotlib', 'inline')
get_ipython().run_line_magic('config', "InlineBackend.figure_format = 'retina'")

import numpy as np
import pandas as pd
import matplotlib.pyplot as plt


# In[2]:


data_path = 'sample_labels.csv'
NIH_Data = pd.read_csv(data_path)


# In[3]:


NIH_Data[:1]


# In[4]:


NIH_Data["Finding Labels"][0].split('|')[0] == 'Emphysema'


# In[5]:


train_data = NIH_Data[:2803] #50% of total data
test_data = NIH_Data[2803:5046] #40% of total data
validation_data = NIH_Data[5046:5607] #10% of total data


# In[6]:


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


# In[7]:


def getDataTarget(data,start_val):
    data_targets = np.zeros([data.shape[0],13])
    for i in range(0,data.shape[0]):
        data_targets[i,:] = getTarget(data["Finding Labels"][i+start_val])
    return data_targets


# In[8]:


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


# In[9]:


train_files, train_targets = load_data(train_data,0)
valid_files, valid_targets = load_data(validation_data,5046)
test_files, test_targets = load_data(test_data,2803)


# In[10]:


from keras.applications.resnet50 import preprocess_input, decode_predictions

def ResNet50_predict_labels(img_path):
    # returns prediction vector for image located at img_path
    img = preprocess_input(path_to_tensor(img_path))
    return np.argmax(ResNet50_model.predict(img))


# In[11]:


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


# In[12]:


from PIL import ImageFile                            
ImageFile.LOAD_TRUNCATED_IMAGES = True                 

# pre-process the data for Keras
train_tensors = paths_to_tensor(train_files).astype('float32')/255
valid_tensors = paths_to_tensor(valid_files).astype('float32')/255
test_tensors = paths_to_tensor(test_files).astype('float32')/255


# In[13]:


train_tensors[0][0][0]


# In[14]:


from keras.layers import Conv2D, MaxPooling2D, GlobalAveragePooling2D
from keras.layers import Dropout, Flatten, Dense, Activation
from keras.models import Sequential

rowNum, colNum, ch = 224, 224, 3
numOfClasses = 13

model = Sequential()

# First Convolution Layer
model.add(Conv2D(16, 5,5 ,input_shape=(rowNum,colNum,ch), subsample=(2,2), border_mode='same', name='convlayer1'))
model.add(Activation('relu'))
# First Maxpool
model.add(MaxPooling2D(pool_size=(2,2),strides=(1,1),name='maxpool1'))

# Second Convolution Layer
model.add(Conv2D(32, 5,5 , subsample=(2,2), border_mode='same', name='convlayer2'))
model.add(Activation('relu'))
# Second Maxpool
model.add(MaxPooling2D(pool_size=(2,2),name='maxpool2'))

# Third Convolution Layer
model.add(Conv2D(64, 3,3 , border_mode='same', name='convlayer3'))
model.add(Activation('relu'))
# Third Maxpool
model.add(MaxPooling2D(pool_size=(2,2),name='maxpool3'))

model.add(Flatten())
model.add(Dropout(0.5))

#Dense layer with 64 neurons and relu activation
model.add(Dense(64, name='Dense1'))
model.add(Activation('relu'))
model.add(Dropout(0.5))

#Output layer with softmax function
model.add(Dense(numOfClasses, activation='softmax', name='output'))
model.summary()


# In[15]:


model.compile(optimizer='rmsprop', loss='categorical_crossentropy', metrics=['accuracy'])


# In[16]:


from keras.callbacks import ModelCheckpoint  
epochs = 10
checkpointer = ModelCheckpoint(filepath='saved_models/weights.best.from_scratch.hdf5', 
                               verbose=1, save_best_only=True)


# In[17]:


model.fit(train_tensors, train_targets, 
          validation_data=(valid_tensors, valid_targets),
          epochs=epochs, batch_size=20, callbacks=[checkpointer], verbose=1)


# In[18]:


model.load_weights('saved_models/weights.best.from_scratch.hdf5')


# In[19]:


# get index of predicted dog breed for each image in test set
image_predictions = [np.argmax(model.predict(np.expand_dims(tensor, axis=0))) for tensor in test_tensors]

# report test accuracy
test_accuracy = 100*np.sum(np.array(image_predictions)==np.argmax(test_targets, axis=1))/len(image_predictions)
print('Test accuracy: %.4f%%' % test_accuracy)

