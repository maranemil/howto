"""
###############################################
Hello World - Machine Learning Recipes #1
https://www.youtube.com/watch?v=cKxRvEZd3Mw&list=PLOU2XLYxmsIIuiBfYad6rFYQU_jL2ryal
###############################################
// write py file
"""

# https://www.youtube.com/watch?v=cKxRvEZd3Mw Hello World - Machine Learning Recipes #1
# https://repl.it/languages/python3


from sklearn import tree

features = [[140, 1], [130, 1], [150, 0], [170, 0]]
labels = [0, 0, 1, 1]
clf = tree.DecisionTreeClassifier()
clf = clf.fit(features, labels)
print(clf.predict([[160, 0]]))

"""
weight 	texture	label
150g	bumpy	orange
170g	bumpy	orange
140g	smooth	apple
130g	smooth	apple
"""

# https://www.youtube.com/watch?v=tNa99PG8hR8 Visualizing a Decision Tree - Machine Learning Recipes

from sklearn.datasets import load_iris
from sklearn import tree

iris = load_iris()
print(iris.feature_names)
print(iris.target_names)
print(iris.data[0])
print(iris.target[0])

for i in range(len(iris.target)):
    print("Ex %d: label %s, feat %s " % (i, iris.target[i], iris.data[i]))

test_idx = [0, 50, 100]
# training data
train_target = np.delete(iris.target, test_idx)
train_data = np.delete(iris.data, test_idx, axis=0)
# testing data
test_target = iris.target[test_idx]
test_data = iris.data[test_idx]

clf = tree.DecisionTreeClassifier()
clf = clf.fit(train_data, train_target)
print(test_target)
print(clf.predict(test_data))
# tree.export_graphviz(clf,   out_file='tree2.dot')

from sklearn.externals.six import StringIO
import pydot

dot_data = StringIO()
tree.export_graphviz(
    clf,
    out_file=dot_data,
    feature_names=iris.feature_names,
    class_names=iris.target_names,
    filled=True, rounded=True,
    impurity=False
)
graph = pydot.graph_from_dot_data(dot_data.getvalue())
graph.write_pdf("iris.pdf")

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

# https://www.youtube.com/watch?v=N9fDIAflCMY  What Makes a Good Feature? - Machine Learning Recipes #3
# https://www.youtube.com/watch?v=84gqSbLcBFE  Let’s Write a Pipeline - Machine Learning Recipes #4
# https://www.youtube.com/watch?v=AoeEHqVSNOw  Writing Our First Classifier - Machine Learning Recipes #5
# https://www.youtube.com/watch?v=cSKfRcEDGUs  Train an Image Classifier with TensorFlow for Poets - Machine Learning Recipes #6
# https://www.youtube.com/watch?v=Gj0iyo265bc  Classifying Handwritten Digits with TF.Learn - Machine Learning Recipes #7
# https://www.youtube.com/watch?v=LDRbO9a6XPU  Let’s Write a Decision Tree Classifier from Scratch - Machine Learning Recipes #8
# https://www.youtube.com/watch?v=d12ra3b_M-0  Intro to Feature Engineering with TensorFlow - Machine Learning Recipes #9
# https://www.youtube.com/watch?v=TF1yh5PKaqI  Getting Started with Weka - Machine Learning Recipes #10


# https://www.youtube.com/watch?v=fNxaJsNG3-s  Natural Language Processing - Tokenization (NLP Zero to Hero, part 1)
# https://www.youtube.com/watch?v=Y_hzMnRXjhI  Training a model to recognize sentiment in text (NLP Zero to Hero, part 3)


# https://www.youtube.com/watch?v=KNAWp2S3w94  Intro to Machine Learning (ML Zero to Hero, part 1)
# https://www.youtube.com/watch?v=bemDFpNooA8  Basic Computer Vision with ML (ML Zero to Hero, part 2)
# https://www.youtube.com/watch?v=x_VrgWTKkiM  Introducing convolutional neural networks (ML Zero to Hero, part 3)
# https://www.youtube.com/watch?v=u2TjZzNuly8  Build an image classifier (ML Zero to Hero, part 4)

# https://www.youtube.com/watch?v=BO4g2DRvL6U  Prepare your data for ML | Text Classification Tutorial Pt. 1 (Coding TensorFlow)


# https://www.youtube.com/watch?v=Y_hzMnRXjhI&list=PLQY2H8rRoyvwLbzbnKJ59NkZvQAW9wLbx

"""
TensorFlow high-level APIs: Part 1 - loading data           https://www.youtube.com/watch?v=oFFbKogYdfc
Saving and Loading Models (Coding TensorFlow)               https://www.youtube.com/watch?v=HxtBIwfy0kM
Use TensorFlow to classify clothing images (Coding TensorFlow) https://www.youtube.com/watch?v=FiNglI1wRNk
Intro to Machine Learning (ML Zero to Hero - Part 1)        https://www.youtube.com/watch?v=KNAWp2S3w94
Build an image classifier (ML Zero to Hero - Part 4)        https://www.youtube.com/watch?v=u2TjZzNuly8
Using TensorBoard with Keras (TensorFlow Tip of the Week)   https://www.youtube.com/watch?v=2U6Jl7oqRkM
"""

import ternsorflow as tf
tf.enable_eager_execution()
#tf.__version___

a = tf.constnt(5)
b = a + 3
print(b)

defaults = [tf.int32] * 55
dataset = tf.contrib.dataCsvDataset(['convtype.csv.train'], detaults)
print(list(dataset.take(1)))

col_names = ['elevation', 'aspect', ...]


def _parse_csv_row(*vals):
    soil_type_t = tf.convert_to_tensor(vals[14:54])  # combine all vals in one tensor
    feat_vals = vals[:10] + (soil_type_t, vals[54])
    features = dict(zip(col_names, feat_vals))
    class_label = tf.argmax(row_vals[10, 14], axis=8)
    return features, class_label


dataset = dataset.map(_parse_csv_row).batch(64)
print(list(dataset.take(1)))
