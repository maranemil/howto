#!/usr/bin/python

#################################
# https://docs.python.org/3/library/sqlite3.html
#################################

import sqlite3
import pandas as pd
# import os

from test_folders import getDbDir, getTestDir
path = getTestDir()
db_path = getDbDir()

db_file = db_path + 'example.db'
con = sqlite3.connect(db_file)
cur = con.cursor()

# if cur.execute('SELECT count(rowid) FROM stocks') is False:
# Create table
cur.execute('''CREATE TABLE IF NOT EXISTS stocks
               (date text, trans text, symbol text, qty real, price real)''')

cur.execute("INSERT INTO stocks VALUES ('2006-01-05','BUY','RHAT',100,35.14)")
con.commit()
# con.close()

# con = sqlite3.connect(db_path + 'example.db')
cur = con.cursor()
res = cur.execute('SELECT count(rowid) FROM stocks')
print(res.fetchone())

# Insert more data
data = [
    ('2006-03-28', 'BUY', 'IBM', 1000, 45.0),
    ('2006-04-05', 'BUY', 'MSFT', 1000, 72.0),
    ('2006-04-06', 'SELL', 'IBM', 500, 53.0),
]
cur.executemany('INSERT INTO stocks VALUES(?, ?, ?, ?, ?)', data)

# read rows
for row in cur.execute('SELECT * FROM stocks ORDER BY price'):
    print(row)

#################################
# export sqlite to CSV in Python
# https://stackoverflow.com/questions/10522830/how-to-export-sqlite-to-csv-in-python-without-being-formatted-as-a-list
# https://www.alixaprodev.com/2022/04/sqlite-database-to-csv-file-in-python.html
# pip install pandas
#################################

conn = sqlite3.connect(db_file, isolation_level=None,
                       detect_types=sqlite3.PARSE_COLNAMES)
db_df = pd.read_sql_query("SELECT * FROM stocks", conn)
db_df.to_csv(path + 'database_sqlite_to_csv.csv', index=False)

# import sqlite3
# import pandas as pd
# conn = sqlite3.connect(db_file)
# cursor = conn.cursor()
# clients = pd.read_sql('SELECT * FROM stocks' ,conn)
# clients.to_csv('database_sqlite_to_csv2.csv', index=False)


# bash export
# https://www.sqlitetutorial.net/sqlite-export-csv/
# sqlite3 -header -csv c:/sqlite/chinook.db < query.sql > data.csv
