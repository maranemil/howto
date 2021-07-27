<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 18.03.16
 * Time: 14:08
 */

/**
 * PHP MySQL Timezone Cheatsheet
 */

// http://stackoverflow.com/questions/5746531/utc-date-time-string-to-timezone

echo "<br>";

echo date("Y-m-d H:i:s"); # REF1
echo "<br>";

$row["StageStartTime"] = "+1hours";
$futureDateUT = strtotime(date("Y-m-d H:i:s") . " " . $row["StageStartTime"] . ""); // add one hour
echo $futureDateDT = date("Y-m-d H:i:s", $futureDateUT); // +1 hour  REF2

echo "<br>";
$UTC = new DateTimeZone("UTC");
$newTZ = new DateTimeZone("Europe/Berlin");
$date = new DateTime($futureDateDT, $UTC);
$date->setTimezone($newTZ);
echo $date->format('Y-m-d H:i:s'); // REF3

echo "<br>";
date_default_timezone_set('Europe/Berlin'); // America/New_York
$datestring = $futureDateDT; //Pulled in from somewhere
$date = date('Y-m-d H:i:s T', strtotime($datestring . ' UTC'));
echo $date; // REF4

//2016-03-18 06:41:45           REF1
//2016-03-18 07:41:45           REF2
//2016-03-18 08:41:45           REF3
//2016-03-18 08:41:45 CET       REF4

//
//----------------------------------------------------------------------

/*

MySQL Timezone Cheatsheet
http://stackoverflow.com/questions/19023978/should-mysql-have-its-timezone-set-to-utc

To select the current datetime in UTC:

SELECT UTC_TIMESTAMP();
SELECT UTC_TIMESTAMP;
SELECT CONVERT_TZ(NOW(), @@session.time_zone, '+00:00');

Example result: 2015-03-24 17:02:41
To select the current datetime in the session timezone
SELECT NOW();
SELECT CURRENT_TIMESTAMP;
SELECT CURRENT_TIMESTAMP();

To get the current timezone
SELECT TIMEDIFF(NOW(), UTC_TIMESTAMP);

To get the current UNIX timestamp (in seconds):
SELECT UNIX_TIMESTAMP(NOW());
SELECT UNIX_TIMESTAMP();

To get the timestamp column as a UNIX timestamp
SELECT UNIX_TIMESTAMP(`timestamp`) FROM `table_name`

To get a UTC datetime column as a UNIX timestamp
SELECT UNIX_TIMESTAMP(CONVERT_TZ(`utc_datetime`, '+00:00', @@session.time_zone)) FROM `table_name`

Get a current timezone datetime from a positive UNIX timestamp integer
SELECT FROM_UNIXTIME(`unix_timestamp_int`) FROM `table_name`

Get a UTC datetime from a UNIX timestamp
SELECT CONVERT_TZ(FROM_UNIXTIME(`unix_timestamp_int`), @@session.time_zone, '+00:00') FROM `table_name`

Get a current timezone datetime from a negative UNIX timestamp integer
SELECT DATE_ADD('1970-01-01 00:00:00',INTERVAL -957632400 SECOND)

in the file "my.cnf"
default_time_zone='+00:00' or timezone='UTC'

@@global.time_zone variable
To see what value they are set to
SELECT @@global.time_zone;

To set a value for it use either one:
SET GLOBAL time_zone = '+8:00';
SET GLOBAL time_zone = 'Europe/Helsinki';
SET @@global.time_zone='+00:00';

@@session.time_zone variable
SELECT @@session.time_zone;

To set it use either one:
SET time_zone = 'Europe/Helsinki';
SET time_zone = "+00:00";
SET @@session.time_zone = "+00:00";

SELECT UTC_TIME()+0;
SELECT UTC_DATE()+0;
SELECT UTC_TIMESTAMP,UTC_TIMESTAMP();

 */

############################################################################################
#
#    Error 1292: "Incorrect datetime value"
#    Getting around MySQL TIMEDIFF() for hours greater than 838
#    http://www.microshell.com/database/mysql/getting-around-mysql-timediff-maximum-value-of-8385959/
#
############################################################################################
/*
SELECT version();
SHOW WARNINGS;

SELECT TIMEDIFF('2010-01-01 00:00:00', '2009-01-01 00:00:00');

solution:
SELECT
DATEDIFF('2010-01-01 00:00:00', '2009-01-01 00:00:00') * 24
+ EXTRACT(HOUR FROM '2010-01-01 00:00:00')
- EXTRACT(HOUR FROM '2009-01-01 00:00:00')

SELECT CONCAT (
REGEXP_SUBSTR (
ABS( DATEDIFF(fildname, UTC_TIMESTAMP()) * 24 + EXTRACT(HOUR FROM date_added) - EXTRACT(HOUR FROM UTC_TIMESTAMP()))      ,'[0-9]{2}')     , ":59:59" )
FROM table WHERE id = 1

----------------------------------------------------------------------------

https://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_timediff
https://dev.mysql.com/doc/refman/5.7/en/string-functions.html#function_substring-index
https://dev.mysql.com/doc/refman/5.7/en/string-functions.html#function_substr
https://dev.mysql.com/doc/refman/5.7/en/string-functions.html
https://dev.mysql.com/doc/refman/5.7/en/string-functions.html#function_substr
https://dev.mysql.com/doc/refman/5.7/en/string-functions.html#function_length
 */
