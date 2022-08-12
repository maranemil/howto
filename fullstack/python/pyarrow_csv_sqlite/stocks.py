#!/usr/bin/python

# pip3 install --upgrade pip

import sys
# !{sys.executable} -m pip install wheel
# !{sys.executable} -m pip install numpy
# !{sys.executable} -m pip install pandas

"""
pip install -r requirements.txt

pandas==1.4.3
numpy==1.21.5
sqlalchemy==1.4.40
pyarrow==9.0.0
Faker~=14.0.0
"""

# from itertools import groupby
from faker import Faker
from pyarrow.parquet import ParquetFile
# import csv
# import numpy as np
import pandas as pd
import pyarrow as pa
# import pyarrow.parquet as pq
# import sqlalchemy
import sqlite3
from datetime import datetime
# import random

print('Python version: ', pd.__version__)

con = sqlite3.connect('stocks.db')
cur = con.cursor()

# Create table
cur.execute('''CREATE TABLE IF NOT EXISTS stocks
               (date text, trans text, symbol text, qty real, price real)''')

cur.execute("INSERT INTO stocks VALUES ('2006-01-05','BUY','RHAT',100,35.14)")
con.commit()
# con.close()

fake = Faker()
d1 = datetime.strptime(f'1/1/2021', '%m/%d/%Y')
d2 = datetime.strptime(f'8/10/2021', '%m/%d/%Y')
transaction_date = fake.date_between(d1, d2)

# Insert more data
data = [
    ('2006-03-28', 'BUY', 'IBM', 1000, 45.0),
    (transaction_date, 'BUY', 'MSFT', 1000, 72.0),
    (transaction_date, 'SELL', 'IBM', 500, 53.0),
    (transaction_date, 'SELL', 'IBM', 500, 53.0)
]
cur.executemany('INSERT INTO stocks VALUES(?, ?, ?, ?, ?)', data)

res = cur.execute('SELECT * FROM stocks ORDER BY date DESC')
print(res.fetchone())
# print(res.fetchall())

# save to csv
db_df = pd.read_sql_query("SELECT * FROM stocks", con)
db_df.to_csv('stocks.csv', index=False)

# Read tables
res = cur.execute("SELECT name FROM sqlite_schema WHERE type ='table' AND name NOT LIKE 'sqlite_%';")
print('SqLite Tables: ', res.fetchall())

# Read stock data
stock_sql = "SELECT * FROM stocks ORDER BY date DESC"
stocks = pd.read_sql_query(stock_sql, con=con, index_col=["date"])
print("\033[94m sample data: \033[0m \n")
print(stocks.head(2))

# save stocks parquet
stocks.to_parquet("stocks.pqt")

# get stocks parquet
stocks_load = ParquetFile('stocks.pqt')
first_ten_rows = next(stocks_load.iter_batches(batch_size=10))
df_stocks = pa.Table.from_batches([first_ten_rows]).to_pandas()
print(df_stocks.head(1))
metadata_stocks = stocks_load.metadata
# print(metadata_stocks)

# get stocks parquet
stocks = pd.read_parquet('stocks.pqt', engine='pyarrow')
print(stocks.head(2))
