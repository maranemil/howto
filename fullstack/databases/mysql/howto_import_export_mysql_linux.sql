
##############################################################
#
# Export Import MySQL Linux Ubuntu CLI
#
##############################################################

/*

mysql -u username -p  databasename  < path/example.sql
mysqldump -u username -p databasename tableName > path/example.sql
mysql -u username -p databasename tableName < path/example.sql

---------------------------------------------------------

mysqldump --user=root databasename > whole.database.sql
mysqldump --user=root databasename onlySingleTableName > single.table.sql
While importing whole database:

mysql --user=root wholedatabase < whole.database.sql
While importing single table data only?

mysql --user=root databasename < single.table.sql

---------------------------------------------------------

//// Export Import MySQL

Create a temporary database (e.g. restore):

mysqladmin -u root -p create restore
Restore the full dump in the temp database:

mysql -u root -p restore < fulldump.sql
Dump the table you want to recover:

mysqldump restore mytable > mytable.sql
Import the table in another database:

mysql -u root -p database < mytable.sql

---------------------------------------------------------

//// Export  MySQL Table From SQL Dump

sed -n -e '/DROP TABLE.*`mytable`/,/UNLOCK TABLES/p' dump.sql > mytable.sql
Also for testing purpose, you may want to change the table name before importing:

sed -n -e 's/`mytable`/`mytable_restored`/g' mytable.sql > mytable_restored.sql
To import you can then use the mysql command:

mysql -u root -p'password' mydatabase < mytable_restore.sql

sed -n -e '/-- Table structure for table `my_table_name`/,/UNLOCK TABLES/p' database_file.sql > table_file.sql

---------------------------------------------------------

//// Backup MySQL ////
$ mysqldump -A | gzip > mysqldump-A.gz

//// Restore single table from MySQL ////
$ mysql -e "truncate TABLE_NAME" DB_NAME
$ zgrep ^"INSERT INTO \`TABLE_NAME" mysqldump-A.gz | mysql DB_NAME

---------------------------------------------------------

mysqldump -u... -p... --no-create-info --skip-extended-insert mydb t1 > mydb_table.sql
mysql -u...-p... --force mydb < mydb_tables.sql

##############################################################
#
# http://zetcode.com/databases/mysqltutorial/exportimport/
#
##############################################################

////  Exporting to CSV files
mysql> SELECT * FROM Cars INTO OUTFILE '/tmp/cars';
$ cat /tmp/cars

mysql> DELETE FROM Cars;
mysql> LOAD DATA INFILE '/tmp/cars' INTO TABLE Cars;

mysql> SELECT * FROM Cars INTO OUTFILE '/tmp/cars.csv'
  -> FIELDS TERMINATED BY ',';
$ cat /tmp/cars.csv

mysql> DELETE FROM Cars;
mysql> LOAD DATA INFILE '/tmp/cars.csv' INTO TABLE Cars
    -> FIELDS TERMINATED BY ',';


////  Exporting to XML files
mysql -uroot -p --xml -e 'SELECT * FROM mydb.Cars' > /tmp/cars.xml

mysql> TRUNCATE Cars;
mysql> LOAD XML /tmp/cars.xml INTO TABLE Cars;

//// Dump SQL Data ////
mysqldump -u root -p --no-data mydb > bkp1.sql # Dumping table structures
mysqldump -uroot -p --no-create-info mydb > bkp2.sql # Dumping data only
mysqldump -uroot -p mydb > bkp3.sql # Dumping the whole database

//// Restoring data /////
mysql> CREATE DATABASE mydb;
mysql> USE mydb;
mysql> source bkp3.sql





################################################
#
# 	mysql import --single-transaction
#
#	https://dev.mysql.com/doc/refman/5.6/en/sql-syntax-transactions.html
#	https://dev.mysql.com/doc/refman/5.6/en/commit.html
#	https://dev.mysql.com/doc/refman/5.7/en/mysqlimport.html
#	https://dev.mysql.com/doc/refman/5.7/en/cannot-roll-back.html
#	https://dev.mysql.com/doc/refman/5.7/en/mysqlimport.html
#	https://dev.mysql.com/doc/refman/5.7/en/mysqldump.html#mysqldump-option-summary
#
###############################################


The structure of the dump file is as follows:

-----------------------------------------------
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";
#DROP TABLE IF EXISTS `table`;
#CREATE TABLE IF NOT EXISTS `table` ([...]);
INSERT INTO `table` ([...]) VALUES ([...]);
COMMIT;
-----------------------------------------------
START TRANSACTION;
SELECT @A:=SUM(salary) FROM table1 WHERE type=1;
UPDATE table2 SET summary=@A WHERE type=1;
COMMIT;
-----------------------------------------------


mysqldump --add-drop-table --default-character-set=utf8 --extended-insert --host=localhost --quick \
    --quote-names --routines --set-charset --single-transaction --triggers --tz-utc --verbose --user=user --password mydbname

mysqldump --single-transaction --insert-ignore --user mysuer --password --host 1.1.1.1 db table < table.sql
mysqlimport --ignore --debug-info --host --password --user --verbose --host 1.1.1.1  table.sql > db table

--replace	The --replace and --ignore - does duplicate existing rows on unique key values
--delete	Empty the table before importing the text file
--force	Continue even if an SQL error occurs


-------------
ROLLBACK Example
-------------

DECLARE CONTINUE HANDLER FOR NOT FOUND
    BEGIN
        SET @error = 1;
        SET @error_string = 'erreur de type NOT FOUND';
    END;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    BEGIN
        SET @error = 1;
        SET @error_string = 'erreur de type SQLEXCEPTION';
    END;
SET @error = 0;
SET @error_string = '';
-- start transact
START TRANSACTION;
//code ...
    IF (@error <> 0) THEN
    ROLLBACK;
    //LEAVE MAj_DOC;
ELSE
    commit;
END IF;
END

*/





####################################################################################
#
# Exporting data to a CSV file whose filename contains timestamp
# http://www.mysqltutorial.org/mysql-export-table-to-csv/
#
####################################################################################

SELECT
    orderNumber, status, orderDate, requiredDate, comments
FROM
    orders
WHERE
    status = 'Cancelled'
INTO OUTFILE 'C:/tmp/cancelled_orders.csv'
FIELDS ENCLOSED BY '"'
TERMINATED BY ';'
ESCAPED BY '"'
LINES TERMINATED BY '\r\n';



(SELECT 'Order Number','Order Date','Status')
UNION
(SELECT orderNumber,orderDate, status
FROM orders
INTO OUTFILE 'C:/tmp/orders.csv'
FIELDS ENCLOSED BY '"' TERMINATED BY ';' ESCAPED BY '"'
LINES TERMINATED BY '\r\n');



SELECT
    orderNumber, orderDate, IFNULL(shippedDate, 'N/A')
FROM
    orders INTO OUTFILE 'C:/tmp/orders2.csv'
    FIELDS ENCLOSED BY '"'
    TERMINATED BY ';'
    ESCAPED BY '"' LINES
    TERMINATED BY '\r\n';




