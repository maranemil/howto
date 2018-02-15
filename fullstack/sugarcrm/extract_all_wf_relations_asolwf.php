<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 23.11.15
 * Time: 11:48
 */


#############################################
##
## AlineaSol Extract all WF Info in Table ...
##
#############################################

//if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
if (!defined('sugarEntry') || !sugarEntry) define('sugarEntry', TRUE);

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

header("Content-Type: text/html; charset=utf-8");
//header("Content-Type: text/html; charset=8859-1");
require_once('sugar_version.php');
require_once('include/utils.php');
require_once('include/entryPoint.php');

global $db;

/**
 * Print All Asol WF in Table Format
 */

$sql ='SELECT
ap.name as APNAME,
ae.name as AENAME,
aa.name as AANAME,
ast.name as ASTNAME,

ast.description as ASTDESC,
ast.task_type as ASTTYPE,
ast.task_implementation as ASTFLOW

FROM asol_process as ap

LEFT JOIN asol_proces_asol_events_c as apae ON ap.id = apae.asol_proce6f14process_ida
LEFT JOIN asol_events as ae ON ae.id = apae.asol_procea8ca_events_idb

LEFT JOIN asol_eventssol_activity_c as aeac ON aeac.asol_event87f4_events_ida = ae.id
LEFT JOIN asol_activity as aa ON aa.id = aeac.asol_event8042ctivity_idb

LEFT JOIN asol_activity_asol_task_c as aaat ON aaat.asol_activ5b86ctivity_ida = aa.id
LEFT JOIN asol_task as ast ON aaat.asol_activf613ol_task_idb = ast.id

ORDER BY ap.name, aa.name
LIMIT 1125';

$res = $db->query($sql);
$deLim = ";"; // delimiter

echo '<table width="90%" cellpadding=2 cellspacing=2>';

while($row = $db->fetchByAssoc($res)){

	echo "<tr> ";
	echo '<td width="21%">'.$row["APNAME"].$deLim."</td>";
	echo '<td width="10%">'.$row["AENAME"].$deLim."</td>";
	echo '<td width="10%">'.$row["AANAME"].$deLim."</td>";
	echo '<td width="10%">'.$row["ASTNAME"].$deLim."</td>";
	echo '<td width="10%">'.$row["ASTDESC"].$deLim."</td>";
	echo '<td width="10%">'.$row["ASTTYPE"].$deLim."</td>";

	echo getConditions($row["ASTFLOW"]);
	//echo '<td width="10%">'.$row["ASTFLOW"]."</td>";
	echo "</tr> ";

}
echo "</table>";


function getConditions($conditions){

	global $deLim;
	$conditions = str_replace(array('Accounts$','{mod}','{relationships}'),"",$conditions);
	$conditions_array = explode('${pipe}', $conditions);
	//print "<pre>"; print_r($conditions_array);

	$info = "";
	foreach ($conditions_array as $keyC => $condition) {
		$condition_array = explode('${dp}', $condition);

		//print "<pre>"; print_r($condition_array);

		$typemod = str_replace("$","",$condition_array[7]);
		$info .= '<td width="5%">'.$typemod.$deLim.' </td>';
		$itemAr = explode('${comma}',$condition_array[1]);
		$name = str_replace(array("%20")," ",$itemAr[1]);
		$info .= '<td width="17%">'.utf8_encode(urldecode($name)).$deLim.' </td>';

	}

	return $info;
}