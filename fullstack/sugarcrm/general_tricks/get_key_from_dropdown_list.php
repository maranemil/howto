<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 03.02.17
 * Time: 14:10
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

ini_set('memory_limit', '3G'); // 3 Gigabytes

proc_nice(19);
echo "Mem: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MiB \n";
echo "CPU: " . max(sys_getloadavg()) . " %  \n \n";

#if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
if (!defined('sugarEntry') || !sugarEntry) define('sugarEntry', TRUE);
#header("Content-Type: text/html; charset=utf-8");
header("Content-Type: text/plain; charset=utf-8");
#header("Content-Type: text/html; charset=8859-1");

include_once('include/entryPoint.php');
#require_once('include/utils.php');

global $app_list_strings;
include ("custom/application/Ext/Language/".$GLOBALS['current_language'].".lang.ext.php");
$accCountry = "Deutschland"; // "";
#echo $keyCountry = array_search($accCountry,$app_list_strings['countries_dom']);
foreach($app_list_strings['countries_dom'] as $key => $country){
	//echo $country."\n";
	if(trim(strtolower($country))==trim(strtolower($accCountry))){
		echo $key;
	}
}
