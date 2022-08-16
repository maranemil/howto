"""
##########################################################################
 data batch convertor
##########################################################################

https://pandas.pydata.org/docs/reference/api/pandas.read_csv.html
https://docs.dask.org/en/latest/generated/dask.dataframe.DataFrame.repartition.html
https://docs.dask.org/en/latest/dataframe-api.html#dask.dataframe.DataFrame.repartition

"""

import pandas as pd
import os
import sqlite3
import dask.dataframe as dd

conn = sqlite3.connect('db_file.db', isolation_level=None, detect_types=sqlite3.PARSE_COLNAMES)
kindex = 0
for items in pd.read_sql_query(sql=f"SELECT user, status, active FROM table", con=con, index_col=["status"],
                               chunksize=2000):
    kindex += 1
    todir = 'tmp'
    filename = os.path.join(todir, ('part%04d' % kindex))

    dfr = pd.DataFrame(items, columns=['status', 'user', 'active'], dtype='unicode')
    print(dfr.head(3))
    dfr.to_csv(filename + ".csv")

    # pqdata = pd.read_csv(filename + ".csv", index_col=False, dtype='unicode', low_memory=False)
    pqdata = pd.read_csv(filename + ".csv", dtype='unicode', low_memory=False)
    pqdata.to_parquet(filename + ".pqt")
    # parquet-tools show -n3 tmp/part0001.pqt
    del items

dfdb = dd.read_parquet('tmp/part*.pqt', columns=['status', 'user', 'active'])
dfdb.repartition(npartitions=1).to_parquet("items", write_metadata_file=False)
os.system('cp items/part.0.parquet items.pqt')

exit("end")
