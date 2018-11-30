
"""
############################################################################################

#  the classifier can only deal with numeric features

https://scikit-learn.org/stable/modules/tree.html
https://chrisalbon.com/machine_learning/trees_and_forests/visualize_a_decision_tree/
https://scikit-learn.org/stable/modules/generated/sklearn.tree.DecisionTreeClassifier.html
https://chrisalbon.com/machine_learning/trees_and_forests/decision_tree_classifier/
http://adataanalyst.com/scikit-learn/decision-trees-scikit-learn/
https://scikit-learn.org/stable/modules/ensemble.html
https://scikit-learn.org/stable/modules/generated/sklearn.tree.export_graphviz.html
https://graphviz.readthedocs.io/en/stable/manual.html
http://www.goodtecher.com/machine-learning-coding-tutorial-2-visualizing-decision-tree/
http://dataaspirant.com/2017/04/21/visualize-decision-tree-python-graphviz/
https://towardsdatascience.com/decision-trees-a-birds-eye-view-and-an-implementation-c91754f0dcd0
https://datascience.stackexchange.com/questions/20415/what-should-be-the-order-of-class-names-in-sklearn-tree-export-function-beginne
https://stackoverflow.com/questions/42933179/python-sklearn-decision-tree-classifier-with-multiple-features
https://towardsdatascience.com/solving-a-simple-classification-problem-with-python-fruits-lovers-edition-d20ab6b071d2
https://markhneedham.com/blog/2015/03/02/python-scikit-learn-training-a-classifier-with-non-numeric-features/
https://pythonhaven.wordpress.com/2009/12/09/generating_graphs_with_pydot/
https://www.programcreek.com/python/example/93898/pydotplus.graph_from_dot_data
https://www.programcreek.com/python/example/84621/pydot.graph_from_dot_data

############################################################################################
"""

# https://repl.it/r

from sklearn import tree

features = [[1, 0, 0], [2, 1, 1], [3, 0, 0], [4, 1, 1], [5, 0, 0], [6, 0, 1], [900, 0, 1],
            [1001, 0, 0]]  # val,pow2,even
labels = ['o', 'e', 'o', 'e', 'o', 'e', 'e', 'o']  # is even

clf = tree.DecisionTreeClassifier()
clf = clf.fit(features, labels)

print (clf.predict([[203, 0, 0]]))
print (clf.predict([[31, 1, 1]]))

"""
import pydot
import pydotplus
from IPython.display import Image  
dot_data = tree.export_graphviz(clf, out_file=None, 
                     feature_names=['number','pow2','even'],  
                     class_names=['o','e'],  
                     filled=True, rounded=True,  
                     special_characters=True)  
graph = pydotplus.graph_from_dot_data(dot_data)  
# Image(graph.create_png())  
graph.write_pdf("1.pdf")
"""

# ---------------------------------------------------------

# Load libraries
from sklearn.tree import DecisionTreeClassifier
from sklearn import datasets

# Load data
iris = datasets.load_iris()
X = iris.data
y = iris.target

# Create decision tree classifer object using gini
clf = DecisionTreeClassifier(criterion='gini', random_state=0)

# Train model
model = clf.fit(X, y)

# Make new observation
observation = [[5, 4, 3, 2]]

# Predict observation's class
model.predict(observation)

# View predicted class probabilities for the three classes
model.predict_proba(observation)

# ---------------------------------------------------------

# fruits

"""

label 	| name 		| subtype 		| mass	| width | height 	| color_score
1 		| apple 	| granny_smith 	| 192 	| 8.4	| 7.3		| 0.55		
2 		| mandarin	| mandarin		| 72 	| 6.4	| 4.3		| 0.85		

"""

import pandas as pd
import matplotlib.pyplot as plt

fruits = pd.read_table('fruit_data_with_colors.txt')
fruits.head()
print(fruits.shape)
print(fruits['fruit_name'].unique())
print(fruits.groupby('fruit_name').size())

import seaborn as sns

sns.countplot(fruits['fruit_name'], label="Count")
plt.show()

fruits.drop('fruit_label', axis=1).plot(kind='box', subplots=True, layout=(2, 2), sharex=False, sharey=False,
                                        figsize=(9, 9), title='Box Plot for each input variable')
plt.savefig('fruits_box')
plt.show()

import pylab as pl

fruits.drop('fruit_label', axis=1).hist(bins=30, figsize=(9, 9))
pl.suptitle("Histogram for each numeric input variable")
plt.savefig('fruits_hist')
plt.show()

from pandas.tools.plotting import scatter_matrix
from matplotlib import cm

feature_names = ['mass', 'width', 'height', 'color_score']
X = fruits[feature_names]
y = fruits['fruit_label']
cmap = cm.get_cmap('gnuplot')
scatter = pd.scatter_matrix(X, c=y, marker='o', s=40, hist_kwds={'bins': 15}, figsize=(9, 9), cmap=cmap)
plt.suptitle('Scatter-matrix for each input variable')
plt.savefig('fruits_scatter_matrix')

# Create Training and Test Sets and Apply Scaling
from sklearn.model_selection import train_test_split

X_train, X_test, y_train, y_test = train_test_split(X, y, random_state=0)
from sklearn.preprocessing import MinMaxScaler

scaler = MinMaxScaler()
X_train = scaler.fit_transform(X_train)
X_test = scaler.transform(X_test)

# Logistic Regression
from sklearn.linear_model import LogisticRegression

logreg = LogisticRegression()
logreg.fit(X_train, y_train)
print('Accuracy of Logistic regression classifier on training set: {:.2f}'
      .format(logreg.score(X_train, y_train)))
print('Accuracy of Logistic regression classifier on test set: {:.2f}'
      .format(logreg.score(X_test, y_test)))

# Decision Tree
from sklearn.tree import DecisionTreeClassifier

clf = DecisionTreeClassifier().fit(X_train, y_train)
print('Accuracy of Decision Tree classifier on training set: {:.2f}'
      .format(clf.score(X_train, y_train)))
print('Accuracy of Decision Tree classifier on test set: {:.2f}'
      .format(clf.score(X_test, y_test)))

# K-Nearest Neighbors
from sklearn.neighbors import KNeighborsClassifier

knn = KNeighborsClassifier()
knn.fit(X_train, y_train)
print('Accuracy of K-NN classifier on training set: {:.2f}'
      .format(knn.score(X_train, y_train)))
print('Accuracy of K-NN classifier on test set: {:.2f}'
      .format(knn.score(X_test, y_test)))

# Linear Discriminant Analysis
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis

lda = LinearDiscriminantAnalysis()
lda.fit(X_train, y_train)
print('Accuracy of LDA classifier on training set: {:.2f}'
      .format(lda.score(X_train, y_train)))
print('Accuracy of LDA classifier on test set: {:.2f}'
      .format(lda.score(X_test, y_test)))

# Gaussian Naive Bayes
from sklearn.naive_bayes import GaussianNB

gnb = GaussianNB()
gnb.fit(X_train, y_train)
print('Accuracy of GNB classifier on training set: {:.2f}'
      .format(gnb.score(X_train, y_train)))
print('Accuracy of GNB classifier on test set: {:.2f}'
      .format(gnb.score(X_test, y_test)))

# Support Vector Machine
from sklearn.svm import SVC

svm = SVC()
svm.fit(X_train, y_train)
print('Accuracy of SVM classifier on training set: {:.2f}'
      .format(svm.score(X_train, y_train)))
print('Accuracy of SVM classifier on test set: {:.2f}'
      .format(svm.score(X_test, y_test)))

from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix

pred = knn.predict(X_test)
print(confusion_matrix(y_test, pred))
print(classification_report(y_test, pred))

# Plot the Decision Boundary of the k-NN Classifier

import matplotlib.cm as cm
from matplotlib.colors import ListedColormap, BoundaryNorm
import matplotlib.patches as mpatches
import matplotlib.patches as mpatches

X = fruits[['mass', 'width', 'height', 'color_score']]
y = fruits['fruit_label']
X_train, X_test, y_train, y_test = train_test_split(X, y, random_state=0)


def plot_fruit_knn(X, y, n_neighbors, weights):
    X_mat = X[['height', 'width']].as_matrix()
    y_mat = y.as_matrix()
    # Create color maps
    cmap_light = ListedColormap(['#FFAAAA', '#AAFFAA', '#AAAAFF', '#AFAFAF'])
    cmap_bold = ListedColormap(['#FF0000', '#00FF00', '#0000FF', '#AFAFAF'])


clf = neighbors.KNeighborsClassifier(n_neighbors, weights=weights)
clf.fit(X_mat, y_mat)
# Plot the decision boundary by assigning a color in the color map
# to each mesh point.

mesh_step_size = .01  # step size in the mesh
plot_symbol_size = 50

x_min, x_max = X_mat[:, 0].min() - 1, X_mat[:, 0].max() + 1
y_min, y_max = X_mat[:, 1].min() - 1, X_mat[:, 1].max() + 1
xx, yy = np.meshgrid(np.arange(x_min, x_max, mesh_step_size),
                     np.arange(y_min, y_max, mesh_step_size))
Z = clf.predict(np.c_[xx.ravel(), yy.ravel()])
# Put the result into a color plot
Z = Z.reshape(xx.shape)
plt.figure()
plt.pcolormesh(xx, yy, Z, cmap=cmap_light)
# Plot training points
plt.scatter(X_mat[:, 0], X_mat[:, 1], s=plot_symbol_size, c=y, cmap=cmap_bold, edgecolor='black')
plt.xlim(xx.min(), xx.max())
plt.ylim(yy.min(), yy.max())
patch0 = mpatches.Patch(color='#FF0000', label='apple')
patch1 = mpatches.Patch(color='#00FF00', label='mandarin')
patch2 = mpatches.Patch(color='#0000FF', label='orange')
patch3 = mpatches.Patch(color='#AFAFAF', label='lemon')
plt.legend(handles=[patch0, patch1, patch2, patch3])
plt.xlabel('height (cm)')
plt.ylabel('width (cm)')
plt.title("4-Class classification (k = %i, weights = '%s')"
          % (n_neighbors, weights))
plt.show()
plot_fruit_knn(X_train, y_train, 5, 'uniform')

k_range = range(1, 20)
scores = []
for k in k_range:
    knn = KNeighborsClassifier(n_neighbors=k)
    knn.fit(X_train, y_train)
    scores.append(knn.score(X_test, y_test))
plt.figure()
plt.xlabel('k')
plt.ylabel('accuracy')
plt.scatter(k_range, scores)
plt.xticks([0, 5, 10, 15, 20])

# ---------------------------------------------------------


import json
import nltk
import collections

from himymutil.ml import pos_features
from sklearn import tree
from sklearn.cross_validation import train_test_split

with open("data/import/trained_sentences.json", "r") as json_file:
    json_data = json.load(json_file)

tagged_sents = []
for sentence in json_data:
    tagged_sents.append([(word["word"], word["speaker"]) for word in sentence["words"]])

featuresets = []
for tagged_sent in tagged_sents:
    untagged_sent = nltk.tag.untag(tagged_sent)
    sentence_pos = nltk.pos_tag(untagged_sent)
    for i, (word, tag) in enumerate(tagged_sent):
        featuresets.append((pos_features(untagged_sent, sentence_pos, i), tag))

from sklearn.feature_extraction import DictVectorizer

vec = DictVectorizer()
X = vec.fit_transform([item[0] for item in featuresets]).toarray()

#>> > len(X)
#>> > len(X[0])
#>> > vec.get_feature_names()[10:15]

vec = DictVectorizer()
X = vec.fit_transform([item[0] for item in featuresets]).toarray()
Y = [item[1] for item in featuresets]
X_train, X_test, Y_train, Y_test = train_test_split(X, Y, test_size=0.20, train_size=0.80)

clf = tree.DecisionTreeClassifier()
clf = clf.fit(X_train, Y_train)

import collections
import nltk


def assess(text, predictions_actual):
    refsets = collections.defaultdict(set)
    testsets = collections.defaultdict(set)
    for i, (prediction, actual) in enumerate(predictions_actual):
        refsets[actual].add(i)
        testsets[prediction].add(i)
    speaker_precision = nltk.metrics.precision(refsets[True], testsets[True])
    speaker_recall = nltk.metrics.recall(refsets[True], testsets[True])
    non_speaker_precision = nltk.metrics.precision(refsets[False], testsets[False])
    non_speaker_recall = nltk.metrics.recall(refsets[False], testsets[False])
    return [text, speaker_precision, speaker_recall, non_speaker_precision, non_speaker_recall]


predictions = clf.predict(X_test)
assessment = assess("Decision Tree", zip(predictions, Y_test))

#>>> assessment

with open("/tmp/decisionTree.dot", 'w') as file:
    tree.export_graphviz(clf, out_file=file, feature_names=vec.get_feature_names())

#dot - Tpng / tmp / decisionTree.dot - o / tmp / decisionTree.png

# -----------------------------------------------------------------

import pydotplus
from sklearn.datasets import load_iris
from sklearn import tree

clf = tree.DecisionTreeClassifier(random_state=42)
iris = load_iris()
clf = clf.fit(iris.data, iris.target)
dot_data = tree.export_graphviz(clf,
                                feature_names=iris.feature_names,
                                out_file=None,
                                filled=True,
                                rounded=True,
                                special_characters=True)
graph = pydotplus.graph_from_dot_data(dot_data)
nodes = graph.get_node_list()

for node in nodes:
    if node.get_label():
        values = [int(ii) for ii in node.get_label().split('value = [')[1].split(']')[0].split(',')]
        values = [int(255 * v / sum(values)) for v in values]
        color = '#{:02x}{:02x}{:02x}'.format(values[0], values[1], values[2])
        node.set_fillcolor(color)

graph.write_png('colored_tree.png')

"""
colors =  ('lightblue', 'lightyellow', 'forestgreen', 'lightred', 'white')
for node in nodes:
    if node.get_name() not in ('node', 'edge'):
        values = clf.tree_.value[int(node.get_name())][0]
        #color only nodes where only one class is present
        if max(values) == sum(values):    
            node.set_fillcolor(colors[numpy.argmax(values)])
        #mixed nodes get the default color
        else:
            node.set_fillcolor(colors[-1])
"""

# -----------------------------------------------------------------

import numpy as np
from sklearn.datasets import load_iris
from sklearn import tree
import pydotplus

# load Iris dataset
iris = load_iris()

# picks some data from Iris dataset as test data
# and rest data would be training data
test_idx = [0, 10, 50, 100]

# training data
train_data = np.delete(iris.data, test_idx, axis=0)
train_target = np.delete(iris.target, test_idx)

# testing data
test_data = iris.data[test_idx]
test_target = iris.target[test_idx]

# train classifier
clf = tree.DecisionTreeClassifier()
clf.fit(train_data, train_target)

# display and compare test target and predict target
print ("Test target: ")
print (test_target)
print ("clf.predict: ")
print (clf.predict(test_data))

# output Decision Tree procedure to a PDF file
dot_data = tree.export_graphviz(clf, out_file=None,
                                feature_names=iris.feature_names,
                                class_names=iris.target_names,
                                filled=True, rounded=True,
                                special_characters=True)
graph = pydotplus.graph_from_dot_data(dot_data)
graph.write_pdf("iris.pdf")
graph.write_png('iris.png')

# -----------------------------------------------------------------

"""
Weight (grams)	Smooth (Range of 1 to 10)	Fruit
170	9	1
175	10	1
180	8	1
178	8	1
182	7	1
130	3	0
120	4	0
130	2	0
138	5	0
145	6	0
"""

# Required Python Packages
import pandas as pd
import numpy as np
from sklearn import tree

# creating dataset for modeling Apple / Orange classification
fruit_data_set = pd.DataFrame()
fruit_data_set["fruit"] = np.array([1, 1, 1, 1, 1, 0, 0, 0, 0, 0])  # 0 for orange # 1 for apple
fruit_data_set["weight"] = np.array([170, 175, 180, 178, 182, 130, 120, 130, 138, 145])
fruit_data_set["smooth"] = np.array([9, 10, 8, 8, 7, 3, 4, 2, 5, 6])

fruit_classifier = tree.DecisionTreeClassifier()
fruit_classifier.fit(fruit_data_set[["weight", "smooth"]], fruit_data_set["fruit"])

print ">>>>> Trained fruit_classifier <<<<<"
print fruit_classifier

DecisionTreeClassifier(class_weight=None, criterion='gini', max_depth=None,
                       max_features=None, max_leaf_nodes=None, min_samples_leaf=1,
                       min_samples_split=2, min_weight_fraction_leaf=0.0,
                       presort=False, random_state=None, splitter='best')

# fruit data set 1st observation
test_features_1 = [[fruit_data_set["weight"][0], fruit_data_set["smooth"][0]]]
test_features_1_fruit = fruit_classifier.predict(test_features_1)
print "Actual fruit type: {act_fruit} , Fruit classifier predicted: {predicted_fruit}".format(
    act_fruit=fruit_data_set["fruit"][0], predicted_fruit=test_features_1_fruit)

# fruit data set 3rd observation
test_features_3 = [[fruit_data_set["weight"][2], fruit_data_set["smooth"][2]]]
test_features_3_fruit = fruit_classifier.predict(test_features_3)
print "Actual fruit type: {act_fruit} , Fruit classifier predicted: {predicted_fruit}".format(
    act_fruit=fruit_data_set["fruit"][2], predicted_fruit=test_features_3_fruit)

# fruit data set 8th observation
test_features_8 = [[fruit_data_set["weight"][7], fruit_data_set["smooth"][7]]]
test_features_8_fruit = fruit_classifier.predict(test_features_8)
print "Actual fruit type: {act_fruit} , Fruit classifier predicted: {predicted_fruit}".format(
    act_fruit=fruit_data_set["fruit"][7], predicted_fruit=test_features_8_fruit)

# Weight	Smoot	Fruit	Classifer Predicted
170
9
1
1
180
10
1
1
130
2
0
0


def predict(weight, smoot):
    if weight <= 157.5:
        return 0
    else:
        return 1


with open("fruit_classifier.txt", "w") as f:
    f = tree.export_graphviz(fruit_classifier, out_file=f)

# converting into the pdf file
with open("fruit_classifier.dot", "w") as f:
    f = tree.export_graphviz(fruit_classifier, out_file=f)

dot - Tpdf
fruit_classifier.dot - o
fruit_classifier.pdf
open - a
preview
fruit_classifier.pdf

# -----------------------------------------------------------------

import pandas as pd
import numpy as np
from sklearn.preprocessing import StandardScaler
import tflearn.data_utils as du
from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split
import seaborn as sns
from sklearn.metrics import confusion_matrix
from sklearn.externals.six import StringIO
from IPython.display import Image
from sklearn.tree import export_graphviz
import pydotplus

data = pd.read_csv('../input/column_3C_weka.csv')

# Calculating the correlation matrix
corr = data.corr()
# Generating a heatmap
sns.heatmap(corr, xticklabels=corr.columns, yticklabels=corr.columns)  # Correlation heat map
sns.pairplot(data)  # Pair plot to visualize the correlation

# Splitting the dataset into independent (x) and dependent (y) variables

x = data.iloc[:, :6].values
y = data.iloc[:, 6].values

# Splitting the dataset into train and test data
x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.25, random_state=0)

# Scaling the independent variables
sc = StandardScaler()
x_train = sc.fit_transform(x_train)
x_test = sc.transform(x_test)  #

# Building the Decision tree

classifier = DecisionTreeClassifier(criterion='entropy', max_depth=4)
classifier.fit(x_train, y_train)

# Making the prediction on the test data
y_pred = classifier.predict(x_test)

# What is a confusion matrix
cm = confusion_matrix(y_test, y_pred)
accuracy = sum(cm[i][i] for i in range(3)) / y_test.shape[0]
print("accuracy = " + str(accuracy))

# Visualizing the Decision Tree
dot_data = StringIO()
export_graphviz(classifier, out_file=dot_data,
                filled=True, rounded=True,
                special_characters=True)
graph = pydotplus.graph_from_dot_data(dot_data.getvalue())
Image(graph.create_png())

# Building a model without the max_depth parameter

classifier2 = DecisionTreeClassifier(criterion='entropy')
classifier2.fit(x_train, y_train)
y_pred2 = classifier2.predict(x_test)
cm2 = confusion_matrix(y_test, y_pred2)
accuracy2 = sum(cm2[i][i] for i in range(3)) / y_test.shape[0]
print("accuracy = " + str(accuracy2))

# Visualizing the decision tree without the max_depth parameter
dot_data = StringIO()
export_graphviz(classifier2, out_file=dot_data,
                filled=True, rounded=True,
                special_characters=True)
graph = pydotplus.graph_from_dot_data(dot_data.getvalue())
Image(graph.create_png())

# -----------------------------------------------------------------

# Load libraries
from sklearn.tree import DecisionTreeClassifier
from sklearn import datasets
from IPython.display import Image
from sklearn import tree
import pydotplus

# Load data
iris = datasets.load_iris()
X = iris.data
y = iris.target

# Create decision tree classifer object
clf = DecisionTreeClassifier(random_state=0)

# Train model
model = clf.fit(X, y)

# Create DOT data
dot_data = tree.export_graphviz(clf, out_file=None,
                                feature_names=iris.feature_names,
                                class_names=iris.target_names)

# Draw graph
graph = pydotplus.graph_from_dot_data(dot_data)

# Show graph
Image(graph.create_png())

# Create PDF
graph.write_pdf("iris.pdf")

# Create PNG
graph.write_png("iris.png")







