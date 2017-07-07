<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 02.02.17
 * Time: 16:53
 */

global $db;
#phpinfo();

######################################################
#
# Reset make Empty sugarcrm-log
#
######################################################

$fp = fopen("sugarcrm.log","w");
fwrite($fp,"");

######################################################
#
# set asol_workingnodes as executing
#
######################################################


$sl = "UPDATE asol_workingnodes SET status = 'executing' WHERE date_modified LIKE  '2016-11-30%' ";
$db->query($sl);


$sl = "UPDATE inbound_email SET status='Active' WHERE id='73335f96-564e-6a23-35c9-4d6d5df596fd' ";
$db->query($sl);


######################################################
#
# set asol_workingnodes as terminated
#
######################################################

$sl = "UPDATE asol_workingnodes SET status='terminated' WHERE 1";
$db->query($sl);


######################################################
#
# Show schedulers info
#
######################################################

$sqlxc = "SELECT job,name,id,status,last_run,job_interval FROM schedulers";
$resxc = $db->query($sqlxc);
while($rowxc = $db->fetchByAssoc($resxc)){
	echo "<BR>".$rowxc["name"]." " .$rowxc["job"]."
	" .$rowxc["job_interval"]." " .$rowxc["id"]." " .$rowxc["status"]."
	" .$rowxc["last_run"];

}

######################################################
#
# Reset schedulers
#
######################################################

$sqlxc = "UPDATE job_queue SET status='done', resolution='success' WHERE 1";
$db->query($sqlxc);

$sqlxc = "UPDATE schedulers SET job_interval='*::*::*::*::*' WHERE id IN ('473254db-6f2b-94d6-ef5c-56b48592a42fb')";
$db->query($sqlxc);

$sqlxc = "UPDATE schedulers SET status='Inactive' WHERE id IN ('94e6c088-5733-a834-6b20-583b2600b88a3',)";
$db->query($sqlxc);


######################################################
#
# Set admin
#
######################################################

$sl = "UPDATE users SET is_admin=1 WHERE id='a52681e2f-00f7-e186-6ce9-541311c9f7ba'";
#$sl = "UPDATE users SET is_admin=0 WHERE id='a52681e2f-00f7-e186-6ce9-541311c9f7ba'";
$db->query($sl);

######################################################
#
# Update Sync date_modified and date_entered with reference date_work_done where date_work_done!=date_entered
#
######################################################

$slx = "UPDATE timelogs
SET date_entered = DATE_FORMAT(date_work_done,'%Y-%m-%d %h:%i:%s'), date_modified = DATE_FORMAT(date_work_done,'%Y-%m-%d %h:%i:%s')
WHERE assigned_user_id='52681e2f-00f7-e186-6ce9-541311c9f7ba' AND  DATE_FORMAT(date_entered,'%Y-%m-%d') != date_work_done; ";
$db->query($slx);

######################################################
#
# Select where date_work_done!=date_entered
#
######################################################

$sl = "SELECT  date_work_done, date_entered, date_modified
FROM timelogs
WHERE assigned_user_id='52681e2f-00f7-e186-6ce9-541311c9f7ba' AND   DATE_FORMAT(date_entered,'%Y-%m-%d') != date_work_done ";
$res = $db->query($sl);
while($row = $db->fetchByAssoc($res)){
	echo ''. $row['date_work_done'];
	echo ' - '. $row['date_entered'];
	echo "<br>";
}

