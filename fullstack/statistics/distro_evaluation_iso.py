

# https://www.onlinegdb.com/online_python_compiler
# https://ideone.com/



# https://www.tutorialspoint.com/execute_python_online.php  - support numpy pandas matplotlib math
# https://repl.it/repls/DimLoathsomeTwintext    - support numpy pandas matplotlib math sklearn

import numpy as np
import pandas as pd

import matplotlib.pyplot as pt
from sklearn import linear_model
import math

# https://bigdata-madesimple.com/how-to-run-linear-regression-in-python-scikit-learn/
# https://www.programiz.com/python-programming/array#introduction
# https://pandas.pydata.org/pandas-docs/stable/generated/pandas.DataFrame.assign.html
# https://towardsdatascience.com/building-a-deployable-ml-classifier-in-python-46ba55e1d720
# https://data-science-blog.com/blog/2017/10/17/lineare-regression-in-python-scitkit-learn/
# https://pandas.pydata.org/pandas-docs/stable/basics.html
# https://www.kaggle.com/riteshdash/linear-regression-numpy-pandas-sklearn-matplotlib
# https://docs.scipy.org/doc/numpy-1.15.0/reference/generated/numpy.polyfit.html
# https://www.ritchieng.com/pandas-selecting-multiple-rows-and-columns/
# https://pythonhow.com/accessing-dataframe-columns-rows-and-cells/
# https://bigdata-madesimple.com/how-to-run-linear-regression-in-python-scikit-learn/
# https://pandas.pydata.org/pandas-docs/stable/generated/pandas.DataFrame.set_index.html
# https://towardsdatascience.com/embedding-machine-learning-models-to-web-apps-part-1-6ab7b55ee428
# https://towardsdatascience.com/building-a-deployable-ml-classifier-in-python-46ba55e1d720
# https://dziganto.github.io/data%20science/online%20learning/python/scikit-learn/An-Introduction-To-Online-Machine-Learning/
# https://www.digitalocean.com/community/tutorials/how-to-build-a-machine-learning-classifier-in-python-with-scikit-learn

arDistro = [
("distro","Yes Features","no Features","Score Seconds","Total Score Yes + Time"),
("Manjaro Xfce minimal 0.8.9 x86 64",	5,	0,	10,	15),
("Pop os 18 04 amd64 intel 37",	5,	0,	9,	14),
("Lubuntu 16.04.5 desktop amd64",	4,	1,	9,	13),
("Ubuntu 14.04.5 LTS (Trusty Tahr)",	5,	0,	8,	13),
("Ubuntu 9.04 desktop i386",	3,	2,	10,	13),
("Elementary OS 0.4.1 stable",	5,	0,	7,	12),
("Fuduntu 2013 2 i686 LiteDVD",	3,	2,	9,	12),
("OpenSUSE 11 1 GNOME LiveCD i686",	3,	2,	9,	12),
("Trisquel mini 8.0 amd64",	3,	2,	9,	12),
("Ubuntu 10.04 desktop i386",	3,	2,	9,	12),
("Ubuntu 12.04.5 LTS (Precise Pangolin)",	3,	2,	9,	12),
("Ubuntu 16.04.5 LTS (Xenial Xerus)",	5,	0,	7,	12),
("Black Lab bll 8 unity x86 64",	4,	1,	7,	11),
("LinuxMint 19 xfce 64bit",	4,	1,	7,	11),
("Pure-OS 8 0 gnome 20180904 amd64",	5,	0,	6,	11),
("Ubuntu 18.04.1 desktop amd64",	5,	0,	6,	11),
("Ubuntu 18.10 (Cosmic Cuttlefish) amd64",	5,	0,	6,	11),
("Feren_OS_x64",	5,	0,	5,	10),
("FreeBSD 11 2 RELEASE amd64",	2,	3,	8,	10),
("Kali Linux light 2018 3 amd64",	3,	2,	7,	10),
("Kali linux light 2018 2 amd64",	3,	2,	7,	10),
("RaspberryPi Debian 2017 x86 stretch",	3,	2,	7,	10),
("Debian live 8.5.0 i386 xfce desktop",	2,	3,	7,	9),
("CentOS 7 x86 64 Minimal 1804",	2,	3,	6,	8),
("Debian live 9.5.0 amd64 xfce",	2,	3,	6,	8),
("Red-Hat rhel server 7 5 x86 64",	2,	3,	6,	8),
("Debian 7.11 0 i386 xfce CD 1",	3,	2,	4,	7),
("Fedora Workstation Live x86 64",	5,	0,	2,	7),
("Debian 9.5.0 amd64 xfce CD 1",	2,	3,	4,	6),
("Scientific Linux SL 7 5 x86 64 2018",	2,	3,	3,	5),
("Linux Mint 18 3 xfce 64bit",	4,	1,	0,	4)
]

#df = pd.DataFrame({'A': [1, 2, 3]})
df = pd.DataFrame(arDistro)
#df["Distro"] = np.zeros(df.shape[0])
print(df.head())
print ("--------------------------------------------------------------------")
print(df.columns)
print ("--------------------------------------------------------------------")
#print(df.describe())
#print "--------------------------------------------------------------------"
#print(df.tail(6))
print(df.index)
print(df.loc[3,1]) # row 3, col 1
print ("--------------------------------------------------------------------")

x = df.loc[1:22,1]
y = df.loc[1:22,2]

#print(x)
# eshape your data either using array.reshape(-1, 1)
# if your data has a single feature or array.reshape(1, -1)

from sklearn.linear_model import LinearRegression
#x = np.arange(10000).reshape(-1,1)
#y = np.arange(10000)+100*np.random.random_sample((10000,))
regr = LinearRegression()
print( regr.fit(x,y))
