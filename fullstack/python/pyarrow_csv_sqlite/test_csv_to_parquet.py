#!/usr/bin/python

# Spark Convert CSV to Avro, Parquet & JSON
# https://spark.apache.org/docs/latest/sql-data-sources-load-save-functions.html
# https://stackoverflow.com/questions/26124417/how-to-convert-a-csv-file-to-parquet
# https://github.com/domoritz/csv2parquet
# https://sparkbyexamples.com/spark/spark-convert-csv-to-avro-parquet-json/
# https://spark.apache.org/docs/latest/sql-data-sources-load-save-functions.html
# https://spark.apache.org/docs/2.2.0/api/python/pyspark.sql.html

# Read CSV into DataFrame
# Convert CSV to Parquet in chunks

# csv_to_parquet.py
import pandas as pd
import pyarrow as pa
import pyarrow.parquet as pq
import os


from test_folders import getDbDir, getTestDir
path = getTestDir()
db_path = getDbDir()

csv_file = path + 'Sales_Data_Sept21.csv'
parquet_file = path + 'Sales_Data_Sept21.parquet'
chunk_size = 100_000
parquet_schema=''
parquet_writer=''
csv_stream = pd.read_csv(csv_file, sep=';', chunksize=chunk_size, low_memory=False)

for i, chunk in enumerate(csv_stream):
    print("Chunk", i)
    if i == 0:
        parquet_schema = pa.Table.from_pandas(df=chunk).schema
        parquet_writer = pq.ParquetWriter(parquet_file, parquet_schema, compression='snappy')
    table = pa.Table.from_pandas(chunk, schema=parquet_schema)
    parquet_writer.write_table(table)

parquet_writer.close()
reloaded_sales = pq.read_table(parquet_file)
print(reloaded_sales)

'''

sqlite
https://linuxhint.com/install-sqlite-ubuntu-linux-mint/
https://www.sqlite.org/docs.html

sudo apt install sqlite3
sqlite3 –version

----------------------------------------------------

https://snapcraft.io/install/pycharm-community/ubuntu

sudo apt update
sudo apt install snapd
sudo snap install pycharm-community --classic
sudo snap install code --classic

----------------------------------------------------

https://arrow.apache.org/cookbook/py/
https://arrow.apache.org/docs/python/install.html

pip install pyarrow

----------------------------------------------------
'''
