<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 10.03.16
 * Time: 17:32
 */

// ----------------------------------------
// http://phptester.net/
// ----------------------------------------
echo md5('2016-03-10 10:06:24.113066'); // 2d62bea38e19fe62be716be85103d8ac
echo '<br>';
echo strtotime('2016-03-10 10:06:24.113066'); // 1457622384
echo '<hr>';
echo '<br>';
echo date("Y-m-d H:i:s"); // NOW()  2016-03-10 10:50:36
echo '<br>';
echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +1hours")); // 2016-03-10 11:50:36
echo '<br>';
echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +1days"));  // 2016-03-11 10:50:36
echo '<br>';
echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +1weeks")); // 2016-03-17 10:50:36
echo '<br>';
echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +1month")); // 2016-04-10 10:50:36

##########
// http://stackoverflow.com/questions/17909871/getting-date-format-m-d-y-his-u-from-milliseconds

$micro_date = microtime();
$date_array = explode(" ",$micro_date);
$date = date("Y-m-d H:i:s",$date_array[1]);
echo "Date: $date:" . $date_array[0]."<br>";

// Recommended and use dateTime() class from referenced:
$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
print $d->format("Y-m-d H:i:s.u"); // note at point on "u"

// DATE DIFF PHP
$dateToday = date_create(date("Y-m-d H:i:s"));
$dateTime = date_create($rowDCN["date_expires_c"]);
$interval = date_diff($dateToday, $dateTime);
if ($interval->format('%d') == 0) { // 0 Days ?
	$caseWF = 'Case0';
}





//Note u is microseconds (1 seconds = 1000000 µs).

############
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


*/


// date_default_timezone_set('UTC');
$given = new DateTime("2014-12-12 14:18:00");
echo $given->format("Y-m-d H:i:s e") . "\n"; // 2014-12-12 14:18:00 Asia/Bangkok


$given->setTimezone(new DateTimeZone("UTC"));
echo $given->format("Y-m-d H:i:s e") . "\n"; // 2014-12-12 07:18:00 UTC



$nowUtc = new \DateTime( 'now',  new \DateTimeZone( 'UTC' ) );
echo '$nowUtc'.PHP_EOL;
var_dump($nowUtc);
$nowUtc = new \DateTime( 'now',  new \DateTimeZone( 'UTC' ) );
echo '$nowUtc->format(\'Y-m-d h:i:s\')'.PHP_EOL;
var_dump($nowUtc->format('Y-m-d h:i:s'));
$nowUtc->setTimezone( new \DateTimeZone( 'Australia/Sydney' ) );
echo '$nowUtc->setTimezone( new \DateTimeZone( \'Australia/Sydney\' ) )'.PHP_EOL;
var_dump($nowUtc);
echo '$nowUtc->format(\'Y-m-d h:i:s\')'.PHP_EOL;
var_dump($nowUtc->format('Y-m-d h:i:s'));exit;



$the_date = strtotime("2010-01-19 00:00:00");
echo(date_default_timezone_get() . "<br />");
echo(date("Y-d-mTG:i:sz",$the_date) . "<br />");
echo(date_default_timezone_set("UTC") . "<br />");
echo(date("Y-d-mTG:i:sz", $the_date) . "<br />");




echo gmdate('d.m.Y H:i', strtotime('2012-06-28 23:55'));



date_default_timezone_set('Europe/Stockholm');
print date('Y-m-d H:i:s',strtotime("2009-01-01 12:00"." UTC"))."\n";
print date('Y-m-d H:i:s',strtotime("2009-06-01 12:00"." UTC"))."\n";



// set timezone to user timezone
date_default_timezone_set($str_user_timezone);
// create date object using any given format
$date = DateTime::createFromFormat($str_user_dateformat, $str_user_datetime);
// convert given datetime to safe format for strtotime
$str_user_datetime = $date->format('Y-m-d H:i:s');
// convert to UTC
$str_UTC_datetime = gmdate($str_server_dateformat, strtotime($str_user_datetime));
// return timezone to server default
date_default_timezone_set($str_server_timezone);

###################################################
#
# set date.timezone
#
###################################################

if (ini_get('date.timezone')) {
	echo 'date.timezone: ' . ini_get('date.timezone');
}
else{
	date_default_timezone_set("Europe/Berlin");
}

$d1=new DateTime("2012-07-08 11:14:15.638276");
$d1->setTimeZone(new DateTimeZone("Europe/Amsterdam"));
$d2=new DateTime('NOW');
$d2->setTimeZone(new DateTimeZone("Europe/Berlin"));

//$diff=$d2->diff($d1);
//print_r( $diff ) ;

// Output the microseconds.
echo $d1->format('u'); // 012345
echo "<br>";
// Output the date with microseconds.
echo $d2->format('Y-m-d\TH:i:s.u'); // 2011-01-01T15:03:01.012345


###################################################
#
# set + 1 day
#
###################################################

$date = new DateTime("2006-12-12");
$date->modify("+7 day");
echo $date->format("Y-m-d");


// This is what you need for future date from now.
echo date('Y-m-d H:i:s', strtotime("+7 day"));
// This is what you need for future date from specific date.
echo date('Y-m-d H:i:s', strtotime('01/01/2010 +7 day'));




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