<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 16.11.16
 * Time: 10:21
 */

if(!defined('sugarEntry'))define('sugarEntry', true);
//define('ENTRY_POINT_TYPE', 'gui');
echo "<br>".$startTime = microtime(true);
require_once('include/entryPoint.php');
ob_start();
echo "run";
echo "<br>". $endtime = microtime(true);
include_once("custom/Extension/modules/Schedulers/Ext/ScheduledTasks/Some_job.php");
Some_job();