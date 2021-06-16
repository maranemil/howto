
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




-- ##################################################################
-- #
-- #   http://mysqlresources.com/documentation/data-manipulation/insert-multiple-row-insertions
-- #   https://stackoverflow.com/questions/5247530/mysql-how-to-insert-a-record-for-each-result-in-a-sql-query
-- #
-- ##################################################################

INSERT INTO config (id, customer_id, domain)
SELECT DISTINCT id, customer_id, domain FROM config;

-- # If you want "www.example.com" as the domain, you can do :
INSERT INTO config (id, customer_id, domain)
SELECT DISTINCT id, customer_id, 'www.example.com' FROM config;

-- ##################################################################
-- #
-- #   disable key relations by import or update
-- #   https://gauravsohoni.wordpress.com/2009/03/09/mysql-disable-foreign-key-checks-or-constraints/
-- #
-- ##################################################################

SET foreign_key_checks = 0;
DELETE FROM users where id > 45;
SET foreign_key_checks = 1;

-- ##################################################################
-- #
-- #   MySQL Database - phpMyAdmin - Display Relationship - Designer
-- #
-- #   https://docs.phpmyadmin.net/en/latest/
-- #   https://github.com/phpmyadmin/phpmyadmin/wiki
-- #   https://www.phpmyadmin.net/docs/
-- #   https://www.phpmyadmin.net
-- #
-- ##################################################################

SET FOREIGN_KEY_CHECKS=0;
SET FOREIGN_KEY_CHECKS=1;

-- #
-- # https://mariadb.com/kb/en/substring/
-- # https://mariadb.com/kb/en/max/
-- # https://mariadb.com/kb/en/min/
-- # https://mariadb.com/kb/en/left/
-- # https://mariadb.com/kb/en/select/
-- # https://mariadb.com/kb/en/getting-data-from-mariadb/
-- #




-- ##################################################################
-- #---------------------------------------------------------------------------------------
-- #    mysql encryption-functions
-- #    https://dev.mysql.com/doc/refman/5.7/en/encryption-functions.html
-- #---------------------------------------------------------------------------------------
-- ##################################################################


/*Table 12.17 Encryption Functions

Name	                        Description
AES_DECRYPT()	                Decrypt using AES
AES_ENCRYPT()	                Encrypt using AES
ASYMMETRIC_DECRYPT()	        Decrypt ciphertext using private or public key
ASYMMETRIC_DERIVE()	            Derive symmetric key from asymmetric keys
ASYMMETRIC_ENCRYPT()	        Encrypt cleartext using private or public key
ASYMMETRIC_SIGN()	            Generate signature from digest
ASYMMETRIC_VERIFY()	            Verify that signature matches digest
COMPRESS()	                    Return result as a binary string
CREATE_ASYMMETRIC_PRIV_KEY()	Create private key
CREATE_ASYMMETRIC_PUB_KEY()	    Create public key
CREATE_DH_PARAMETERS()	        Generate shared DH secret
CREATE_DIGEST()	                Generate digest from string
DECODE()                        (deprecated 5.7.2)	Decodes a string encrypted using ENCODE()
DES_DECRYPT()                   (deprecated 5.7.6)	Decrypt a string
DES_ENCRYPT()                   (deprecated 5.7.6)	Encrypt a string
ENCODE()                        (deprecated 5.7.2)	Encode a string
ENCRYPT()                       (deprecated 5.7.6)	Encrypt a string
MD5()	                        Calculate MD5 checksum
OLD_PASSWORD()	                Return the value of the pre-4.1 implementation of PASSWORD
PASSWORD()                      (deprecated 5.7.6)	Calculate and return a password string
RANDOM_BYTES()	                Return a random byte vector
SHA1(), SHA()	                Calculate an SHA-1 160-bit checksum
SHA2()	                        Calculate an SHA-2 checksum
UNCOMPRESS()	                Uncompress a string compressed
UNCOMPRESSED_LENGTH()	        Return the length of a string before compression
VALIDATE_PASSWORD_STRENGTH()	Determine strength of password

INSERT INTO t
VALUES (1,AES_ENCRYPT('text',UNHEX('F3229A0B371ED2D9441B830D21A390C3')));


INSERT INTO t
VALUES (1,AES_ENCRYPT('text', UNHEX(SHA2('My secret passphrase',512))));


mysql> SET block_encryption_mode = 'aes-256-cbc';
mysql> SET @key_str = SHA2('My secret passphrase',512);
mysql> SET @init_vector = RANDOM_BYTES(16);
mysql> SET @crypt_str = AES_ENCRYPT('text',@key_str,@init_vector);
mysql> SELECT AES_DECRYPT(@crypt_str,@key_str,@init_vector);

*/

-- ##################################################################
--
-- mySQL select IN range
--
-- ##################################################################

SELECT job FROM mytable WHERE id BETWEEN 10 AND 15;
SELECT job FROM mytable WHERE id > 10 AND id < 15;



############################################
#
# install mysql-workbench in Ubuntu 19.04
#
############################################

/*

https://ubuntu.pkgs.org/18.10/ubuntu-universe-amd64/libzip4_1.1.2-1.1_amd64.deb.html
libzip4_1.1.2-1.1_amd64.deb

https://dev.mysql.com/downloads/workbench/
https://dev.mysql.com/get/Downloads/MySQLGUITools/mysql-workbench-community_8.0.16-1ubuntu18.04_amd64.deb
mysql-workbench-community_8.0.16-1ubuntu18.04_amd64.deb


mysql-workbench
mysql-workbench-community

*/
