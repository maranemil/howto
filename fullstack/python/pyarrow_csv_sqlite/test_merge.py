#####################################################
#
#   append two DataFrames in Pandas
#   Merge, join, concatenate and compare
#
#####################################################

"""
https://pandas.pydata.org/docs/user_guide/merging.html
https://www.tutorialspoint.com/how-to-append-two-dataframes-in-pandas
https://datacarpentry.org/python-ecology-lesson/05-merging-data/
https://www.digitalocean.com/community/tutorials/pandas-concat-examples
https://pandas.pydata.org/docs/reference/api/pandas.concat.html
https://pandas.pydata.org/docs/reference/api/pandas.read_parquet.html

https://www.anycodings.com/1questions/1232058/python-numpy-valueerror-must-pass-2-d-input-shape2-2-2
https://datascienceparichay.com/article/create-pandas-dataframe-from-numpy-array/
https://pandas.pydata.org/docs/reference/api/pandas.DataFrame.sample.html
"""

# create pqt file
import pandas as pd
import pyarrow as pa
import pyarrow.parquet as pq

fields = [('one', pa.int64()), ('two', pa.string(), False), ('three', pa.bool_())]
schema = pa.schema(fields)
schema = schema.remove_metadata()
df = pd.DataFrame(
    {
        'one': [1, 2, 3],
        'two': ['foo', 'bar', 'baz'],
        'three': [True, False, True]
    }
)
df['two'] = df['two'].astype(str)
table = pa.Table.from_pandas(df, schema, preserve_index=False).replace_schema_metadata()
writer = pq.ParquetWriter('parquest_user_defined_schema.parquet', schema=schema)
writer.write_table(table)

# add new row
df2 = pd.read_parquet("parquest_user_defined_schema.parquet", engine='pyarrow')
# --------------------------------------------------------
# newrow = pd.DataFrame({'one': [4], 'two': ['noo'], 'three': [True] })
# newrow = pd.DataFrame([[ 4, 'noo',  True ]], columns=['one','two','three'], index=['3'])
newrow = pd.DataFrame([[4, 'noo', True]], columns=['one', 'two', 'three'])
print(newrow)
print(df2)
df2 = df2.append(newrow, ignore_index=True)
pd.concat([df2, newrow], axis=1)  # ignore_index=True
df2.to_parquet('parquest_user_defined_schema2.parquet')

# print onfo file 1
pfile = pd.read_parquet("parquest_user_defined_schema.parquet", engine='pyarrow')
pfile.head(2)

# print info file 2
pfile = pd.read_parquet("parquest_user_defined_schema2.parquet", engine='pyarrow')
# pfile.shape
# pfile.info()
pfile.head(5)
# random samples
pfile.sample(frac=0.5, replace=True, random_state=1)
pfile.sample(frac=2, replace=True, random_state=1)

#########################################################################
# spark read file
#########################################################################

# https://spark.apache.org/docs/3.2.0/api/python/reference/api/pyspark.sql.DataFrame.show.html
# https://sparkbyexamples.com/spark/spark-show-display-dataframe-contents-in-table/

import pandas as pd
from pyspark.sql import SparkSession
from pyspark.sql.types import *
from pyspark.sql.functions import avg, col, desc

spark = SparkSession \
    .builder \
    .appName("Python Spark SQL basic example") \
    .config("spark.some.config.option", "some-value") \
    .getOrCreate()
df = spark.read.parquet("parquest_user_defined_schema2.parquet")
# df.printSchema()
# df.show(20, False)
# df.show(3,21,True)
# df.show(1,truncate=3, vertical=True)
df.show(1, truncate=3)
