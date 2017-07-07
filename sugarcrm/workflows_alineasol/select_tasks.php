<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 16.02.17
 * Time: 14:09
 */


if (!defined('sugarEntry')) define('sugarEntry', true);
//change directories to where this file is located.
#define('ENTRY_POINT_TYPE', 'api');
//require_once('include/entryPoint.php');
require_once('include/entryPoint.php');

header("Content-Type: text/html; charset=utf-8");
#header("Content-Type: text/plain; charset=utf-8");
#header("Content-Type: text/html; charset=8859-1");


global $db;
global $sugar_config;

$sql = "SELECT DISTINCT
tasks.id AS TID,
tasks.name AS TName,
DATE_FORMAT(tasks.date_due,'%Y-%m-%d') AS TDateDue,
tasks.status AS TStatus,
tasks.parent_type AS TPType,
tasks.parent_id AS TPID,
(SELECT CONCAT(UCASE(LEFT(user_name,1)),SUBSTRING(user_name,2)) FROM users WHERE users.id = tasks.assigned_user_id LIMIT 1) AS UName,
tasks.assigned_user_id AS UAssigId
FROM tasks 
WHERE tasks.status NOT IN ('Completed','Deferred')
AND ( DATEDIFF(DATE_FORMAT(tasks.date_due,'%Y-%m-%d'),NOW()) < 0  ) 
AND tasks.assigned_user_id IN ('g2681e2f-00f7-e186-6ce9-541311c9f7ba')
ORDER BY tasks.date_due DESC
LIMIT 1200
";

$res = $db->query($sql);
while ($row = $db->fetchByAssoc($res)) {
	//	 do something
}



