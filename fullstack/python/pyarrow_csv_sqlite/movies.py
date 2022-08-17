from sqlalchemy import create_engine
import pandas as pd
import sqlalchemy as sql
import sys
import numpy as np
import sqlite3
from multiprocessing import Pool as ThreadPool
from multiprocessing import Pool
from multiprocessing import Process
import pyarrow as pa
import pyarrow.parquet as pq
import os
import time
from multiprocessing import Process, Queue
import threading
import dask.dataframe as dd

engine = create_engine("sqlite:///db/movies.sqlite")

# convert csv into sql
# movies = pd.read_csv('db/movies.csv')
# movies.to_sql('movies', con=engine)

# Create dummy dataset
# df = pd.DataFrame(np.random.random((10 ** 4, 10)))
# print("DataFrame contains", len(df), "rows by", len(df.columns), "columns")
# df.head()
# print("DataFrame is", round(sys.getsizeof(df) / 1024 ** 2, 1), "MB")
# df.to_sql('', con=engine, index=False, if_exists='replace')

print("SQLAlchemy version:", sql.__version__)
print("Pandas version", pd.__version__)
print("Numpy version:", np.__version__)

'''
select movies from sqlite
'''
query = "SELECT * FROM movies"  # String containing the SQL query to select all rows
df = pd.read_sql_query(query, engine)  # Finally, importing the data into DataFrame df
df.info()
# df.shape
# df.dtypes
# df.memory_usage()
# print(type(df))

'''
delete tmp files
'''
stream = os.popen('rm tmp/*')
stream.read()

'''
read csv with dask
'''
# ddf = dd.read_csv('db/movies.csv')
# #ddf.repartition(partition_size="1MB")
# ddf.to_parquet("tmp", engine="pyarrow", compression=None)
# ddf = dd.read_parquet("tmp", engine="pyarrow")
# # ddf.groupby("genres", dropna=False, observed=True).agg({"v1": "sum"}).compute()
# ddf.shape
# exit()

'''
save sqlite as parquet
'''


def save_to_parquet(chunkx, it):
    table = pa.Table.from_pandas(chunkx)
    local_file_name = "tmp/part_" + str(it) + ".parquet"
    pq.write_table(table, local_file_name)


sqlquery = "SELECT * FROM movies"
i = 0
for chunk in pd.read_sql_query(sqlquery, engine, chunksize=5000):
    # print(chunk)
    # print(chunk.head())
    # save_to_parquet(chunk, i)
    i += 1
    # time.sleep(0.4)
    p = Process(target=save_to_parquet, args=(chunk, i,))
    p.start()
    p.join()

    # break

# are these in the right spots?
# pool = ThreadPool(4)
# pool.close()
# pool.join()

'''
read parquet
'''
df = pd.read_parquet("tmp/part_1.parquet")
print(df.head())

'''
run threading
'''


def banchmark(ii):
    # q.put('X' * 10000)
    print(ii)
    dfx = pd.DataFrame(np.random.random((30 ** 5, 10)))
    print("DataFrame contains", len(dfx), "rows by", len(dfx.columns), "columns")
    # dfx.head()


# for i in range(18):
#     p = Process(target=banchmark, args=(i,))
#     p.start()
#     time.sleep(1.3)

# p = Pool(5)
# with p:
#     for i in range(15):
#         p.apply(func=banchmark, args=(i,))
for i in range(8):
    # threading.Thread(target=fque, args=(i,)).start()
    threading.Thread(target=banchmark,
                     args=(i,),
                     kwargs={},
                     ).start()

# connex = sqlite3.connect("sqlite:////db/movies.sqlite")  # Opens file if exists, else creates file
# cur = connex.cursor()
# # for chunk in pd.read_csv("data.csv", chunksize=4):
# #     chunk.to_sql(name="data", con=connex, if_exists="append", index=False)  #"name" is name of table
# #     print(chunk.iloc[0, 1])
# sql = "SELECT DISTINCT title FROM movies;"  # A SQL command to get unique values from the sex column
# cur.execute(sql)
# print(cur.fetchone())
# # print(cur.fetchall())
# # Execute returns a generator you can loop through.
# for result in cur.execute(sql):
#     print(result)
#     break


# Look at the first few rows of the CSV file
# pd.read_csv("data.csv", nrows=2).head()
# Peek at the middle of the CSV file
# pd.read_csv("data.csv", nrows=2, skiprows=7, header=None).head()
# df = pd.read_csv("data.csv", nrows=5)
# df.head()
# Cast during the csv read
# df = pd.read_csv("data.csv", nrows=5, dtype={"active": np.int8})
# # ...or cast after reading
# df["age"] = df["age"].astype(np.int16)
# df["id"] = df["id"].astype(np.int16)
# df["sex"] = df["sex"].astype(np.int8)


# ratings_memory = ratings_df.memory_usage().sum()
# # Let's print out the memory consumption
# print('Total Current memory is-', ratings_memory ,'Bytes.')
# ratings_df.memory_usage()

# # Let's get a list of the rating scale or keys
# rate_keys = list(ratings_df['rating'].unique())
# # let's sort the ratings keys from highest to lowest.
# rate_keys = sorted(rate_keys, reverse=True)
# print(rate_keys)
#
# ratings_dict = {}
# for i in rate_keys: ratings_dict[i] = 0
# print(ratings_dict)

# Example of passing chunksize to read_csv
# reader = pd.read_csv('db/movies.csv', chunksize=100)
# Example of iterator=True. Note iterator=False by default.
# reader = pd.read_csv('some_data.csv', iterator=True)
# reader.get_chunk(100)

# print(sum(list(ratings_dict.values())) == len(ratings_df))
#
# # We use the operator module to easily get the max and min values
# import operator
# print(max(ratings_dict.items(), key=operator.itemgetter(1)))

# product = sum((ratings_dict_df.Rating_Keys * ratings_dict_df.Count))
# ratings_dict_df['Percent'] = ratings_dict_df['Count'].apply(lambda x: (x / (len(ratings_df)) * 100))
# print(ratings_dict_df)


"""
https://www.architecture-performance.fr/ap_blog/reading-a-sql-table-by-chunks-with-pandas/
https://pythonspeed.com/articles/pandas-sql-chunking/
https://www.sqlshack.com/introduction-to-sqlalchemy-in-pandas-dataframe/
https://docs.python.org/3/library/_thread.html
https://www.python-kurs.eu/threads.php
https://stackoverflow.com/questions/6319268/what-happened-to-thread-start-new-thread-in-python-3
https://docs.python.org/3/library/threading.html#module-threading
https://docs.python.org/3/library/multiprocessing.html
https://www.programiz.com/python-programming/time/sleep
https://groups.google.com/g/sqlalchemy/c/tGIO7opXuKQ
https://pythonmana.com/2022/167/202206170024239319.html
https://wesmckinney.com/book/accessing-data.html
https://medium.com/analytics-vidhya/speed-up-bulk-inserts-to-sql-db-using-pandas-and-python-61707ae41990
https://hackersandslackers.com/connecting-pandas-to-a-sql-database-with-sqlalchemy/
https://datascience.stackexchange.com/questions/27767/opening-a-20gb-file-for-analysis-with-pandas
https://riptutorial.com/pandas/example/30224/to-read-mysql-to-dataframe--in-case-of-large-amount-of-data
https://pandas.pydata.org/pandas-docs/stable/reference/api/pandas.read_sql.html
https://pandas.pydata.org/pandas-docs/stable/user_guide/io.html
https://sdsawtelle.github.io/blog/output/large-data-files-pandas-sqlite.html
https://towardsai.net/p/data-science/efficient-pandas-using-chunksize-for-large-data-sets-c66bf3037f93
https://stackoverflow.com/questions/18107953/how-to-create-a-large-pandas-dataframe-from-an-sql-query-without-running-out-of
https://pandas.pydata.org/pandas-docs/version/0.15.2/io.html#querying
https://leblancfg.com/benchmarks_writing_pandas_dataframe_SQL_Server.html
https://blog.panoply.io/how-to-read-a-sql-query-into-a-pandas-dataframe
https://wellsr.com/python/import-sql-data-query-into-pandas-dataframe-with-sqlalchemy/

Datasets

https://github.com/IBM/pyflowgraph/tree/master/flowgraph/integration_tests/data/datasets

!wget -O moviedataset.zip https://s3-api.us-geo.objectstorage.softlayer.net/cf-courses-data/CognitiveClass/ML0101ENv3
/labs/moviedataset.zip 

print('unziping ...')
!unzip -o -j moviedataset.zip

Archive:  moviedataset.zip
  inflating: links.csv
  inflating: movies.csv
  inflating: ratings.csv
  inflating: README.txt
  inflating: tags.csv

"""
