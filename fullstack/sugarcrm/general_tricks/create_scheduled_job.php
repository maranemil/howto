<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 19.12.16
 * Time: 14:43
 */

/*
https://developer.sugarcrm.com/2012/09/07/adding-your-own-reoccuring-jobs-to-the-scheduler/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.8/Architecture/Job_Queue/Schedulers/Creating_Custom_Schedulers/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.5/Application_Framework/Job_Queue/Schedulers/Custom_Schedulers/
*/




// Defining the Job Label
// ./custom/Extension/modules/Schedulers/Ext/Language/en_us.custom_job.php

$mod_strings['LBL_CUSTOM_JOB'] = 'Custom Job';




// Defining the Job Function
// /custom/Extension/modules/Schedulers/Ext/ScheduledTasks/custom_job.php

array_push($job_strings, 'custom_job');
function custom_job()
{
	//logic here
	//return true for completed
	return true;
}

/*
Prior to 6.3.x, job functions were added by creating the file ./custom/modules/Schedulers/_AddJobsHere.php.
This method of creating functions is still compatible but is not recommended from a best practices standpoint.
*/


