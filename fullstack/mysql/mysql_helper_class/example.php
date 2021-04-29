<?php
# test
# https://codeshack.io/super-fast-php-mysql-database-class/

include_once "db.php";

$dbhost = 'localhost';
$dbuser = 'dbuser';
$dbpass = 'dbpass';
$dbname = 'todo';

$db = new db($dbhost, $dbuser, $dbpass, $dbname) or die("Cannot connect to ". $dbname);

$strTable      = 'posts';
$strSQL        = "SELECT * FROM " . $strTable;

$rows = $db->query($strSQL)->fetchAll();
foreach ($rows as $row) {
    // do here something
}


