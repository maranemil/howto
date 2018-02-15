<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 12.05.15
 * Time: 13:38
 */


/////////////////////////////////////////////////////
//
// Entry Point
//
/////////////////////////////////////////////////////

if (!defined('sugarEntry')) define('sugarEntry', true);
define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');

global $db;

$arTeamsData = array();
$sqlQ = "SELECT * FROM test_table_where_teams_are_set";
$res = $db->query($sqlQ);
while($row = $db->fetchByAssoc($res)){
    $arTeamsData[$row["team_id"]] = array(
        "team_id"       => $row["team_id"],
        "team_set_id"   => $row["team_set_id"],
    );
}

//print "<pre>"; print_r($arTeamsData); print "</pre>"; die();

/////////////////////////////////////////////////////
//
// Test Update Relations Teams
//
/////////////////////////////////////////////////////

require_once('include/utils.php');
//$newID = create_guid();

foreach($arTeamsData as $entry){
    $ransID = create_guid();

    $sqlInsTST = "INSERT INTO team_sets_teams (id, team_set_id, team_id, date_modified, deleted)
      VALUES ('".$ransID."', '".$entry["team_set_id"]."', '".$entry["team_id"]."', '".date("Y-m-d H:i:s")."', 0);";
    $db->query($sqlInsTST );

}

$db->query("TRUNCATE TABLE team_sets_teams");
$db->query("TRUNCATE TABLE team_sets");

foreach($arTeamsData as $entry){
    $ransID = create_guid();

    $sqlInsTST = "INSERT INTO team_sets_teams (id, team_set_id, team_id, date_modified, deleted)
      VALUES ('".$ransID."', '".$entry["team_set_id"]."', '".$entry["team_id"]."', '".date("Y-m-d H:i:s")."', 0);";
    $db->query($sqlInsTST );


    $sqlInTS = "INSERT INTO team_sets (id, name, team_md5, team_count, date_modified, deleted, created_by)
    VALUES
    ('".$entry["team_set_id"]."', '".md5($entry["team_id"])."', '".md5($entry["team_id"])."', 1, '".date("Y-m-d H:i:s")."', 0, '1');";
    $db->query($sqlInTS );

}

