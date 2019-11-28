
###################################################
#
#   DATE FORMAT
#
###################################################

# https://mariadb.com/kb/en/library/date_format/
# https://www.w3resource.com/mysql/date-and-time-functions/mysql-date_format-function.php
# http://www.mysqltutorial.org/mysql-date_format/


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


SELECT
DATE_FORMAT(STR_TO_DATE('01.10.2019','%d.%m.%Y'),'%Y-%m-%d %h:%i%p') date1,
DATE_FORMAT(STR_TO_DATE('01.10.2019','%d.%m.%Y'),'%Y-%m-%d %H:%i:%s') date2,
STR_TO_DATE('2011-12-21', '%Y-%m-%d %h:%i%p') date3,
STR_TO_DATE('2011-12-21', '%Y-%m-%d %H:%i:%s') date4,
DATE_FORMAT(STR_TO_DATE('2011-12-21', '%Y-%m-%d %H:%i:%s'),'%Y-%m-%d 23:59:59') date5


# output
2019-10-01 12:00AM
2019-10-01 00:00:00
2011-12-21 00:00:00
2011-12-21 00:00:00
2011-12-21 23:59:59




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





/*
https://dev.mysql.com/doc/refman/8.0/en/regexp.html#operator_not-regexp
https://dev.mysql.com/doc/refman/8.0/en/regexp.html
https://www.w3resource.com/mysql/string-functions/mysql-not-regexp-function.php
*/

# REGEXP NEGATION

SELECT * FROM author WHERE country NOT REGEXP '^U';
SELECT 'Michael!' REGEXP '.*';

# https://www.w3schools.com/sql/func_mysql_coalesce.asp

# Return the first non-null expression in a list:
SELECT COALESCE(NULL, NULL, NULL, 'W3Schools.com', NULL, 'Example.com');


# Select integer
SELECT
  CAST(count(number) as UNSIGNED) as average,
FROM stats





#############################################################
#
#   MySQL row_number – adding a row number for each row
#
#   http://www.mysqltutorial.org/mysql-row_number/
#   https://blog.sqlauthority.com/2014/03/08/mysql-generating-row-number-for-each-row-using-variable/
#   https://www.tech-recipes.com/rx/17470/mysql-how-to-get-row-number-order-5/
#   https://www.xaprb.com/blog/2006/12/02/how-to-number-rows-in-mysql/
#
#############################################################

SET @row_number = 0;
SELECT (@row_number:=@row_number + 1) AS num, firstName, lastName
FROM employees LIMIT 5;

SELECT (@row_number:=@row_number + 1) AS num, firstName, lastName
FROM employees,(SELECT @row_number:=0) AS t LIMIT 5;

#############################################################
#
#  SQL Date Interval Week
#
#   http://www.mysqltutorial.org/mysql-date-functions/
#   http://www.java2s.com/Tutorial/MySQL/0280__Date-Time-Functions/DATESUBcurdateINTERVAL1WEEK.htm
#   https://discourse.looker.com/t/how-to-count-only-weekdays-between-two-dates/3345
#   https://dba.stackexchange.com/questions/24262/get-two-weeks-of-data-but-group-by-a-period-of-7-days
#   https://dba.stackexchange.com/questions/151245/how-to-get-all-data-before-and-after-10-days-of-interval
#   https://coursesweb.net/php-mysql/days-between-two-dates-specified-week-php-mysql_t
#
#############################################################


SELECT LAST_DAY('2016-02-03'); # Returns last day of the month.
SELECT DAYNAME('2000-01-01') dayname; # Dayname "Saturday"
SELECT DAYNAME('2012-12-01'), DAYOFWEEK('2012-12-01'); # Saturday 7
SELECT TIMEDIFF('12:00:00','10:00:00') diff; # Diff
SELECT WEEK(NOW()) # 48 - Week Number
SELECT DATE_SUB( DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL +7 DAY ) # last monday
SELECT DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) # current monday




#############################################################
#
# Format CRON Format as DateTime
#
#############################################################

/*
https://forums.mysql.com/read.php?20,508361,508361#REPLY
https://crontab.guru/
https://www.w3schools.com/sql/func_mysql_cast.asp
https://dev.mysql.com/doc/refman/8.0/en/user-variables.html
https://dev.mysql.com/doc/refman/5.5/en/string-functions.html#function_substring
https://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_date-format
https://dev.mysql.com/doc/refman/5.5/en/string-functions.html#function_substring-index
https://coderwall.com/p/zzgo-w/splitting-strings-with-mysql
https://www.w3resource.com/mysql/string-functions/mysql-substring_index-function.php
https://www.gyrocode.com/articles/how-to-split-and-search-in-comma-separated-values-in-mysql/
https://www.periscopedata.com/blog/splitting-comma-separated-values-in-mysql
https://stackoverflow.com/questions/5928599/equivalent-of-explode-to-work-with-strings-in-mysql
https://www.w3schools.com/sql/func_mysql_substring_index.asp
*/

# minute hour day(month) month day(week)

#SET @cron = '* 20/21 * * *';
#SET @cron = '11 12 13 8 3';
SET @cron = '55 * * 9 *';

SELECT
CONCAT(
   # Date
	YEAR(NOW()),"-",
	IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) = '*',   MONTH(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",4)    ," ",-1)    )  ,"-",
	IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) = '*',   DAY(NOW() + INTERVAL 1 DAY),   CAST( SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",3)    ," ",-1)  AS INT)   )  ," ",
    # Time
    IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) = '*',   HOUR(NOW()),   CAST(  SUBSTRING_INDEX(  SUBSTRING_INDEX(@cron," ",2)    ," ",-1)   AS INT)     ) , ":",
    IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2) = '*',   MINUTE(NOW()) ,  CAST(  SUBSTRING_INDEX(  SUBSTRING_INDEX(@cron," ",1)    ," ",-1)   AS INT)           ) , ":",
    "00"
) AS DATEOUTPUT;

--  IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2)  = '*', MINUTE(NOW()),   "00") as CRONMIN,
--  IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) = '*',   HOUR(NOW()),   SUBSTRING_INDEX(  SUBSTRING_INDEX(@cron," ",2)    ," ",-1)    ) as CRONHOUR,
 -- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) = '*',   DAY(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",3)    ," ",-1)    ) as CRONDAY,
 -- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) = '*',   MONTH(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",4)    ," ",-1)    ) as CRONMONTH,
 -- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2) = '*',   DAYOFWEEK(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",5)    ," ",-1)    ) as CRONDAYWEEK

/*
SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2)  as CRONMIN1,
SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2)  as CRONMIN2,
SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2)  as CRONMIN3,
SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2)  as CRONMIN4,
SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2)  as CRONMIN5
*/


#SET @cron = '*/4 * 5,6-12 * *';
SET @cron = '8-6 * 5,6-12 * *';
SELECT
@CRONMIN:=
	LPAD (
		IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2) LIKE '*%' ,  '00' ,
			IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2) LIKE '%,%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2)   ,',' ,1),
				IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2) LIKE '%-%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2) , '-',1),   '00'    )
			)
        )
    ,2,'0') as CRONMIN,
    @CRONHOUR := LPAD (
		IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) LIKE '*%' , HOUR(NOW()) ,
			IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) LIKE '%,%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2)   ,',' ,1),
			   IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) LIKE '%-%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) , '-',1), HOUR(NOW())    )
		)
	)
    ,2,'0') as CRONHOUR,
    @CRONDAY:= LPAD (
		IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) LIKE '*%' , DAY(NOW()) ,
			IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) LIKE '%,%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2)   ,',' ,1),
			   IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) LIKE '%-%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) , '-',1), DAY(NOW())   )
		)
	)	 ,2,'0') as CRONDAY,
    @CRONMONTH:= LPAD (
    	IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) LIKE '*%' , MONTH(NOW()) ,
			IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) LIKE '%,%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2)   ,',' ,1),
			   IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) LIKE '%-%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) , '-',1),  MONTH(NOW())    )
		)
	)   ,2,'0') as CRONMONTH,
    @CRONDAYWEEK:= LPAD (
        	IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2) LIKE '*%' , DAYOFWEEK(NOW()) ,
			IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2) LIKE '%,%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2)   ,',' ,1),
			   IF ( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2) LIKE '%-%' , SUBSTRING_INDEX( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2) , '-',1),  DAYOFWEEK(NOW())    )
		)
	)  ,2,'0') as CRONDAYWEEK ,
     CONCAT(YEAR(NOW()),'-',@CRONMONTH,'-',@CRONDAY,' ',@CRONHOUR,':',@CRONMIN,':00')    AS NEXTCRONDATE
     #GROUP BY @CRONMONTH,@CRONDAY,@CRONHOUR,@CRONMIN, NEXTCRONDATE

-- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-5),1,2)  = '*', MINUTE(NOW()),   "00") as CRONMIN
 -- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-4),1,2) = '*',   HOUR(NOW()),   SUBSTRING_INDEX(  SUBSTRING_INDEX(@cron," ",2)    ," ",-1)    ) as CRONHOUR,
-- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-3),1,2) = '*',   DAY(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",3)    ," ",-1)    ) as CRONDAY,
-- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-2),1,2) = '*',   MONTH(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",4)    ," ",-1)    ) as CRONMONTH,
-- IF( SUBSTR( SUBSTRING_INDEX(@cron," ",-1),1,2) = '*',   DAYOFWEEK(NOW()),   SUBSTRING_INDEX( SUBSTRING_INDEX(@cron," ",5)    ," ",-1)    ) as CRONDAYWEEK

/*
https://crontab.guru/#
https://dev.mysql.com/doc/refman/8.0/en/case.html
https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_date-sub
https://stackoverflow.com/questions/9052815/mysql-use-a-value-from-a-select-in-the-select-itself
https://stackoverflow.com/questions/21676224/how-to-write-nested-if-else-if-in-mysql
https://www.w3resource.com/mysql/string-functions/mysql-lpad-function.php
*/




###################################################
#
#   Difference in HOURS from two time fields in MySQL
#   https://stackoverflow.com/questions/11579946/only-show-hours-in-mysql-datediff
#   https://stackoverflow.com/questions/1770594/how-to-calculate-difference-in-hours-decimal-between-two-dates-in-sql-server
#
###################################################

SELECT TIMESTAMPDIFF(HOUR, start_time, end_time) as `difference` FROM timeattendance WHERE id = '1484'
SELECT HOUR(TIMEDIFF(end_time, start_time)) as difference FROM timeattendance WHERE id = '1484';
SELECT TIMEDIFF ( "2012-01-02 13:00:00", "2012-01-01 12:00:00") / 3600
SELECT ( UNIX_TIMESTAMP("2012-01-02 13:00:00") -  UNIX_TIMESTAMP("2012-01-01 12:00:00") ) / 3600
SELECT DATEDIFF(second, start_date, end_date) / 3600.0


###################################################
#
#   Difference in minutes from two time fields in MySQL
#   https://stackoverflow.com/questions/5070111/difference-in-minutes-from-two-time-fields-in-mysql
#
###################################################

TIMESTAMPDIFF(MINUTE, start_time, end_time)
SELECT (TIME_TO_SEC(end_time) - TIME_TO_SEC(start_time))/60 AS `minutes`
SELECT SUBTIME(end_time, start_time)
UNIX_TIMESTAMP(event1)-UNIX_TIMESTAMP(event2)


MINUTE(TIMEDIFF(o.date_input,NOW())) as diff_hours   	# 0  when > 1h else minutes as output
TIMESTAMPDIFF(HOUR,o.date_input,NOW())  as diff_hours 	# 1 h
TIMESTAMPDIFF(MINUTE, o.date_input,NOW()) as diff_min	# 60 min



###################################################
#
# Select difference in minutes or hours (start_date,now())
#
###################################################

SELECT DISTINCT item_id,
TIMESTAMPDIFF(HOUR,start_date,NOW()) as diff_hours, -- get diff in hours
TIMESTAMPDIFF(MINUTE, start_date,NOW()) as diff_min -- get diff in minutes
FROM <table>
WHERE start_date > DATE (NOW() - INTERVAL 60 day) -- from last 60 days
ORDER BY diff_min DESC -- sort by diff hours desc




###################################################
#
#   Select difference in hours (start_date,end_date)
#   Transform text in dateformat if possible with SUBSTRING_INDEX
#   field_text is 2019-11-21 15:39:03/text<info>
#   use STR_TO_DATE to validate string as dateformat
#
###################################################

SELECT DISTINCT item_id, end_date,
SUBSTRING_INDEX(field_text,'/',1) as start_date,
TIMESTAMPDIFF(HOUR,SUBSTRING_INDEX(field_text,'/',1),end_date) as diff_hours -- get diff in hours
FROM <table>
WHERE end_date > DATE (NOW() - INTERVAL 30 day) -- from last 30 days
AND STR_TO_DATE(SUBSTRING_INDEX(field_text,'/',1), '%Y-%m-%d %H:%i:%s') IS NOT NULL -- valid date
AND DATEDIFF(DATE_FORMAT(end_date,'%Y-%m-%d'), SUBSTRING_INDEX(field_text,'/',1)) = 0 -- must be from the same day
AND TIMESTAMPDIFF(HOUR,SUBSTRING_INDEX(field_text,'/',1),end_date) > 5 -- where diff hours bigger than 5





