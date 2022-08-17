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


exit()
