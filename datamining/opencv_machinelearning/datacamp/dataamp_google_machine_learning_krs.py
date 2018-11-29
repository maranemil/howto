

#########################################################
#
#	Hello World - Machine Learning Recipes #
#	https://www.youtube.com/watch?v=cKxRvEZd3Mw
#	https://www.youtube.com/watch?v=tNa99PG8hR8
#	https://scikit-learn.org/stable/modules/generated/sklearn.tree.export_graphviz.html
#
#########################################################

import sklearn
features = [[140,"smooth"],[130,"smooth"],[150,"bumpy"],[170,"bumpy"]]
labels = ["apple","apple","orange","orange"]

from sklearn import tree
features = [[140,1],[130,1],[150,1],[170,0]]
labels = [0,0,1,1]
clf = tree.DecisionTreeClassifier()
clf = clf.fit(features, labels)
print(clf.predict([[160,0]]))

# ....

from sklearn.datasets import load_iris
iris = load_iris()
print iris.feature_names
print iris.target_names
print iris.data[0]
print iris.target0]
for i in range(len(iris.target)):
	print "Example %d: label %s, features %s" % (i,iris.target[i], iris.data[i])


import numpy as np
from sklearn.datasets import load_iris
from sklearn import tree

iris = load_iris()
test_idx = [0,50,100]

# train data
train_target = np.delete(iris.target, test_idx)
train_data = np.delete(iris.data, test_idx, axis = 0)

# test data
test_target = iris.target[test_idx]
test_data = iris.target[test_idx]

clf = tree.DecisionTreeClassifier()
clf.fit(train_data,train_target)

print test_target
print clf.predict(test_data)

# viz code
from sklearn.externals.six import StringIO
import pydot
dot_data = StringIO()
tree.export_graphviz(clf,
        out_file=dot_data,
        feature_names=iris.feature_names,
        class_names=iris.target_names,
        filled=True, rounded=True,
        impurity=False)

graph = pydot.graph_from_dot_data(dot_data.getvalue())
graph.write_pdf("iris.pdf")

#graph = pydot.graph_from_dot_data(dot_data.getvalue())
#graph[0].write_pdf("iris.pdf")

#import pydotplus
#...
#graph = pydotplus.graph_from_dot_data(dot_data.getvalue())
#graph.write_pdf("iris.pdf")


"""

from sklearn.externals.six import StringIO  
import pydot 
dot_data = StringIO() 
tree.export_graphviz(clf, out_file=dot_data) 
graph = pydot.graph_from_dot_data(dot_data.getvalue()) 
graph.write_pdf("iris.pdf") 

from IPython.display import Image  
dot_data = StringIO()  
tree.export_graphviz(clf, out_file=dot_data,  
                         feature_names=iris.feature_names,  
                         class_names=iris.target_names,  
                         filled=True, rounded=True,  
                         special_characters=True)  
graph = pydot.graph_from_dot_data(dot_data.getvalue())  
Image(graph.create_png())

"""

"""

R IRIS
library(GGally)
df <- read.csv(file="c:\\IrisAnalysis\\IrisData.csv", header=TRUE, sep=",")
aggregate(df[, 1:4], list(df$Irisart), mean)
ggpairs(df, aes(colour = Irisart, alpha = 0.4))

"""

Python IRIS
import pandas as pd
import seaborn as sns
df = pd.read_csv('IrisData.csv', delimiter=',', header=0, index_col=False)
groupedData = df.groupby('Irisart')
meanValues  = groupedData[['Kelchblattlaenge in cm', 'Kelchblattbreite in cm',
                            'Bluetenblattlaenge in cm', 'Bluetenblattbreite in cm']].mean()
print(meanValues.to_string())
sns.set(style="ticks")
sns.pairplot(df, hue="Irisart")

"""

iris.csv
https://gist.github.com/curran/a08a1080b88344b0c8a7
https://raw.githubusercontent.com/uiuc-cse/data-fa14/gh-pages/data/iris.csv
https://raw.githubusercontent.com/rhiever/Data-Analysis-and-Machine-Learning-Projects/master/example-data-science-notebook/iris-data.csv

sepal_length	sepal_width	petal_length	petal_width	species
5.1	3.5	1.4	0.2	setosa
4.9	3.0	1.4	0.2	setosa
4.7	3.2	1.3	0.2	setosa
6.4	3.2	4.5	1.5	versicolor
6.9	3.1	4.9	1.5	versicolor
5.5	2.3	4.0	1.3	versicolor
6.2	2.8	4.8	1.8	virginica
6.1	3.0	4.9	1.8	virginica
6.4	2.8	5.6	2.1	virginica

"""


