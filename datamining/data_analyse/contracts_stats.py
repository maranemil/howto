#!/usr/bin/python

import os,sys
import pandas as pd
import numpy as np
#import matplotlib.pylab as plt
import sklearn as sk
from scipy import stats
from sklearn.tree import DecisionTreeRegressor
import matplotlib
import matplotlib.pyplot as plt

# read csv with pandas
os.chdir(".")
df = pd.read_csv('contracte2aP1cut2.csv')
features = list(df.columns[:10]) # show firt 10 columns

# print info about csv
print(df.head()) # print first 4 lines
print(features) # print features
print(len(df)) # print total csv lines

print "------------------------------------------"
X = df.values[:, 1:2] # second col [:, 1:5]
Y = df.values[: -1,9] # last column

print(X) # [['Bucuresti']  ['IASI']  ['Sibiu']]
print(Y) # ['RON' 'RON' 'RON' ..., 'RON' 'RON' 'RON']

print(df.shape) # (92211, 10)
print(df.ndim) # 2
print(df.size) # 922110
print(type(df)) # <class 'pandas.core.frame.DataFrame'>

#import numpy
#a = numpy.asarray([ [1,2,3], [4,5,6], [7,8,9] ])
#numpy.savetxt("contracte2aP1cut2.csv", a, delimiter=",")
#a.tofile('foo.csv',sep=',',format='%10.5f')

#import pandas as pd
#df = pd.DataFrame(np_array)
#df.to_csv("file_path.csv")

from collections import defaultdict
pdf = defaultdict(int)
for x,y in zip(X,Y):
  pdf[x] += y

aResult = pdf.keys()
bResult = pdf.values()



"""

https://data.gov.ro/dataset/achizitii-publice-2007-2015-contracte

http://data.gov.ro/storage/f/2013-11-01T13:59:27.012Z/contracte-2007.csv
http://data.gov.ro/dataset/situatia-executarii-contractelor-de-achizitii-publice-2017
http://data.gov.ro/dataset/contracte-de-achizitii-publice-incheiate-pe-anul-2016
http://data.gov.ro/dataset/contracte_achizitii_publice
http://data.gov.ro/dataset/contracte-de-achizitii-publice-cu-valoare-peste-10-000-euro
http://data.gov.ro/dataset/achizitii-publice-2016-continuare
http://data.gov.ro/dataset/achizitii-publice-2010-2015-anunturi-de-participare
http://data.gov.ro/dataset/achizitii-publice-2010-2015-invitatii-de-participare

"""

