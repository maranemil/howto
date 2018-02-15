<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 05.02.16
 * Time: 13:07
 */

ini_set('error_reporting', 0);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);

ini_set('max_execution_time', 3000);
ini_set('mysql.connect_timeout', 3000);

if(!defined('sugarEntry'))define('sugarEntry', true);
//change directories to where this file is located.
//chdir(dirname(__FILE__));
define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');

SugarMetric_Manager::getInstance()->setMetricClass('background')->setTransactionName('cron');

if(empty($current_language)) {
	$current_language = $sugar_config['default_language'];
}

$app_list_strings = return_app_list_strings_language($current_language);
$app_strings = return_application_language($current_language);

global $current_user;
$current_user = BeanFactory::getBean('Users');
$current_user->getSystemUser();

$GLOBALS['log']->debug('-----------------> at cron.php <----------------------');
$cron_driver = !empty($sugar_config['cron_class'])?$sugar_config['cron_class']:'SugarCronJobs';
$GLOBALS['log']->debug("Using $cron_driver as CRON driver");

SugarAutoLoader::requireWithCustom("include/SugarQueue/$cron_driver.php");

$jobq = new $cron_driver();
$jobq->runCycle();

$exit_on_cleanup = true;

sugar_cleanup(false);
// some jobs have annoying habit of calling sugar_cleanup(), and it can be called only once
// but job results can be written to DB after job is finished, so we have to disconnect here again
// just in case we couldn't call cleanup
if(class_exists('DBManagerFactory')) {
	$db = DBManagerFactory::getInstance();
	$db->disconnect();
}

// If we have a session left over, destroy it
if(session_id()) {
	session_destroy();
}

if($exit_on_cleanup) exit($jobq->runOk()?0:1);
die();

