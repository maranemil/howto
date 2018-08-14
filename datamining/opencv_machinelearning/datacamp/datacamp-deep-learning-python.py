
###################################################################################
#
#   Keras Tutorial: Deep Learning in Python
#   https://www.datacamp.com/community/tutorials/deep-learning-python
#
###################################################################################

"""

Requirements:

sudo apt install python-pip

pip install numpy
pip install matplotlib
pip install scipy
pip install tensorflow
pip install keras
pip install sklearn
pip install seaborn
pip install pandas
pip install --upgrade pip

"""

#------------------------------------------------------------------
#   Loading In The Data
#------------------------------------------------------------------

# Import pandas 
from sklearn import datasets
import pandas as pd
import csv
import numpy as np 

white = pd.read_csv('datacamp-deep-learning-python-wine-white.csv', delimiter=";")
red = pd.read_csv('datacamp-deep-learning-python-wine-red.csv', delimiter=";")


"""
Sample:
"fixed acidity";"volatile acidity";"citric acid";"residual sugar";"chlorides";"free sulfur dioxide";"total sulfur dioxide";"density";"pH";"sulphates";"alcohol";"quality"
7.4;0.7;0;1.9;0.076;11;34;0.9978;3.51;0.56;9.4;5
7.8;0.88;0;2.6;0.098;25;67;0.9968;3.2;0.68;9.8;5
"""

# Read in white wine data 
#white = pd.read_csv("http://archive.ics.uci.edu/ml/machine-learning-databases/wine-quality/winequality-white.csv", sep=';')
# Read in red wine data 
#red = pd.read_csv("http://archive.ics.uci.edu/ml/machine-learning-databases/wine-quality/winequality-red.csv", sep=';')

#---------------------
# Explore Data
#---------------------
print ("Explore Data----------------------------------------------------\n")
# Print info on white wine
print(white[0:2])

# Print info on red wine
print(red[0:2])

# Double check for null values in `red`
#pd.isnull(red)

#------------------------------------------------------------------
#   Preprocess Data
#------------------------------------------------------------------

# Add `type` column to `red` with value 1
red['type'] = 1

# Add `type` column to `white` with value 0
white['type'] = 0

# Append `white` to `red`
wines = red + white # , ignore_index=True)


#------------------------------------------------------------------
#   Alcohol
#------------------------------------------------------------------

import matplotlib.pyplot as plt
fig, ax = plt.subplots(1, 2)
ax[0].hist(red.alcohol, 10, facecolor='red', alpha=0.5, label="Red wine")
ax[1].hist(white.alcohol, 10, facecolor='white', ec="black", lw=0.5, alpha=0.5, label="White wine")
fig.subplots_adjust(left=0, right=1, bottom=0, top=0.5, hspace=0.05, wspace=1)
ax[0].set_ylim([0, 1000])
ax[0].set_xlabel("Alcohol in % Vol")
ax[0].set_ylabel("Frequency")
ax[1].set_xlabel("Alcohol in % Vol")
ax[1].set_ylabel("Frequency")
#ax[0].legend(loc='best')
#ax[1].legend(loc='best')
fig.suptitle("Distribution of Alcohol in % Vol")
plt.show()

#------------------------------------------------------------------
#   Sulphates
#------------------------------------------------------------------

import matplotlib.pyplot as plt
fig, ax = plt.subplots(1, 2, figsize=(8, 4))
ax[0].scatter(red['quality'], red["sulphates"], color="red")
ax[1].scatter(white['quality'], white['sulphates'], color="white", edgecolors="black", lw=0.5)
ax[0].set_title("Red Wine")
ax[1].set_title("White Wine")
ax[0].set_xlabel("Quality")
ax[1].set_xlabel("Quality")
ax[0].set_ylabel("Sulphates")
ax[1].set_ylabel("Sulphates")
ax[0].set_xlim([0,10])
ax[1].set_xlim([0,10])
ax[0].set_ylim([0,2.5])
ax[1].set_ylim([0,2.5])
fig.subplots_adjust(wspace=0.5)
fig.suptitle("Wine Quality by Amount of Sulphates")
plt.show()

#------------------------------------------------------------------
#   Acidity
#------------------------------------------------------------------

import matplotlib.pyplot as plt
import numpy as np
np.random.seed(570)
redlabels = np.unique(red['quality'])
whitelabels = np.unique(white['quality'])

import matplotlib.pyplot as plt
fig, ax = plt.subplots(1, 2, figsize=(8, 4))
redcolors = np.random.rand(6,4)
whitecolors = np.append(redcolors, np.random.rand(1,4), axis=0)

for i in range(len(redcolors)):
    redy = red['alcohol'][red.quality == redlabels[i]]
    redx = red['volatile acidity'][red.quality == redlabels[i]]
    ax[0].scatter(redx, redy, c=redcolors[i])
for i in range(len(whitecolors)):
    whitey = white['alcohol'][white.quality == whitelabels[i]]
    whitex = white['volatile acidity'][white.quality == whitelabels[i]]
    ax[1].scatter(whitex, whitey, c=whitecolors[i])
    
ax[0].set_title("Red Wine")
ax[1].set_title("White Wine")
ax[0].set_xlim([0,1.7])
ax[1].set_xlim([0,1.7])
ax[0].set_ylim([5,15.5])
ax[1].set_ylim([5,15.5])
ax[0].set_xlabel("Volatile Acidity")
ax[0].set_ylabel("Alcohol")
ax[1].set_xlabel("Volatile Acidity")
ax[1].set_ylabel("Alcohol") 
ax[1].legend(whitelabels, loc='best', bbox_to_anchor=(1.3, 1))
fig.subplots_adjust(top=0.85, wspace=0.7)
plt.show()

#------------------------------------------------------------------
#   Train and Test Sets
#------------------------------------------------------------------
print ("Train and Test Sets----------------------------------------------------\n")
# Import `train_test_split` from `sklearn.model_selection`
from sklearn.model_selection import train_test_split
# Specify the data 
X=wines.ix[:,0:11]
np.nan_to_num(X)
# Specify the target labels and flatten the array 
y=np.ravel(wines.type)
np.nan_to_num(y)
# Split the data up in train and test sets
#X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.33, random_state=42)
X_train, X_test, y_train, y_test = train_test_split(np.nan_to_num(X),y,test_size = 0.3,random_state=123)

#------------------------------------------------------------------
#   Standardize The Data
#------------------------------------------------------------------
print ("Standardize The Data----------------------------------------------------\n")
#np.nan_to_num(X_train)
# Import `StandardScaler` from `sklearn.preprocessing`
from sklearn.preprocessing import StandardScaler
# Define the scaler 
#scaler = StandardScaler.fit(X_train)
scaler = StandardScaler().fit(X_train)
# Scale the train set
X_train = scaler.transform(X_train)
# Scale the test set
X_test = scaler.transform(X_test)

#------------------------------------------------------------------
#   Model Data
#------------------------------------------------------------------
print ("Model Data----------------------------------------------------\n")
# Import `Sequential` from `keras.models`
from keras.models import Sequential
# Import `Dense` from `keras.layers`
from keras.layers import Dense
# Initialize the constructor
model = Sequential()
# Add an input layer 
model.add(Dense(12, activation='relu', input_shape=(11,)))
# Add one hidden layer 
model.add(Dense(8, activation='relu'))
# Add an output layer 
model.add(Dense(1, activation='sigmoid'))
# Model output shape
#model.shape
# Model summary
model.summary
# Model config
model.get_config()
# List all weight tensors 
model.get_weights()

#------------------------------------------------------------------
#    Compile and Fit
#------------------------------------------------------------------
print ("Compile and Fit----------------------------------------------------\n")
model.compile(loss='binary_crossentropy',
              optimizer='adam',
              metrics=['accuracy'])
model.fit(np.nan_to_num(X_train), y_train,epochs=2, batch_size=1, verbose=1) # epochs 20

#------------------------------------------------------------------
#   Predict Values
#------------------------------------------------------------------
print ("Predict Values----------------------------------------------------\n")
y_pred = model.predict(X_test)

#------------------------------------------------------------------
#   Evaluate Model
#------------------------------------------------------------------

score = model.evaluate(np.nan_to_num(X_test), y_test,verbose=1)
print(score)

# Import the modules from `sklearn.metrics`
from sklearn.metrics import confusion_matrix, precision_score, recall_score, f1_score, cohen_kappa_score

# Confusion matrix
confusion_matrix(y_test, y_pred)

# Precision 
precision_score(y_test, y_pred)

# Recall
recall_score(y_test, y_pred)

# F1 score
f1_score(y_test,y_pred)

# Cohen's kappa
cohen_kappa_score(y_test, y_pred)


#------------------------------------------------------------------
#   Predicting Wine Quality
#------------------------------------------------------------------

# Isolate target labels
y = wines.labels

# Isolate data
X = wines.drop('quality', axis=_) 


# Scale the data with `StandardScaler`
X = StandardScaler.fit_transform(X)

#------------------------------------------------------------------
#   Model Neural Network Architecture
#------------------------------------------------------------------

# Import `Sequential` from `keras.models`
from keras.models import Sequential

# Import `Dense` from `keras.layers`
from keras.layers import Dense

# Initialize the model
model = Sequential()

# Add input layer 
model.add(Dense(64, input_dim=12, activation='relu'))
    
# Add output layer 
model.add(Dense(1))

#------------------------------------------------------------------
#   Compile The Model, Fit The Data
#------------------------------------------------------------------

import numpy as np
from sklearn.model_selection import StratifiedKFold

seed = 7
np.random.seed(seed)

kfold = StratifiedKFold(n_splits=5, shuffle=True, random_state=seed)
for train, test in kfold.split(X, Y):
    model = Sequential()
    model.add(Dense(64, input_dim=12, activation='relu'))
    model.add(Dense(1))
    model.compile(optimizer='rmsprop', loss='mse', metrics=['mae'])
    model.fit(X[train], Y[train], epochs=10, verbose=1)


#------------------------------------------------------------------
#   Evaluate Model
#------------------------------------------------------------------

mse_value, mae_value = model.evaluate(X[test], Y[test], verbose=0)

print(mse_value)
print(mae_value)

from sklearn.metrics import r2_score
r2_score(Y[test], y_pred)

#------------------------------------------------------------------
#   Model Fine-Tuning
#------------------------------------------------------------------

"""

# Adding Layers
model = Sequential()
model.add(Dense(64, input_dim=12, activation='relu'))
model.add(Dense(64, activation='relu'))
model.add(Dense(1))

# Adding Hidden Units
model = Sequential()
model.add(Dense(128, input_dim=12, activation='relu'))
model.add(Dense(1))

# Some More Experiments: Optimization Parameters

from keras.optimizers import RMSprop
rmsprop = RMSprop(lr=0.0001)
model.compile(optimizer=rmsprop, loss='mse', metrics=['mae'])

from keras.optimizers import SGD, RMSprop
sgd=SGD(lr=0.1)
model.compile(optimizer=sgd, loss='mse', metrics=['mae'])

"""