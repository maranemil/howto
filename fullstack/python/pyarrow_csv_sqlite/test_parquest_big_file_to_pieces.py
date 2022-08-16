######################################################
# chuck big parquet file in pieces
######################################################

import pandas as pd
import pyarrow as pa
from fastparquet import ParquetFile

# read file v1
df = pd.read_parquet('big_file.pqt',
                     engine='pyarrow',
                     columns=['status', 'valid_from', 'valid_to', 'last_update']
                     )  # .dropna()
print(df.head())
print(df.shape)

# read file v2
pf = ParquetFile('big_file.pqt')
df = pf.to_pandas(['status', 'valid_from', 'valid_to', 'last_update'],
                  categories=[])
print(df.shape)
print(df.head())

import dask.dataframe as da
ddf = da.from_pandas(df, chunksize=100000)
save_dir = 'tmp/'
ddf.to_parquet(save_dir)

#  parquet-tools show -n5 tmp/part.0.parquet
