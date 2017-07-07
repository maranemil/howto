<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 21.01.16
 * Time: 10:15
 */

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

define('sugarEntry', 'index.php');
require_once('include/entryPoint.php');
//require_once('include/MVC/SugarApplication.php');
//require_once('config.php');
//require_once('include/database/PearDatabase.php');
//require_once ("include/TimeDate.php");
//require_once("modules/Users/User.php");
//require_once("modules/Accounts/Account.php");
//require_once("modules/Contacts/Contact.php");
//require_once("modules/Administration/Administration.php");
include_once('sugar_version.php');
//require_once('include/MVC/SugarApplication.php');
//require_once('modules/Emails/Email.php');
//require_once('modules/EmailTemplates/EmailTemplate.php');
//require_once('data/SugarBean.php');
//require_once('include/SugarPHPMailer.php');


global $sugar_config;
global $GLOBALS;
global $db;
global $current_user;
//global $bean_id;

for($i = 0; $i < 2000; $i++){
	$triggerModule = "Calls"; //
//$triggerBeanId = create_guid(); // $new_bean['id'];
	$triggerBean = BeanFactory::newBean($triggerModule);
	$triggerBean->name = 'Example Call '.rand(1,9999);
	$triggerBean->date_start = '2016-01-23 06:45:00';
	$triggerBean->date_end = '2016-01-23 07:45:00';
	$triggerBean->status = 'Planned';
	$triggerBean->direction = 'Outbound';

	$triggerBean->assigned_user_id = 1;
	$triggerBean->modified_user_id = 1;
	$triggerBean->created_by = 1;
	$triggerBean->duration_hours = 0;
	$triggerBean->duration_minutes = 45;

	$triggerBean->save();
}
