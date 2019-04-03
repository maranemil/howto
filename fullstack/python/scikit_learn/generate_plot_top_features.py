# sudo apt install python3-pip
# sudo apt-get install python3-tk
#pip3 install pandas
#pip3 install sklearn
#pip3 install matplotlib
#pip3 install python-tk # tkinter

# python3 file.py

import pandas as pd
import tkinter as tk
import numpy as np
import pylab

from pandas.plotting import scatter_matrix
import matplotlib.pyplot as plt

from sklearn.feature_selection import SelectKBest
from sklearn.feature_selection import chi2
import seaborn as sns

np.random.seed(19680801)
#tk._test()
filename = "invitatiiparticipare-2018-t1.csv"
df = pd.read_csv(filename, delimiter="^", dtype={'Judet': np.str,'ValoareEstimata': np.float} ); #,nrows=2000

col = df.columns
print(col)

impraw =  pd.DataFrame(df)
print(impraw.count())
print(impraw.describe())
print(impraw.columns)
print(impraw.info())
print(impraw.head(5))

fig, ax = plt.subplots(  ncols=4, figsize=(6, 6)) # nrows=2,

judete = impraw['Judet'].value_counts()
ax[0].tick_params(axis='x', labelsize=8)
ax[0].tick_params(axis='y', labelsize=8)
ax[0].set_xlabel('Judet', fontsize=8)
ax[0].set_ylabel('Total' , fontsize=8)
ax[0].set_title('Top5 Judet ', fontsize=8, fontweight='bold')
ax[0].plot(judete[:5],color='r')
#ax[0].bar(judete[:5],judete[:5],color='r')
#plt.axhline(0,  color='red');

TipContract = impraw['TipContract'].value_counts()
ax[1].tick_params(axis='x', labelsize=8)
ax[1].tick_params(axis='y', labelsize=8)
ax[1].set_xlabel('Tip Contract', fontsize=8)
ax[1].set_ylabel('Total' , fontsize=8)
ax[1].set_title('Top5 Tip Contract ', fontsize=8, fontweight='bold')
ax[1].plot(TipContract[:5],color='g')

Moneda = impraw['Moneda'].value_counts()
ax[2].tick_params(axis='x', labelsize=8)
ax[2].tick_params(axis='y', labelsize=8)
ax[2].set_xlabel('Moneda', fontsize=8)
ax[2].set_ylabel('Total' , fontsize=8)
ax[2].set_title('Top5 Moneda ', fontsize=8, fontweight='bold')
ax[2].plot(Moneda[:5])

FonduriComunitare = impraw['FonduriComunitare'].value_counts()
ax[3].tick_params(axis='x', labelsize=8)
ax[3].tick_params(axis='y', labelsize=8)
ax[3].set_xlabel('Fonduri Comunitare', fontsize=8)
ax[3].set_ylabel('Total' , fontsize=8)
ax[3].set_title('Top5 Fonduri Comunitare ', fontsize=8, fontweight='bold')
ax[3].plot(FonduriComunitare[:5])

fig.subplots_adjust(top=0.835,
bottom=0.43,
left=0.105,
right=0.891,
hspace=0.23,
wspace=0.285)

fig.suptitle('Filename: '+ filename, fontsize=11)
fig.suptitle('http://data.gov.ro/dataset/achizitii-publice-2018 ', fontsize=11)


plt.show()


# pd.read_csv(my_path, dtype={'id' : np.int})
# pd.read_csv(my_path, dtype={'id' : np.str})
# pd.read_csv(my_path, dtype={'id' : str})


"""
# https://www.datacamp.com/community/tutorials/pandas-read-csv
# https://www.marsja.se/pandas-read-csv-tutorial-to-csv/
# https://honingds.com/blog/pandas-read_csv/
# https://www.ritchieng.com/pandas-changing-datatype/
# https://pbpython.com/pandas_dtypes.html
# https://rushter.com/blog/pandas-data-type-inference/
# https://pandas.pydata.org/pandas-docs/stable/user_guide/visualization.html
# https://docs.scipy.org/doc/numpy-1.13.0/numpy-user-1.13.0.pdf
# https://github.com/pandas-dev/pandas/blob/master/pandas/plotting/_misc.py
# http://jonathansoma.com/lede/algorithms-2017/classes/fuzziness-matplotlib/understand-df-plot-in-pandas/
# https://asecuritysite.com/bigdata/pandas_scatter
# https://pandas.pydata.org/pandas-docs/stable/reference/api/pandas.plotting.bootstrap_plot.html
# https://matplotlib.org/gallery/shapes_and_collections/scatter.html#sphx-glr-gallery-shapes-and-collections-scatter-py
# https://matplotlib.org/api/_as_gen/matplotlib.pyplot.scatter.html
# https://scikit-learn.org/stable/auto_examples/datasets/plot_random_multilabel_dataset.html
# https://matplotlib.org/gallery/shapes_and_collections/scatter.html
# https://scikit-learn.org/stable/auto_examples/datasets/plot_random_dataset.html
https://python-graph-gallery.com/191-custom-axis-on-matplotlib-chart/
https://pandas.pydata.org/pandas-docs/stable/user_guide/visualization.html

https://matplotlib.org/api/_as_gen/matplotlib.pyplot.subplots.html#matplotlib.pyplot.subplots
https://undocumentedmatlab.com/blog/bar-plot-customizations
https://matplotlib.org/gallery/subplots_axes_and_figures/subplots_demo.html
https://www.physi.uni-heidelberg.de/Einrichtungen/AP/python/subplot.html
https://jakevdp.github.io/PythonDataScienceHandbook/04.08-multiple-subplots.html
https://matplotlib.org/gallery/pyplots/align_ylabels.html#sphx-glr-gallery-pyplots-align-ylabels-py
https://matplotlib.org/gallery/lines_bars_and_markers/bar_stacked.html#sphx-glr-gallery-lines-bars-and-markers-bar-stacked-py
https://matplotlib.org/api/_as_gen/matplotlib.pyplot.subplots.html
https://matplotlib.org/gallery/style_sheets/ggplot.html
https://matplotlib.org/gallery/style_sheets/style_sheets_reference.html
https://tonysyu.github.io/raw_content/matplotlib-style-gallery/gallery.html

https://matplotlib.org/api/_as_gen/matplotlib.pyplot.subplot.html
https://matplotlib.org/gallery/lines_bars_and_markers/scatter_star_poly.html#sphx-glr-gallery-lines-bars-and-markers-scatter-star-poly-py
https://matplotlib.org/gallery/subplots_axes_and_figures/figure_title.html

http://qaru.site/questions/13864721/typeerror-empty-dataframe-no-numeric-data-to-plot

http://memobio2015.u-strasbg.fr/conference/FICHIERS/Documentation/doc-matplotlib-pdf/doc-Matplotlib_pdf.pdf
http://python.physique.free.fr/_downloads/LIB_Matplotlib.pdf
https://matplotlib.org/2.2.3/Matplotlib.pdf

"""


"""
plt.style.use('ggplot')
fig, axes = plt.subplots(ncols=2, nrows=2)
ax1 = axes.ravel()
x = df['ValoareEstimata']
y = df[1]
ax1.plot(x, y)
"""
"""
# bar graphs
x = np.arange(5)
y1, y2 = np.random.randint(1, 25, size=(2, 5))
width = 0.25
ax2.bar(x, y1, width)
ax2.bar(x + width, y2, width,
        color=list(plt.rcParams['axes.prop_cycle'])[2]['color'])
ax2.set_xticks(x + width)
ax2.set_xticklabels(['a', 'b', 'c', 'd', 'e'])2
"""

# https://seaborn.pydata.org/generated/seaborn.countplot.html
"""

"""
#X = df2.iloc[:,0:30]  #independent columns
#y = df2.iloc[:,-1]    #target column i.e price range

#ax = sns.countplot(y[:5],label="Count",data=X[:5], palette="Set3")       # M = 212, B = 357
#plt.show()
#X.describe()




"""
# first ten features
data_dia = y
data = X
data_n_2 = (data - data.mean()) / (data.std()) # standardization
data = pd.concat([y,data_n_2.iloc[:,0:10]],axis=1)
data = pd.melt(data,id_vars="Judet",
                    var_name="Judet",
                    value_name='Judet')
plt.figure(figsize=(10,10))
sns.violinplot(X="Judet", y="Judet", hue="Judet", data=data,split=True, inner="quart")
plt.xticks(rotation=90)
"""



# df = pd.read_csv(filecsv, delimiter="^",  na_values="Not Available", nrows=30, usecols=[9],dtype={'DataPublicare': np.str, 'Judet': np.str, 'TipContract': np.str, 'ValoareEstimata': np.float} ,skiprows = 1  ) #
# df = pd.read_csv(filecsv, delimiter="^", usecols=[0,1,2,3,4,5,6], na_values="Not Available", nrows=20)
# df = pd.read_csv(filecsv, skiprows = 1, index_col=0, na_values = ['no info', '.'],dtype={'speed':int, 'period':str, 'warning':str, 'pair':int, "revenues" : "float64"}, header = None)

#rad_viz = pd.plotting.radviz(df2, 'Judet')  # doctest: +SKIP
#df3 = pd.DataFrame(df2, columns=['Judet','ValoareEstimata'])
#scatter_matrix(df2, alpha=0.2)
#plt.close('all')
#plt.show()

"""
#pylab.clf()
axs = scatter_matrix(df2, alpha=100, diagonal='hist')
#axs = scatter_matrix(df, alpha=0.2, ax=None, grid=False, diagonal='hist', marker='.', density_kwds=None, hist_kwds=None, range_padding=0.05)
#axs = scatter_matrix(df, alpha=20, ax=None, grid=False, diagonal='hist', marker='.', density_kwds=None, hist_kwds=None)
for ax in axs[:,0]: # the left boundary
    ax.grid('off', axis='both')
    ax.set_yticks([0, .5])
for ax in axs[-1,:]: # the lower boundary
    ax.grid('off', axis='both')
#pylab.savefig( "111.png")
pylab.show()
"""

"""
plt.hist(X, bins=20, normed=1) # matplotlib version (plot)
plt.show()
(n, bins) = np.histogram(X, bins=20, normed=True) #
plt.plot(.5*(bins[1:]+bins[:-1]), n)
plt.show()
"""

#np.random.seed(19680801)
#plt.scatter(X, y= np.random.rand(30), s=(30 * np.random.rand(30))**2, c=np.random.rand(30), alpha=0.5)
#plt.show()

# compare 2 csv if identical
#print(pd.DataFrame.equals(df, df2))


"""
# save csv
df = pd.DataFrame({'Names':['Andreas', 'George', 'Steve', 'Sarah', 'Joanna', 'Hanna'], 'Age':[21, 22, 20, 19, 18, 23]})
df.head()
df.to_csv('NamesAndAges.csv')
"""

#pd.drop([0], axis=1)
#df.drop(['B', 'C'], axis=1)
#df.drop(columns=['B', 'C'])
#df.drop([0, 1]) # rows
