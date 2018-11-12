import numpy as np
import pandas as pd

import matplotlib.pyplot as pt
from sklearn import linear_model
import math


arDistro = [
#("distro","yes","no","score","total"),
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
df = pd.DataFrame(arDistro, columns=['distro', 'yes','no', 'score', 'total'])

#df2 = pd.Series(np.random.randn(5), index=['a', 'b', 'c', 'd', 'e'])
#print(df2)
print(df)

#df_dict = df.to_dict()
print ("--------------------------------------------------------------------")
#df["Distro"] = np.zeros(df.shape[0])
print(df.head())
print ("--------------------------------------------------------------------")
print(df.columns)
print ("--------------------------------------------------------------------")
#print(df.describe())
#print "--------------------------------------------------------------------"
#print(df.tail(6))
print(df.index)
print ("--------------------------------------------------------------------")
print(df['yes'][:4])
print ("--------------------------------------------------------------------")
x = df['yes']
y = df['score']

s1 = pd.Series(np.arange(5,10))
print(s1.dot(s1))


"""
from sklearn.linear_model import LinearRegression
#x = np.arange(10000).reshape(-1,1)
#y = np.arange(10000)+100*np.random.random_sample((10000,))
regr = LinearRegression()
print ("--------------------------------------------------------------------")
print( regr.fit(x.reshape(1, -1),y.reshape(1, -1)))
print ("--------------------------------------------------------------------")
print( regr.predict(x.reshape(1, -1)))
"""
# https://pandas.pydata.org/pandas-docs/stable/generated/pandas.DataFrame.loc.html
# https://pandas.pydata.org/pandas-docs/stable/dsintro.html
# https://scikit-learn.org/stable/auto_examples/linear_model/plot_ols.html