#!/usr/bin/python

# Reading and Writing Data
# https://arrow.apache.org/cookbook/py/io.html#write-a-parquet-file


# Write a Parquet file
import pyarrow.parquet as pq
# import pyarrow.dataset as ds
import pyarrow.csv
import tempfile
import pyarrow.json
import pyarrow.feather as ft
import numpy as np
import numpy.random
import pyarrow as pa
import pyarrow.dataset as ds
import os
from pyarrow import fs

from test_folders import getDbDir, getTestDir

path = getTestDir()
db_path = getDbDir()

# Generate random data
arr = pa.array(np.arange(100))
print(f"{arr[0]} .. {arr[-1]}")
table = pa.Table.from_arrays(arrays=[arr], names=["col1"])
print(table)
pq.write_table(table, path + "example.parquet", compression=None)

# Reading a Parquet file
table = pq.read_table(path + "example.parquet")
print(table)

# Reading a subset of Parquet data
table_subset = pq.read_table(path + "example.parquet",
                             columns=["col1"],
                             filters=[
                                 ("col1", ">", 5),
                                 ("col1", "<", 10),
                             ])
print(table_subset)

# Saving Arrow Arrays to disk
arr = pa.array(np.arange(100))
print(f"{arr[0]} .. {arr[-1]}")
schema = pa.schema([
    pa.field('nums', arr.type)
])

with pa.OSFile(path + 'arraydata.arrow', 'wb') as sink:
    with pa.ipc.new_file(sink, schema=schema) as writer:
        batch = pa.record_batch([arr], schema=schema)
        writer.write(batch)

# Writing CSV files
arr = pa.array(range(100))
table = pa.Table.from_arrays(arrays=[arr], names=["col1"])
pa.csv.write_csv(table, path + "table.csv",
                 write_options=pa.csv.WriteOptions(include_header=True))

# Writing CSV files incrementally
schema = pa.schema([("col1", pa.int32())])
with pa.csv.CSVWriter(path + "table2.csv", schema=schema) as writer:
    for chunk in range(10):
        datachunk = range(chunk * 10, (chunk + 1) * 10)
        table = pa.Table.from_arrays([pa.array(datachunk)], schema=schema)
        writer.write(table)

# Reading CSV files
# import pyarrow.csv
table = pa.csv.read_csv(path + "table.csv")
print(table)

# Writing Partitioned Datasets
data = pa.table({"day": numpy.random.randint(1, 31, size=100),
                 "month": numpy.random.randint(1, 12, size=100),
                 "year": [2000 + x // 10 for x in range(100)]})

if os.path.isdir('./partitioned') is False:
    ds.write_dataset(data, "./partitioned", format="parquet",
                     partitioning=ds.partitioning(pa.schema([("year", pa.int16())])))

    localfs = fs.LocalFileSystem()
    partitioned_dir_content = localfs.get_file_info(
        fs.FileSelector("./partitioned"))

    files = sorted((f.path for f in partitioned_dir_content if f.type == fs.FileType.File))
    for file in files:
        print(file)

# Reading Partitioned data
dataset = ds.dataset("./partitioned", format="parquet")
print(dataset.files)
table = dataset.to_table()
print(table)
for record_batch in dataset.to_batches():
    col1 = record_batch.column("day")
    print(f"{col1._name} = {col1[0]} .. {col1[-1]}")

# Reading Partitioned Data from S3
# from pyarrow import fs
#
# # List content of s3://ursa-labs-taxi-data/2011
# s3 = fs.SubTreeFileSystem(
#     "ursa-labs-taxi-data",
#     fs.S3FileSystem(region="us-east-2", anonymous=True)
# )
# for entry in s3.get_file_info(fs.FileSelector("2011", recursive=True)):
#     if entry.type == fs.FileType.File:
#         print(entry.path)
#
# dataset = ds.dataset("s3://ursa-labs-taxi-data/2011",
#                      partitioning=["month"])
# for f in dataset.files[:10]:
#     print(f)
# print("...")


# Write a Feather file
arr = pa.array(np.arange(100))
print(f"{arr[0]} .. {arr[-1]}")
table = pa.Table.from_arrays([arr], names=["col1"])
ft.write_feather(table, path + 'example.feather')

# Reading a Feather file
table = ft.read_table(path + "example.feather")
print(table)

# Reading Line Delimited JSON
with tempfile.NamedTemporaryFile(delete=False, mode="w+") as f:
    f.write('{"a": 1, "b": 2.0, "c": 1}\n')
    f.write('{"a": 3, "b": 3.0, "c": 2}\n')
    f.write('{"a": 5, "b": 4.0, "c": 3}\n')
    f.write('{"a": 7, "b": 5.0, "c": 4}\n')
table = pa.json.read_json(f.name)
print(table.to_pydict())

# Writing Compressed Data
table = pa.table([
    pa.array([1, 2, 3, 4, 5])
], names=["numbers"])
pa.feather.write_feather(table, path + "compressed.feather",
                         compression="lz4")
pa.parquet.write_table(table, path + "compressed.parquet",
                       compression="lz4")
with pa.CompressedOutputStream(path + "compressed.csv.gz", "gzip") as out:
    pa.csv.write_csv(table, out)

# Reading Compressed Data
table_feather = pa.feather.read_table(path + "compressed.feather")
print(table_feather)
table_parquet = pa.parquet.read_table(path + "compressed.parquet")
print(table_parquet)
with pa.CompressedInputStream(pa.OSFile(path + "compressed.csv.gz"), "gzip") as inputx:
    table_csv = pa.csv.read_csv(inputx)
    print(table_csv)
table_csv2 = pa.csv.read_csv(path + "compressed.csv.gz")
print(table_csv2)
