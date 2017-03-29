<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 25.09.15
 * Time: 16:09
 */


/////////////////////////////////////////////////////
//
// Overide Init PHP Settings
//
/////////////////////////////////////////////////////

ini_set('error_reporting', 0);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);

ini_set('max_execution_time', 30);
ini_set('mysql.connect_timeout', 30);
ini_set('mysql.cache_size', 16000); // '2000'
ini_set('mysql.cache_type', 0);
ini_set('default_socket_timeout', 30);

ini_set('html_errors', FALSE);
//ini_set('xdebug.default_enable', false);
ini_set('ignore_repeated_errors', true);
ini_set('ignore_repeated_source', true);

//ini_set("zlib.output_compression", 4096);
//ini_set("zlib.output_compression_level","-1");
//ini_set('zlib.output_compression', 'Off');
// ini_set('output_handler', 'mb_output_handler');

ini_set('zlib.output_handler', '');
ini_set('zlib.output_compression', 0);
ini_set('output_handler', '');
ini_set('output_buffering', false);
ini_set('implicit_flush', true);

/////////////////////////////////////////////////////
//
// Overide xdebug PHP Settings
//
/////////////////////////////////////////////////////

ini_set("xdebug.var_display_max_depth", -1);
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);


ini_set('log_errors', 0);
ini_set('html_errors', FALSE);

ini_set('max_execution_time', 300);    //300 seconds = 5 minutes
//ini_set('max_execution_time', 0); 	//0=NOLIMIT
set_time_limit(10); // or this way
ini_set('memory_limit', '256M');
//ini_set('memory_limit', '3G'); // 3 Gigabytes


//ini_set('error_prepend_string','<span style="color: red;">');
//ini_set('error_append_string','<br /></span>');
ini_set('ignore_repeated_errors', true);

# supress php errors

ini_set('display_startup_errors', 'Off');
ini_set('display_errors', 'Off');
ini_set('html_errors', 'Off');
ini_set('xdebug.default_enable', false);

ini_set('log_errors', 'Off');
ini_set('ignore_repeated_errors', 'On');
ini_set('ignore_repeated_source', 'On');

ini_set('magic_quotes_gpc', 'Off');
ini_set('track_vars', 'Off');
ini_set('track_errors', 'Off');
ini_set('register_globals', 'Off');
ini_set('report_memleaks', 'Off');

ini_set('error_reporting', 'E_ALL | E_STRICT');
//ini_set('error_reporting', '-1');
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'logs/error_log.txt');

ini_set('log_errors_max_len', 0);
ini_set('docref_root', 0);
ini_set('docref_ext', 'Off');

//ini_set('max_execution_time', 0);
ini_set('max_execution_time', '30');
ini_set('post_max_size', '10M');
ini_set('upload_max_filesize', '10M');
ini_set('memory_limit', '1024M');

ini_set('max_input_time', '20');
ini_set('session.gc_maxlifetime', '1200');
ini_set('date.timezone', 'Europe/Berlin');


/*
ini_set('error_reporting', E_ERROR);
//ini_set("error_log", "/path/to/php-error.log");

ini_set('display_errors', true);
ini_set('display_startup_errors', true);

ini_set("soap.wsdl_cache", "0");
ini_set("soap.wsdl_cache_dir", "/tmp");

//ini_set("soap.wsdl_cache_enabled", "1");
//ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
ini_set("soap.wsdl_cache_ttl", "86400");
ini_set("soap.wsdl_cache_enabled", "0");
//ini_set('soap.wsdl_cache_ttl', '0');
##ini_set('default_socket_timeout', 1); // set timeout
*/

//query_cache_size = 268435456
//query_cache_type=1
//query_cache_limit=1048576

// SET GLOBAL query_cache_size = 16 * 1024 * 1024;
// SET GLOBAL query_cache_size = 0;
// SET GLOBAL query_cache_type = 0;
// SET GLOBAL query_cache_limit = 1048576;
// SET GLOBAL query_cache_type = 1;
// SET GLOBAL query_cache_size = 8388608;

#query_alloc_block_size       | 8192    |
#query_cache_limit            | 1048576 |
#query_cache_min_res_unit     | 4096    |
#query_cache_size             | 8388608 |
#query_cache_type             | ON      |
#query_cache_wlock_invalidate | OFF     |
#query_prealloc_size          | 8192

/*
 * [MySQL]
    mysql.allow_local_infile = On
    mysql.allow_persistent = On
    mysql.cache_size = 2000
    mysql.max_persistent = -1
    mysql.max_links = -1
    mysql.default_port =
    mysql.default_socket=/tmp/mysql.sock
    mysql.default_host=
    mysql.default_user =
    mysql.default_password =
    mysql.connect_timeout = 60
    mysql.trace_mode = Off
*/


// Set up sessions to use cookies, NO MATTER WHAT
ini_set('session.use_cookies', 1);
// Set the save_handler to files
ini_set('session.save_handler', 'files');
// Set the content compression to zlib
//ini_set("zlib.output_compression", "4096");
//ini_set("allow_url_fopen",1);
if (DEVELOPMENT) {
	// In development mode, we need to turn on full throttle error reporting.
	// Display all errors (some production servers have this set to off)
	ini_set('display_errors', 1);
	// Up the ante on the error reporting so we can see notices as well.
	ini_set('error_reporting', E_ALL);
//    ini_set('error_reporting',E_ALL & ~E_STRICT);  // hide 'strict' warning in v5.4
	// This is rarely set to true, but the first time it is, we'll be ready.
	ini_set('ignore_repeated_errors', 0);
} else {
	// We can't be showing errors in a production environment...
	ini_set('display_errors', 0);
	ini_set('ignore_repeated_errors', 1);
}

function INISET()
{
	ini_set('register_globals', 'Off');
	ini_set('allow_call_time_pass_reference', 'Off');
	ini_set('allow_url_fopen', 'On');
	ini_set('allow_url_include', 'Off');
	ini_set('default_mimetype', 'text/html');
	ini_set('default_socket_timeout', '45');
	ini_set('display_errors', "off");
	ini_set('magic_quotes_gpc', 'Off');
	ini_set('max_execution_time', '30');
	ini_set('max_file_uploads', '20');
	ini_set('max_input_time', '1000');
	ini_set('mysqli.connect_timeout', '30');
	ini_set('post_max_size', '1M');
	ini_set('safe_mode', 'Off');
	ini_set('session.gc_maxlifetime', '1200');
	ini_set('session.cache_expire', '180');
	ini_set('short_open_tag', 'Off');
	ini_set('upload_max_filesize', '1M');
	ini_set('file_uploads', 'off');
	ini_set('output_buffering', 4096);
	ini_set('memory_limit', '256M');
	ini_set('mysql.cache_size', '2048');
	ini_set('display_errors', "on");
	error_reporting(1);
	return;
}



function INISET_V2()
{

// http://www.sssup.it/CSI/docs/php4/en-html-manual/function.ini-set.html

   proc_nice(19);

   set_time_limit(600);
   ini_set('default_socket_timeout', 300);
   ini_set('max_execution_time', '600');

   ini_set('mysql.connect_timeout', 300);
   ini_set('mysql.allow_persistent', 1);
   ini_set('mysql.max_persistent', -1);
   ini_set('mysql.max_links', -1);

   ini_set('error_reporting', E_ERROR);
   ini_set('display_errors', 'On');
   ini_set('display_startup_errors', 'On');

   ini_set('mysql.cache_size', 8000); // '2000'
   ini_set('mysql.cache_type', "ON");

   ini_set('mysql.query_cache_type', '1');
   ini_set('mysql.query_cache_size', '256000');
   ini_set('mysql.query_cache_limit', '32000');
   ini_set('mysql.query_cache_wlock_invalidate', "OFF");
   ini_set('mysql.query_cache_min_res_unit', '4096');
   ini_set('mysql.query_cache_strip_comments', "ON");

   ini_set('mysql.performance_schema', "OFF");
   ini_set('mysql.innodb_stats_on_metadata', "OFF");

#ini_set('mysqlnd.collect_statistics', "OFF");
#ini_set('mysqlnd.collect_memory_statistics', "OFF");

   ini_set('mysql.log_warnings', "OFF");
   ini_set('mysql.slow_query_log', "OFF");
   ini_set('mysql.long_query_time', "OFF");

   ini_set('html_errors', 'Off');
   ini_set('xdebug.default_enable', 'Off');
   ini_set('ignore_repeated_errors', 'On');
   ini_set('ignore_repeated_source', 'On');

   ini_set('log_errors_max_len', 0);
   ini_set('docref_root', 0);
   ini_set('docref_ext', 'Off');

   ini_set('track_vars', 'Off');
   ini_set('track_errors', 'Off');

#ini_set("soap.wsdl_cache_ttl", "86400");
#ini_set("soap.wsdl_cache_enabled", 1);

   ini_set('output_buffering', 4096);
   ini_set('expose_php', 'Off');

#echo ini_get("default_socket_timeout"); // 60 - 1min
#echo "<br>";
#echo ini_get("max_execution_time"); // 600 - 10min

   return;
}





function INISET_SUGARCRM7()
{

	// exec( "nice nohup php -f index.php < /dev/null > output.txt 2>&1 &" );
	// exec("renice +$priority ".getmypid());

	// decrease niceness
	proc_nice(19);
	echo memory_get_peak_usage();
	// exec("service apache2 restart", $output); print_r($output);
	// echo shell_exec('service httpd restart &');
	// exec("/usr/bin/sudo /usr/bin/service apache2 restart");
	// exec('/sbin/service apache2 restart');
	// http://php.net/manual/en/features.gc.collecting-cycles.php
	// http://php.net/manual/en/features.gc.performance-considerations.php

	// kill child process to "reset" niceness
	// posix_kill( getmypid(), 28 );

// --------------------------------------
	ini_set('memory_limit', '2048M'); // 3 Gigabytes 500M 2G
	ini_set('max_execution_time', 20);
	ini_set('default_mimetype', 'text/html');
	ini_set('short_open_tag', 'On');
#ini_set('default_socket_timeout','45');
// --------------------------------------
	ini_set('error_reporting', 'E_ERROR');
	ini_set('display_errors', true);
	ini_set('display_startup_errors', true);
	ini_set('docref_root', false);
	ini_set('docref_ext', false);
	ini_set('html_errors', 'Off');
	ini_set('ignore_repeated_errors', true);
	ini_set('ignore_repeated_source', true);
	ini_set('log_errors', false);
#ini_set('log_errors_max_len', "1024");
	ini_set('report_memleaks', false); // 'Off'
	ini_set('track_vars', false);
	ini_set('track_errors', 'Off');
#ini_set('register_globals', 'Off');
#ini_set('error_log', 'php-error.log');
	ini_set('allow_call_time_pass_reference', 'Off');
	ini_set('allow_url_include', 'Off');
	ini_set('define_syslog_variables', false);
#ini_set('magic_quotes_runtime',true);
	ini_set('register_argc_argv', 'Off');
// --------------------------------------
	ini_set('zlib.output_handler', '');
	ini_set('zlib.output_compression', 'Off');
#ini_set('output_buffering', 4096);
#ini_set('implicit_flush','Off');
// --------------------------------------
	ini_set('expose_php', 'Off');
#ini_set('max_input_time', 30);
// --------------------------------------
	ini_set('mysql.default_port', '3306');
	ini_set('mysql.allow_persistent', 'On');
	ini_set('mysql.default_host', '127.0.0.1');
	ini_set('mysql.trace_mode', false);
	ini_set('mysql.cache_size', '15M'); // '2000'
	ini_set('mysql.cache_type', '1');
	ini_set('mysql.query_cache_min_res_unit', '4k');
	ini_set('mysql.query_cache_type', '1');
	ini_set('mysql.query_cache_size', '10M');
	ini_set('mysql.query_cache_limit', '4M');
	ini_set('mysql.query_cache_strip_comments', true);
	ini_set('mysql.performance_schema', 'Off');
	ini_set('mysql.innodb_stats_on_metadata', 'Off');
#ini_set('mysql.innodb_sort_buffer_size','12M');
#ini_set('mysql.innodb_online_alter_log_max_size','4M');
	ini_set('mysql.connect_timeout', 15);
	ini_set('mysql.max_connections', '300');
	ini_set('mysql.default-storage-engine', 'InnoDB');
#ini_set('mysql.thread_concurrency','12');
	ini_set('mysql.log_warnings', 0);
	ini_set('mysql.slow_query_log', 0);
	ini_set('mysql.long_query_time', 0);
#ini_set('mysql.slow_query_log_file','/var/lib/mysql/slowq.log');
#ini_set('mysql.log-error','/var/log/mysqld.log');
// --------------------------------------
	ini_set('mysqli.allow_persistent', 'On');
	ini_set('mysqli.default_port', '3306');
	ini_set('mysqli.default_host', '127.0.0.1');
// --------------------------------------
	ini_set('mysqlnd.collect_statistics', 'Off');
	ini_set('mysqlnd.collect_memory_statistics', 'Off');
// --------------------------------------
	ini_set('session.bug_compat_42', 'Off');
	ini_set('session.bug_compat_warn', 'Off');
	ini_set('session.cache_expire', '3600');

	ini_set('xdebug.dump_globals', 'Off');
	ini_set('xdebug.dump_once', 0);
	ini_set('xdebug.dump_undefined', 0);
	ini_set('xdebug.default_enable', false);
	ini_set('xdebug.auto_trace', false);
	ini_set('xdebug.collect_vars', false);
	ini_set('xdebug.collect_return', false);
	ini_set('xdebug.collect_params', 'Off');
	ini_set('xdebug.trace_options', false);
	ini_set('xdebug.show_local_vars', false);
	ini_set('xdebug.show_exception_trace', 0);
	ini_set('xdebug.overload_var_dump', false);
	ini_set('xdebug.remote_enable', false);
	ini_set('xdebug.var_display_max_depth', 0);

}


function INISET_V2()
{

// http://www.sssup.it/CSI/docs/php4/en-html-manual/function.ini-set.html

   proc_nice(19);

   set_time_limit(600);
   ini_set('default_socket_timeout', 300);
   ini_set('max_execution_time', '600');

   ini_set('mysql.connect_timeout', 300);
   ini_set('mysql.allow_persistent', 1);
   ini_set('mysql.max_persistent', -1);
   ini_set('mysql.max_links', -1);

   ini_set('error_reporting', E_ERROR);
   ini_set('display_errors', 'On');
   ini_set('display_startup_errors', 'On');

   ini_set('mysql.cache_size', 8000); // '2000'
   ini_set('mysql.cache_type', "ON");

   ini_set('mysql.query_cache_type', '1');
   ini_set('mysql.query_cache_size', '256000');
   ini_set('mysql.query_cache_limit', '32000');
   ini_set('mysql.query_cache_wlock_invalidate', "OFF");
   ini_set('mysql.query_cache_min_res_unit', '4096');
   ini_set('mysql.query_cache_strip_comments', "ON");

   ini_set('mysql.performance_schema', "OFF");
   ini_set('mysql.innodb_stats_on_metadata', "OFF");

#ini_set('mysqlnd.collect_statistics', "OFF");
#ini_set('mysqlnd.collect_memory_statistics', "OFF");

   ini_set('mysql.log_warnings', "OFF");
   ini_set('mysql.slow_query_log', "OFF");
   ini_set('mysql.long_query_time', "OFF");

   ini_set('html_errors', 'Off');
   ini_set('xdebug.default_enable', 'Off');
   ini_set('ignore_repeated_errors', 'On');
   ini_set('ignore_repeated_source', 'On');

   ini_set('log_errors_max_len', 0);
   ini_set('docref_root', 0);
   ini_set('docref_ext', 'Off');

   ini_set('track_vars', 'Off');
   ini_set('track_errors', 'Off');

#ini_set("soap.wsdl_cache_ttl", "86400");
#ini_set("soap.wsdl_cache_enabled", 1);

   ini_set('output_buffering', 4096);
   ini_set('expose_php', 'Off');

#echo ini_get("default_socket_timeout"); // 60 - 1min
#echo "<br>";
#echo ini_get("max_execution_time"); // 600 - 10min

   return;
}





function INISET_SUGARCRM7()
{

	// exec( "nice nohup php -f index.php < /dev/null > output.txt 2>&1 &" );
	// exec("renice +$priority ".getmypid());

	// decrease niceness
	proc_nice(19);
	echo memory_get_peak_usage();
	// exec("service apache2 restart", $output); print_r($output);
	// echo shell_exec('service httpd restart &');
	// exec("/usr/bin/sudo /usr/bin/service apache2 restart");
	// exec('/sbin/service apache2 restart');
	// http://php.net/manual/en/features.gc.collecting-cycles.php
	// http://php.net/manual/en/features.gc.performance-considerations.php

	// kill child process to "reset" niceness
	// posix_kill( getmypid(), 28 );

// --------------------------------------
	ini_set('memory_limit', '2048M'); // 3 Gigabytes 500M 2G
	ini_set('max_execution_time', 20);
	ini_set('default_mimetype', 'text/html');
	ini_set('short_open_tag', 'On');
#ini_set('default_socket_timeout','45');
// --------------------------------------
	ini_set('error_reporting', 'E_ERROR');
	ini_set('display_errors', true);
	ini_set('display_startup_errors', true);
	ini_set('docref_root', false);
	ini_set('docref_ext', false);
	ini_set('html_errors', 'Off');
	ini_set('ignore_repeated_errors', true);
	ini_set('ignore_repeated_source', true);
	ini_set('log_errors', false);
#ini_set('log_errors_max_len', "1024");
	ini_set('report_memleaks', false); // 'Off'
	ini_set('track_vars', false);
	ini_set('track_errors', 'Off');
#ini_set('register_globals', 'Off');
#ini_set('error_log', 'php-error.log');
	ini_set('allow_call_time_pass_reference', 'Off');
	ini_set('allow_url_include', 'Off');
	ini_set('define_syslog_variables', false);
#ini_set('magic_quotes_runtime',true);
	ini_set('register_argc_argv', 'Off');
// --------------------------------------
	ini_set('zlib.output_handler', '');
	ini_set('zlib.output_compression', 'Off');
#ini_set('output_buffering', 4096);
#ini_set('implicit_flush','Off');
// --------------------------------------
	ini_set('expose_php', 'Off');
#ini_set('max_input_time', 30);
// --------------------------------------
	ini_set('mysql.default_port', '3306');
	ini_set('mysql.allow_persistent', 'On');
	ini_set('mysql.default_host', '127.0.0.1');
	ini_set('mysql.trace_mode', false);
	ini_set('mysql.cache_size', '15M'); // '2000'
	ini_set('mysql.cache_type', '1');
	ini_set('mysql.query_cache_min_res_unit', '4k');
	ini_set('mysql.query_cache_type', '1');
	ini_set('mysql.query_cache_size', '10M');
	ini_set('mysql.query_cache_limit', '4M');
	ini_set('mysql.query_cache_strip_comments', true);
	ini_set('mysql.performance_schema', 'Off');
	ini_set('mysql.innodb_stats_on_metadata', 'Off');
#ini_set('mysql.innodb_sort_buffer_size','12M');
#ini_set('mysql.innodb_online_alter_log_max_size','4M');
	ini_set('mysql.connect_timeout', 15);
	ini_set('mysql.max_connections', '300');
	ini_set('mysql.default-storage-engine', 'InnoDB');
#ini_set('mysql.thread_concurrency','12');
	ini_set('mysql.log_warnings', 0);
	ini_set('mysql.slow_query_log', 0);
	ini_set('mysql.long_query_time', 0);
#ini_set('mysql.slow_query_log_file','/var/lib/mysql/slowq.log');
#ini_set('mysql.log-error','/var/log/mysqld.log');
// --------------------------------------
	ini_set('mysqli.allow_persistent', 'On');
	ini_set('mysqli.default_port', '3306');
	ini_set('mysqli.default_host', '127.0.0.1');
// --------------------------------------
	ini_set('mysqlnd.collect_statistics', 'Off');
	ini_set('mysqlnd.collect_memory_statistics', 'Off');
// --------------------------------------
	ini_set('session.bug_compat_42', 'Off');
	ini_set('session.bug_compat_warn', 'Off');
	ini_set('session.cache_expire', '3600');

	ini_set('xdebug.dump_globals', 'Off');
	ini_set('xdebug.dump_once', 0);
	ini_set('xdebug.dump_undefined', 0);
	ini_set('xdebug.default_enable', false);
	ini_set('xdebug.auto_trace', false);
	ini_set('xdebug.collect_vars', false);
	ini_set('xdebug.collect_return', false);
	ini_set('xdebug.collect_params', 'Off');
	ini_set('xdebug.trace_options', false);
	ini_set('xdebug.show_local_vars', false);
	ini_set('xdebug.show_exception_trace', 0);
	ini_set('xdebug.overload_var_dump', false);
	ini_set('xdebug.remote_enable', false);
	ini_set('xdebug.var_display_max_depth', 0);

}


apache_setenv('no-gzip', 1);

header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
header("Cache-Control: maxage=1, post-check=0, pre-check=0");
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Content-Encoding: none");
#header("Content-Type: application/force-download");
#header("Content-type: application/octet-stream");
#header("Content-Type: multipart/form-data");
#header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache"); //HTTP 1.0
header("Pragma: public");
#header('Content-Type: application/pdf');


ini_set('magic_quotes_gpc', 'On');
ini_set('register_globals', 'On');

ini_set('implicit_flush', 1);
ini_set('output_buffering', 'Off');
ini_set('output_handler', '');
ini_set('zlib.output_compression', 'Off');
ini_set('zlib.output_compression', '0 ');
ini_set('zlib.output_compression_level', "-1");
ini_set("zlib.output_compression", 4096);

ini_set('display_errors', false);
ini_set('display_startup_errors', false);
ini_set('error_reporting', E_ERROR);

