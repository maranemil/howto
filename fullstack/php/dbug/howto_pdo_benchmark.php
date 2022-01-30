<?php /** @noinspection DuplicatedCode */
/** @noinspection SqlDialectInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection ForgottenDebugOutputInspection */
/** @noinspection PhpUndefinedVariableInspection */
/*
---------------------------------------------------------------------------------------
PDO benchmark
https://gist.github.com/stephen-hill/5508483
---------------------------------------------------------------------------------------
single row results:

PDO::FETCH_ASSOC - 936 ms
PDO::FETCH_BOTH - 948 ms
PDO::FETCH_NUM - 1,184 ms
PDO::FETCH_OBJ - 1,272 ms
PDO::FETCH_LAZY - 1,276 ms

For large data sets:

PDO::FETCH_LAZY - 5,490 ms
PDO::FETCH_NUM - 8,818 ms
PDO::FETCH_ASSOC- 10,220 ms
PDO::FETCH_BOTH - 11,359 ms
PDO::FETCH_OBJ - 14,027 ms

---------------------------------------------------------------------------------------
https://gonzalo123.com/2011/03/28/performance-analysis-fetching-data-with-pdo-and-php/
http://www.dragonbe.com/2015/07/speeding-up-database-calls-with-pdo-and.html

Use PDOStatement::fetchAll() to retrieve all data in a single go
Use PDOSTatement::fetch() to retrieve a single row per iteration
*/

$pdo = new PDO(
    $config['db']['dsn'],
    $config['db']['username'],
    $config['db']['password']
);

$sql = 'SELECT * FROM `gen_contact` ORDER BY `contact_modified` DESC';

$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

echo 'Getting the contacts that changed the last 3 months' . PHP_EOL;
foreach ($data as $row) {
    $dt = new DateTime('2015-04-01 00:00:00');
    if ($dt->format('Y-m-d') . '00:00:00' < $row->contact_modified) {
        echo sprintf(
                '%s (%s)| modified %s',
                $row->contact_name,
                $row->contact_email,
                $row->contact_modified
            ) . PHP_EOL;
    }
}


// ~ ~ ~

// Example with fetch
error_reporting(-1);
$time = microtime(TRUE);
$mem = memory_get_usage();

$dbh = new PDO('pgsql:dbname=mydb;host=localhost', 'username', 'password');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare('SELECT * FROM tableName limit 10000');
$stmt->execute();

$i = 0;
while ($row = $stmt->fetch()) {
    $i++;
}
echo '<h1>fetch()</h1>';
echo ' <strong>{$i} </strong> ';
print_r(array('memory' => (memory_get_usage() - $mem) / (1024 * 1024), 'seconds' => microtime(TRUE) - $time));

// ~ ~ ~

// Example with fetchAll
error_reporting(-1);
$time = microtime(TRUE);
$mem = memory_get_usage();

$dbh = new PDO('pgsql:dbname=mydb;host=localhost', 'username', 'password');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare('SELECT * FROM tableName limit 10000');
$stmt->execute();

$i = 0;
$data = $stmt->fetchAll();
foreach ($data as $row) {
    $i++;
}

echo '<h1>fetchAll()</h1> ';
echo '<strong>{$i}</strong> ';
print_r(array('memory' => (memory_get_usage() - $mem) / (1024 * 1024), 'seconds' => microtime(TRUE) - $time));

// ~ ~ ~
/*
fetchAll: [memory] => 31.305999755859
fetch: [memory] => 0.002532958984375
*/
// ~ ~ ~

/*
http://php.net/manual/de/pdostatement.fetchall.php
http://php.net/manual/de/pdostatement.fetchall.php
http://php.net/manual/en/function.array-keys.php
*/

// $_DB is my PDO class instance.
$tStart = microtime(true);
$q = $_DB->prepare('SELECT id FROM ... WHERE ... LIMIT 1000');
$q->execute($aArgs);
var_dump(round(microtime(true) - $tStart, 5));
$aIDsFiltered = $q->fetchAll(PDO::FETCH_COLUMN, 0);
var_dump(round(microtime(true) - $tStart, 5));
exit;

/*
This outputs:

float(0.0612)
float(2.58708)
*/

$sth = $dbh->prepare("SELECT name, colour FROM fruit");
$sth->execute();

/* Fetch all of the values of the first column */
$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
var_dump($result);

