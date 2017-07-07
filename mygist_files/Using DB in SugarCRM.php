<?php

///////////////////////////////////////////////////////////////
//
// Using DB in SugarCRM
//
///////////////////////////////////////////////////////////////

global $db;
$db = DBManagerFactory::getInstance();

$sql = "SELECT your_qurey_here";
$res = $db->query($sql);
$row = $db->fetchByAssoc($res);
$cnt = $db->getRowCount($res); 