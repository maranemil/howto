import numpy as np
import sklearn

from sklearn.model_selection import cross_val_score
from sklearn.datasets import make_blobs
from sklearn.ensemble import RandomForestClassifier
from sklearn.ensemble import ExtraTreesClassifier
from sklearn.tree import DecisionTreeClassifier
from sklearn.ensemble import AdaBoostClassifier
from sklearn.ensemble import GradientBoostingClassifier

from sklearn.neighbors import KNeighborsClassifier
from sklearn.naive_bayes import GaussianNB
from sklearn.cluster import KMeans
from sklearn.ensemble import ExtraTreesClassifier



#from sklearn.svm import SVC
from sklearn.svm import LinearSVC


# generate samples
X, y = make_blobs(n_samples=100, n_features=2, centers=10, random_state=0)
# print samples
print(X[:10])
print(y[:10])
#---------------------------------
# DecisionTreeClassifier
clf = DecisionTreeClassifier(max_depth=None, min_samples_split=2, random_state=0)
scores = cross_val_score(clf, X, y, cv=5)
print("DecisionTreeClassifier",  scores.mean())
#---------------------------------
# RandomForestClassifier
clf = RandomForestClassifier(n_estimators=10, max_depth=None, min_samples_split=2, random_state=0)
scores = cross_val_score(clf, X, y, cv=5)
print("RandomForestClassifier", scores.mean())
#---------------------------------
# ExtraTreesClassifier
clf = ExtraTreesClassifier(n_estimators=10, max_depth=None, min_samples_split=2, random_state=0)
scores = cross_val_score(clf, X, y, cv=5)
print("ExtraTreesClassifier", scores.mean())
#---------------------------------
# AdaBoostClassifier
clf = AdaBoostClassifier(n_estimators=10)
scores = cross_val_score(clf, X, y, cv=5)
print("AdaBoostClassifier", scores.mean())
#---------------------------------
# KNeighborsClassifier
clf = KNeighborsClassifier()
scores = cross_val_score(clf, X, y, cv=5)
print("KNeighborsClassifier", scores.mean())
#---------------------------------
# GaussianNB
clf = GaussianNB()
scores = cross_val_score(clf, X, y, cv=5)
print("GaussianNB", scores.mean())
#---------------------------------
# KMeans
#X = np.array([[1, 2], [1, 4], [1, 0], [4, 2], [4, 4], [4, 0]])
clf = KMeans(n_clusters=2, random_state=0).fit(X)
scores = cross_val_score(clf, X, y, cv=5)
print("KMeans", scores.mean())
print(clf.labels_)
print(clf.predict([[0, 0]]))
print(clf.cluster_centers_)
#---------------------------------
# ExtraTreesClassifier
clf = ExtraTreesClassifier(n_estimators=10,max_features=2, n_jobs=1, random_state=0)
scores = cross_val_score(clf, X, y, cv=5)
print("ExtraTreesClassifier", scores.mean())
clf.fit(X, y)
print(clf.feature_importances_)
print(clf.predict([[0, 0]]))
#---------------------------------
# LinearSVC
clf = LinearSVC(random_state=0, tol=0.1, max_iter=2000)
scores = cross_val_score(clf, X, y, cv=5)
print("LinearSVC", scores.mean())
clf.fit(X, y)
print(clf.predict([[0, 0]]))
#---------------------------------
# GradientBoostingClassifier
from sklearn.datasets import make_hastie_10_2
X, y = make_hastie_10_2(random_state=0)
X_train, X_test = X[:2000], X[2000:]
y_train, y_test = y[:2000], y[2000:]

clf = GradientBoostingClassifier(n_estimators=100, learning_rate=1.0,    max_depth=1, random_state=0).fit(X_train, y_train)
print("GradientBoostingClassifier", clf.score(X_test, y_test))

"""

https://repl.it/repls/BrilliantNextDistributeddatabase

OUTPUT


Python 3.6.1 (default, Dec 2015, 13:05:11)
[GCC 4.8.2] on linux
[[ 0.80247216  1.67515402]
 [-3.15710236  3.38066452]
 [-1.65143272  9.05790509]
 [ 0.44136967  0.68492338]
 [-2.19936446  2.5583291 ]
 [-1.12456237  2.23307217]
 [ 6.13273894  1.90428429]
 [ 1.29264962 10.22527549]
 [-9.07731129 -6.32788195]
 [ 1.2624387   7.84845448]]
[1 2 3 1 2 2 5 6 7 6]
DecisionTreeClassifier 0.85
RandomForestClassifier 0.86
ExtraTreesClassifier 0.8699999999999999
AdaBoostClassifier 0.4
KNeighborsClassifier 0.9199999999999999
GaussianNB 0.9
KMeans -743.4116240150582
[1 1 1 1 1 1 1 1 0 1 1 1 1 1 1 1 1 1 1 1 1 0 1 1 1 1 1 1 1 1 1 0 1 1 0 1 0
 0 1 1 1 0 1 0 1 1 1 1 0 0 1 1 1 1 1 1 1 1 0 1 1 0 0 0 1 1 1 1 1 1 0 1 1 1
 1 1 0 1 1 1 1 1 1 0 1 1 1 1 1 1 1 0 1 0 1 1 1 1 0 1]
[1]
[[-9.29484301 -1.04674501]
 [ 2.78132112  3.92338042]]
ExtraTreesClassifier 0.8799999999999999
[0.58634434 0.41365566]
[1]
LinearSVC 0.7799999999999999
[1]
GradientBoostingClassifier 0.913





from sklearn.linear_model import LogisticRegression
from sklearn.tree import DecisionTreeClassifier
from sklearn.svm import SVC
from sklearn.ensemble import RandomForestClassifier
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis, QuadraticDiscriminantAnalysis
from sklearn.cluster import KMeans
from sklearn.neighbors import KNeighborsClassifier
from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import precision_recall_fscore_support
from sklearn.metrics import mean_squared_error as mse
from sklearn.preprocessing import StandardScaler
from sklearn.model_selection import cross_validate
from sklearn.model_selection import train_test_split
from sklearn.ensemble import ExtraTreesClassifier
from sklearn.feature_selection import SelectFromModel
from sklearn.svm import LinearSVC
from sklearn.ensemble import VotingClassifier
from sklearn.feature_selection import RFECV


https://scikit-learn.org/stable/modules/generated/sklearn.preprocessing.StandardScaler.html
https://www.kaggle.com/sameer99/kernel176d2219ea
https://www.kaggle.com/klaudiajankowska/binary-classification-methods-comparison
https://scikit-learn.org/stable/modules/generated/sklearn.svm.LinearSVC.html
https://www.scipy.org/scikits.html
https://scikit-image.org/
https://scikit-learn.org/stable/auto_examples/ensemble/plot_forest_importances_faces.html
https://scikit-learn.org/stable/modules/ensemble.html#random-forests
https://scikit-learn.org/stable/supervised_learning.html#supervised-learning
https://scikit-learn.org/stable/

"""