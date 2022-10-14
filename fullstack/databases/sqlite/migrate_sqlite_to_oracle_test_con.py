#!/usr/bin/env python3

############################################
# sample conn oracle
############################################

import cx_Oracle
import sqlalchemy

# https://gist.github.com/jtrive84/cce982fd1f92c6aca9e83539cd6db2ee
# https://gist.github.com/peteristhegreat/acfeebb140073c7655a35a7b098ea05e
# https://gist.github.com/jtrive84/cce982fd1f92c6aca9e83539cd6db2ee
# https://cx-oracle.readthedocs.io/en/latest/user_guide/connection_handling.html
# https://www.oracletutorial.com/oracle-basics/oracle-fetch/
# https://stackoverflow.com/questions/470542/how-do-i-limit-the-number-of-rows-returned-by-an-oracle-query-after-ordering
# https://www.w3schools.com/sql/sql_top.asp

# cx_Oracle
# con = cx_Oracle.connect(user="schema_name",
#                        password="oracle",
#                        dsn="172.21.0.2:1521/xe")

# cx_Oracle
#con = cx_Oracle.connect('schema_name', 'oracle', '172.21.0.2:1521/xe')

# cx_Oracle -> connect + makedsn
con = cx_Oracle.connect('schema_name', 'oracle', cx_Oracle.makedsn('172.21.0.2', 1521, 'xe'))

# cx_Oracle -> dns + con
# dsn = cx_Oracle.makedsn(host='172.21.0.2', port=1521, sid='xe')
# con = cx_Oracle.connect(user='schema_name', password='oracle', dsn=dsn, encoding="UTF-8")

# sqlalchemy
#con_str = "oracle+cx_oracle://schema_name:oracle@172.21.0.2:1521/xe"
#con = sqlalchemy.create_engine(con_str)

cursor = con.cursor()
cursor.execute("SELECT colname FROM table WHERE ROWNUM < 10")

for colname in cursor:
    print("Values:", colname)



"""
################################################
cx_Oracle install
################################################
https://oracle.github.io/python-cx_Oracle/
https://pypi.org/project/cx-Oracle/
https://help.ubuntu.com/community/Oracle%20Instant%20Client
"""