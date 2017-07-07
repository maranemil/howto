<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 26.11.16
 * Time: 00:05
 */

// WF SoftDelete Notifications

global $db;

$sqlXU = "UPDATE notifications SET deleted=1 WHERE deleted=0";
$db->query($sqlXU);

$sqlX = "SELECT * FROM notifications WHERE deleted=0 limit 1";
$resX = $db->query($sqlX);
while($rowX = $db->fetchByAssoc($resX)){

	echo "<br>". $rowX["id"];
	$recordXid = $rowX["id"];

	//$focusX = BeanFactory::getBean('Notifications', $recordXid, array('disable_row_level_security' => true));
	//$focusX->mark_deleted();
	//$focusX->save();

	//$focusX = new Notification();
	//$focusX->disable_row_level_security = true;
	//$focusX->retrieve($rowX["id"]);
	//$focusX->mark_deleted();
	//$focusX->save();

}

