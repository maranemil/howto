"""
pip3 install opencv-python  numpy pandas scipy matplotlib tensorflow scikit-learn
sudo apt-get install python3-tk
pip3 install --upgrade pandas
pip3 install plotting


pip3 install pandas
pip3 install -U numpy
pip3 install -U scipy


https://scikit-learn.org/stable/modules/neighbors.html
https://jakevdp.github.io/PythonDataScienceHandbook/04.02-simple-scatter-plots.html
https://matplotlib.org/gallery/shapes_and_collections/scatter.html
https://matplotlib.org/gallery/mplot3d/scatter3d.html
"""

from sklearn.neighbors import NearestNeighbors
from sklearn.cluster import KMeans
from sklearn.datasets import make_blobs
from sklearn.model_selection import cross_val_score
import numpy as np
import matplotlib.pyplot as plt
import pandas as pd


X, y = make_blobs(n_samples=6, n_features=3, centers=5, random_state=1)
"""
X = np.array([[-1, -1, 25], [-2, -1, 54], [-3, -2, 62], [1, 1, 73], [2, 1, 89], [3, 2, 93]])
z = np.unique(X).shape[0]
y = np.array([1, 9, 1, 0, 1, 1])
"""
nbrs = NearestNeighbors(n_neighbors=3, algorithm='ball_tree').fit(X)
distances, indices = nbrs.kneighbors(X)
print("------y,X //--------")
print(y)
print(X)
print("------indices,distances //--------")
print(indices)
print(distances)
print(nbrs.kneighbors_graph(X).toarray())
print("------clf.labels_ //---------")
clf = KMeans(n_clusters=2, random_state=0, max_iter=100).fit(X)
print(clf.labels_)
print("------- predict //-------------")
print(clf.predict([[0, 0, 4]]))
y_pred = clf.predict(X)
print("--------cluster center //------------")
print(clf.cluster_centers_)
print("--------------------")
scores = cross_val_score(clf, X, y, cv=5)
print("------Scores Mean //--------------")
print("KMeans", scores.mean())
print("---------Shape //-----------")
print (X[:3].shape, y[:3].shape)
print("-------PLT-------------")
fig = plt.figure(figsize=(4, 6))
plt.scatter(X[:, 0], X[:, 1], c=y_pred, s=31, alpha=1.0, cmap=plt.get_cmap('viridis'), marker = 'o')
plt.scatter(X[:, 0], X[:, 2], c=y_pred, s=41, alpha=0.9, cmap=plt.cm.Paired) # RdYlGn c='darkred'
plt.colorbar().set_label("elevation (m)", labelpad=+1)
# plt.scatter(X[:, 0], X[:, 1], s=30, cmap=plt.cm.Paired)
#ind = np.arange(6)
#plt.xticks(ind,(1,2,3,4,5,6) )
plt.title("Point observations")
plt.xlabel("Values")
plt.ylabel("Labels")
# plt.savefig('graph.png')
plt.show()

from mpl_toolkits.mplot3d import Axes3D
fig = plt.figure()
ax = fig.add_subplot(111, projection='3d')
ax.scatter(X[:, 0], X[:, 1],  X[:, 2],c=y_pred, s=65)
ax.set_xlabel('X Label')
ax.set_ylabel('Y Label')
ax.set_zlabel('Z Label')
plt.show()

