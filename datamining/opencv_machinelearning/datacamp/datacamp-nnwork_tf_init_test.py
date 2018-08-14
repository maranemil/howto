# Import `tensorflow` 
import tensorflow as tf

# Initialize two constants
x1 = tf.constant([1,2,3,4])
x2 = tf.constant([5,6,7,8])

# Multiply
result = tf.multiply(x1, x2)

# Intialize the Session
sess = tf.Session()

# Print the result
print(sess.run(result))

# Close the session
sess.close()

"""
http://scikit-learn.org/stable/modules/generated/sklearn.preprocessing.MinMaxScaler.html
http://scikit-learn.org/stable/modules/generated/sklearn.preprocessing.StandardScaler.html
http://scikit-learn.org/stable/modules/preprocessing.html
http://scikit-learn.org/stable/auto_examples/preprocessing/plot_all_scaling.html
http://scikit-learn.org/stable/modules/generated/sklearn.datasets.load_digits.html

https://www.datacamp.com/community/tutorials/machine-learning-python#preprocess
https://pythonprogramming.net/machine-learning-clustering-introduction-machine-learning-tutorial/
http://www.astroml.org/book_figures/chapter6/fig_kmeans_metallicity.html
http://mdtraj.org/1.3.0/examples/pca.html
http://ogrisel.github.io/scikit-learn.org/sklearn-tutorial/modules/generated/sklearn.decomposition.RandomizedPCA.html

https://pandas.pydata.org/pandas-docs/stable/generated/pandas.read_csv.html
https://pymotw.com/2/csv/
https://docs.python.org/3.1/library/csv.html
https://docs.python.org/2/library/csv.html
https://pythonprogramming.net/reading-csv-files-python-3/
https://github.com/scikit-optimize/scikit-optimize/issues/617

"""
