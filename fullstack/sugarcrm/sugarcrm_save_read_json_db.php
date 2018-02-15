<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 18.06.15
 * Time: 14:57
 */

// Prepare SQL as Text to be saved in DB
$prepareSQL = str_replace("&#039;","'",$row['sqlquery_text']);

// Save Json in DB
$result = $db->query(trim($prepareSQL),true);
$rowsJsonData = array();
while($rowx = $db->fetchByAssoc($result)) {
    $rowsJsonData[] = $rowx;
}
$JSONDataSQLReport = json_encode($rowsJsonData);

// Read Json Data from DB
$jsonData = (string) html_entity_decode($sqlJsonField); // strval  (string)
$phpStdbjData = (array) json_decode($jsonData,true);