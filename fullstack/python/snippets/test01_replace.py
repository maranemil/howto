
##########################################################
# replace test
##########################################################

# https://www.programiz.com/python-programming/online-compiler/

# Online Python compiler (interpreter) to run Python online.
# Write Python 3 code in this online editor and run it.

import numpy as np
import pandas as pd
df = pd.DataFrame(
    {
        "DF1": [1, 5, 7,'None',None],
        "DF2": [1, 2, 3,'None','None']
    },
    index=['a','b','c','d','e']
)


print(df.head())
print('\n-----------------------------\n')

def replacemap(x):
    x = {'None':'No'}
    return x

df.loc['d'] = df.loc['d'].map({'None':'No'})
df.loc['d'] = df.loc['d'].replace({'No':'Awwww'})

#df.loc['e'].fillna(value=np.nan, inplace=True)
#df.loc['e'] = df.loc['e'].map({'None':'Dooo'})
#df.loc['e'] = df.loc['e'].map({'Dooo': 1, np.nan: 0})

# .loc[row_indexer,col_indexer] = value
#df.loc[df.loc["e"] == "Dooo", "e"] = 1
#df.loc["e"] = np.where(df.loc["e"] == "Dooo", "Doooooo", "Diiii")
#df.loc['e'].mask(df.loc['e'] == 'Dooo', 50, inplace=True)
df.loc["e"] = df.loc["e"].map(replacemap)
print(df.head())




##########################################################
# Try using .loc[row_indexer,col_indexer] = value instead
##########################################################
"""
https://www.analyticsvidhya.com/blog/2021/11/3-ways-to-deal-with-settingwithcopywarning-in-pandas/
https://pandas.pydata.org/pandas-docs/version/0.22/indexing.html
https://www.dataquest.io/blog/settingwithcopywarning/
https://stackoverflow.com/questions/20625582/how-to-deal-with-settingwithcopywarning-in-pandas
https://datascientyst.com/fix-settingwithcopywarning-pandas-value-trying-set-copy/
https://www.programiz.com/python-programming/online-compiler/
"""


import warnings
warnings.simplefilter(action='ignore', category=FutureWarning)

from pandas.util.testing import makeMixedDataFrame
df = makeMixedDataFrame()
print(df)
print('\n-----------------------------\n')

from pandas import util
df= util.testing.makeDataFrame()
print(df.head())
print('\n-----------------------------\n')

import pandas as pd
from pandas.util.testing import makeTimeSeries
df2 = makeTimeSeries()
print(df2.head())
print('\n-----------------------------\n')

import pandas as pd
df3 = pd.DataFrame({"A": [1, 5, 7,'None'], "B": [1, 2, 3,'None']}, index=['a','b','c','d'])
print(df3.head())
print('\n-----------------------------\n')

"""
df_2 = df
df_3 = df.copy()
df_4 = df[:]
df_5 = df.loc[:, :]
df_6 = df.iloc[0:2, :]
df_7 = df['D']

"""

