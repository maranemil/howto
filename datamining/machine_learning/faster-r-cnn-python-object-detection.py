"""

A Practical Implementation of the Faster R - CNN Algorithm for Object Detection(Part 2 – with Python codes)
https: // www.analyticsvidhya.com / blog / 2018 / 11 / implementation - faster - r - cnn - python - object - detection /

# Setting up the System
Add in requirement.txt

pandas
matplotlib
tensorflow
keras – 2.0.3
numpy
opencv-python
sklearn
h5py

pip install -r requirement.txt

"""

# Data Exploration

# importing required libraries
import pandas as pd
import matplotlib.pyplot as plt
#% matplotlib
#inline
from matplotlib import patches

# read the csv file using read_csv function of pandas
train = pd.read_csv('train.csv')
train.head()

# reading single image using imread function of matplotlib
image = plt.imread('images/1.jpg')
plt.imshow(image)

# Number of unique training images
train['image_names'].nunique()

# Number of classes
train['cell_type'].value_counts()

fig = plt.figure()

# add axes to the image
ax = fig.add_axes([0, 0, 1, 1])

# read and plot the image
image = plt.imread('images/1.jpg')
plt.imshow(image)

# iterating over the image for different objects
for _, row in train[train.image_names == "1.jpg"].iterrows():
    xmin = row.xmin
    xmax = row.xmax
    ymin = row.ymin
    ymax = row.ymax

    width = xmax - xmin
    height = ymax - ymin

    # assign different color to different classes of objects
    if row.cell_type == 'RBC':
        edgecolor = 'r'
        ax.annotate('RBC', xy=(xmax - 40, ymin + 20))
    elif row.cell_type == 'WBC':
        edgecolor = 'b'
        ax.annotate('WBC', xy=(xmax - 40, ymin + 20))
    elif row.cell_type == 'Platelets':
        edgecolor = 'g'
        ax.annotate('Platelets', xy=(xmax - 40, ymin + 20))

    # add bounding boxes to the image
    rect = patches.Rectangle((xmin, ymin), width, height, edgecolor=edgecolor, facecolor='none')

# ---------------------------
# Implementing Faster R-CNN
# ---------------------------

"""
git clone https://github.com/kbardool/keras-frcnn.git

Move the train_images and test_images folder, as well as the train.csv file 
filepath,x1,y1,x2,y2,class_name
where,

filepath is the path of the training image
x1 is the xmin coordinate for bounding box
y1 is the ymin coordinate for bounding box
x2 is the xmax coordinate for bounding box
y2 is the ymax coordinate for bounding box
class_name is the name of the class in that bounding box

"""

data = pd.DataFrame()
data['format'] = train['image_names']

# as the images are in train_images folder, add train_images before the image name
for i in range(data.shape[0]):
    data['format'][i] = 'train_images/' + data['format'][i]

# add xmin, ymin, xmax, ymax and class as per the format required
for i in range(data.shape[0]):
    data['format'][i] = data['format'][i] + ',' + str(train['xmin'][i]) + ',' + str(train['ymin'][i]) + ',' + str(
        train['xmax'][i]) + ',' + str(train['ymax'][i]) + ',' + train['cell_type'][i]

data.to_csv('annotate.txt', header=None, index=None, sep=' ')

"""
cd keras - frcnn 
python train_frcnn.py - o simple - p annotate.txt
python test_frcnn.py - p test_images

"""





