
###################################################
#
#   DATE FORMAT
#
###################################################

/*

SELECT DATE_ADD(NOW(), INTERVAL 5 DAY) # 5 days in future
SELECT DATE_ADD(NOW(), INTERVAL 1 MONTH) # 1 months in future
SELECT DATE_ADD(NOW(), INTERVAL 6 HOUR) # 6 hours in future

SELECT DATE_SUB(CURDATE(),INTERVAL 7 DAY) # 7 days ago - only date
SELECT DATE_SUB(NOW(),INTERVAL 7 DAY) # 7 days ago
SELECT DATE_SUB(NOW(),INTERVAL 7 HOUR) # 7 hours ago
SELECT DATE_SUB(NOW(),INTERVAL 1 MONTH) # 7 months ago


# SELECT UNIX_TIMESTAMP(  STR_TO_DATE('2011-12-21 02:20pm', '%Y-%m-%d %h:%i%p') );
# DATE_FORMAT(STR_TO_DATE(t.datestring, '%d/%m/%Y'), '%Y-%m-%d')

DATEDIFF(NOW(),'2016-09-27') = 0 				        // 0 days difference
DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),NOW()) = 0)		// 0 days difference

# fieldx != "" AND fieldx IS NOT NULL

# last_7_days
date_sent BETWEEN date_sub( now( ) , INTERVAL 1 WEEK ) AND now( )

# last_30_days
date_sent BETWEEN DATE_FORMAT( NOW( ) , '%Y-%m-01 00:00:00' ) AND DATE_FORMAT( LAST_DAY( NOW( ) - INTERVAL 15 DAY ) , '%Y-%m-%d 23:59:59' )

# last month
date_sent BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00') AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')

# this month
date_sent BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 DAY, '%Y-%m-01 00:00:00') AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 DAY), '%Y-%m-%d 23:59:59')

# last year
YEAR(date_sent) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))

# this year
YEAR(date_sent) = YEAR(CURDATE())

# This week
SELECT * FROM accounts WHERE deleted=0 AND WEEK(DATE(NOW())) = WEEK(date_entered) ORDER BY date_entered DESC
SELECT * FROM accounts WHERE  WHERE date_entered >= DATE(NOW()) + INTERVAL 0 - WEEKDAY(NOW()) DAY AND date_entered <  DATE(NOW()) + INTERVAL 7 - WEEKDAY(NOW()) DAY

# Last Week
SELECT id FROM tbl WHERE date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
SELECT id FROM tbl WHERE date between date_sub(now(),INTERVAL 1 WEEK) and now();
SELECT id FROM tbl WHERE  WEEK (date) = WEEK( current_date ) - 1 AND YEAR( date) = YEAR( current_date );
SELECT id FROM tbl WHERE  WEEK (date) = WEEK( current_date ) - 2 AND YEAR( date) = YEAR( current_date );

SELECT YEARWEEK('1987-01-01');
SELECT WEEKOFYEAR('2008-02-20');
SELECT YEAR('1987-01-01');
SELECT WEEKDAY('2008-02-03 22:23:00');
SELECT WEEK('2000-01-01',2);


###################################################
#
# disable ONLY_FULL_GROUP_BY
#
###################################################

SET sql_mode = 'ONLY_FULL_GROUP_BY';
SET sql_mode = '';

mysql > SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

sudo nano /etc/mysql/my.cnf
Add this to the end of the file
[mysqld]
sql_mode = "STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
sudo service mysql restart to restart MySQL

SELECT @@sql_mode
ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION
SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';


###################################################
#
# #1451 - Cannot delete or update a parent row: a foreign key constraint fails
#
###################################################


SET FOREIGN_KEY_CHECKS=0; -- to disable them
# Do here update or delete
SET FOREIGN_KEY_CHECKS=1; -- to re-enable them

###################################################
#
# Replace regex oracle
# https://docs.oracle.com/cd/B19306_01/server.102/b14200/functions130.htm
###################################################


###################################################
#
# SELECT HOUR
# https://stackoverflow.com/questions/14845981/datetime-group-by-date-and-hour
# https://dev.mysql.com/doc/refman/5.7/en/date-and-time-functions.html
#
###################################################

SELECT [activity_dt], count(*) FROM table1 GROUP BY hour( activity_dt ) , day( activity_dt )
SELECT [activity_dt], count(*) FROM table1 GROUP BY minute( activity_dt ) , minute( activity_dt )

*/





# https://stackoverflow.com/questions/5201383/how-to-convert-a-string-to-date-in-mysql
# http://www.mysqltutorial.org/mysql-str_to_date/
# https://mariadb.com/kb/en/library/substring/

SELECT STR_TO_DATE(SUBSTRING('20180328160604.png',1,8), '%Y%m%d')
SELECT * FROM table WHERE STR_TO_DATE(SUBSTRING(table.field,1,8), '%Y%m%d') < DATE_SUB(NOW(),INTERVAL 1 WEEK)


#####################################################################
#
#  DAYNAME DAYOFWEEK
#
#####################################################################

SELECT DAYNAME('2008-05-15'); # Thursday
SELECT DAYOFWEEK('2008-05-15'); # 5
SELECT MONTH('2008-05-15'); # 5
SELECT YEAR('2008-05-15'); # 2008
SELECT DAY('2008-05-15'); # 15

/*

https://www.w3resource.com/mysql/date-and-time-functions/mysql-dayname-function.php
https://www.php-einfach.de/mysql-tutorial/mysql-datumfunktion-zeitfunktion/#DAY_MONTH_und_YEAR

Funktion	Beschreibung

SECOND()	Gibt die Sekunden zurück.
MINUTE()	Gibt die Minuten zurück.
HOUR()		Gibt die Stunden zurück.
DAY()		Gibt den Tag zurück.
DAYOFWEEK()	Gibt den Wochentag (1=Sonntag, 7=Samstag) zurück.
MONTH()		Gibt den Monat (als Zahl) zurück.
YEAR()		Gibt das Jahr zurück.
NOW()		Gibt das aktuelle Datum und die aktuelle Zeit zurück ('YYYY-MM-DD HH:MM:SS').
DATE_SUB()	Zieht vom ersten Argument eine Zeitspanne ab.
DATE_ADD()	Addierst auf das erste Argument eine Zeitspanne.
*/