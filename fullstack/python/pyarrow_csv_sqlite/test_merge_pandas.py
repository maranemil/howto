#############################################################
# mrge parq files
#############################################################

import dask.dataframe as dd
import os
import pandas as pd
import glob
import time

databases = pd.DataFrame()
filenames = glob.glob("tmp/*.parquet")
k = 0
for file in filenames:
    df = pd.read_parquet(file, engine='pyarrow', use_nullable_dtypes=False)
    dfpanda = pd.DataFrame(df, dtype='unicode')
    print(dfpanda.head(2))
    df.info()
    databases = pd.concat([databases, dfpanda], ignore_index=True, axis=0)
    del dfpanda, df
    k += 1

    if k > 3:
        break

pd.DataFrame(databases).to_parquet('file.parquet')
time.sleep(5)

# parquet-tools show -n2 file.parquet
# parquet-tools inspect file.parquet
# python3 test_merge_pandas.py

"""
import dask.dataframe as dd
dfdb = dd.read_parquet('tmp/part*.pqt', columns=['status', 'user', 'active'])
dfdb.repartition(npartitions=1).to_parquet("items", write_metadata_file=False)
os.system('cp items/part.0.parquet items.pqt')
"""
exit()

"""

############################################################
simple merge parquet
############################################################

import dask.dataframe as dd
import os
import pandas as pd
import glob
import time

os.system('rm stock.pqt')
stocks = pd.DataFrame()
# filenames = glob.glob("batch_merge/*.parquet")
filenames = ['stock_1.pqt', 'stock_2.pqt', 'stock_3.pqt', 'stock_4.pqt',
             'stock_5.pqt', 'stock_6.pqt', 'stock_7.pqt', 'stock_8.pqt',
             'stock_9.pqt']
k = 0
for file in filenames:
    df = pd.read_parquet(file)
    # stocks = pd.concat([stocks, df], ignore_index=True, axis=0)
    stocks = pd.concat([stocks, df])
    time.sleep(1)


pd.DataFrame(stocks).to_parquet('stock.pqt')

"""
