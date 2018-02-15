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

// Note u is microseconds (1 seconds = 1000000 µs).

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

