<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 11.11.16
 * Time: 16:42
 */


ini_set('max_execution_time', 0);    //0=NOLIMIT
set_time_limit(0); // or this way

ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('log_errors', 0);
//ini_set("error_log", "/path/to/php-error.log");
ini_set('html_errors', FALSE);
//ini_set('xdebug.default_enable', false);
ini_set('ignore_repeated_errors', true);
ini_set('ignore_repeated_source', true);

///error_log( "Hello log errors!" ); // write some hallo in log
ini_set('memory_limit', '2256M');
//ini_set('memory_limit', '3G'); // 3 Gigabytes


// Instalation
// pecl install memcache
// pecl install pthreads
// sudo apt-get install php5-dev
// sudo apt-get install php7.0-dev
// yum install php-devel # Redhat Enterprise / CentOS
// php -i | grep pcntl
// php -i | grep disable_functions


// References
// https://www.mullie.eu/parallel-processing-multi-tasking-php/
// https://www.saidov.net/3-multi-threading-strategies-in-php.html
// http://php.net/manual/en/function.pcntl-fork.php
// http://php.net/manual/fr/pthreads.installation.php
// http://php.net/manual/en/class.worker.php
// https://www.rabbitmq.com/tutorials/tutorial-two-php.html
// http://dev.iron.io/worker/languages/php/
// https://github.com/chrisboulton/php-resque
// http://stackoverflow.com/questions/2861969/improving-html-scraper-efficiency-with-pcntl-fork/15691424#15691424
// http://stackoverflow.com/questions/16383803/pcntl-runs-the-same-code-several-times-assistance-required/16431346#16431346
// https://amigotechnotes.wordpress.com/2014/02/17/how-multi-core-processors-accelerate-your-lamp-applications/
// http://stackoverflow.com/questions/2267345/how-do-you-make-good-use-of-multicore-cpus-in-your-php-mysql-applications
// http://kamisama.me/2012/10/12/background-jobs-with-php-and-resque-part-4-managing-worker/
// https://devcenter.heroku.com/articles/php-workers
// http://kvz.io/blog/2009/01/09/create-daemons-in-php/

/*
 *
 * Batch Job Test for 1 CPU 100%
 *
 *

$micro_date = microtime();
$date_array = explode(" ",$micro_date);
$date = date("Y-m-d H:i:s",$date_array[1]);
echo "Date:<br> $date:" . $date_array[0]."<br>";

for($i = 0; $i < 100000; $i++){
	sha1(md5(crypt(crc32($i)))) ;
}
proc_nice(19);
for($i = 0; $i < 100000; $i++){
	sha1(md5(crypt(crc32($i)))) ;
}

//Recommended and use dateTime() class from referenced:
$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
print $d->format("Y-m-d H:i:s.u"); // note at point on "u"

*/


/*
Date:
2016-11-11 13:48:20:0.76366000
2016-11-11 13:57:17.988629
*/