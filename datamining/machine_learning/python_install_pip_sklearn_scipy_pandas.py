#!/usr/bin/python
# -*- coding: utf-8 -*-

"""
cd /opt
#wget http://repo.continuum.io/archive/Anaconda3-4.0.0-Linux-x86_64.sh
sudo wget https://repo.continuum.io/archive/Anaconda2-4.4.0-Linux-x86_64.sh
bash Anaconda3-4.0.0-Linux-x86_64.sh
conda list
conda update conda

# https://repo.continuum.io/archive/
# https://pip.pypa.io/en/stable/


#################################
# Python 3.5
#################################

sudo apt install python3-pip
pip3 install sklearn
pip3 install numpy
pip3 install scipy
pip3 install graphviz

################################
# Python 2.7
################################

sudo apt install python-pip

pip install sklearn
pip install numpy
pip install scipy
pip install graphviz

pip list
pip list --outdated
pip search "query"

sudo pip install [package_name] --upgrade
pip install $(pip list --outdated | awk '{ print $1 }') --upgrade

sudo chmod +x pip-upgrade
sudo cp pip-upgrade /usr/bin/


# pip install graphviz
# sudo apt install linuxbrew-wrapper
# brew install graphviz
# sudo apt-get install graphviz
# conda install graphviz

----------------------------------------------------

sudo apt install weka

Weka tree graphs:

- trees.J48 # ***
- trees.RandomTree # ***
- trees.J48graft # ***
- trees.ADTree
- meta.FilteredClassifier # ***
- bayes.BayesNet


"""

"""

http://scikit-learn.org/stable/modules/tree.html
http://scikit-learn.org/stable/auto_examples/tree/plot_unveil_tree_structure.html
http://scikit-learn.org/stable/auto_examples/ensemble/plot_adaboost_regression.html
http://scikit-learn.org/stable/modules/generated/sklearn.tree.export_graphviz.html
http://scikit-learn.org/stable/auto_examples/tree/plot_tree_regression_multioutput.html

"""

from sklearn import tree
X = [[0, 0], [1, 1]]
Y = [0, 1]
clf = tree.DecisionTreeClassifier()
clf = clf.fit(X, Y)
clf.predict([[2., 2.]])
clf.predict_proba([[2., 2.]])
tree.export_graphviz(clf, out_file='tree.dot')


from sklearn.datasets import load_iris
from sklearn import tree
clf = tree.DecisionTreeClassifier()
iris = load_iris()
clf = clf.fit(iris.data, iris.target)
tree.export_graphviz(clf,   out_file='tree2.dot')


"""
from sklearn.datasets import load_iris
from sklearn import tree
iris = load_iris()
clf = tree.DecisionTreeClassifier()
clf = clf.fit(iris.data, iris.target)
"""


"""
import graphviz
dot_data = tree.export_graphviz(clf, out_file=None)
graph = graphviz.Source(dot_data)
graph.render("iris")
dot_data = tree.export_graphviz(clf, out_file=None,
                 feature_names=iris.feature_names,
                 class_names=iris.target_names,
                 filled=True, rounded=True,
                 special_characters=True)
graph = graphviz.Source(dot_data)
graph

"""