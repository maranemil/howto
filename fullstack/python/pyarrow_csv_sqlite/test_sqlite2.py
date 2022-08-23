#!/usr/bin/python

# https://gist.github.com/shitalmule04/82d2091e2f43cb63029500b56ab7a8cc

import sqlite3 as sql
import csv
from sqlite3 import Error
import os
from test_folders import getDbDir, getTestDir

path = getTestDir()
db_path = getDbDir()

# Connect to database
conn = sql.connect(db_path + 'mydb.db')

try:

    # Create Table into database
    conn.execute('''CREATE TABLE IF NOT EXISTS Employee(Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,\
               Name TEXT NOT NULL, Salary INT NOT NULL 
              );''')
    # Insert some values to database
    conn.execute('''INSERT INTO Employee(Name, Salary) VALUES('Laxmi', 30000);''')
    conn.execute('''INSERT INTO Employee(Name, Salary) VALUES('Prerna', 40000);''')
    conn.execute('''INSERT INTO Employee(Name, Salary) VALUES('Shweta', 30000);''')
    conn.execute('''INSERT INTO Employee(Name, Salary) VALUES('Soniya', 50000);''')
    conn.execute('''INSERT INTO Employee(Name, Salary) VALUES('Priya', 60000);''')
    conn.commit()

    # To view table data in table format
    print("******Employee Table Data*******")
    cur = conn.cursor()
    cur.execute('''SELECT * FROM Employee''')
    rows = cur.fetchall()

    for row in rows:
        print(row)

    # Export data into CSV file
    print("Exporting data into CSV............")
    cursor = conn.cursor()
    cursor.execute("select * from Employee")
    with open(path + "employee_data.csv", "w") as csv_file:
        csv_writer = csv.writer(csv_file, delimiter="\t")
        csv_writer.writerow([i[0] for i in cursor.description])
        csv_writer.writerows(cursor)

    dir_path = os.getcwd() + '/' + path + "employee_data.csv"
    print("Data exported Successfully into {}".format(dir_path))

except Error as e:
    print(e)

# Close database connection
finally:
    conn.close()

'''
https://wellsr.com/python/convert-csv-to-sqlite-python-and-export-sqlite-to-csv/
https://www.adamsmith.haus/python/answers/how-to-insert-the-contents-of-a-csv-file-into-an-sqlite3-database-in-python
https://www.codegrepper.com/code-examples/sql/csv+to+sqlite+python
https://www.pythontutorial.net/python-basics/python-write-csv-file/
https://realpython.com/python-csv/
https://www.geeksforgeeks.org/python-os-path-isdir-method/
https://appdividend.com/2022/01/13/python-os-path-isdir-function/
'''
