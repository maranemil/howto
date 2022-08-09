#!/usr/bin/python

# Getting Started
# https://arrow.apache.org/docs/python/getstarted.html

# Creating Arrays and Tables
import pyarrow as pa
import pyarrow.parquet as pq
import pyarrow.compute as pc
import pyarrow.dataset as ds
import os

from test_folders import getDbDir, getTestDir
path = getTestDir()
db_path = getDbDir()

days = pa.array([1, 12, 17, 23, 28], type=pa.int8())
months = pa.array([1, 3, 5, 7, 1], type=pa.int8())
years = pa.array([1990, 2000, 1995, 2000, 1995], type=pa.int16())
birthdays_table = pa.table([days, months, years],
                           names=["days", "months", "years"])

# print(birthdays_table)

# Saving and Loading Tables
pq.write_table(birthdays_table, 'tests/birthdays.parquet')
reloaded_birthdays = pq.read_table('tests/birthdays.parquet')
# print(reloaded_birthdays)


# Performing Computations
compute = pc.value_counts(birthdays_table["years"])
# print(compute)

# Working with large data
if os.path.isdir('./savedir'):
    print('dir exists')
else:
    ds.write_dataset(birthdays_table,
                     "savedir",
                     format="parquet",
                     partitioning=ds.partitioning(
                         pa.schema([birthdays_table.schema.field("years")])
                     ))

birthdays_dataset = ds.dataset("savedir", format="parquet", partitioning=["years"])
# print(birthdays_dataset.files)

# import datetime
# current_year = datetime.datetime.utcnow().year
# for table_chunk in birthdays_dataset.to_batches():
#    print("AGES", pc.subtract(current_year, table_chunk["years"]))
