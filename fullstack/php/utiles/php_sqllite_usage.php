<?php
/**
 * Created by PhpStorm.
 * User: sublime
 * Date: 28.02.16
 * Time: 19:58
 */

$db = new SQLite3('mysqlitedb.db');
$db->exec('CREATE TABLE foo (bar STRING)');
$db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");
$result = $db->query('SELECT bar FROM foo');
var_dump($result->fetchArray());