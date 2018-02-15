
##################################################
##
## mysql management terminal
##
##################################################

/*

# mysql connect with socket in terminal:
sudo mysql --user=root  --socket=/opt/lampp/var/mysql/mysql.sock --password= --default-character-set=utf8
sudo mysql -u root --socket=/opt/lampp/var/mysql/mysql.sock -p

# update mysql password
mysql -u root -p
use mysql;
update user set password=PASSWORD('your_new_password') where User='root';
flush privileges;
quit

---------------------------------------------
# mysql usual commands
---------------------------------------------
mysql> SHOW DATABASES;
mysql> CREATE DATABASE x;
mysql> DROP DATABASE x;
mysql> TRUNCATE TABLE x;
mysql> USE `x`;

---------------------------------------------
# Import Classic Console Terminal:
---------------------------------------------
mysql> create DATABASE_NAME;
#mysql> use DATABASE_NAME;
mysql> connect DATABASE;
mysql> source file.sql;

---------------------------------------------
Import:
---------------------------------------------
mysql -u root -p dbname < table1.sql  #everything
mysql -u root -p --socket=/opt/lampp/var/mysql/mysql.sock dbname < table1.sql #just a table using socket
mysql -u root -p -D dbname < tableName.sql #just a table

---------------------------------------------
Export:
---------------------------------------------
mysqldump -u root -p  dbname > tableName.sql #everything
mysqldump -u root -p  dbname tableName > tableName.sql #just a table
mysqldump -u root -p --socket=/opt/lampp/var/mysql/mysql.sock dbname tableName > tableName.sql #just a table using socket
mysqldump -u root -p --socket=/opt/lampp/var/mysql/mysql.sock dbname > dbname.sql



mysqldum -u root -p dbname \
  --ignore-table=schema.tablename1    \
  --ignore-table=schema.tablename2    \
  --ignore-table=schema.tablename3 > mysqldump.sql



*/

-----------------------------------------------
----  Import csv into mysql
-----------------------------------------------

/*
mysql -u root -p --local-infile DatabaseName
LOAD DATA LOCAL INFILE 'file.csv' INTO TABLE TableName FIELDS TERMINATED BY '^' LINES TERMINATED BY '\n';

Export as postgresql;
mysqldump --compatible=postgresql -u root -p  DatabaseName TableName > TableName.sql

Options Import:
mysqlimport --fields-optionally-enclosed-by="\"" --fields-terminated-by=, --lines-terminated-by="\r\n" --user=root --password YOUR_TABLE YOUR_TABLE.csv
mysqlimport --ignore-lines=1 --columns='head -n 1 YOUR_TABLE.csv' --ignore-lines=1 YOUR_TABLE YOUR_TABLE.csv

*/

-----------------------------------------------
----  Export DB Table into csv
-----------------------------------------------

/*

#mysql> use DBName; mysql> SET autocommit=0 ; source the_sql_file.sql ; COMMIT ;
-----------------------------------------------
Export CSV directly from MySQL
-----------------------------------------------

mysql -u root -p
mysql> use DBName;
mysql> SHOW TABLES;

mysql> SELECT * INTO OUTFILE 'export.csv' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' ESCAPED BY '\\' LINES TERMINATED BY '\n' FROM DBTable WHERE 1 LIMIT 10;
mysql> SELECT * INTO OUTFILE 'export.csv' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n' FROM DBTable WHERE 1 LIMIT 10;

mysql> SELECT  orderNumber, status, orderDate, requiredDate, comments FROM  orders
WHERE  status = 'Cancelled' INTO OUTFILE 'C:/tmp/cancelled_orders.csv' FIELDS ENCLOSED BY '"' TERMINATED BY ';' ESCAPED BY '"' LINES TERMINATED BY '\r\n';

https://ariejan.net/2008/11/27/export-csv-directly-from-mysql/
http://www.mysqltutorial.org/mysql-export-table-to-csv/

*/

