from __future__ import division, print_function, absolute_import
from scipy.misc import imresize
from sklearn.cross_validation import train_test_split
from glob import glob

from tflearn.data_utils import to_categorical
from tflearn.layers.core import input_data, dropout, fully_connected
from tflearn.layers.conv import conv_2d, max_pool_2d
from tflearn.layers.estimator import regression
from tflearn.data_preprocessing import ImagePreprocessing
from tflearn.data_augmentation import ImageAugmentation
from tflearn.metrics import Accuracy
import tflearn
import numpy as np
import matplotlib.pyplot as plt 
import os,cv2

# Data Preparation 
Cat_files_path = '/home/raghu/Desktop/Cat&DogClassifier/train/cats/'
Dog_files_path = '/home/raghu/Desktop/Cat&DogClassifier/train/dogs/'

cat_files_path = os.path.join(Cat_files_path, '*.png')
dog_files_path = os.path.join(Dog_files_path, '*.png')

cat_files = sorted(glob(cat_files_path))
dog_files = sorted(glob(dog_files_path))

num_files = len(cat_files) + len(dog_files)
print(num_files) #Display the total number of images available for training

Img_size = 100 

Train_Samples = np.zeros((num_files,Img_size,Img_size,3),dtype='float64')
Train_Labels = np.zeros(num_files)

count = 0
# processing all the cat images
for i in cat_files:
    cat_img = cv2.imread(i) # read the image 
    # Resize the image to required width and height 
    resized_img = imresize(cat_img,(Img_size,Img_size,3))  
    Train_Samples[count] = np.array(resized_img) # Store each image
    Train_Labels[count] = 0 # Assign cat class '0' Label
    count += 1

# Processing all the dog images    
for j in dog_files:
    dog_img = cv2.imread(j)
    resized_img = imresize(dog_img, (Img_size, Img_size, 3))
    Train_Samples[count] = np.array(resized_img)
    Train_Labels[count] = 1 # Assign dog class '1' label
    count += 1
    
# Training and Validation Split
X,X_val,Y,Y_val = train_test_split(Train_Samples,Train_Labels,
                                   test_size=0.25,random_state=42)

# Convert class vectors to binary class matrix
Y = to_categorical(Y,2)
Y_val = to_categorical(Y_val,2)

# Data Augmentation and Image Processing
img_prep = ImagePreprocessing()
img_prep.add_featurewise_zero_center()
img_prep.add_featurewise_stdnorm()

img_aug = ImageAugmentation()
img_aug.add_random_flip_leftright()
img_aug.add_random_flip_updown()
img_aug.add_random_90degrees_rotation()
img_aug.add_random_blur()
img_aug.add_random_rotation(max_angle=25)

# Define the Model Architecture
net = input_data(shape=[None, Img_size, Img_size, 3],
                     data_preprocessing=img_prep,
                     data_augmentation=img_aug)

conv_1 = conv_2d(net, 32, 3, activation='relu', name='conv_1')
net = max_pool_2d(conv_1, 2)
conv_2 = conv_2d(net, 64, 3, activation='relu', name='conv_2')
conv_3 = conv_2d(conv_2, 64, 3, activation='relu', name='conv_3')
net = max_pool_2d(conv_3, 2)
net = fully_connected(net, 512, activation='relu')
net = dropout(net, 0.5)
net = fully_connected(net, 2, activation='softmax')

acc = Accuracy(name="Accuracy")
network = regression(net, optimizer='adam',loss='categorical_crossentropy',
                     learning_rate=0.0001, metric=acc)

model = tflearn.DNN(network,tensorboard_verbose=0,tensorboard_dir='tmp/tflearn_logs/')

model.fit(X,Y,validation_set=(X_val, Y_val),
          batch_size=100,
          n_epoch=1, 
          run_id='CatvsDog',
          show_metric=True)
          
model.save('CatvsDog.tflearn') # Save the model 


# Testing the trained model with unforeseen data
Test_files_path = '/home/raghu/Desktop/Cat&DogClassifier/test/'

test_files_path = os.path.join(Test_files_path,'*.png')
test_files = sorted(glob(test_files_path))
num_Test_files = len(test_files)
print(num_Test_files) # Display the total number of test images

size_image = 100

Test_Data = np.zeros((num_Test_files,Img_size,Img_size,3),dtype='float64')

count = 0
for k in test_files:
    test_img = cv2.imread(k)
    resized_test_img = imresize(test_img,(Img_size,Img_size,3))
    Test_Data[count] = np.array(resized_test_img)
    count += 1

Predicted_result = []
for Img in Test_Data:
    # Predict what class each image belongs to
    model_out = model.predict([Img])[0] 
    # Assign label according to the prediction
    if np.argmax(model_out) == 1:
        str_label='Dog'
    else: 
        str_label='Cat'
    Predicted_result.append(str_label)

# DIsplay the predicted result   
fig=plt.figure()
for num,img in enumerate(test_files):
    y = fig.add_subplot(4,5,num+1)
    y.imshow(cv2.cvtColor(cv2.imread(img),cv2.COLOR_BGR2RGB))
    plt.title(Predicted_result[num])
    y.axes.get_xaxis().set_visible(False)
    y.axes.get_yaxis().set_visible(False)
plt.show()



