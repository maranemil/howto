
# coding: utf-8

# <h2> Maple or Walnut?: Neural Network Tree ID </h2>
# 
# An example neural network that classifies lab photographs of either Maple or Walnut leaves. <br>
# Multiple species of each genus acer (maple) & juglans (walnut) are included in the dataset. <br>
# 
# Maple Images: <b>679</b><br>
# Walnut Images: <b>268</b><br>
# 
# <b>Original Leaf Images Taken From:</b><br>
# "Leafsnap: A Computer Vision System for Automatic Plant Species Identification,"
# Neeraj Kumar, Peter N. Belhumeur, Arijit Biswas, David W. Jacobs, W. John Kress, Ida C. Lopez, João V. B. Soares,
# Proceedings of the 12th European Conference on Computer Vision (ECCV),
# October 2012
# 

# <h3>Step 1: Process Image Files</h3>
# Before the images can be turned into a useable dataset, I had to do some image processing.
# 
# Here is a sample image:

# In[31]:


import os

#Load Image Locaction
maple_image_sample = os.path.join(os.path.dirname('__file__'), 'acer\\pi0029-01-3.jpg')

#Show image
from IPython.display import Image as py_img
py_img(filename=maple_image_sample)


# <h4> Clean Images </h4>
# 
# There are several things I wanted to change about these images in order to turn them into clean(ish) data.
# 
# -Remove the size and color scale since this isn't relevant data for id. <br>
# -Color also isn't really required to id a Maple leaf vs a Walnut, so we can remove color. <br>
# -These images are huge and will make massive features for processing.  I want something small. <br>
# 
# I turned to the PIL/pillow library to clean up these images
# 

# In[32]:


from PIL import Image, ImageEnhance

#Crop function crops, ups contrast, scales, and converts to a 2-tone black and white image.
def crop(image_path, coords, saved_location):
    image_obj = Image.open(image_path)
    cropped_image = image_obj.crop(coords)

    contrast = ImageEnhance.Contrast(cropped_image)
    cropped_image = contrast.enhance(20)

    cropped_image = cropped_image.convert('1')
    cropped_image = cropped_image.resize((35, 35), Image.ANTIALIAS)

    cropped_image.save(saved_location)
    


# With the crop function defined, I applied that to all the maple and walnut images.
# 
# All the images are saved in a new directory.

# In[33]:


counter = 0

maple_directory = os.path.join(os.path.dirname('__file__'), 'acer')
walnut_directory = os.path.join(os.path.dirname('__file__'), 'juglans')

for file in os.listdir(maple_directory):
    file = os.fsencode(maple_directory + '\\' + file)
    img = Image.open(file)
    width, height = img.size
    crop(file, (0, 0, width*.66, height*.8), 'maple\\' + 'maple_' + str(counter) + '.png')
    counter =  counter + 1


    
for file in os.listdir(walnut_directory):
    file = os.fsencode(walnut_directory + '\\' + file)
    img = Image.open(file)
    width, height = img.size
    crop(file, (0, 0, width*.66, height*.75), 'walnut\\' + 'walnut_' + str(counter) + '.png')
    counter =  counter + 1


# <h4> Processed Images Complete </h4>
# 
# The simplified two-tone, small version of each id picture is done
# 
# Here is a sample maple & walnut:

# In[34]:


maple_image_processed = os.path.join(os.path.dirname('__file__'), 'maple\\maple_2.png')
py_img(filename=maple_image_processed)


# In[35]:


walnut_image_processed = os.path.join(os.path.dirname('__file__'), 'walnut\\walnut_710.png')
py_img(filename=walnut_image_processed)


# <h4> Image to Data Example</h4>
# 
# At this point the image is basically just a series of black or white pixel data.
# 
# That was is easily transformed into float Matrix where each row is a row of pixels from the image.
# In the matrix a 1 is white and a 0 is black.
# 
# Obviously, most of the image is white, so this is mostly a huge matrix of 1's.

# In[36]:


import matplotlib.image as mpimg
img = mpimg.imread(os.path.join(os.path.dirname('__file__'), 'maple\\maple_2.png'))
img


# For my purposes here I don't need to maintain the 2d structure of the data,
# and it is even be easier to deal with as one long row of digits.
# 
# So I flattened the matrix into a long list.

# In[37]:


list_of_lists = img.tolist()
flat_list = [item for sublist in list_of_lists for item in sublist]


# Each image file has 1225 pixels, so each list is 1225 items long.

# In[38]:


len(flat_list)


# Instead of naming every column in the dataset, <br>
# I just used the number value for the count of items in the list as the name of each column:

# In[39]:


columns = list(range(0, (len(flat_list)+1)))


# <h4> All Images to Data Loop</h4>
# 
# Using the same process above where I turned one image into a matrix of 1s and 0s,
# below I loop over each maple image creating a matrix, flattening it, and adding it to a list of lists.

# In[40]:


#process_maple_directory = 'C:\\Users\\Admin\\Documents\\Spyder_Projects\\Leaf Id\\maple'
process_maple_directory = os.path.join(os.path.dirname('__file__'), 'maple')

maple_img_stack = []

for file in os.listdir(process_maple_directory):
    full_file = os.fsencode(process_maple_directory + '\\' + file)
    img = mpimg.imread(full_file)
    list_of_lists = img.tolist()
    flat_list = [item for sublist in list_of_lists for item in sublist]
    #Add filename as index
    row = [str(file)] + flat_list
    maple_img_stack.append(row)


# Same process for the walnut images...

# In[41]:


process_walnut_directory = 'C:\\Users\\Admin\\Documents\\Spyder_Projects\\Leaf Id\\walnut'

walnut_img_stack = []

for file in os.listdir(process_walnut_directory):
    full_file = os.fsencode(process_walnut_directory + '\\' + file)
    img = mpimg.imread(full_file)
    list_of_lists = img.tolist()
    flat_list = [item for sublist in list_of_lists for item in sublist]
    #Add filename as index
    row = [str(file)] + flat_list
    walnut_img_stack.append(row)


# Then I took the list of lists and turned them into pandas Dataframes:

# In[42]:


import pandas as pd
dfM = pd.DataFrame(maple_img_stack)
dfO = pd.DataFrame(walnut_img_stack)


# In[43]:


dfO.head()


# Just to clean things up, I reset the index to be the file names:

# In[44]:


dfM['Index'] = dfM[0]
dfM = dfM.set_index('Index')
dfM = dfM.drop([0], axis=1)
dfM['Maple'] = True


# In[45]:


dfM.head()


# In[46]:


dfO['Index'] = dfO[0]
dfO['Index'] = dfO['Index']
dfO = dfO.set_index('Index')
dfO = dfO.drop([0], axis=1)
dfO['Maple'] = False


# In[47]:


dfO.head()


# <h4> Joining and Shuffling Dataframes </h4>
# Then I put together the maple & walnut dataframes, and did one shuffle.

# In[48]:


dft = pd.concat([dfM,dfO])


# In[49]:


dft.info()


# In[50]:


dft = dft.sample(frac=1)
dft.columns = dft.columns.astype(str)
dft.head(15)


# <h4> Applying Machine Learning </h4>
# 
# Up to this point, with all this work with the images, all I have accomplished is preparing a dataset.  Two datasets really: training & test.  
# 
# In order to classify a leaf image, I need to choose, set parameters, and deploy a machine learning algorithm
# 
# In this instance, I used the Google library Tensorflow.
# 
# With the Estimator module, Tensorflow abstracts away much of the complexity of defining an algorithm.
# That said, there are still some decisions I had to make.  Primarily, which kind of classifier I would use.  In this instance, with over a thousand feature in our model, I doubt that a linear classifier would perform optimally.  Tensorflow has easily accessible deep neural network structures, so I opted for that.
# 
# 

# In[51]:


import tensorflow as tf
import tempfile

df_train = dft.sample(frac=0.8)
df_test = dft.drop(df_train.index)
df_predict = dft.drop(df_train.index)

pred_column = 'Maple'
pred_label = True

base_columns = []

for column in df_test:
    if column != pred_column:
        if df_test[column].dtype == 'float64':
            feature = tf.feature_column.numeric_column(column)
        else:
            feature = tf.feature_column.categorical_column_with_hash_bucket(column, hash_bucket_size=10000)
        base_columns.append(feature)


################ SETUP TENSORFLOW INPUTS ##########################
# Establish Labels to generate with model.
df_train['train_labels'] = df_train[pred_column] == pred_label
df_test['test_labels'] = df_test[pred_column] == pred_label
  
train_input = tf.estimator.inputs.pandas_input_fn(
       x=df_train,
       y=df_train["train_labels"],
       batch_size=100,
       num_epochs=None,
       shuffle=True,
       num_threads=5)
  
test_input = tf.estimator.inputs.pandas_input_fn(
       x=df_test,
       y=df_test["test_labels"],
       batch_size=100,
       num_epochs=None,
       shuffle=True,
       num_threads=5)

#predict is done only once, without shuffle, since we are writing results nex
#next to data inputs.
predict_input = tf.estimator.inputs.pandas_input_fn(
       x=df_predict,
       batch_size=100,
       num_epochs=1,
       shuffle=False,
       num_threads=1)
       
##########################################################
       
# Define where tensorflow model is saved.  This hardcoded version will break.
# files need to be deleted after run.  Use tempfolder to deal with this.
model_dir = tempfile.mkdtemp()

m = tf.estimator.DNNClassifier(
     model_dir=model_dir, hidden_units=[512,256,128,64], feature_columns=base_columns)

############ Training and Evaluating Our Model #####################
m.train(input_fn=train_input, steps=1000)      


# In[52]:


df_test.head()


# In[53]:


import re

 #eval
results = m.evaluate(input_fn=test_input, steps=100)

#Show eval results
print("model directory = %s" % model_dir)
for key in sorted(results):
    tf.summary.scalar(key, results[key])
    print("%s: %s" % (key, results[key]))
print ('######################################')

#predict
predictions = m.predict(input_fn=predict_input)

#create list to save predictions to.
predict_list = []
prob_list = []

# For each input row, add binary prediction to new column.
for i, p in enumerate(predictions):
  #print("Prediction %s: %s" % (i + 1, p['classes']))
  #predict_list.append(p['classes'])
  for x in p['classes']:
     predict_list.append(re.sub("\D", "", str(x)))
  #print("Probabilities %s: %s" % (i + 1, p['probabilities']))
  prob_list.append(str(p['probabilities']))

pred_series = pd.Series(predict_list)
df_predict['Prediction'] = pred_series.values

prob_series = pd.Series(prob_list)
df_predict['Probabilities'] = prob_series.values

# Output prediction results to file.
df_predict.to_csv('prediction_results.csv', sep=',', encoding='utf-8')

#### GET COUNTS OF TRUE PREDICTION COLUMNS


# In[54]:


df_predict.head(10)


# In[55]:


df_predict.to_csv('tree_pred_results.csv', sep=',', encoding='utf-8')

