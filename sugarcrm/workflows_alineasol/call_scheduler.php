<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 25.11.16
 * Time: 23:52
 */

//$note = new Note();
//$note->name = "Scheduler test ".date("Y-m-d H:i:s");
//$note->save();

//$note = BeanFactory::newBean('Notes');
//$note->name = "Scheduler test ".date("Y-m-d H:i:s");
//$note->save();

include_once('modules/WorkFlow/WorkFlowSchedule.php');
global $app_list_strings, $app_strings, $current_language;
$mod_strings = return_module_language('en_us', 'WorkFlow');
//run as admin
global $current_user;
#$current_user->is_admin = true;
$current_user = Scheduler::initUser();
$process_object = new WorkFlowSchedule();
$process_object->process_scheduled();
unset($process_object);
