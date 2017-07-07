<?php

////////////////////////////////////////////////////
//
// PHP Error Log Settings in php scripts
//
////////////////////////////////////////////////////

ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('log_errors', 1);
//ini_set("error_log", "/path/to/php-error.log");
ini_set('html_errors',FALSE);
error_log( "Hello log errors!" ); // write some hallo in log