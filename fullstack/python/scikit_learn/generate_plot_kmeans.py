


# https://repl.it/languages/python3
from sklearn.cluster import KMeans
from sklearn.datasets import make_blobs
from sklearn.model_selection import cross_val_score
import matplotlib.pyplot as plt

# generate random samples
X, y = make_blobs(n_samples=20, n_features=2, centers=5, random_state=1)
# print samples
print(X[:5])
print(y[:5])
print("--------------------")
# KMeans
clf = KMeans(n_clusters=5, random_state=0, max_iter=100).fit(X)
print(clf.labels_)
print("--------------------")
print(clf.predict([[0, 0]]))
y_pred = clf.predict(X)
print("--------------------")
print(clf.cluster_centers_)
print("--------------------")
scores = cross_val_score(clf, X, y, cv=5)
print("KMeans", scores.mean())
print("--------------------")
print (X[:3].shape, y[:3].shape)
print("--------------------")
# Visualizing the blobs as a scatter plot
fig = plt.figure(figsize=(8, 4))
plt.scatter(X[:, 0], X[:, 1], c=y_pred, cmap=plt.cm.Paired)
# plt.scatter(X[:, 0], X[:, 1], s=30, cmap=plt.cm.Paired)
plt.savefig('graph.png')

##################################################################################


import matplotlib as mpl

mpl.use('Agg')
import matplotlib.pyplot as plt
from random import randint

fig = plt.figure(figsize=(10, 8))
ax = fig.add_subplot(111)

points = []
last = 0
bound = 100
for i in range(0, 100):
    last += randint(-bound, bound)
    points.append(last)

ax.plot(points)
fig.savefig('graph.png')


##################################################################################

"""
https://www.dpunkt.de/common/leseproben/12869/3_Daten%20generieren.pdf

import numpy as np
import pandas as pd
import sklearn

from sklearn.cluster import KMeans
from sklearn.neighbors import KNeighborsClassifier
from sklearn.datasets import make_blobs
from sklearn.model_selection import cross_val_score

import matplotlib as mpl
# mpl.use('Agg')
import matplotlib.pyplot as plt
from random import randint


https://shankarmsy.github.io/stories/clustering-sklearn.html
https://nikkimarinsek.com/blog/7-ways-to-label-a-cluster-plot-python
https://docs.scipy.org/doc/numpy-1.15.1/reference/generated/numpy.asarray.html
https://docs.scipy.org/doc/numpy/user/basics.creation.html

import numpy as np
x = np.array([[1,2.0],[0,0],[0,0],[0,0],[88,110],[4,30],[330,770]])
print(x[:20])
#x = np.indices((3,2))
#print(x[:20])

np.random.seed(2)
im = np.zeros((100, 2)) # 100 rows 2 columns
x, y = (2*np.random.random((2, 2))).astype(np.int)
im[x, y] = np.arange(2) # generate list
im[2, 1] = 3 # set 1 at 2 row / col 1
im[4:-84, 0:1] = 2 # set all between 4 and -84 with 1 on first col
print(im[:10]) # print first 30 elements


# generate random samples
X, y = make_blobs(n_samples=100, n_features=2, centers=10, random_state=0)
# X, y = make_blobs(n_samples=[3, 3, 4], centers=3, n_features=2, random_state=0,shuffle=True)
# X, y = make_moons(n_samples=100, noise=0.1)
# X, y = make_circles(n_samples=100, noise=0.05)
# X, y = make_blobs(n_samples=100, n_features=2, centers=2, cluster_std=2.7, random_state=random_state)
# print samples
print(X[:5])
print(y[:5])
# KNeighborsClassifier
# clf = KNeighborsClassifier()
# scores = cross_val_score(clf, X, y, cv=5)
# print("KNeighborsClassifier", scores.mean())
# ---------------------------------
# KMeans
# X = im
clf = KMeans(n_clusters=3, random_state=0, max_iter=100).fit(X)
print(clf.labels_)
print(clf.predict([[0, 0]]))
y_pred = clf.predict(X)
print(clf.cluster_centers_)
scores = cross_val_score(clf, X, y, cv=5)
print("KMeans", scores.mean())
print (X[:3].shape, y[:3].shape)
# y can take values 0,1,2 for 3 clusters but we're going to ignore y for the time being 
# Visualizing the blobs as a scatter plot 
fig = plt.figure(figsize=(10, 8))
ax = fig.add_subplot(111)
plt.scatter(X[:, 0], X[:, 1], c=y_pred, cmap=plt.cm.Paired)
# plt.scatter(X[:, 0], X[:, 1], s=30, cmap=plt.cm.Paired)
plt.savefig('graph.png')

"""
