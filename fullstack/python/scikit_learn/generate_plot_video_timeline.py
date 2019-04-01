
import matplotlib.pyplot as plt
y_values = ['Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Desi Lydic', 'Desi Lydic', 'Desi Lydic', 'Desi Lydic', 'Desi Lydic', 'Ronny Chieng', 'Ronny Chieng', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Roy Wood Jr.', 'Roy Wood Jr.', 'Roy Wood Jr.', 'Roy Wood Jr.', 'Roy Wood Jr.', ' Young-White', ' Young-White', ' Young-White', ' Young-White', ' Young-White', 'Michael Kosta', 'Michael Kosta', 'Michael Kosta', 'Michael Kosta' ]
x_values = [7, 13, 11, 2, 33, 47, 8, 14, 26, 18, 15, 12, 3, 17, 7, 40, 4, 12, 16, 15, 48, 13, 11, 18, 15, 18, 4, 24, 13, 11, 36, 35, 2, 236, 31, 249, 179, 112, 18, 2, 136, 12, 13, 117, 70, 108, 36, 48, 5, 18, 64, 37, 35, 8, 123, 23, 28, 41, 33, 26, 16, 26, 11, 108, 68 ]
# Customize plot.
plt.figure(figsize=(8, 6))
plt.title("The Daily Show News Team Live | SXSW 2019", fontsize=10)
plt.xlabel('speakers’ interventions in seconds', fontsize=10)
plt.ylabel('Guests', fontsize=10)
plt.tick_params(axis='both', labelsize=9)
plt.axis([0, 260, -1, 8])
plt.scatter(x_values, y_values, s=50, color='r', linewidth=0.5)
plt.savefig("graph.png")
# https://repl.it/languages/python3
# http://phptester.net/

####################################################################

import matplotlib.pyplot as plt

names = ['Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Jake ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Trevor ', 'Desi ', 'Desi ', 'Desi ', 'Desi ', 'Desi ', 'Ronny ', 'Ronny ', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Roy ', 'Roy ', 'Roy ', 'Roy ', 'Roy ', ' Young-White', ' Young-White', ' Young-White', ' Young-White', ' Young-White', 'Michael ', 'Michael ', 'Michael ', 'Michael ' ]
values = [7, 13, 11, 2, 33, 47, 8, 14, 26, 18, 15, 12, 3, 17, 7, 40, 4, 12, 16, 15, 48, 13, 11, 18, 15, 18, 4, 24, 13, 11, 36, 35, 2, 236, 31, 249, 179, 112, 18, 2, 136, 12, 13, 117, 70, 108, 36, 48, 5, 18, 64, 37, 35, 8, 123, 23, 28, 41, 33, 26, 16, 26, 11, 108, 68 ]

plt.figure(figsize=(12, 6))
plt.figure(1,figsize=(26, 6))
#plt.figure(1, figsize=(26, 6))
plt.subplot(131)
plt.bar(names, values)
plt.subplot(132)
plt.scatter(names, values,s=50, color='r', linewidth=0.9)
plt.subplot(133)
plt.plot(names, values, color='g')
plt.suptitle('Categorical Plotting')
plt.savefig("graph.png")

#####################################################################

from sklearn.cluster import KMeans
from sklearn.model_selection import cross_val_score
import matplotlib.pyplot as plt
import numpy as np

# generate random samples
y = ['Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Jake Tapper', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Trevor Noah', 'Desi Lydic', 'Desi Lydic', 'Desi Lydic', 'Desi Lydic', 'Desi Lydic', 'Ronny Chieng', 'Ronny Chieng', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Dulcé Sloan', 'Roy Wood Jr.', 'Roy Wood Jr.', 'Roy Wood Jr.', 'Roy Wood Jr.', 'Roy Wood Jr.', ' Young-White', ' Young-White', ' Young-White', ' Young-White', ' Young-White', 'Michael Kosta', 'Michael Kosta', 'Michael Kosta', 'Michael Kosta' ]
X = np.array([[7],[13], [11], [2], [33], [47], [8], [14], [26], [18], [15], [12], [3], [17], [7], [40], [4], [12], [16], [15], [48], [13], [11], [18], [15], [18], [4], [24], [13], [11], [36], [35], [2], [236], [31], [249], [179], [112], [18], [2], [136], [12], [13], [117], [70], [108], [36], [48], [5], [18], [64], [37], [35], [8], [123], [23], [28], [41], [33], [26], [16], [26], [11], [108], [68] ])
X.shape
#X = X.reshape(-2,1)
print(X[:5])
print(y[:5])
print("--------------------")
# KMeans
clf = KMeans(n_clusters=5, random_state=0, max_iter=100).fit(X)
print(clf.labels_)
print("--------------------")
print(clf.predict([[1]]))
y_pred = clf.predict(X)
print("--------------------")
print(clf.cluster_centers_)
print("--------------------")
scores = cross_val_score(clf, X, y, cv=5)
print("KMeans", scores.mean())
print("--------------------")
print (X[:1].shape)
print("--------------------")
# Visualizing the blobs as a scatter plot
fig = plt.figure(figsize=(10, 6))
plt.scatter(X, y, c=y_pred, cmap=plt.cm.Paired)
plt.savefig('graph.png')