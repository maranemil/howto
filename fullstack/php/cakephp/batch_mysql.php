<?php

// https://www.a2hosting.com/kb/developer-corner/mysql/connect-to-mysql-using-php
// https://www.cyberciti.biz/faq/how-to-connect-to-my-mysql-database-server-using-command-line-and-php/
// https://www.thegeekstuff.com/2017/05/php-mysql-connect/

// https://arjunphp.com/creating-restful-api-slim-framework/
// https://www.phpflow.com/php/create-simple-rest-api-using-slim-framework/
// https://gist.github.com/odan/d2b889c350aa2ea0ff8e5ca93ce588a2

// https://www.w3schools.com/php/func_mysqli_fetch_array.asp
// https://www.w3schools.com/php/php_ref_mysqli.asp

// https://www.w3schools.com/sql/func_mysql_now.asp
// https://www.w3schools.com/sql/func_sqlserver_current_timestamp.asp

// php -c /etc/php5/cli/php.ini -nf script.php

/*
$mysqli = new mysqli("localhost", "username", "password", "dbname");
$result = $mysqli->query("SELECT lastname FROM employees");
while ($row = mysqli_fetch_array($result)){
echo $row["employees"].PHP_EOL;
}
 */

/*
$myPDO = new PDO('mysql:host=localhost;dbname=dbname', 'username', 'password');
$myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $myPDO->query("SELECT lastname FROM employees");
 */

/*
mysql_connect('localhost','username','password');
mysql_select_db("dbname");
$result = mysql_query('SELECT lastname FROM employees');
 */

$link = mysqli_connect("localhost", "my_user", "my_password", "my_db");
// did we connected?
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
// run some query
$query = "SELECT * FROM table";
$result = mysqli_query($query);
while ($line = mysqli_fetch_array($result)) {
    foreach ($line as $value) {
        print "$value\n";
    }
}
mysqli_close($link);
