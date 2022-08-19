import pandas as pd
import pyarrow as pa
from fastparquet import ParquetFile
import dask.dataframe as dd
import pyarrow.parquet as pq

print("------------------------ read parquet metadata ------------------------ ")

filename = "file.pqt"
pq_file = pq.ParquetFile(filename)

data = [["columns:", pq_file.metadata.num_columns],
        ["rows:", pq_file.metadata.num_rows],
        ["row_roups:", pq_file.metadata.num_row_groups]
        ]

s = pq_file.metadata.schema
dataschema = [[s.column(i).name, s.column(i).physical_type, s.column(i).logical_type] for i in range(len(s))]
print(dataschema)

rg_meta = pq_file.metadata.row_group(0)
print('---------------------------------------------')
print(rg_meta.column(0))

column = 1  # tpep_pickup_datetime
datacolumn = [["rowgroup", "min", "max"]]
for rg in range(pq_file.metadata.num_row_groups):
    rg_meta = pq_file.metadata.row_group(rg)
    datacolumn.append([rg, str(rg_meta.column(column).statistics.min), str(rg_meta.column(column).statistics.max)])
print('---------------------------------------------')
print(datacolumn)

# https://stackoverflow.com/questions/1094841/get-human-readable-version-of-file-size
def sizeof_fmt(num, suffix="B"):
    for unit in ["", "Ki", "Mi", "Gi", "Ti", "Pi", "Ei", "Zi"]:
        if abs(num) < 1024.0:
            return f"{num:3.1f}{unit}{suffix}"
        num /= 1024.0
    return f"{num:.1f}Yi{suffix}"


s = pq_file.metadata.schema
datametadata = []
for rg in range(pq_file.metadata.num_row_groups):
    rg_meta = pq_file.metadata.row_group(rg)
    datametadata.append([rg, rg_meta.num_rows, sizeof_fmt(rg_meta.total_byte_size)])
print('---------------------------------------------')
print(datametadata)


# dfdb = dd.read_parquet('file.pqt', engine='pyarrow')
# dfdb = dd.read_parquet('tmp/part*.parquet', engine='pyarrow')
# print(dfdb.shape)
# print(dfdb.head())
# print(dfdb.columns)

# df2 = pd.read_parquet('file.pqt', engine='pyarrow').dropna()
# print(df2.shape)
# print(df2.head())

# OK
# pf = ParquetFile('file.pqt')
# pdata = pf.to_pandas()
# columns_list = pdata.columns
# print(pdata.columns)
# print(columns_list[:4])
# print(columns_list[1], type(columns_list[1]))
# print(pdata.head())

# import pandas as pd
# df = pd.read_parquet('tmp/')
# print(df.shape[0])
# print(df.head())
# print(len(df.index))
# print(len(df.columns))
