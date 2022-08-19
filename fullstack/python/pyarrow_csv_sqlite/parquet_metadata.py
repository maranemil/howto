##############################################################
#
#   Understand predicate pushdown on row group level in Parquet with pyarrow and python
#   peter hoffmann
#
##############################################################

# http://peter-hoffmann.com/2020/understand-predicate-pushdown-on-rowgroup-level-in-parquet-with-pyarrow-and-python.html
# https://github.com/dask/fastparquet

"""
mkdir input
cd input
for i in {01..12};  do
  wget get https://s3.amazonaws.com/nyc-tlc/trip+data/yellow_tripdata_2018-$i.csv
done

head -n4 input/yellow_tripdata_2019-01.csv
du -sh input/yellow_tripdata_2018-0*

convert the data to parquet
"""

import glob
import pandas as pd

files = glob.glob("input/yellow_tripdata_2018-*.csv")


def read_csv(filename):
    return pd.read_csv(
        filename,
        dtype={"store_and_fwd_flag": "bool"},
        parse_dates=["tpep_pickup_datetime", "tpep_dropoff_datetime"],
        index_col=False,
        infer_datetime_format=True,
        true_values=["Y"],
        false_values=["N"],
    )


dfs = list(map(read_csv, files))
df = pd.concat(dfs)
df.to_parquet("yellow_tripdata_2018.parquet")

# resulting parquet file has a size of 2.2GiB

# Read

import pyarrow.parquet as pq

filename = "yellow_tripdata_2018.parquet"
pq_file = pq.ParquetFile(filename)

data = [["columns:", pq_file.metadata.num_columns],
        ["rows:", pq_file.metadata.num_rows],
        ["row_roups:", pq_file.metadata.num_row_groups]
        ]

# look at the schema of the parquet file

s = pq_file.metadata.schema
data = [[s.column(i).name, s.column(i).physical_type, s.column(i).logical_type] for i in range(len(s))]

#  get row groups

s = pq_file.metadata.schema
data = []
for rg in range(pq_file.metadata.num_row_groups):
    rg_meta = pq_file.metadata.row_group(rg)
    data.append([rg, rg_meta.num_rows, sizeof_fmt(rg_meta.total_byte_size)])

# write them in one batch

import pandas as pd
import pyarrow as pa
import pyarrow.parquet as pq

months = range(1, 13)


def read_csv(month):
    filename = "input/yellow_tripdata_2018-{:02d}.csv".format(month)
    df = pd.read_csv(
        filename,
        dtype={"store_and_fwd_flag": "bool"},
        parse_dates=["tpep_pickup_datetime", "tpep_dropoff_datetime"],
        index_col=False,
        infer_datetime_format=True,
        true_values=["Y"],
        false_values=["N"],
    )
    return df[(df['tpep_pickup_datetime'].dt.year == 2018) & (df['tpep_pickup_datetime'].dt.month == month)]


dfs = list(map(read_csv, months))
table = pa.Table.from_pandas(dfs[0], preserve_index=False)
writer = pq.ParquetWriter('yellow_tripdata_2018-rowgroups.parquet', table.schema)

for df in dfs:
    table = pa.Table.from_pandas(df, preserve_index=False)
    writer.write_table(table)
writer.close()

# read metadata
rg_meta = pq_file.metadata.row_group(0)
rg_meta.column(0)

# Looking at the min and max statistics of the tpep_pickup_datetime:
column = 1  # tpep_pickup_datetime
data = [["rowgroup", "min", "max"]]
for rg in range(pq_file.metadata.num_row_groups):
    rg_meta = pq_file.metadata.row_group(rg)
    data.append([rg, str(rg_meta.column(column).statistics.min), str(rg_meta.column(column).statistics.max)])
print_table(data)
