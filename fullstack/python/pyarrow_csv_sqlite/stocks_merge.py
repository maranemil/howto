import dask.dataframe as dd
import os
import pandas as pd
import glob
import time

if os.path.exists("stock_final_merge.pqt"):
    os.system('rm stock_final_merge.pqt')

files = glob.glob("stock_parts/stock_part_*.pqt")

k = 0
my_set = {'stock_part_2.pqt', 'stock_part_3.pqt'}
for file in files:
    if os.path.basename(file) in my_set:
        continue
    else:
        print(os.path.basename(file))
        if k == 0:
            stocks = pd.read_parquet(file, engine='fastparquet')  # , use_nullable_dtypes=True
            print(stocks.shape)
            stocks.to_parquet('stock_final_merge.pqt', compression='snappy', index=True, engine='fastparquet')
            # compression{‘snappy’, ‘gzip’, ‘brotli’, None}, default ‘snappy’
        else:
            stock = pd.read_parquet(file, engine='fastparquet')  # fastparquet pyarrow
            print(stock.shape)
            stocks = stocks.append(stock, ignore_index=False)
            # pd.concat([stocks,stock], axis=1, ignore_index=True) #
            del stock
            time.sleep(3)

    if k == 62:
        break
    k += 1

stocks.to_parquet('stock_final_merge.pqt')

# read
stocks = pd.read_parquet('stock_final_merge.pqt', engine='fastparquet')
print(stocks.shape)
print(stocks.head(2))
print(len(stocks))

# stocks.dtypes
# stocks.info(verbose=True)
# stocks.head(3)['last_update']
# stocks.sample(frac=0.5, replace=True, random_state=1)
# stocks.sample(n=3, replace=True, random_state=1)
# len(stocks)

"""
import pandas as pd
from pyspark.sql import SparkSession
from pyspark.sql.types import *
from pyspark.sql.functions import avg, col, desc

spark = SparkSession \
    .builder \
    .appName("Python Spark SQL basic example") \
    .config("spark.some.config.option", "some-value") \
    .getOrCreate()
df = spark.read.parquet("stock.pqt")
#df.printSchema()
#df.show(20, False)
#df.show(3,21,True)
#df.show(1,truncate=3, vertical=True)
df.show(1,truncate=3)
"""

